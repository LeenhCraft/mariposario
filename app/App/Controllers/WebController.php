<?php

namespace App\Controllers;

use App\Models\TableModel;

class WebController extends Controller
{
    public function index($request, $response, $args)
    {
        $model = new TableModel;
        return $this->render($response, "Web.web", [
            "data" => [
                "cant" => $model->cantidadCarrito($_SESSION['vi']),
                "title" => "Web",
            ],
            "items_banner" => $this->items_banner(),
            "carousel_1" => $this->carousel(),
            "carousel_2" => $this->carousel(),
        ]);
    }

    private function items_banner()
    {
        $model = new TableModel;
        $model->setTable("bib_libros");
        $model->setId("idlibro");
        $html = '';
        $response = $model->orderBy("idlibro", "desc")->limit(4)->get();
        foreach ($response as $row) {
            $model->setTable("bib_imagenes");
            $model->setId("img_propietario");
            $rowImages = $model->find($row['idlibro']);
            // if ($rowImages['img_externo']) {
            //     $img = $rowImages['img_url'] ?? '/img/placeholder/woocommerce-placeholder-300x300.png';
            // }
            $img = $rowImages['img_url'] ?? '/img/placeholder/woocommerce-placeholder-300x300.png';
            $html .= '
					<div class="single_banner_slider">
                        <div class="row">
                            <div class="col-lg-5 col-md-8">
                                <div class="banner_text">
                                    <div class="banner_text_iner">
                                        <h1>' . $row['lib_titulo'] . '</h1>
                                        <p>' . substr($row['lib_descripcion'], 0, 100) . '...</p>
                                        <a href="#" class="btn_2" onclick="return add_carrito(this,' . $row['idarticulo'] . ')">Reservar</a>
                                    </div>
                                </div>
                            </div>
							<div class="banner_img d-none d-lg-block" style="max-width: 300px; right: 15%;">
								<img src="' . $img . '" alt="Cargando...">
							</div>
                        </div>
                    </div>
					';
        }

        return $html;
    }

    private function carousel()
    {
        $model = new TableModel;
        $model->setTable("bib_libros");
        $model->setId("idlibro");
        $ImageModel = new TableModel;
        $ImageModel->setTable("bib_imagenes");
        $ImageModel->setId("img_propietario");
        $html = '';
        $response = $model->orderBy("RAND()")->limit(8)->get();
        foreach ($response as $row => $value) {
            $rowImages = $ImageModel->find($value['idlibro']);
            $img = $rowImages['img_url'] ?? '/img/placeholder/woocommerce-placeholder-300x300.png';
            $html .= '
            <div class="col-lg-3 col-sm-6">
                <div class="single_product_item">
                    <img style="width:230px;" src="' . $img . '" alt="' . $value['lib_titulo'] . '">
                    <div class="single_product_text">
                        <h4>' . $value['lib_titulo'] . '</h4>
                        <h3>' . formatMoney(generar_numeros(3)) . '</h3>
                        <a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a>
                    </div>
                </div>
            </div>
            ';
        }
        return $html;
    }
}
