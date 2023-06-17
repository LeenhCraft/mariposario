<?php

// use Slim\App;

use App\Complements\Snowflake;
use App\Controllers\Admin\CentinelaController;
use App\Controllers\Admin\ConfiguracionController;
use Slim\Routing\RouteCollectorProxy;

// Controllers
use App\Controllers\Crud\CrudController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\DataBaseController;
use App\Controllers\Admin\EntrenarController;
use App\Controllers\Admin\EspeciesController;
use App\Controllers\Admin\FamiliasController;
use App\Controllers\Admin\GenerosController;
use App\Controllers\Admin\HistorialController;
use App\Controllers\Admin\IaController;
use App\Controllers\Admin\LoginAdminController;
use App\Controllers\Admin\MenusController;
use App\Controllers\Admin\ModeloController;
use App\Controllers\Admin\OrdenesController;
use App\Controllers\Admin\PermisosController;
use App\Controllers\Admin\PersonController;
use App\Controllers\Admin\RolController;
use App\Controllers\Admin\SubmenusController;
use App\Controllers\Admin\SubfamiliasController;
use App\Controllers\Admin\UserController;
use App\Controllers\LogoutController;

// Middlewares
use App\Middleware\AdminMiddleware;
use App\Middleware\LoginAdminMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RemoveCsrfMiddleware;

$app->get('/admin/login', LoginAdminController::class . ':index')->add(new AdminMiddleware)->add(new RemoveCsrfMiddleware());

$app->get('/admin/lnh', function ($request, $response, $args) {
    $snow = new Snowflake(1);
    $response->getBody()->write("Hello<br>" . $snow->generateId());
    return $response;
});

$app->post('/admin/login', LoginAdminController::class . ':sessionUser');

$app->group('/admin', function (RouteCollectorProxy $group) {
    $group->get("", DashboardController::class . ':index')->add(new RemoveCsrfMiddleware());
    $group->get("/logout", LogoutController::class . ':admin')->add(new RemoveCsrfMiddleware());

    $group->group('/database', function (RouteCollectorProxy $group) {
        $group->get('', DataBaseController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', DataBaseController::class . ':list');
        $group->post('/save', DataBaseController::class . ':store');
        $group->post('/update', DataBaseController::class . ':update');
        $group->post('/search', DataBaseController::class . ':search');
        $group->post('/delete', DataBaseController::class . ':delete');
        $group->post('/execute', DataBaseController::class . ':execute');
    })->add(PermissionMiddleware::class);

    $group->group('/menus', function (RouteCollectorProxy $group) {
        $group->get('', MenusController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', MenusController::class . ':list');
        $group->post('/save', MenusController::class . ':store');
        $group->post('/update', MenusController::class . ':update');
        $group->post('/search', MenusController::class . ':search');
        $group->post('/delete', MenusController::class . ':delete');
    })->add(PermissionMiddleware::class);

    $group->group('/submenus', function (RouteCollectorProxy $group) {
        $group->get('', SubmenusController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', SubmenusController::class . ':list');
        $group->post('/save', SubmenusController::class . ':store');
        $group->post('/update', SubmenusController::class . ':update');
        $group->post('/menus', SubmenusController::class . ':menus');
        $group->post('/search', SubmenusController::class . ':search');
        $group->post('/delete', SubmenusController::class . ':delete');
    })->add(PermissionMiddleware::class);

    $group->group('/permisos', function (RouteCollectorProxy $group) {
        $group->get('', PermisosController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', PermisosController::class . ':list');
        $group->post('/save', PermisosController::class . ':store');
        $group->post('/delete', PermisosController::class . ':delete');
        $group->post('/active', PermisosController::class . ':active');
        $group->post('/roles', PermisosController::class . ':roles');
        $group->post('/submenus', PermisosController::class . ':submenus');
    })->add(PermissionMiddleware::class);

    $group->group('/user', function (RouteCollectorProxy $group) {
        $group->get('', UserController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('/roles', UserController::class . ':roles');
        $group->post('/person', UserController::class . ':person');

        $group->post('', UserController::class . ':list');
        $group->post('/save', UserController::class . ':store');
        $group->post('/search', UserController::class . ':search');
        $group->post('/update', UserController::class . ':update');
        $group->post('/delete', UserController::class . ':delete');
    })->add(PermissionMiddleware::class);

    $group->group('/person', function (RouteCollectorProxy $group) {
        $group->get('', PersonController::class . ':index')->add(new RemoveCsrfMiddleware());

        $group->post('', PersonController::class . ':list');
        $group->post('/save', PersonController::class . ':store');
        $group->post('/search', PersonController::class . ':search');
        $group->post('/update', PersonController::class . ':update');
        $group->post('/delete', PersonController::class . ':delete');
    })->add(PermissionMiddleware::class);

    $group->group('/rol', function (RouteCollectorProxy $group) {
        $group->get('', RolController::class . ':index')->add(new RemoveCsrfMiddleware());

        $group->post('', RolController::class . ':list');
        $group->post('/save', RolController::class . ':store');
        $group->post('/search', RolController::class . ':search');
        $group->post('/update', RolController::class . ':update');
        $group->post('/delete', RolController::class . ':delete');
    })->add(PermissionMiddleware::class);

    $group->group("/crud", function (RouteCollectorProxy $group) {
        $group->get("", CrudController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", CrudController::class . ":list");
        $group->post("/save", CrudController::class . ":store");
        $group->post("/search", CrudController::class . ":search");
        $group->post("/update", CrudController::class . ":update");
        $group->post("/delete", CrudController::class . ":delete");
        $group->post("/libros", CrudController::class . ":libros");
    })->add(PermissionMiddleware::class);

    // // Obtener la conexión a la base de datos
    // $pdo = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'tu_usuario', 'tu_contraseña');

    // // Obtener los datos de la tabla de rutas
    // $stmt = $pdo->query('SELECT * FROM rutas');
    // $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // // Definir las rutas dinámicamente
    // foreach ($rutas as $ruta) {
    //     $app->map([$ruta['method']], $ruta['path'], $ruta['controlador'])->add($ruta['middleware']);
    // }


    $group->group("/ordenes", function (RouteCollectorProxy $group) {
        $group->get("", OrdenesController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", OrdenesController::class . ":list");
        $group->post("/save", OrdenesController::class . ":store");
        $group->post("/search", OrdenesController::class . ":search");
        $group->post("/update", OrdenesController::class . ":update");
        $group->post("/delete", OrdenesController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/familias", function (RouteCollectorProxy $group) {
        $group->get("", FamiliasController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", FamiliasController::class . ":list");
        $group->post("/save", FamiliasController::class . ":store");
        $group->post("/search", FamiliasController::class . ":search");
        $group->post("/update", FamiliasController::class . ":update");
        $group->post("/delete", FamiliasController::class . ":delete");

        $group->post("/ordenes", FamiliasController::class . ":ordenes");
    })->add(PermissionMiddleware::class);

    $group->group("/subfamilias", function (RouteCollectorProxy $group) {
        $group->get("", SubfamiliasController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", SubfamiliasController::class . ":list");
        $group->post("/save", SubfamiliasController::class . ":store");
        $group->post("/search", SubfamiliasController::class . ":search");
        $group->post("/update", SubfamiliasController::class . ":update");
        $group->post("/delete", SubfamiliasController::class . ":delete");

        $group->post("/familias", SubfamiliasController::class . ":familias");
    })->add(PermissionMiddleware::class);

    $group->group("/generos", function (RouteCollectorProxy $group) {
        $group->get("", GenerosController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", GenerosController::class . ":list");
        $group->post("/save", GenerosController::class . ":store");
        $group->post("/search", GenerosController::class . ":search");
        $group->post("/update", GenerosController::class . ":update");
        $group->post("/delete", GenerosController::class . ":delete");

        $group->post("/subfamilias", GenerosController::class . ":subfamilias");
    })->add(PermissionMiddleware::class);

    $group->get("/especies/[{slug}]", EspeciesController::class . ":especie")->add(new RemoveCsrfMiddleware());

    $group->group("/especies", function (RouteCollectorProxy $group) {
        $group->get("", EspeciesController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", EspeciesController::class . ":list");
        $group->post("/save", EspeciesController::class . ":store");
        $group->post("/search", EspeciesController::class . ":search");
        $group->post("/update", EspeciesController::class . ":update");
        $group->post("/delete", EspeciesController::class . ":delete");

        $group->post("/familias", EspeciesController::class . ":familias");
        $group->post("/subfamilias", EspeciesController::class . ":subfamilias");
        $group->post("/generos", EspeciesController::class . ":generos");
        $group->post("/upload", EspeciesController::class . ":uploadImgEntre");
        $group->post("/view", EspeciesController::class . ":viewImgEntre");
        $group->post("/destroy", EspeciesController::class . ":delImgEntre");
    })->add(PermissionMiddleware::class);

    $group->group("/ia", function (RouteCollectorProxy $group) {
        $group->get("", IaController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", IaController::class . ":list");
        $group->post("/save", IaController::class . ":store");
        $group->post("/search", IaController::class . ":search");
        $group->post("/update", IaController::class . ":update");
        $group->post("/delete", IaController::class . ":delete");
    })->add(PermissionMiddleware::class);

    // ruta para generar los datos que se usaran en el entrenaminto del modelo
    $group->group("/entrenamiento", function (RouteCollectorProxy $group) {
        $group->get("", ModeloController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", ModeloController::class . ":generarDatosEntrenamiento");
        $group->post("/save", ModeloController::class . ":store");
        $group->post("/search", ModeloController::class . ":search");
        $group->post("/update", ModeloController::class . ":update");
        $group->post("/delete", ModeloController::class . ":delete");

        $group->post("/ruta", ModeloController::class . ":pathDatosEntre");
        $group->post("/nombre", ModeloController::class . ":nombreDatosEntre");
        $group->post("/imagenes", ModeloController::class . ":imagenes");
        $group->post("/especies", ModeloController::class . ":especies");
    })->add(PermissionMiddleware::class);

    // ruta para entrenar el modelo
    $group->group("/modelo", function (RouteCollectorProxy $group) {
        $group->get("", EntrenarController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", EntrenarController::class . ":list");
        $group->post("/ruta", EntrenarController::class . ":nombreModelo");
        $group->post("/datos-de-entrenamiento", EntrenarController::class . ":listDatosEntre");
        $group->post("/datos", EntrenarController::class . ":datosEntre");
        $group->post("/activar", EntrenarController::class . ":activarModelo");
        $group->post("/entrenar", EntrenarController::class . ":entrenar");
    })->add(PermissionMiddleware::class);

    // ruta para configurar variables genereales del sistema
    $group->group("/sistem", function (RouteCollectorProxy $group) {
        $group->get("", ConfiguracionController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", ConfiguracionController::class . ":list");
        $group->post("/save", ConfiguracionController::class . ":store");
        $group->post("/search", ConfiguracionController::class . ":search");
        $group->post("/update", ConfiguracionController::class . ":update");
        $group->post("/delete", ConfiguracionController::class . ":delete");
    })->add(PermissionMiddleware::class);

    // ruta para configurar variables genereales del sistema
    $group->group("/historial", function (RouteCollectorProxy $group) {
        $group->get("", HistorialController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", HistorialController::class . ":list");
        $group->post("/save", HistorialController::class . ":store");
        $group->post("/search", HistorialController::class . ":search");
        $group->post("/update", HistorialController::class . ":update");
        $group->post("/delete", HistorialController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/centinela", function (RouteCollectorProxy $group) {
        $group->get("", CentinelaController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", CentinelaController::class . ":list");
        $group->post("/save", CentinelaController::class . ":store");
        $group->post("/search", CentinelaController::class . ":search");
        $group->post("/update", CentinelaController::class . ":update");
        $group->post("/delete", CentinelaController::class . ":delete");
    })->add(PermissionMiddleware::class);
})->add(new LoginAdminMiddleware());
