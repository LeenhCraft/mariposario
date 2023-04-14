<?php

namespace App\Http;

class Imagenes
{
    public function nombre($img)
    {
        $arrUrl = explode(".", $img['name']);
        return $arrUrl[0];
    }

    public function extension($img)
    {
        return pathinfo($img['name'], PATHINFO_EXTENSION);
    }

    public function validarImagen($foto)
    {
        $coderror_fichero = [
            0 => ["error" => 0, 'valor' => 'No hay error, fichero subido con éxito.'],
            1 => ['error' => 1, 'valor' => 'El fichero subido excede la directiva upload_max_filesize de php.ini.'],
            2 => ['error' => 2, 'valor' => 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.'],
            3 => ['error' => 3, 'valor' => 'El fichero fue sólo parcialmente subido.'],
            4 => ['error' => 4, 'valor' => 'No se subió ningún fichero.'],
            6 => ['error' => 6, 'valor' => 'Falta la carpeta temporal.'],
            7 => ['error' => 7, 'valor' => 'No se pudo escribir el fichero en el disco.'],
            8 => ['error' => 8, 'valor' => 'Una extensión de PHP detuvo la subida de ficheros.'],
        ];
        if ($foto['error'] == 0) {
            $formatos_permitidos =  array('jpg', 'jpeg', 'png', 'webp');
            $archivo = $foto['name'];
            // $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $extension = $this->extension($foto);
            if (in_array($extension, $formatos_permitidos)) {
                $return['text'] = 'Formato correcto';
                $return['status'] = true;
            } else {
                $return['text'] = 'El formato de la imagen no es valido.';
                $return['status'] = false;
            }
        } else {
            foreach ($coderror_fichero as $row) {
                if ($row['error'] == $foto['error']) {
                    $return['text'] = $row['valor'];
                    $return['status'] = false;
                }
            }
        }
        return $return;
    }

    public function convertirWebp($extension, $ruta, $destination, $quality = 50)
    {

        // $extension = pathinfo($ruta, PATHINFO_EXTENSION);
        if ($extension == 'jpeg' || $extension == 'jpg') {
            $image = imagecreatefromjpeg($ruta);
        } elseif ($extension == 'gif') {
            $image = imagecreatefromgif($ruta);
        } elseif ($extension == 'png') {
            $image = imagecreatefrompng($ruta);
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } elseif ($extension == 'webp') {
            $image = imagecreatefromwebp($ruta);
        }
        return imagewebp($image, $destination, $quality);
    }

    public function minificar($archivo)
    {
        // https://www.delftstack.com/es/howto/php/image-resizing-in-php/#imagescale-en-php
        if (!empty($archivo)) {
            list($ancho, $alto, $tipo) = getimagesize(__dir__ . '/../../Medios/Webp/' . $archivo);
            $imgVieja = $this->cargarImg($archivo, $tipo);
            $imgMinificada = $this->escalarImg(0.3, $imgVieja, $ancho, $alto, $archivo);
            if ($imgMinificada) {
                $return = ['status' => true, 'icon' => 'success', 'text' => 'Imagen minificada'];
            } else {
                $return = ['status' => false, 'icon' => 'warning', 'text' => 'Error al minificar la imagen'];
            }
            return $return;
        } else {
            return  ['status' => false, 'icon' => 'warning', 'text' => 'No se recibio la imagen'];
        }
        exit();
    }

    public function cargarImg($archivo, $tipo)
    {
        $archivo = __DIR__ . '/../../Medios/Webp/' . $archivo;
        if ($tipo == IMAGETYPE_JPEG) {
            $image = imagecreatefromjpeg($archivo);
        } elseif ($tipo == IMAGETYPE_JPEG2000) {
            $image = imagecreatefromjpeg($archivo);
        } elseif ($tipo == IMAGETYPE_PNG) {
            $image = imagecreatefrompng($archivo);
        } elseif ($tipo == IMAGETYPE_GIF) {
            $image = imagecreatefromgif($archivo);
        } elseif ($tipo == IMAGETYPE_WEBP) {
            $image = imagecreatefromwebp($archivo);
        }
        return $image;
    }

    public function escalarImg($escala, $img, $ancho, $alto, $nombreArchivo)
    {
        $nuevoAncho = $ancho * $escala;
        $nuevoAlto = $alto * $escala;
        return $this->redimensionarImg($nuevoAncho, $nuevoAlto, $img, $ancho, $alto, $nombreArchivo);
    }

    public function redimensionarImg($nuevoAncho, $nuevoAlto, $img, $width, $height, $nombreArchivo)
    {
        $image12 = __DIR__ . '/../../Medios/Mini/' . $nombreArchivo;
        $nuevaImg = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagecopyresampled($nuevaImg, $img, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $width, $height);
        return imagejpeg($nuevaImg, $image12);
    }

    // funcion para verificar el peso de la imagen
    function peso($archivo, $unidad = 'KB')
    {
        $tamaño = $archivo['size'];
        $tamaño_kb = $tamaño / 1024;
        $tamaño_mb = $tamaño_kb / 1024;

        switch ($unidad) {
            case 'KB':
                return number_format($tamaño_kb, 2) . ' KB';
                break;
            case 'MB':
                return number_format($tamaño_mb, 2) . ' MB';
                break;
            default:
                return $tamaño;
                break;
        }
    }

    public function moverImg($ruta, $destination)
    {
        if (move_uploaded_file($ruta, $destination)) {
            return true;
        } else {
            return false;
        }
    }
}
