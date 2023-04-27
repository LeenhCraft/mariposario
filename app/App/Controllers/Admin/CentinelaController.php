<?php 

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Centinela Controller
 */
class CentinelaController extends Controller
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
		return $this->render($response, 'App.Centinela.Centinela', [
			'titulo_web' => 'Centinela',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			'js' => ['js/app/nw_centinela.js'],
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
		$model->setTable("sis_centinela");
		$model->setId("idvisita");

		$arrData = $model->orderBy("idvisita", "DESC")->get();
		$data = [];
		$num = 0;

		for ($i = 0; $i < count($arrData); $i++) {

			$btnDelete = "";
			$btnEdit = "";
			$num++;

			if ($this->permisos['perm_d'] == 1) {
				$btnDelete = '<a class="dropdown-item" href="javascript:fntDel(' . $arrData[$i]['idvisita'] . ');"><i class="bx bx-trash me-1"></i> Eliminar</a>';
			}

			if ($this->permisos['perm_u'] == 1) {
				$btnEdit = '<a class="dropdown-item" href="javascript:fntEdit(' . $arrData[$i]['idvisita'] . ');"><i class="bx bx-edit-alt me-1"></i> Editar</a>';
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
		$model->setTable("sis_centinela");
		$model->setId("idvisita");

		/*
		$existe = $model->where("field", "LIKE", $data['field'])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}
		*/

		$rq = $model->create([
			'vis_cod' => $data['vis_cod'],
			'idwebusuario' => $data['idwebusuario'],
			'vis_ip' => $data['vis_ip'],
			'vis_agente' => $data['vis_agente'],
			'vis_method' => $data['vis_method'],
			'vis_url' => $data['vis_url'],
			'vis_fechahora' => $data['vis_fechahora'],
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
		if (empty($data['vis_cod'])) {
			return false;
		}
		if (empty($data['idwebusuario'])) {
			return false;
		}
		if (empty($data['vis_ip'])) {
			return false;
		}
		if (empty($data['vis_agente'])) {
			return false;
		}
		if (empty($data['vis_method'])) {
			return false;
		}
		if (empty($data['vis_url'])) {
			return false;
		}
		if (empty($data['vis_fechahora'])) {
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
		$model->setTable("sis_centinela");
		$model->setId("idvisita");

		$rq = $model->find($data['idvisita']);
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
		if (empty($data['idvisita'])) {
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
		$model->setTable("sis_centinela");
		$model->setId("idvisita");

		/*
		$existe = $model->where("field", "LIKE", $data['field'])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}
		*/

		$rq = $model->update($data['idvisita'],[
			'vis_cod' => $data['vis_cod'],
			'idwebusuario' => $data['idwebusuario'],
			'vis_ip' => $data['vis_ip'],
			'vis_agente' => $data['vis_agente'],
			'vis_method' => $data['vis_method'],
			'vis_url' => $data['vis_url'],
			'vis_fechahora' => $data['vis_fechahora'],
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
		if (empty($data['idvisita'])) {
			return false;
		}
		if (empty($data['vis_cod'])) {
			return false;
		}
		if (empty($data['idwebusuario'])) {
			return false;
		}
		if (empty($data['vis_ip'])) {
			return false;
		}
		if (empty($data['vis_agente'])) {
			return false;
		}
		if (empty($data['vis_method'])) {
			return false;
		}
		if (empty($data['vis_url'])) {
			return false;
		}
		if (empty($data['vis_fechahora'])) {
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

		if (empty($data["idvisita"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		$model = new TableModel;
		$model->setTable("sis_centinela");
		$model->setId("idvisita");

		$rq = $model->find($data['idvisita']);
		if (!empty($rq)) {
			$rq = $model->delete($data["idvisita"]);
			if (!empty($rq)) {
				$msg = "Datos eliminados correctamente";
				return $this->respondWithSuccess($response, $msg);
			}
		}

		$msg = "Error al eliminar los datos";
		return $this->respondWithError($response, $msg);
	}
}
