<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Subordenes Controller
 */
class SubfamiliasController extends Controller
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
		return $this->render($response, 'App.Subfamilias.subfamilias', [
			'titulo_web' => 'Subfamilias',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			'js' => ['js/app/nw_subfamilias.js'],
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
		$model->setTable("ma_subfamilias_1");
		$model->setId("idsubfamilia");

		$arrData = $model->leftjoin("ma_familias_1", "idfamilia")->orderBy("idsubfamilia", "DESC")->get();
		$num = 0;

		for ($i = 0; $i < count($arrData); $i++) {

			$btnDelete = "";
			$btnEdit = "";
			$num++;

			if ($this->permisos['perm_d'] == 1) {
				$btnDelete = '<a class="dropdown-item" href="javascript:fntDel(' . $arrData[$i]['idsubfamilia'] . ');"><i class="bx bx-trash me-1"></i> Eliminar</a>';
			}

			if ($this->permisos['perm_u'] == 1) {
				$btnEdit = '<a class="dropdown-item" href="javascript:fntEdit(' . $arrData[$i]['idsubfamilia'] . ');"><i class="bx bx-edit-alt me-1"></i> Editar</a>';
			}

			$arrData[$i]['num'] = $num;
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
		// return $this->respondWithJson($response, $data);

		$validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
		if (!$validate) {
			$msg = "Error de validación, por favor recargue la página";
			return $this->respondWithError($response, $msg);
		}

		$errors = $this->validar($data);
		if (!$errors) {
			$msg = "Verifique los datos ingresados";
			return $this->respondWithError($response, $msg);
		}

		$model = new TableModel;
		$model->setTable("ma_subfamilias_1");
		$model->setId("idsubfamilia");

		$existe = $model->where("sub_nombre", "LIKE", $data['sub_nombre'])->where("idfamilia", $data["idfamilia"])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}

		$rq = $model->create([
			'idfamilia' => $data['idfamilia'],
			'sub_nombre' => $data['sub_nombre'],
			'sub_descripcion' => $data['sub_descripcion'],
		]);

		if (!empty($rq)) {
			$msg = "Datos guardados correctamente";
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
		if (empty($data['idfamilia'])) {
			return false;
		}
		if (empty($data['sub_nombre'])) {
			return false;
		}
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
		$model->setTable("ma_subfamilias_1");
		$model->setId("idsubfamilia");

		$rq = $model->find($data['idsubfamilia']);
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
		if (empty($data['idsubfamilia'])) {
			return false;
		}
		// validar si es numerico
		if (!is_numeric($data['idsubfamilia'])) {
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
		$model->setTable("ma_subfamilias_1");
		$model->setId("idsubfamilia");

		$existe = $model->where("sub_nombre", "LIKE", $data['sub_nombre'])->where("idsubfamilia", "!=", $data['idsubfamilia'])->where("idfamilia", $data["idfamilia"])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}

		$rq = $model->update($data['idsubfamilia'], [
			'idfamilia' => $data['idfamilia'],
			'sub_nombre' => $data['sub_nombre'],
			'sub_descripcion' => $data['sub_descripcion'],
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
		if (empty($data['idsubfamilia'])) {
			return false;
		}
		if (empty($data['idfamilia'])) {
			return false;
		}
		if (empty($data['sub_nombre'])) {
			return false;
		}
		// if (empty($data['sub_descripcion'])) {
		// 	return false;
		// }
		// if (empty($data['sub_date'])) {
		// 	return false;
		// }
		return true;
	}


	/**
	 * Metodo para eliminar registro por id
	 */
	public function delete($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		// return $this->respondWithJson($response, $data);

		if (empty($data["idsubfamilia"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		if (!is_numeric($data["idsubfamilia"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		$model = new TableModel;
		$model->setTable("ma_subfamilias_1");
		$model->setId("idsubfamilia");

		$rq = $model->find($data['idsubfamilia']);
		if (!empty($rq)) {
			$model2 = new TableModel;
			$model2->setTable("ma_generos_1");
			$model2->setId("idgenero");
			$existe = $model2->where("idsubfamilia", "=", $data['idsubfamilia'])->first();
			if (!empty($existe)) {
				$msg = "No se puede eliminar el registro, existen generos asociadas";
				return $this->respondWithError($response, $msg);
			}
			$rq = $model->delete($data["idsubfamilia"]);
			if (!empty($rq)) {
				$msg = "Datos eliminados correctamente";
				return $this->respondWithSuccess($response, $msg);
			}
		}

		$msg = "Error al eliminar los datos";
		return $this->respondWithError($response, $msg);
	}

	/**
	 * Lista de familias activas
	 */
	public function familias($request, $response)
	{
		$model = new TableModel;
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");
		return $this->respondWithJson($response, $model->orderBy("idfamilia", "DESC")->get());
	}
}
