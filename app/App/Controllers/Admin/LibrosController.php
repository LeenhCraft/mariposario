<?php

namespace App\Controllers\Admin;

use App\Complements\ImageClass;
use App\Controllers\Controller;
use App\Models\TableModel;

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LibrosController extends Controller
{

    protected $permisos = [];
    protected $responseFactory;
    protected $guard;

    public function __construct()
    {
        parent::__construct();
        $this->permisos = getPermisos($this->className($this));
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
    }

    public function index($request, $response)
    {
        // return $response;
        // $this->guard->removeAllTokenFromStorage();
        return $this->render($response, 'App.Libros.libros', [
            'titulo_web' => 'Libros',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            'js' => [
                'js/app/plugins/ckeditor/ckeditor.js',
                'js/app/sample.js',
                'js/app/libros.js',
            ],
            "tk" => [
                "name" => $this->guard->getTokenNameKey(),
                "value" => $this->guard->getTokenValueKey(),
                "key" => $this->guard->generateToken()
            ]
        ]);
    }

    public function list($request, $response)
    {
        $model = new TableModel;
        $model->setTable('bib_libros');
        $model->setId("idlibro");

        $arrData = $model->orderBy("idlibro", "DESC")->get();
        $data = [];

        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnEdit = "";
            $btnDelete = "";
            $nmr++;
            if ($arrData[$i]['lib_estado'] == 1) {
                $data[$i]['status'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $data[$i]['status'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            if ($arrData[$i]['lib_publicar'] == 1) {
                $data[$i]['web'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $data[$i]['web'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['idlibro'] . ')" title="Editar Libro"><i class="bx bxs-edit-alt"></i></button>';
            }
            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDel(' . $arrData[$i]['idlibro'] . ')" title="Eliminar Libro"><i class="bx bxs-trash-alt" ></i></button>';
            }

            $data[$i]['options'] = '<div class="btn-group" role="group" aria-label="Basic example">' . $btnEdit . ' ' . $btnDelete . '</div>';
            $data[$i]['num'] = $nmr;
            $data[$i]['name'] = $arrData[$i]['lib_titulo'];
        }
        return $this->respondWithJson($response, $data);
    }

    public function store(Request $request, Response $response)
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
        $model->setTable("bib_libros");
        $model->setId("idlibro");

        $existe = $model->orWhere("lib_titulo", $data['name'])->orWhere("lib_slug", $data['slug'])->where("lib_estado", '1')->first();
        if (!empty($existe)) {
            $msg = "Ya existe un articulo con el mismo nombre o slug";
            return $this->respondWithError($response, $msg);
        }

        $data['slug'] = $data['slug'] ?? urls_amigables($data['name']);
        $rq = $model->create([
            "idarticulo" => $data['idarticulo'] ?? 0,
            "ideditorial" => $data['ideditorial'] ?? 0,
            "lib_titulo" => ucwords($data['name']) ?? "UNDEFINED",
            "lib_slug" => strtolower($data['slug']),
            "lib_descripcion" => $data['description'],
            "lib_fecha_publi" => $data['date_publish'],
            "lib_num_paginas" => $data['pages'],
            "lib_estado" => isset($data['status']) && $data['status'] == "on" ? '1' : "0",
            "lib_publicar" => isset($data['publish']) && $data['publish'] == "on" ? '1' : "0",
        ]);
        if (!empty($rq)) {
            $model->setTable("bib_lib_aut");
            $model->setId("idlibroautor");
            $model->create([
                "idlibro" => $rq['idlibro'] ?? 0,
                "idautor" => $data['idautor'] ?? 0,
                "lxa_tipo" => ucfirst("Autor"),
            ]);

            if (isset($data['unique']) && $data['unique'] == "on") {
                $model->setTable("bib_copias");
                $model->setId("idcopias");
                $model->create([
                    "idlibro" => $rq['idlibro'] ?? 0,
                    "cop_codinventario" => $rq['idlibro'] ?? 0,
                    "cop_ubicacion" => "Undefined",
                    "cop_copias_disponibles" => '1',
                    "cop_estado" => 1
                ]);
            }

            $image = new ImageClass;
            $img = $image->cargarImagen($_FILES['photo'], $rq);
            $msg = "Datos guardados correctamente" . $img['text'];
            if (isset($data['img_externa']) && $data['img_externa'] == "on") {
                $img = $image->imagenExterna($data['photo_url'], $rq);
            }
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $existe);
    }

    public function validar($data)
    {

        if (empty("idarticulo")) {
            return false;
        }
        if (empty("idautor")) {
            return false;
        }
        if (empty("ideditorial")) {
            return false;
        }
        if (empty("name")) {
            return false;
        }
        return true;
    }

    public function search($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());

        $errors = $this->validarSearch($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable("bib_libros");
        $model->setId("idlibro");

        $rq = $model->find($data['id']);

        //id del autor
        $model->setTable("bib_lib_aut");
        $dataAutor['idautor'] = $model->find($data['id'])['idautor'] ?? '0';

        $rq = array_merge($rq, $dataAutor);

        if (!empty($rq)) {
            $imgClass = new ImageClass;
            $rq['photo'] = $imgClass->getImage($rq['idlibro']);
            return $this->respondWithJson($response, ["status" => true, "data" => $rq]);
        }
        $msg = "No se encontraron datos";
        return $this->respondWithError($response, $msg);
    }

    public function validarSearch($data)
    {
        if (empty($data["id"])) {
            return false;
        }
        return true;
    }

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
        $model->setTable("bib_libros");
        $model->setId("idlibro");

        $existe = $model->query("SELECT SQL_CALC_FOUND_ROWS * FROM bib_libros WHERE (lib_titulo = ? OR lib_slug = ?) AND idlibro != ?", [$data['name'], $data['slug'], $data['id']])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un libro con el mismo nombre o slug";
            return $this->respondWithError($response, $msg);
        }

        $data['slug'] = $data['slug'] ?? urls_amigables($data['name']);
        $rq = $model->update($data['id'], [
            "idarticulo" => $data['idarticulo'] ?? 0,
            "ideditorial" => $data['ideditorial'] ?? 0,
            "lib_titulo" => ucfirst($data['name']) ?? "UNDEFINED",
            "lib_slug" => strtolower($data['slug']),
            "lib_descripcion" => $data['description'],
            "lib_fecha_publi" => $data['date_publish'],
            "lib_num_paginas" => $data['pages'],
            "lib_estado" => isset($data['status']) && $data['status'] == "on" ? '1' : "0",
            "lib_publicar" => isset($data['publish']) && $data['publish'] == "on" ? '1' : "0",
        ]);
        if (!empty($rq)) {
            $model->setTable("bib_lib_aut");
            $model->setId("idlibro");
            $model->update($data['id'], [
                "idautor" => $data['idautor'] ?? 0,
                "lxa_tipo" => ucfirst("Autor"),
            ]);

            $image = new ImageClass;
            $img = ['text' => ''];
            if ($image->verificar($_FILES['photo'])) {
                $img = $image->cargarImagen($_FILES['photo'], $rq);
            }
            if (isset($data['img_externa']) && $data['img_externa'] == "on") {
                $img = $image->imagenExterna($data['photo_url'], $rq);
            }

            $msg = "Datos guardados correctamente" . $img['text'];
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $existe);
    }

    private function validarUpdate($data)
    {
        if (empty($data["id"])) {
            return false;
        }
        if (empty("idarticulo")) {
            return false;
        }
        if (empty("idautor")) {
            return false;
        }
        if (empty("ideditorial")) {
            return false;
        }
        if (empty("name")) {
            return false;
        }
        return true;
    }

    public function delete($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        if (empty($data["id"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new TableModel;
        $model->setTable("bib_libros");
        $model->setId("idlibro");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {

            // copias del libro
            $model->setTable("bib_copias");
            $model->setId("idlibro");

            $copias = $model->find($data["id"]);

            if (!empty($copias)) {
                // eliminar copias del libro
                $model->delete($data["id"]);
            }
            
            $model->setTable("bib_libros");
            $model->setId("idlibro");
            $rq = $model->delete($data["id"]);
            if (!empty($rq)) {

                $model->setTable("bib_imagenes");
                $model->setId("img_propietario");

                $imgData = $model->where("img_propietario", $data["id"])->where("img_type", "LIB::MIN")->first();

                if (!empty($imgData)) {
                    $imgClass = new ImageClass;
                    $imgClass->eliminarFile($imgData['img_url']);

                    $model->query("DELETE FROM bib_imagenes WHERE img_propietario = ? AND img_type = ?", [$data["id"], "LIB::MIN"])->first();
                }

                $msg = "Datos eliminados correctamente";
                return $this->respondWithSuccess($response, $msg);
            }
            $msg = "Error al eliminar los datos";
            return $this->respondWithError($response, $msg);
        }
        $msg = "No se encontraron datos para eliminar.";
        return $this->respondWithError($response, $msg);
    }

    public function autores($request, $response)
    {
        $model = new TableModel;
        $arrData = $model->query("SELECT idautor as id, aut_nombre as nombre FROM bib_autores WHERE aut_estado = 1 ORDER BY idautor ASC")->get();
        return $this->respondWithJson($response, ["status" => true, "data" => $arrData]);
    }

    public function editoriales($request, $response)
    {
        $model = new TableModel;
        $arrData = $model->query("SELECT ideditorial as id, edi_nombre as nombre FROM bib_editoriales WHERE edi_estado = 1 ORDER BY ideditorial ASC")->get();
        return $this->respondWithJson($response, ["status" => true, "data" => $arrData]);
    }

    public function articulos($request, $response)
    {
        $model = new TableModel;
        $arrData = $model->query("SELECT idarticulo as id, art_nombre as nombre FROM bib_articulos WHERE art_estado = 1 AND idtipo = 1 ORDER BY idarticulo ASC")->get();
        return $this->respondWithJson($response, ["status" => true, "data" => $arrData]);
    }
}
