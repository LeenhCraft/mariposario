<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Familias Controller
 */
class FamiliasController extends Controller
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
		return $this->render($response, 'App.Familias.Familias', [
			'titulo_web' => 'Familias',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			'js' => ['js/app/nw_familias.js'],
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
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");

		$arrData = $model->join("ma_ordenes_1", "idorden")->orderBy("idfamilia", "DESC")->get();
		// dep($arrData,1);
		$data = [];
		$num = 0;

		for ($i = 0; $i < count($arrData); $i++) {

			$btnDelete = "";
			$btnEdit = "";
			$num++;

			if ($this->permisos['perm_d'] == 1) {
				$btnDelete = '<a class="dropdown-item" href="javascript:fntDel(' . $arrData[$i]['idfamilia'] . ');"><i class="bx bx-trash me-1"></i> Eliminar</a>';
			}

			if ($this->permisos['perm_u'] == 1) {
				$btnEdit = '<a class="dropdown-item" href="javascript:fntEdit(' . $arrData[$i]['idfamilia'] . ');"><i class="bx bx-edit-alt me-1"></i> Editar</a>';
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
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");

		$existe = $model->where("fam_nombre", "LIKE", $data['fam_nombre'])->where("idorden", $data["idorden"])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}

		$rq = $model->create([
			'idorden' => $data['idorden'],
			'fam_nombre' => $data['fam_nombre'],
			// 'fam_date' => $data['fam_date'],
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
		if (empty($data['idorden'])) {
			return false;
		}
		if (empty($data['fam_nombre'])) {
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
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");

		$rq = $model->find($data['idfamilia']);
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
		if (empty($data['idfamilia'])) {
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
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");

		$existe = $model->where("fam_nombre", "LIKE", $data['fam_nombre'])->where("idfamilia", "!=", $data["idfamilia"])->where("idorden", $data["idorden"])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}

		$rq = $model->update($data['idfamilia'], [
			'idorden' => $data['idorden'],
			'fam_nombre' => $data['fam_nombre'],
			// 'fam_date' => $data['fam_date'],
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
		if (empty($data['idfamilia'])) {
			return false;
		}
		if (empty($data['idorden'])) {
			return false;
		}
		if (empty($data['fam_nombre'])) {
			return false;
		}
		// if (empty($data['fam_date'])) {
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

		if (empty($data["idfamilia"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		$model = new TableModel;
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");

		$rq = $model->find($data['idfamilia']);
		if (!empty($rq)) {
			// consultar a la tabla ma_subfamilias_1 si existe algun registro con el idfamilia
			$model2 = new TableModel;
			$model2->setTable("ma_subfamilias_1");
			$model2->setId("idsubfamilia");
			$existe = $model2->where("idfamilia", "=", $data['idfamilia'])->first();
			if (!empty($existe)) {
				$msg = "No se puede eliminar el registro, existen subfamilias asociadas";
				return $this->respondWithError($response, $msg);
			}
			$rq = $model->delete($data["idfamilia"]);
			if (!empty($rq)) {
				$msg = "Datos eliminados correctamente";
				return $this->respondWithSuccess($response, $msg);
			}
		}

		$msg = "Error al eliminar los datos";
		return $this->respondWithError($response, $msg);
	}

	/**
	 * Lista de ordenes activos
	 */
	public function ordenes($request, $response)
	{
		$model = new TableModel;
		$model->setTable("ma_ordenes_1");
		$model->setId("idorden");
		return $this->respondWithJson($response, $model->orderBy("idorden", "DESC")->get());
	}
}
