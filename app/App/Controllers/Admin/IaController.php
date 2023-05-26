<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Especies Controller
 */
class IaController extends Controller
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
        return $this->render($response, 'App.Ia.Ia', [
            'titulo_web' => 'Especies',
            'url' => $request->getUri()->getPath(),
            'permisos' => $this->permisos,
            'js' => ['js/app/nw_ia.js'],
            'tk' => [
                'name' => $this->guard->getTokenNameKey(),
                'value' => $this->guard->getTokenValueKey(),
                'key' => $this->guard->generateToken(),
            ]
        ]);
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

        // veriricar que $data['files']['photo'] no este vacio
        if (empty($data['files']['photo']['tmp_name'])) {
            $msg = "Debe seleccionar una imagen";
            return $this->respondWithError($response, $msg);
        }

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable("ma_entrenamiento");
        $model->setId("identrenamiento");

        $model2 = new TableModel;
        $model2->setTable("ma_detalle_modelo");
        $model2->setId("iddetallemodelo");

        // configuraciones
        $arrModelo = $model2->where("det_default", 1)->first();
        if (empty($arrModelo)) {
            $msg = "No hay modelo entrenado, por favor entrene un modelo para continuar";
            return $this->respondWithError($response, $msg);
        }

        $diccionario = $model->where("identrenamiento", $arrModelo["identrenamiento"])->first();
        $diccionario = json_decode($diccionario['ent_diccionario'],true);
        // invertir los valores a que sean las llaves y las llaves los valores
        $diccionario = array_flip($diccionario);

        // dep($diccionario, 1);

        // Ejecutar el archivo Python y pasarle las variables
        $command = escapeshellcmd('python ' . __DIR__ . '/ia/ex.py ' . $data['files']['photo']['tmp_name'] . ' ' . $arrModelo["det_ruta"]);
        $output = shell_exec($command);
        $output = json_decode($output, true);
        $predic = $output["message"];

        // dep([$output, $diccionario], 1);

        // buscar el $output["message"] en el diccionario
        $especie = $diccionario[$predic];
        if (!array_key_exists($predic, $diccionario)) {
            $especie = "No se encontró la especie";
            return $this->respondWithError($response, $especie);
        }

        return $this->respondWithSuccess($response, "La especie es: " . $especie);


        // $msg = "Error al guardar los datos";
        // return $this->respondWithError($response, $msg);
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

    public function subordenes($request, $response)
    {
        $model = new TableModel;
        $model->setTable("ma_subordenes_1");
        $model->setId("idsuborden");

        return $this->respondWithJson($response, $model->orderBy("idsuborden", "DESC")->get());
    }

    public function familias($request, $response)
    {
        $data = ($request->getParsedBody());
        return $this->respondWithJson($response, $data);

        if (empty($data["id"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new TableModel;
        $model->setTable("ma_familias_1");
        $model->setId("idfamilia");

        return $this->respondWithJson($response, $model->where("idsuborden", $data["id"])->orderBy("idfamilia", "DESC")->get());
    }

    public function generos($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());

        if (empty($data["idespecie"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new TableModel;
        $model->setTable("ma_subordenes_1");
        $model->setId("idsuborden");

        return $this->respondWithJson($response, $model->orderBy("idsuborden", "DESC")->get());
    }
}
