<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Controllers\Error\ErrorController;
use App\Http\ImageGPT;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

/**
 * Class Especies Controller
 */
class EspeciesController extends Controller
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
		$js = [];
		if ($this->permisos['perm_w'] == 1 || $this->permisos['perm_u'] == 1) {
			$js = [
				'js/app/plugins/ckeditor/ckeditor.js',
				'js/app/sample.js',
				'js/app/nw_especies.js'
			];
		}

		$js[] = 'js/app/nw_especies_2.js';

		return $this->render($response, 'App.Especies.Especies', [
			'titulo_web' => 'Especies',
			'url' => $request->getUri()->getPath(),
			'permisos' => $this->permisos,
			'css' => ['css/app/spinkit.css'],
			'js' => $js,

			'tk' => [
				'name' => $this->guard->getTokenNameKey(),
				'value' => $this->guard->getTokenValueKey(),
				'key' => $this->guard->generateToken(),
			],
			'list' => $this->listGet()
		]);
	}

	/**
	 * Muestra la vista individual de un registro
	 */
	public function especie($request, $response)
	{
		$model = new TableModel;
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		$url = $request->getUri()->getPath();
		$slug = explode("/", $url);
		$data = $model->where("es_status", 1)->where("es_slug", end($slug))->first();

		if (empty($data)) {
			$error = new ErrorController;
			return $error->notFound($request, $response, true);
		}

		$model->emptyQuery();
		$model->setTable("ma_configuracion");
		$model->setId("idconfig");

		$url = '/' . $slug[1] . '/' . $slug[2];
		return $this->render($response, 'App.Especies.viewespecie', [
			'titulo_web' => 'Especies',
			'url' => $url,
			'permisos' => $this->permisos,
			// 'css' => ['css/app/dropzone.css'],
			'js' => [
				'js/app/plugins/dropzone-min.js',
				'js/app/plugins/ckeditor/ckeditor.js',
				'js/app/sample.js',
				'js/app/nw_especies_edit.js'
			],
			'tk' => [
				'name' => $this->guard->getTokenNameKey(),
				'value' => $this->guard->getTokenValueKey(),
				'key' => $this->guard->generateToken(),
			],
			"data" => $data
		]);
	}


	/**
	 * Lista los datos de la tabla
	 */
	public function list($request, $response)
	{
		// sleep(10);
		$data = $this->sanitize($request->getParsedBody());
		$model = new TableModel;
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		// $arrData = $model->where("es_status", "1")->orderBy("idespecie", "DESC")->paginate_int($data["limit"], $data["page"],  $data['sort'], $data['order']);
		$arrData = $model->where("es_status", "1")->orderBy("idespecie", "DESC")->paginate_int($data["limit"], $data["page"]);
		return $this->respondWithJson($response, $arrData);
	}

	/**
	 * Lista los datos de la tabla
	 */
	private function listGet()
	{
		$model = new TableModel;
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		return $model->where("es_status", "1")->orderBy("idespecie", "DESC")->paginate(10);
	}


	/**
	 * Metodo para guardar nuevo registro
	 */
	public function store($request, $response)
	{
		if ($this->permisos["perm_w"] != 1) {
			return $this->respondWithError($response, "No tiene permisos para realizar esta acción");
		}

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
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");

		$existe = $model
			->orWhere("es_nombre_comun", "LIKE", $data['es_nombre_comun'])
			->orWhere("es_nombre_cientifico", "LIKE", $data["es_nombre_cientifico"])
			->first();

		if (!empty($existe) && $existe['idgenero'] == $data['idgenero'] && $existe["es_status"] == 1) {
			$msg = "Ya tiene una especie registrado con ese nombre";
			return $this->respondWithError($response, $msg);
		}

		$rq = $model->create([
			'idgenero' => $data['idgenero'],
			'es_nombre_cientifico' => ucwords($data['es_nombre_cientifico']),
			'es_nombre_comun' => ucwords($data['es_nombre_comun']),
			"es_tamanio" => "",
			"es_imagen_url" => "",
			"es_slug" => urls_amigables($data['es_nombre_comun']),
			'es_descripcion' => $data['description']
		]);

		// verififcar si se guardo
		if ($rq) {
			$msg = "Registro guardado correctamente.";

			$file = $_FILES['es_imagen_url'];

			$bulletproof = new ImageGPT($file);
			$img = $bulletproof
				->setName(urls_amigables($rq["es_nombre_comun"]))
				->setSize(1, 5242880) // Tamaño mínimo de 1024 bytes, tamaño máximo de 5242880 bytes = 5MB
				->setMime(['image/jpeg', 'image/png']) // Tipos MIME permitidos
				// ->setDimension(800, 600) // Ancho y altura maximos permitidos de 800x600 píxeles
				->setStorage($_ENV['IMG_BUTTER_PATH'], 0755) // Carpeta de destino y permisos opcionales, si no existe se creará
				->upload();

			// comprobar que se subio la imagen
			if ($img) {
				$rq = $model->update($rq['idespecie'], [
					'es_imagen_url' => $bulletproof->getPath()
				]);

				if (!empty($rq)) {
					$msg .= " Imagen guardada correctamente.";
				}
			}


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
		if (empty($data['es_nombre_comun'])) {
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
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		$data = $model->find($data['idespecie']);

		$model2 = new TableModel;
		$model2->setTable("ma_generos_1");
		$model2->setId("idgenero");
		$genero = $model2->where("idgenero", $data['idgenero'])->first();
		$model2->emptyQuery();
		$generos = $model2->where("idsubfamilia", $genero["idsubfamilia"])->orderBy("idgenero", "DESC")->get();
		// dep($generos,1);

		$model3 = new TableModel;
		$model3->setTable("ma_subfamilias_1");
		$model3->setId("idsubfamilia");
		$subfamilia = $model3->where("idsubfamilia", $genero['idsubfamilia'])->first();
		$model3->emptyQuery();
		$subfamilias = $model3->where("idfamilia", $subfamilia["idfamilia"])->orderBy("idsubfamilia", "DESC")->get();

		$model4 = new TableModel;
		$model4->setTable("ma_familias_1");
		$model4->setId("idfamilia");
		$familia = $model4->where("idfamilia", $subfamilia['idfamilia'])->first();
		$model4->emptyQuery();
		$familias = $model4->orderBy("idfamilia", "DESC")->get();

		$data['genero'] = $genero;
		$data['subfamilia'] = $subfamilia;
		$data['familia'] = $familia;

		if (!empty($data)) {
			return $this->respondWithJson($response, ["sessio" => $_SESSION["csrf"], "status" => true, "data" => $data, "generos" => $generos, "subfamilias" => $subfamilias, "familias" => $familias]);
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
		// $data = array_merge($data, $_FILES);
		// return $this->respondWithJson($response, [$_SESSION, $data]);

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

		$existe = $model
			->query("SELECT SQL_CALC_FOUND_ROWS * FROM ma_especies_1 WHERE (es_nombre_comun LIKE ? OR es_nombre_cientifico LIKE ?) AND es_status = ?", [
				$data['es_nombre_comun'],
				$data["es_nombre_cientifico"],
				1
			]);
		// ->orWhere("es_nombre_comun", "LIKE", $data['es_nombre_comun'])
		// ->orWhere("es_nombre_cientifico", "LIKE", $data["es_nombre_cientifico"])
		// ->first();

		// return $this->respondWithJson($response, $existe);
		// verificar que $existe no este vacio

		if (empty($existe)) {
			if ($existe['idgenero'] == $data['idgenero'] && $existe['idespecie'] != $data['idespecie'] && $existe["es_status"] == 1) {
				$msg = "Ya tiene una especie registrado con ese nombre";
				return $this->respondWithError($response, $msg);
			}
		}

		$original = $model->find($data['idespecie']);

		$rq = $model->update($data['idespecie'], [
			'idgenero' => $data['idgenero'],
			'es_nombre_cientifico' => ucwords($data['es_nombre_cientifico']),
			'es_nombre_comun' => ucwords($data['es_nombre_comun']),
			"es_tamanio" => "",
			// "es_imagen_url" => "",
			"es_slug" => urls_amigables($data['es_nombre_comun']),
			'es_descripcion' => $data['description']
		]);

		if (!empty($rq)) {
			$msg = "Datos actualizados.";
			// 0 en php es igual a false
			if ($data["eliminar_img"] == 1) {
				$msg .= " dentro";
				$rq = $model->update($data['idespecie'], [
					'es_imagen_url' => ""
				]);
			} else {
				$file = $_FILES['es_imagen_url'];

				$bulletproof = new ImageGPT($file);
				$img = $bulletproof
					->setName(urls_amigables($rq["es_nombre_comun"]))
					->setSize(1, 5242880) // Tamaño mínimo de 1024 bytes, tamaño máximo de 5242880 bytes = 5MB
					->setMime(['image/jpeg', 'image/png']) // Tipos MIME permitidos
					// ->setDimension(800, 600) // Ancho y altura maximos permitidos de 800x600 píxeles
					->setStorage('img/especies', 0755) // Carpeta de destino y permisos opcionales, si no existe se creará
					->upload();
				if ($img) {
					$rq = $model->update($rq['idespecie'], [
						'es_imagen_url' => $bulletproof->getPath()
					]);

					if (!empty($rq)) {
						$msg .= " Imagen guardada correctamente.";
					}
				}
			}
			// cambiar el nombre de la carpea con las imagenes de entrenamiento
			if ($original["es_nombre_cientifico"] != $data["es_nombre_cientifico"]) {
				// cambiar el nombre de la carpeta
				$mConf = new TableModel;
				$mConf->setTable("ma_configuracion");
				$mConf->setId("idconfig");
				$arrConf = json_decode($mConf->first()['valor'], true);

				$carpetaOrigen = $arrConf['carpeta_img_entrenamiento'] . '/' . urls_amigables($original["es_nombre_cientifico"]);
				$carpetaDestino = $arrConf['carpeta_img_entrenamiento'] . '/' . urls_amigables($data["es_nombre_cientifico"]);

				// veriricar si existe el directorio
				if (!file_exists($arrConf['carpeta_img_entrenamiento'])) {
					mkdir($arrConf['carpeta_img_entrenamiento'], 0777, true);
				}

				// mover la carpeta de imagenes a la carpeta de eliminados
				if (is_dir($carpetaOrigen)) {
					rename($carpetaOrigen, $carpetaDestino);
				}
			}

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
		// if (empty($data['es_nombre_cientifico'])) {
		// 	return false;
		// }
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
	 * Metodo para eliminar registro por id
	 */
	public function delete($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		// return $this->respondWithJson($response, $data);
		if ($this->permisos['perm_d'] != 1) {
			return $this->respondWithError($response, "No tiene permisos para realizar esta acción");
		}

		if (empty($data["idespecie"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		if (!is_numeric($data["idespecie"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}

		$model = new TableModel;
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		$rq = $model->find($data['idespecie']);

		if (!empty($rq)) {
			if ($_ENV["APP_ENV"] === "local") {
				$rq = $model->delete($data["idespecie"]);
			} else {
				$rq = $model->update($rq['idespecie'], [
					'es_status' => 0
				]);
			}
			// mover la carpeta de imagenes a la carpeta de eliminados
			$mConf = new TableModel;
			$mConf->setTable("ma_configuracion");
			$mConf->setId("idconfig");
			$arrConf = json_decode($mConf->first()['valor'], true);

			$carpetaOrigen = $arrConf['carpeta_img_entrenamiento'] . '/' . urls_amigables($rq["es_nombre_cientifico"]);
			$carpetaDestino = $arrConf['ruta_train_delete'] . urls_amigables($rq["es_nombre_cientifico"]);

			// veriricar si existe el directorio
			if (!file_exists($arrConf['ruta_train_delete'])) {
				mkdir($arrConf['ruta_train_delete'], 0777, true);
			}

			// mover la carpeta de imagenes a la carpeta de eliminados
			if (is_dir($carpetaOrigen)) {
				rename($carpetaOrigen, $carpetaDestino);
			}

			if (!empty($rq)) {
				$msg = "Datos eliminados correctamente";
				return $this->respondWithSuccess($response, $msg);
			}
		}

		$msg = "Error al eliminar los datos";
		return $this->respondWithError($response, $msg);
	}

	public function familias($request, $response)
	{
		$model = new TableModel;
		$model->setTable("ma_familias_1");
		$model->setId("idfamilia");
		return $this->respondWithJson($response, $model->orderBy("idfamilia", "DESC")->get());
	}

	public function subfamilias($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		if (empty($data["idfamilia"])) {
			return $this->respondWithError($response, "Seleccione una familia");
		}
		$model = new TableModel;
		$model->setTable("ma_subfamilias_1");
		$model->setId("idsubfamilia");
		return $this->respondWithJson($response, $model->where("idfamilia", $data['idfamilia'])->orderBy("idsubfamilia", "DESC")->get());
	}

	public function generos($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());

		if (empty($data["idsubfamilia"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}
		$model = new TableModel;
		$model->setTable("ma_generos_1");
		$model->setId("idgenero");
		return $this->respondWithJson($response, $model->where("idsubfamilia", $data['idsubfamilia'])->orderBy("idgenero", "DESC")->get());
	}

	public function uploadImgEntre($request, $response)
	{
		$data = ($request->getParsedBody());
		$msg = "Error al guardar los datos";

		$model = new TableModel;
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		$rq = $model->find($data['idespecie']);
		$nombre_carpeta = urls_amigables($rq["es_nombre_cientifico"]);

		$model2 = new TableModel;
		$model2->setTable("ma_configuracion");
		$model2->setId("idconfig");

		$textData = $model2->first();
		$arrData = json_decode($textData['valor'], true);

		// dep($arrData['carpeta_img_entrenamiento'] . '/' . $nombre_carpeta,1);

		$bulletproof = new ImageGPT($_FILES["file"]);
		$img = $bulletproof
			->setName($nombre_carpeta . '-' . uniqid()) // Nombre del archivo
			->setSize(1, 5242880) // Tamaño mínimo de 1024 bytes, tamaño máximo de 5242880 bytes = 5MB
			->setMime(['image/jpeg', 'image/png']) // Tipos MIME permitidos
			// ->setDimension(800, 600) // Ancho y altura maximos permitidos de 800x600 píxeles
			->setStorage($arrData['carpeta_img_entrenamiento'] . '/' . $nombre_carpeta, 0755) // Carpeta de destino y permisos opcionales, si no existe se creará
			->upload();

		if ($img) {
			// sleep(1);
			$msg = " Imagen guardada correctamente.";
			return $this->respondWithSuccess($response, $msg);
		}
		return $this->respondWithError($response, $msg);
	}

	public function viewImgEntre($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		$msg = "Error al guardar los datos";

		$model = new TableModel;
		$model->setTable("ma_especies_1");
		$model->setId("idespecie");
		$rq = $model->find($data['idespecie']);
		$nombre_carpeta = urls_amigables($rq["es_nombre_cientifico"]);

		$model2 = new TableModel;
		$model2->setTable("ma_configuracion");
		$model2->setId("idconfig");

		$textData = $model2->first();
		$arrData = json_decode($textData['valor'], true);

		$ruta = scandir($arrData['carpeta_img_entrenamiento'] . '/' . $nombre_carpeta);
		$list = [];

		foreach ($ruta as $archivo) {
			// Ignora los archivos "." y ".."
			if ($archivo !== '.' && $archivo !== '..') {
				// Ignora los archivos que no sean imágenes
				if (exif_imagetype($arrData['carpeta_img_entrenamiento'] . '/' . $nombre_carpeta . '/' . $archivo)) {
					$list[] = $arrData['carpeta_img_entrenamiento'] . '/' . $nombre_carpeta . '/' . $archivo;
				}
			}
		}
		return $this->respondWithJson($response, $list);
	}

	// funcion para eliminar imagenes de entrenamiento
	public function delImgEntre($request, $response)
	{
		$data = $this->sanitize($request->getParsedBody());
		// verificar que no este vacio $data["path]
		if (empty($data["ruta"])) {
			return $this->respondWithError($response, "Error de validación, por favor recargue la página");
		}
		$filePath = $data["ruta"];
		$msg = "Error al guardar los datos";

		if (file_exists($filePath)) {
			unlink($filePath); // Elimina el archivo
			return $this->respondWithSuccess($response, "Imagen eliminada correctamente");
		} else {
			return $this->respondWithError($response, "El archivo no existe");
		}
		return $this->respondWithError($response, "No se pudo procesar, por favor recargue la página");
	}
}
