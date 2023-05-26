<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Controllers\Admin\EspeciesController;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Especies Controller
 */
class ModeloController extends Controller
{
    protected $permisos = [];
    protected $responseFactory;
    protected $guard;


    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
        $this->permisos = getPermisos($this->className($this));
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
    }


    /**
     * Muestra la vista principal
     */
    public function index($request, $response)
    {
        $model = new TableModel;
        $model->setTable("ma_configuracion");
        $model->setId("idconfig");

        $encode_data = $model->first();
        $decode_data = json_decode($encode_data['valor'], true);

        $model->emptyQuery();
        $model->setTable("ma_entrenamiento");
        $model->setId("identrenamientos");
        $ma_entrenamiento = $model->first();

        $model->emptyQuery();
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");
        $ma_especies_1 = $model->where("es_status", "1")->get();

        // dep([$decode_data, $ma_entrenamiento],1);

        return $this->render($response, 'App.Ia.Modelo', array_merge([
            'titulo_web' => 'Especies',
            'url' => $request->getUri()->getPath(),
            'permisos' => $this->permisos,
            'js' => ['js/app/nw_entrenamiento.js'],
            'tk' => [
                'name' => $this->guard->getTokenNameKey(),
                'value' => $this->guard->getTokenValueKey(),
                'key' => $this->guard->generateToken(),
            ]
        ], $decode_data, ["especies" => count($ma_especies_1)]));
    }


    /**
     * Lista los datos de la tabla
     */
    public function list($request, $response)
    {
        $model = new TableModel;
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");

        $arrData = $model->orderBy("idespecie", "DESC")->get();
        $data = [];
        $num = 0;

        for ($i = 0; $i < count($arrData); $i++) {

            $btnDelete = "";
            $btnEdit = "";
            $num++;

            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<a class="dropdown-item" href="javascript:fntDel(' . $arrData[$i]['idespecie'] . ');"><i class="bx bx-trash me-1"></i> Eliminar</a>';
            }

            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<a class="dropdown-item" href="javascript:fntEdit(' . $arrData[$i]['idespecie'] . ');"><i class="bx bx-edit-alt me-1"></i> Editar</a>';
            }

            $arrData[$i]['options'] = '<div class="d-flex flex-row"><div class="ms-3 dropdown"><button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu">' . $btnEdit . $btnDelete . '</div></div></div>';
        }
        return $this->respondWithJson($response, $arrData);
    }


    /**
     * Metodo para guardar nuevo registro
     */
    public function store($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        $data['files'] = $_FILES;
        // return $this->respondWithJson($response, $data);

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        // Ejecutar el archivo Python y pasarle las variables
        $command = escapeshellcmd('python ' . __DIR__ . '/ia/ex.py ' . $data['files']['photo']['tmp_name']);
        $output = shell_exec($command);
        return $this->respondWithSuccess($response, $output);

        $msg = "Error al guardar los datos";

        return $this->respondWithError($response, $msg);
    }

    /**
     * Metodo para genenerar nuevos datos de entrenamiento
     */
    public function generarDatosEntrenamiento($request, $response)
    {
        // $data = $this->sanitize($request->getParsedBody());

        /* */
        $model = new TableModel;
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");

        $model2 = new TableModel;
        $model2->setTable("ma_configuracion");
        $model2->setId("idconfig");

        // configuraciones
        $textData = $model2->first();
        $configData = json_decode($textData['valor'], true);

        // lista de especies
        $arrData = $model->where("es_status", "1")->orderBy("es_nombre_cientifico", "ASC")->get();

        $arrPy = [];
        $total = 0;

        for ($i = 0; $i < count($arrData); $i++) {
            // contar las imagenes de cada especie
            $carpeta = $configData["carpeta_img_entrenamiento"] . "/" . urls_amigables($arrData[$i]["es_nombre_cientifico"]);
            $total_especie = $this->contarImagenes($carpeta);
            $total += $total_especie;
            $arrPy[] = $total_especie . " = " . $arrData[$i]["es_nombre_cientifico"];
        }

        // veriricar si existe el directorio
        if (!file_exists($configData["ruta_datos_entrenamiento"])) {
            mkdir($configData["ruta_datos_entrenamiento"], 0777, true);
        }

        $archivo = $configData["ruta_datos_entrenamiento"] . '/' . $configData["nombre_datos_entrenamiento"] . '-' . date('Ymdhis') . '.txt';
        $manejador = fopen($archivo, "w");
        fwrite($manejador, json_encode($arrPy));
        fclose($manejador);
        /* */

        // crear labels
        // $jsonData = json_encode($arrPy);
        $command = escapeshellcmd(
            'python ' . __DIR__ . '/entrenamiento/label.py '
                . $configData["ruta_datos_entrenamiento"] . ' '
                . $configData["nombre_datos_entrenamiento"] . ' '
                . $archivo
                // . $jsonData
        );
        $output = shell_exec($command);
        // dep($output, 1);
        $output = json_decode($output, true);

        if (!$output["status"]) {
            $msg = "Error al generar las etiquetas de entrenamiento";
            return $this->respondWithError($response, $msg);
        }

        // crear imagenes
        $command = escapeshellcmd(
            'python ' . __DIR__ . '/entrenamiento/img.py '
                . $configData["carpeta_img_entrenamiento"] . ' '
                . $configData["ruta_datos_entrenamiento"] . ' '
                . $configData["nombre_datos_entrenamiento"] . ' '
        );
        $output2 = shell_exec($command);
        $output2 = json_decode($output2, true);
        if (!$output2["status"]) {
            $msg = "Error al generar las imagenes de entrenamiento";
            return $this->respondWithError($response, $msg);
        }

        $model3 = new TableModel;
        $model3->setTable("ma_entrenamiento");
        $model3->setId("identrenamiento");

        $rq = $model3->create([
            // "ent_fecha" => date("Y-m-d H:i:s"),
            "ent_ruta_datos_generados" => json_encode([$output["npy"], $output2["npy"]]),
            "ent_nombre_datos_generados" => json_encode([$output["name"], $output2["name"]]),
            "ent_total_imagenes" => $total,
            "ent_descripcion" => "",
            "ent_diccionario" => $output["dicc"],
            // "ent_default" => "0"
        ]);
        $model->query("UPDATE ma_entrenamiento SET ent_default = 0 WHERE identrenamiento != " . $rq["identrenamiento"]);
        if ($rq) {
            $msg = "Datos de entrenamiento generados correctamente";
            return $this->respondWithSuccess($response, $msg);
        }

        $msg = "Error al guardar los datos";
        return $this->respondWithError($response, $msg);
    }


    /**
     * Metodo para verificar los datos
     */
    public function validar($data)
    {
        if (empty($data['idgenero'])) {
            return false;
        }
        if (empty($data['es_nombre_cientifico'])) {
            return false;
        }
        if (empty($data['es_nombre_comun'])) {
            return false;
        }
        // if (empty($data['es_habitad'])) {
        // 	return false;
        // }
        // if (empty($data['es_alimentacion'])) {
        // 	return false;
        // }
        // if (empty($data['es_plantas_hospederas'])) {
        // 	return false;
        // }
        // if (empty($data['es_tiempo_de_vida'])) {
        // 	return false;
        // }
        // if (empty($data['es_imagen_url'])) {
        // 	return false;
        // }
        // if (empty($data['es_date'])) {
        // 	return false;
        // }
        return true;
    }


    /**
     * Metodo para buscar un registro por el id
     */
    public function search($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        $errors = $this->validarSearch($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");

        $rq = $model->find($data['idespecie']);
        if (!empty($rq)) {
            return $this->respondWithJson($response, ["status" => true, "data" => $rq]);
        }

        $msg = "No se encontraron datos";
        return $this->respondWithError($response, $msg);
    }


    /**
     * Metodo para verificar el campo de busqueda
     */
    public function validarSearch($data)
    {
        if (empty($data['idespecie'])) {
            return false;
        }
        return true;
    }


    /**
     * Metodo para actualizar registro
     */
    public function update($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        $errors = $this->validarUpdate($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");

        /*
		$existe = $model->where("field", "LIKE", $data['field'])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}
		*/

        $rq = $model->update($data['idespecie'], [
            'idgenero' => $data['idgenero'],
            'es_nombre_cientifico' => $data['es_nombre_cientifico'],
            'es_nombre_comun' => $data['es_nombre_comun'],
            'es_habitad' => $data['es_habitad'],
            'es_alimentacion' => $data['es_alimentacion'],
            'es_plantas_hospederas' => $data['es_plantas_hospederas'],
            'es_tiempo_de_vida' => $data['es_tiempo_de_vida'],
            'es_imagen_url' => $data['es_imagen_url'],
            'es_date' => $data['es_date'],
        ]);

        if (!empty($rq)) {
            $msg = "Datos actualizados";
            return $this->respondWithSuccess($response, $msg);
        }

        $msg = "Error al guardar los datos";

        return $this->respondWithJson($response, $msg);
    }


    /**
     * Metodo para verificar los datos por actualizar
     */
    public function validarUpdate($data)
    {
        if (empty($data['idespecie'])) {
            return false;
        }
        if (empty($data['idgenero'])) {
            return false;
        }
        if (empty($data['es_nombre_cientifico'])) {
            return false;
        }
        if (empty($data['es_nombre_comun'])) {
            return false;
        }
        if (empty($data['es_habitad'])) {
            return false;
        }
        if (empty($data['es_alimentacion'])) {
            return false;
        }
        if (empty($data['es_plantas_hospederas'])) {
            return false;
        }
        if (empty($data['es_tiempo_de_vida'])) {
            return false;
        }
        if (empty($data['es_imagen_url'])) {
            return false;
        }
        if (empty($data['es_date'])) {
            return false;
        }
        return true;
    }


    /**
     * Metodo para eliminar registro por id
     */
    public function delete($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        if (empty($data["idespecie"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new TableModel;
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");

        $rq = $model->find($data['idespecie']);
        if (!empty($rq)) {
            $rq = $model->delete($data["idespecie"]);
            if (!empty($rq)) {
                $msg = "Datos eliminados correctamente";
                return $this->respondWithSuccess($response, $msg);
            }
        }

        $msg = "Error al eliminar los datos";
        return $this->respondWithError($response, $msg);
    }

    public function imagenes($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        $model = new TableModel;
        $model->setTable("ma_configuracion");
        $model->setId("idconfig");

        $textdata = $model->first();
        $arrData = json_decode($textdata['valor'], true);

        $arrData["carpeta_img_entrenamiento"] = $data["carpeta_img_entrenamiento"];

        $rq = $model->update($textdata['idconfig'], [
            'valor' => json_encode($arrData),
        ]);

        $msg = (!empty($rq)) ? "Datos actualizados" : "Error al guardar los datos";
        return (!empty($rq)) ? $this->respondWithSuccess($response, $msg) : $this->respondWithError($response, $msg);
    }

    public function especies($request, $response)
    {
        $model = new TableModel;
        $model->setTable("ma_especies_1");
        $model->setId("idespecie");

        $model2 = new TableModel;
        $model2->setTable("ma_configuracion");
        $model2->setId("idconfig");

        // configuraciones
        $textData = $model2->first();
        $configData = json_decode($textData['valor'], true);

        // lista de especies
        $arrData = $model->where("es_status", "1")->orderBy("idespecie", "DESC")->get();


        for ($i = 0; $i < count($arrData); $i++) {
            // contar las imagenes de cada especie

            $carpeta = $configData["carpeta_img_entrenamiento"] . "/" . urls_amigables($arrData[$i]["es_nombre_comun"]);
            $arrData[$i]["total_imagenes"] = $this->contarImagenes($carpeta);
            $arrData[$i]["ruta"] = $carpeta;
        }
        return $this->respondWithJson($response, $arrData);
    }

    private function contarImagenes($carpeta)
    {
        $total = 0;
        if (is_dir($carpeta)) {
            $files = scandir($carpeta);
            foreach ($files as $file) {
                if (is_file($carpeta . "/" . $file)) {
                    $total++;
                }
            }
        }
        return $total;
    }

    public function pathDatosEntre($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        $model = new TableModel;
        $model->setTable("ma_configuracion");
        $model->setId("idconfig");

        $textdata = $model->first();
        $arrData = json_decode($textdata['valor'], true);

        $arrData["ruta_datos_entrenamiento"] = $data["ruta_datos_entrenamiento"];

        $rq = $model->update($textdata['idconfig'], [
            'valor' => json_encode($arrData),
        ]);

        $msg = (!empty($rq)) ? "Datos actualizados" : "Error al guardar los datos";
        return (!empty($rq)) ? $this->respondWithSuccess($response, $msg) : $this->respondWithError($response, $msg);
    }

    public function nombreDatosEntre($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        $model = new TableModel;
        $model->setTable("ma_configuracion");
        $model->setId("idconfig");

        $textdata = $model->first();
        $arrData = json_decode($textdata['valor'], true);

        $arrData["nombre_datos_entrenamiento"] = urls_amigables($data["nombre_datos_entrenamiento"]);

        $rq = $model->update($textdata['idconfig'], [
            'valor' => json_encode($arrData),
        ]);

        $msg = (!empty($rq)) ? "Datos actualizados" : "Error al guardar los datos";
        return (!empty($rq)) ? $this->respondWithSuccess($response, $msg) : $this->respondWithError($response, $msg);
    }
}
