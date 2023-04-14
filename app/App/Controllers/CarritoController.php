<?php

namespace App\Controllers;

use App\Models\TableModel;

class CarritoController extends Controller
{
    public function index($request, $response, $args)
    {
        return $this->render($response, "Web.Carrito.index", [
            "data" => [
                "cant" => 10,
                "title" => "Web",
            ]
        ]);
    }

    public function agregar($request, $response, $args)
    {
        $data = $this->sanitize($request->getParsedBody());

        $model = new TableModel;

        $model->setTable("bib_articulos");
        $model->setId("idarticulo");

        $articulo = $model->find($data['id']);
        if (empty($articulo)) {
            return $this->respondWithJson($response, [
                "status" => false,
                "icon" => "error",
                "text" => "El articulo no existe",
                "data" => $model->cantidadCarrito($_SESSION['vi'])
            ]);
        }

        $model = new TableModel;
        $model->setTable("web_carritos");
        $model->setId("idcarrito");

        $articuloAgregado = $model->where("idarticulo", $data['id'])->where("vis_cod", $_SESSION['vi'])->where("car_anulado", 0)->where("codPedido", 0)->get();

        if (!empty($articuloAgregado)) {
            return $this->respondWithJson($response, [
                "status" => false,
                "icon" => "warning",
                "text" => "El articulo ya se encuentra agregado",
                "data" => $model->cantidadCarrito($_SESSION['vi'])
            ]);
        }

        $rowCarrito = $model->create([
            "vis_cod" => $_SESSION['vi'],
            "idwebusuario" => $_SESSION['lnh'] ?? 0,
            "idarticulo" => $data['id'],
            "codPedido" => 0,
            "car_cantidad" => 1,
            "car_anulado" => 0
        ]);

        $cantidadArticuloCarrito = $model->cantidadCarrito($_SESSION['vi']);

        if (!empty($rowCarrito)) {
            return $this->respondWithJson($response, [
                "status" => true,
                "icon" => "success",
                "text" => "Articulo agregado correctamente",
                "data" => $cantidadArticuloCarrito
            ]);
        }

        return $this->respondWithJson($response, [
            "status" => false,
            "icon" => "error",
            "text" => "Error al agregar el articulo",
            "data" => $cantidadArticuloCarrito,
            "articulo" => $rowCarrito
        ]);
    }
}
