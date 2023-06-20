<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Ordenes Controller
 */
class EntrenarController extends Controller
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

		$model2 = new TableModel;
		$model2->setTable("ma_detalle_modelo");
		$model2->setId("iddetallemodelo");

		$textdata = $model->first();
		$arrData = json_decode($textdata['valor'], true);

		$modelo_entrenado = $model2->where("det_default", "1")->first();

		return $this->render($response, 'App.IA.Entrenar', array_merge([
			'titulo_web' => 'Entrenar Modelo',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			'js' => ['js/app/nw_entrenar.js'],
			'tk' => [
				'name' => $this->guard->getTokenNameKey(),
				'value' => $this->guard->getTokenValueKey(),
				'key' => $this->guard->generateToken(),
			]
		], ["nombre_modelo" => $arrData['nombre_modelo'] ?? ""], ["ruta_modelo" => $modelo_entrenado['det_ruta'] ?? ""]));
	}

	/**
	 * Lista los datos de la tabla
	 */
	public function list($request, $response)
	{
		$model = new TableModel;
		$model->setTable("ma_detalle_modelo");
		$model->setId("iddetallemodelo");

		$model2 = new TableModel;
		$model2->setTable("ma_modelo");
		$model2->setId("idmodelo");

		// $arrData = $model->where("det_default", 1)->get();
		$arrData = $model->get();
		// dep($arrData,1);
		$arrModelo = [];

		$data = [];
		$act = "";

		for ($i = 0; $i < count($arrData); $i++) {
			if (!empty($arrData)) {
				$arrModelo = $model2->where("idmodelo", $arrData[$i]["idmodelo"])->first();
			}
			if ($arrData[$i]["det_default"]) {
				$act = "checked";
			}
			$data[$i]["accion"] = '<label class="switch">
				<input type="radio" name="accionModelo" class="switch-input" onchange="return accionModelo(this,' . "'{$arrData[$i]["iddetallemodelo"]}'" . ')"' . $act . '>
				<span class="switch-toggle-slider">
				<span class="switch-on">
					<i class="bx bx-check"></i>
				</span>
				<span class="switch-off">
					<i class="bx bx-x"></i>
				</span>
				</span>
			</label>';
			$act = "";
			$data[$i]["nombre"] = $arrModelo["mo_nombre"] ?? "";
			$data[$i]["ruta"] = $arrData[$i]['det_ruta'];
			$data[$i]["fecha"] = date("d/m/Y", strtotime($arrData[$i]['det_fecha']));
			// reseteamos arrdata
			$arrModelo = [];
			$model2->emptyQuery();
		}
		return $this->respondWithJson($response, $data);
	}

	/**
	 * Lista los datos de la tabla
	 */
	public function listDatosEntre($request, $response)
	{
		$model = new TableModel;
		$model->setTable("ma_entrenamiento");
		$model->setId("identrenamiento");

		$arrData = $model->orderBy("identrenamiento", "DESC")->get();
		$data = [];
		$act = "";

		for ($i = 0; $i < count($arrData); $i++) {
			if ($arrData[$i]["ent_default"]) {
				$act = "checked";
			}
			$data[$i]["accion"] = '<label class="switch">
				<input type="radio" name="accion" class="switch-input" onchange="return accion(this,' . "'{$arrData[$i]["identrenamiento"]}'" . ')"' . $act . '>
				<span class="switch-toggle-slider">
				<span class="switch-on">
					<i class="bx bx-check"></i>
				</span>
				<span class="switch-off">
					<i class="bx bx-x"></i>
				</span>
				</span>
			</label>';
			$act = "";
			$data[$i]["fecha"] = $arrData[$i]['ent_fecha'];
			$data[$i]["ruta"] = $arrData[$i]['ent_ruta_datos_generados'];
		}
		return $this->respondWithJson($response, $data);
	}

	public function nombreModelo($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		// return $this->respondWithJson($response, $data);

		if (empty($data['nombre_modelo'])) {
			return $this->respondWithError($response, "El nombre del modelo es obligatorio");
		}

		$model = new TableModel;
		$model->setTable("ma_configuracion");
		$model->setId("idconfig");

		$textdata = $model->first();
		$arrData = json_decode($textdata['valor'], true);

		$arrData["nombre_modelo"] = urls_amigables($data["nombre_modelo"]);

		$rq = $model->update($textdata['idconfig'], [
			'valor' => json_encode($arrData),
		]);

		$msg = (!empty($rq)) ? "Datos actualizados" : "Error al guardar los datos";
		return (!empty($rq)) ? $this->respondWithSuccess($response, $msg) : $this->respondWithError($response, $msg);
	}

	public function datosEntre($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		// return $this->respondWithJson($response, $data);

		if (empty($data['identrenamiento'])) {
			return $this->respondWithError($response, "Error de validacion, por favor recargue la pagina");
		}

		$model = new TableModel;
		$model->setTable("ma_entrenamiento");
		$model->setId("identrenamiento");

		$rq = $model->query("UPDATE ma_entrenamiento SET ent_default = 1 WHERE identrenamiento = " . $data["identrenamiento"]);
		if (!empty($rq)) {
			$rq = $model->query("UPDATE ma_entrenamiento SET ent_default = 0 WHERE identrenamiento != " . $data["identrenamiento"]);
		}

		$msg = (!empty($rq)) ? "Datos actualizados" : "Error al guardar los datos";
		return (!empty($rq)) ? $this->respondWithSuccess($response, $msg) : $this->respondWithError($response, $msg);
	}

	public function activarModelo($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		return $this->respondWithJson($response, $data);

		if (empty($data['iddetallemodelo'])) {
			return $this->respondWithError($response, "Error de validacion, por favor recargue la pagina");
		}

		$model = new TableModel;
		$model->setTable("ma_detalle_modelo");
		$model->setId("iddetallemodelo");

		$rq = $model->query("UPDATE ma_detalle_modelo SET det_default = 1 WHERE iddetallemodelo = " . $data["iddetallemodelo"]);
		if (!empty($rq)) {
			$rq = $model->query("UPDATE ma_detalle_modelo SET det_default = 0 WHERE iddetallemodelo != " . $data["iddetallemodelo"]);
		}

		$msg = (!empty($rq)) ? "Datos actualizados" : "Error al guardar los datos";
		return (!empty($rq)) ? $this->respondWithSuccess($response, $msg) : $this->respondWithError($response, $msg);
	}

	public function entrenar($request, $response)
	{
		$inicio = microtime(true);
		$model = new TableModel;
		$model->setTable("ma_entrenamiento");
		$model->setId("identrenamiento");

		$model2 = new TableModel;
		$model2->setTable("ma_configuracion");
		$model2->setId("idconfig");

		$model3 = new TableModel;
		$model3->setTable("ma_modelo");
		$model3->setId("idmodelo");
		$svm = $model3->where("mo_default", 1)->first();
		if (empty($svm)) {
			return $this->respondWithError($response, "No se ha seleccionado un modelo por defecto");
		}

		$entrenamiento = $model->where("ent_default", 1)->first();
		if (empty($entrenamiento)) {
			return $this->respondWithError($response, "No se ha seleccionado un conjunto de datos para entrenamiento");
		}

		// rutas del modelo
		$textData = $model2->first();
		$configData = json_decode($textData['valor'], true);

		// rutas de datos de entrenamiento
		$rutas = json_decode($entrenamiento['ent_ruta_datos_generados'], true);

		$command = escapeshellcmd(
			'python ' . __DIR__ . '/entrenamiento/ex2.py '
				. $configData["nombre_modelo"] . ' '
				. $configData["ruta_modelo"] . ' '
				. $rutas[0] . ' '
				. $rutas[1] . ' '
		);
		$output = shell_exec($command);
		$output = json_decode($output, true);

		if (!$output["status"]) {
            return $this->respondWithError($response, $output["message"]);
        }

		$model5 = new TableModel;
		$model5->setTable("ma_detalle_modelo");
		$model5->setId("iddetallemodelo");

		// Calcular el tiempo transcurrido
		$fin = microtime(true);
		$tiempo = $fin - $inicio;

		$rq = $model5->create([
			// "iddetallemodelo" => "",
			"idmodelo" => $svm["idmodelo"],
			"identrenamiento" => $entrenamiento["identrenamiento"],
			"det_ruta" => $output["pkl"],
			"det_nombre" => $output["name"],
			"det_default" => "1",
			"det_tiempo" => $tiempo,
			"det_inicio" => $inicio,
			"det_fin" => $fin,
			// "det_fecha" => ""
		]);
		$model->query("UPDATE ma_detalle_modelo SET det_default = 0 WHERE iddetallemodelo != " . $rq["iddetallemodelo"]);
		if ($rq) {
			$msg = "Modelo entrenado con exito. El proceso tardo " . $tiempo . " segundos";
			return $this->respondWithSuccess($response, $msg);
		}

		$msg = "Error al guardar los datos";
		return $this->respondWithError($response, $msg);
	}
}
