<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Mpdf\Mpdf;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Historial Controller
 */
class ReportesController extends Controller
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
		/*
		$mpdf = new Mpdf();
		// iniciar alamcenamiento en buffer
		ob_start();
		// incluir el archivo de la vista
		$data = [
			'titulo_web' => 'Reportes',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			'css' => ['css/app/spinkit.css'],
			// 'js' => ['js/app/nw_historial.js'],
			'tk' => [
				'name' => $this->guard->getTokenNameKey(),
				'value' => $this->guard->getTokenValueKey(),
				'key' => $this->guard->generateToken(),
			]
		];
		include __DIR__ . '/../../../resources/views/App/Reportes/Reportes.php';
		// obtener el contenido del buffer
		$html = ob_get_clean();
		// escribir el contenido en el pdf
		$mpdf->WriteHTML($html);
		// $mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output('filename.pdf', "I");
		*/
		return $this->render($response, 'App.Reportes.Reportes', [
			'titulo_web' => 'Reportes',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			// 'css' => ['css/app/spinkit.css'],
			// 'js' => ['js/app/nw_historial.js'],
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
		$model->setTable("ma_historial_identificacion");
		$model->setId("idhistorial");

		$arrData = $model->orderBy("idhistorial", "DESC")->get();
		$data = [];
		$num = 0;

		for ($i = 0; $i < count($arrData); $i++) {

			$btnDelete = "";
			$btnEdit = "";
			$num++;

			if ($this->permisos['perm_d'] == 1) {
				$btnDelete = '<a class="dropdown-item" href="javascript:fntDel(' . $arrData[$i]['idhistorial'] . ');"><i class="bx bx-trash me-1"></i> Eliminar</a>';
			}

			if ($this->permisos['perm_u'] == 1) {
				$btnEdit = '<a class="dropdown-item" href="javascript:fntEdit(' . $arrData[$i]['idhistorial'] . ');"><i class="bx bx-edit-alt me-1"></i> Editar</a>';
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
		$model->setTable("ma_historial_identificacion");
		$model->setId("idhistorial");

		/*
		$existe = $model->where("field", "LIKE", $data['field'])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}
		*/

		$rq = $model->create([
			'iddetallemodelo' => $data['iddetallemodelo'],
			'his_tiempo' => $data['his_tiempo'],
			'his_inicio' => $data['his_inicio'],
			'his_fin' => $data['his_fin'],
			'his_index' => $data['his_index'],
			'his_prediccion' => $data['his_prediccion'],
			'his_fecha' => $data['his_fecha'],
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
		if (empty($data['iddetallemodelo'])) {
			return false;
		}
		if (empty($data['his_tiempo'])) {
			return false;
		}
		if (empty($data['his_inicio'])) {
			return false;
		}
		if (empty($data['his_fin'])) {
			return false;
		}
		if (empty($data['his_index'])) {
			return false;
		}
		if (empty($data['his_prediccion'])) {
			return false;
		}
		if (empty($data['his_fecha'])) {
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
		$model->setTable("ma_historial_identificacion");
		$model->setId("idhistorial");

		$rq = $model->find($data['idhistorial']);
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
		if (empty($data['idhistorial'])) {
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
		$model->setTable("ma_historial_identificacion");
		$model->setId("idhistorial");

		/*
		$existe = $model->where("field", "LIKE", $data['field'])->first();
		if (!empty($existe)) {
			$msg = "Ya tiene un usuario registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}
		*/

		$rq = $model->update($data['idhistorial'], [
			'iddetallemodelo' => $data['iddetallemodelo'],
			'his_tiempo' => $data['his_tiempo'],
			'his_inicio' => $data['his_inicio'],
			'his_fin' => $data['his_fin'],
			'his_index' => $data['his_index'],
			'his_prediccion' => $data['his_prediccion'],
			'his_fecha' => $data['his_fecha'],
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
		if (empty($data['idhistorial'])) {
			return false;
		}
		if (empty($data['iddetallemodelo'])) {
			return false;
		}
		if (empty($data['his_tiempo'])) {
			return false;
		}
		if (empty($data['his_inicio'])) {
			return false;
		}
		if (empty($data['his_fin'])) {
			return false;
		}
		if (empty($data['his_index'])) {
			return false;
		}
		if (empty($data['his_prediccion'])) {
			return false;
		}
		if (empty($data['his_fecha'])) {
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

		if (empty($data["idhistorial"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		$model = new TableModel;
		$model->setTable("ma_historial_identificacion");
		$model->setId("idhistorial");

		$rq = $model->find($data['idhistorial']);
		if (!empty($rq)) {
			$rq = $model->delete($data["idhistorial"]);
			if (!empty($rq)) {
				$msg = "Datos eliminados correctamente";
				return $this->respondWithSuccess($response, $msg);
			}
		}

		$msg = "Error al eliminar los datos";
		return $this->respondWithError($response, $msg);
	}
}
