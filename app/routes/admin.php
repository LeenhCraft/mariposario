<?php

// use Slim\App;

use App\Controllers\Admin\ArticulosController;
use App\Controllers\Admin\AutoresController;
use App\Controllers\Admin\CopiasController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\DataBaseController;
use App\Controllers\Admin\EditorialesController;
use App\Controllers\Admin\LibrosController;
use Slim\Routing\RouteCollectorProxy;

// Controllers
use App\Controllers\Admin\LoginAdminController;
use App\Controllers\Admin\MenusController;
use App\Controllers\Admin\PermisosController;
use App\Controllers\Admin\PersonController;
use App\Controllers\Admin\ReservasController;
use App\Controllers\Admin\RolController;
use App\Controllers\Admin\SubmenusController;
use App\Controllers\Admin\TipoArticulosController;
use App\Controllers\Admin\UserController;
use App\Controllers\LogoutController;
use App\Middleware\AdminMiddleware;

// Middlewares
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

    $group->group("/tipos", function (RouteCollectorProxy $group) {
        $group->get("", TipoArticulosController::class . ":index")->add(new RemoveCsrfMiddleware());
        $group->post("", TipoArticulosController::class . ":list");
        $group->post("/save", TipoArticulosController::class . ":store");
        $group->post("/search", TipoArticulosController::class . ":search");
        $group->post("/update", TipoArticulosController::class . ":update");
        $group->post("/delete", TipoArticulosController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/autores", function (RouteCollectorProxy $group) {
        $group->get("", AutoresController::class . ":index")->add(new RemoveCsrfMiddleware());
        $group->post("", AutoresController::class . ":list");

        $group->post("/save", AutoresController::class . ":store");
        $group->post("/search", AutoresController::class . ":search");
        $group->post("/update", AutoresController::class . ":update");
        $group->post("/delete", AutoresController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/editoriales", function (RouteCollectorProxy $group) {
        $group->get("", EditorialesController::class . ":index")->add(new RemoveCsrfMiddleware());
        $group->post("", EditorialesController::class . ":list");

        $group->post("/save", EditorialesController::class . ":store");
        $group->post("/search", EditorialesController::class . ":search");
        $group->post("/update", EditorialesController::class . ":update");
        $group->post("/delete", EditorialesController::class . ":delete");
    })->add(PermissionMiddleware::class);

    $group->group("/articulos", function (RouteCollectorProxy $group) {
        $group->get("", ArticulosController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", ArticulosController::class . ":list");
        $group->post("/save", ArticulosController::class . ":store");
        $group->post("/search", ArticulosController::class . ":search");
        $group->post("/update", ArticulosController::class . ":update");
        $group->post("/delete", ArticulosController::class . ":delete");
        $group->post("/tipos", ArticulosController::class . ":tipos");
    })->add(PermissionMiddleware::class);

    $group->group("/libros", function (RouteCollectorProxy $group) {
        $group->get("", LibrosController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", LibrosController::class . ":list");
        $group->post("/save", LibrosController::class . ":store");
        $group->post("/search", LibrosController::class . ":search");
        $group->post("/update", LibrosController::class . ":update");
        $group->post("/delete", LibrosController::class . ":delete");
        $group->post("/autores", LibrosController::class . ":autores");
        $group->post("/editoriales", LibrosController::class . ":editoriales");
        $group->post("/articulos", LibrosController::class . ":articulos");
    })->add(PermissionMiddleware::class);

    $group->group("/copias", function (RouteCollectorProxy $group) {
        $group->get("", CopiasController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", CopiasController::class . ":list");
        $group->post("/save", CopiasController::class . ":store");
        $group->post("/search", CopiasController::class . ":search");
        $group->post("/update", CopiasController::class . ":update");
        $group->post("/delete", CopiasController::class . ":delete");
        $group->post("/libros", CopiasController::class . ":libros");
    })->add(PermissionMiddleware::class);

    $group->group("/reservas", function (RouteCollectorProxy $group) {
        $group->get("", ReservasController::class . ":index")->add(new RemoveCsrfMiddleware());

        $group->post("", ReservasController::class . ":list");
        $group->post("/save", ReservasController::class . ":store");
        $group->post("/search", ReservasController::class . ":search");
        $group->post("/update", ReservasController::class . ":update");
        $group->post("/delete", ReservasController::class . ":delete");
        $group->post("/libros", ReservasController::class . ":libros");
    })->add(PermissionMiddleware::class);
})->add(new LoginAdminMiddleware());
