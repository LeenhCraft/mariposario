<?php

namespace App\Complements;

use App\Http\Imagenes;
use App\Models\TableModel;

class ImageClass
{
    public function verificar($photo)
    {
        $class = new Imagenes;
        $validate = $class->validarImagen($photo);
        if ($validate['status']) {
            return true;
        }
        return false;
    }

    public function cargarImagen($photo, $data = [], $type = "img", $isArray = false)
    {
        $class = new Imagenes;
        $validate = $class->validarImagen($photo);
        $peso = $class->peso($photo, "MB");
        if ($peso > 5) {
            $validate['text'] = "El peso de la imagen no debe ser mayor a 5 MB";
            $validate['status'] = false;
        }
        if ($validate['status']) {
            // meter a la bd
            $model = new TableModel;
            $model->setTable("bib_imagenes");
            $model->setId("idimagen");

            $nombre = $data['lib_slug'];
            $extension = $class->extension($photo);
            $ruta = $photo['tmp_name'];
            $destination = $type . "/" . $nombre . "." . $extension;

            $dataImg = $model->where("img_propietario", $data['idlibro'])->where("img_type", "LIB::MIN")->first();

            if (empty($dataImg)) {
                $rq = $model->create([
                    "idgalery" => '0',
                    "img_externo" => '0',
                    "img_url" => "/" . $destination,
                    "img_propietario" => $data['idlibro'],
                    "img_type" => 'LIB::MIN',
                ]);
            }

            if (!empty($dataImg)) {
                $this->eliminarFile($dataImg['img_url']);
                $rq = $model->update($dataImg['idimagen'], [
                    "idgalery" => '0',
                    "img_externo" => '0',
                    "img_url" => "/" . $destination,
                    "img_propietario" => $data['idlibro'],
                    "img_type" => 'LIB::MIN',
                ]);
            }
            $mover = $class->moverImg($ruta, $destination);

            $validate['text'] = ($mover) ? "\nImagen cargada correctamente" : "\nError al cargar la imagen";
            $validate['status'] = ($mover) ? true : false;
        }
        return $validate;
    }

    public function imagenExterna($url, $data)
    {
        if (empty($url)) {
            return ['status' => false, 'text' => 'No se ha enviado la url de la imagen'];
        }

        $url = filter_var($url, FILTER_SANITIZE_URL);

        $model = new TableModel;
        $model->setTable("bib_imagenes");
        $model->setId("idimagen");

        $dataImg = $model->where("img_propietario", $data['idlibro'])->where("img_type", "LIB::MIN")->first();

        $this->eliminarFile(trim($dataImg['img_url'], "/"));

        if (empty($dataImg)) {
            $img = $model->create([
                "idgalery" => '0',
                "img_externo" => '1',
                "img_url" => $url,
                "img_propietario" => $data['idlibro'],
                "img_type" => "LIB::MIN",
            ]);
        }

        if (!empty($dataImg)) {
            $img = $model->update($dataImg['idimagen'], [
                "idgalery" => '0',
                "img_externo" => '0',
                "img_url" => $url,
                "img_propietario" => $data['idlibro'],
                "img_type" => 'LIB::MIN',
            ]);
        }

        return ['status' => !empty($img), 'text' => !empty($img) ? 'Imagen cargada correctamente' : 'Error al cargar la imagen'];
    }


    public function eliminarFile($ruta = "")
    {
        if (file_exists($ruta)) {
            unlink($ruta);
            return ['status' => true, 'text' => 'Imagen eliminada correctamente'];
        }
        return ['status' => false, 'text' => 'Error al eliminar la imagen'];
    }

    public function getImage($idpropietario)
    {
        $model = new TableModel;
        $model->setTable("bib_imagenes");
        $model->setId("idimagen");
        $img = $model->where("img_propietario", $idpropietario)->where("img_type", "LIB::MIN")->first();
        if (!empty($img)) {
            return $img['img_url'];
        }
        return "/img/placeholder/woocommerce-placeholder-150x150.png";
    }

    // function mover_archivo($archivo, $ruta_destino, $crear_carpeta = false, $nombre_carpeta = '')
    // {
    //     // Obtener el nombre y la extensión del archivo
    //     $nombre_archivo = $archivo['name'];
    //     $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

    //     // Crear la carpeta si es necesario
    //     if ($crear_carpeta) {
    //         if (!empty($nombre_carpeta)) {
    //             $ruta_destino = $ruta_destino . '/' . $nombre_carpeta;
    //         }

    //         if (!is_dir($ruta_destino)) {
    //             mkdir($ruta_destino, 0777, true);
    //         }
    //     }

    //     // Generar un nombre de archivo único y mover el archivo a la ruta de destino
    //     $nuevo_nombre_archivo = uniqid('archivo_') . '.' . $extension;
    //     $ruta_completa_archivo = $ruta_destino . '/' . $nuevo_nombre_archivo;

    //     if (move_uploaded_file($archivo['tmp_name'], $ruta_completa_archivo)) {
    //         return $nuevo_nombre_archivo;
    //     } else {
    //         return false;
    //     }
    // }
}
