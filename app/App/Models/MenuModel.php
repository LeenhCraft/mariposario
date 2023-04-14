<?php

namespace App\Models;

class MenuModel extends Model
{
    public $table = 'web_menus';

    public $id = 'idmenu';

    protected $sql;

    public function menus()
    {
        $menu = $this->where('me_publico', 1)->where("me_status", 1)->get();
        foreach ($menu as $key => $value) {
            $menu[$key]['submenus'] = $this->query("SELECT * FROM web_submenus WHERE idmenu = {$value['idmenu']} AND me_publico = 1 AND me_status = 1")->get();
        }
        return $menu;
    }

    public function app_menus(int $idrol)
    {
        $sql = "SELECT * FROM sis_menus 
        WHERE idmenu IN( SELECT DISTINCT (c.idmenu) 
        FROM sis_permisos a INNER JOIN sis_submenus b ON a.idsubmenu = b.idsubmenu 
        LEFT JOIN sis_menus c ON c.idmenu = b.idmenu 
        WHERE a.idrol = '$idrol'  AND a.perm_r = 1 AND c.men_visible = 1 ) ORDER BY men_orden ASC";
        $request = $this->query($sql)->get();
        $data = [];
        for ($i = 0; $i < count($request); $i++) {
            $data[$i] = [
                'idmenu' => $request[$i]['idmenu'],
                'men_nombre' => (!empty($request[$i]['men_nombre'])) ? ucfirst($request[$i]['men_nombre']) : ucfirst('sin nombre'),
                'men_icono' => (!empty($request[$i]['men_icono'])) ? $request[$i]['men_icono'] : 'fa-solid fa-circle-notch',
                'men_url_si' => (!empty($request[$i]['men_url_si'])) ? $request[$i]['men_url_si'] : 0,
                'men_url' => (!empty($request[$i]['men_url'])) ? $request[$i]['men_url'] : '#'
            ];
        }
        return $data;
    }

    public function app_submenus(int $idmenu)
    {
        $idrol = $_SESSION['app_r'] ?? '0';
        $sql = "SELECT b.idsubmenu,b.idmenu,b.sub_nombre,b.sub_icono,b.sub_url FROM sis_permisos a
        INNER JOIN sis_submenus b ON a.idsubmenu=b.idsubmenu 
        WHERE b.idmenu = '$idmenu' AND b.sub_visible = 1 AND a.perm_r = 1 AND a.idrol = '$idrol' ORDER BY b.sub_orden ASC";
        $request = $this->query($sql)->get();

        $return = [];
        for ($i = 0; $i < count($request); $i++) {
            $return[$i] = [
                'idmenu' => $request[$i]['idmenu'],
                'idsubmenu' => $request[$i]['idsubmenu'],
                'sub_nombre' => (!empty($request[$i]['sub_nombre']) ? ucfirst($request[$i]['sub_nombre']) : ucfirst('sin nombre')),
                'sub_icono' => (!empty($request[$i]['sub_icono']) ? $request[$i]['sub_icono'] : 'fa-solid fa-circle-notch'),
                'sub_url' => (!empty($request[$i]['sub_url']) ? $request[$i]['sub_url'] : '#')
            ];
        }
        return $return;
    }

    public function app_pertenece($submenu, $menu)
    {
        $sql = "SELECT * FROM sis_submenus WHERE idmenu = '$menu' AND sub_url like BINARY '$submenu'";
        $request = $this->query($sql)->first();
        return $request;
    }

    public function app_menu_permisos($controlador)
    {
        $idrol = $_SESSION['app_r'] ?? '0';
        $sql = "SELECT * FROM sis_permisos a 
        INNER JOIN sis_submenus b ON a.idsubmenu=b.idsubmenu 
        WHERE b.sub_controlador LIKE BINARY '$controlador' AND a.idrol='$idrol'";
        $request = $this->query($sql)->first();
        return [
            'perm_r' => (!empty($request['perm_r']) ? $request['perm_r'] : '0'),
            'perm_w' => (!empty($request['perm_w']) ? $request['perm_w'] : '0'),
            'perm_u' => (!empty($request['perm_u']) ? $request['perm_u'] : '0'),
            'perm_d' => (!empty($request['perm_d']) ? $request['perm_d'] : '0')
        ];
    }
}
