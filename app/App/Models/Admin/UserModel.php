<?php

namespace App\Models\Admin;

use App\Models\Model;

class UserModel extends Model
{
    protected $table = "sis_usuarios";

    protected $id = "idwebusuario";

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function lstUser()
    {
        if ($_SESSION['app_r'] == 1) {
            $where = "";
        } else {
            $where = " WHERE idusuario != 1";
        }
        $sql = "SELECT a.idusuario as id,a.usu_usuario as usu,a.usu_activo as estado,b.rol_nombre as rol FROM sis_usuarios a INNER JOIN sis_rol b ON b.idrol=a.idrol $where";
        $request = $this->query($sql)->get();
        return $request;
    }
}
