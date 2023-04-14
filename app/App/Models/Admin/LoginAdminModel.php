<?php

namespace App\Models\Admin;

use App\Models\Model;

class LoginAdminModel extends Model
{
    protected $table = "sis_usuarios", $id = "idusuario";

    public function getUser($campo, $valor)
    {
        $operador = "LIKE";
        if ($campo === "idusuario") {
            $operador = "=";
        }
        $sql = "SELECT * FROM sis_usuarios a INNER JOIN sis_personal b ON b.idpersona = a.idpersona WHERE $campo $operador ?";
        return $this->query($sql, [$valor])
            ->first();
    }

    public function getRol($campo, $valor)
    {
        $operador = "LIKE";
        if ($campo === "idrol") {
            $operador = "=";
        }
        $sql = "SELECT * FROM sis_rol WHERE $campo $operador ?";
        return $this->query($sql, [$valor])
            ->first();
    }

    public function bscUsu($id)
    {
        $sql = "SELECT b.per_nombre as nombre, c.rol_nombre as rol FROM sis_usuarios a 
        INNER JOIN sis_personal b ON a.idpersona=b.idpersona 
        INNER JOIN sis_rol c ON c.idrol=a.idrol  WHERE a.idusuario='{$id}'";
        $request = $this->query($sql)->first();
        return empty($request) ? 'sin datos' : $request;
    }
}
