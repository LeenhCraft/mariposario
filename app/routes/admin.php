<?php

// use Slim\App;
use App\Controllers\Admin\CentinelaController;
use Slim\Routing\RouteCollectorProxy;

// Controllers
use App\Controllers\Crud\CrudController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\DataBaseController;
use App\Controllers\Admin\EspeciesController;
use App\Controllers\Admin\FamiliasController;
use App\Controllers\Admin\GenerosController;
use App\Controllers\Admin\LoginAdminController;
use App\Controllers\Admin\MenusController;
use App\Controllers\Admin\OrdenesController;
use App\Controllers\Admin\PermisosController;
use App\Controllers\Admin\PersonController;
use App\Controllers\Admin\RolController;
use App\Controllers\Admin\SubmenusController;
use App\Controllers\Admin\SubordenesController;
use App\Controllers\Admin\UserController;
use App\Controllers\LogoutController;

// Middlewares
use App\Middleware\AdminMiddleware;
use App\Middleware\LoginAdminMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RemoveCsrfMiddleware;

$app->get('/admin/login', LoginAdminController::class . ':index')->add(new AdminMiddleware)->add(new RemoveCsrfMiddleware());
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
    });

    $group->group('/menus', function (RouteCollectorProxy $group) {
        $group->get('', MenusController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', MenusController::class . ':list');
        $group->post('/save', MenusController::class . ':store');
        $group->post('/update', MenusController::class . ':update');
        $group->post('/search', MenusController::class . ':search');
        $group->post('/delete', MenusController::class . ':delete');
    });

    $group->group('/submenus', function (RouteCollectorProxy $group) {
        $group->get('', SubmenusController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', SubmenusController::class . ':list');
        $group->post('/save', SubmenusController::class . ':store');
        $group->post('/update', SubmenusController::class . ':update');
        $group->post('/menus', SubmenusController::class . ':menus');
        $group->post('/search', SubmenusController::class . ':search');
        $group->post('/delete', SubmenusController::class . ':delete');
    });

    $group->group('/permisos', function (RouteCollectorProxy $group) {
        $group->get('', PermisosController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('', PermisosController::class . ':list');
        $group->post('/save', PermisosController::class . ':store');
        $group->post('/delete', PermisosController::class . ':delete');
        $group->post('/active', PermisosController::class . ':active');
        $group->post('/roles', PermisosController::class . ':roles');
        $group->post('/submenus', PermisosController::class . ':submenus');
    });

    $group->group('/user', function (RouteCollectorProxy $group) {
        $group->get('', UserController::class . ':index')->add(new RemoveCsrfMiddleware());
        $group->post('/roles', UserController::class . ':roles');
        $group->post('/person', UserController::class . ':person');

        $group->post('', UserController::class . ':list');
        $group->post('/save', UserController::class . ':store');
        $group->post('/search', UserController::class . ':search');
        $group->post('/update', UserController::class . ':update');
        $group->post('/delete', UserController::class . ':delete');
    });

    $group->group('/person', function (RouteCollectorProxy $group) {
        $group->get('', PersonController::class . ':index')->add(new RemoveCsrfMiddleware());

        $group->post('', PersonController::class . ':list');
        $group->post('/save', PersonController::class . ':store');
        $group->post('/search', PersonController::class . ':search');
        $group->post('/update', PersonController::class . ':update');
        $group->post('/delete', PersonController::class . ':delete');
    });

    $group->group('/rol', function (RouteCollectorProxy $group) {
        $group->get('', RolController::class . ':index')->add(new RemoveCsrfMiddleware());

        $group->post('', RolController::class . ':list');
        $group->post('/save', RolController::class . ':store');
        $group->post('/search', RolController::class . ':search');
        $group->post('/update', RolController::class . ':update');
        $group->post('/delete', RolController::class . ':delete');
    });

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

    $group->group("/subordenes", function (RouteCollectorProxy $group) {
        $group->get("", SubordenesController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", SubordenesController::class . ":list");
        $group->post("/save", SubordenesController::class . ":store");
        $group->post("/search", SubordenesController::class . ":search");
        $group->post("/update", SubordenesController::class . ":update");
        $group->post("/delete", SubordenesController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/familias", function (RouteCollectorProxy $group) {
        $group->get("", FamiliasController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", FamiliasController::class . ":list");
        $group->post("/save", FamiliasController::class . ":store");
        $group->post("/search", FamiliasController::class . ":search");
        $group->post("/update", FamiliasController::class . ":update");
        $group->post("/delete", FamiliasController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/generos", function (RouteCollectorProxy $group) {
        $group->get("", GenerosController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", GenerosController::class . ":list");
        $group->post("/save", GenerosController::class . ":store");
        $group->post("/search", GenerosController::class . ":search");
        $group->post("/update", GenerosController::class . ":update");
        $group->post("/delete", GenerosController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/especies", function (RouteCollectorProxy $group) {
        $group->get("", EspeciesController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", EspeciesController::class . ":list");
        $group->post("/save", EspeciesController::class . ":store");
        $group->post("/search", EspeciesController::class . ":search");
        $group->post("/update", EspeciesController::class . ":update");
        $group->post("/delete", EspeciesController::class . ":delete");

        $group->post("/subordenes", EspeciesController::class . ":subordenes");
        $group->post("/familias", EspeciesController::class . ":familias");
        $group->post("/generos", EspeciesController::class . ":generos");
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