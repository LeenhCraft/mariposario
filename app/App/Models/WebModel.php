<?php

namespace App\Models;

class WebModel extends Model
{
    protected $table = "bib_articulos";

    public function car_art($idvisita)
    {
        $sql = "SELECT SUM(car_cantidad) as car_cantidad FROM web_carritos WHERE idvisita = '$idvisita' AND car_anulado = 0 AND idreserva = 0";
        $request = $this->query($sql)->first();
        return $request['car_cantidad'];
    }

    public function rg_visita($idvisita, $ip = "", $agente = "", $url = '', $method = "", $idwebusuario = 0)
    {
        // $this->table = "sis_visitas"; //con bd db_project
        $this->table = "web_visitas";
        $this->id = "idvisita";
        return $this->create([
            'vis_cod' => $idvisita,
            'idwebusuario' => $idwebusuario,
            'vis_ip' => $ip,
            'vis_agente' => $agente,
            'vis_method' => $method,
            'vis_url' => $url,
            // 'vis_method' => $method,
        ]);
        // $sql = "INSERT INTO sis_visitas(vis_cod,vis_ip,vis_agente,vis_url) VALUES (?,?,?,?)";
        // $arrData = array($idvisita, $ip, $agente, $url);
        // $response = $this->query($sql, $arrData);
        // return $response;
    }

    public function chk_vi($vis_cod)
    {
        // $this->table = "sis_visitas"; //con bd db_project
        $this->table = "web_visitas";
        // $sql = "SELECT * FROM sis_visitas WHERE vis_cod = $vis_cod AND idwebusuario !=0";
        // $request = $this->select($sql);
        // return $request;
        return $this->where("vis_cod", "=", $vis_cod)->where("idwebusuario", "!=", 0)->first();
    }

    public function centinel($idvisita, $ip = "", $agente = "", $url = '', $method = "", $idwebusuario = 0)
    {
        $this->table = "sis_centinela";
        $this->id = "idvisita";
        // $sql = "INSERT INTO api_centinela(vis_cod,vis_ip,vis_agente,vis_url,vis_method,idwebusuario) VALUES (?,?,?,?,?,?)";
        // $arrData = array($idvisita, $ip, $agente, $url, $method, $idwebusuario);
        // $response = $this->query($sql, $arrData);
        // return $response;

        return $this->create([
            'vis_cod' => $idvisita,
            'idwebusuario' => $idwebusuario,
            'vis_ip' => $ip,
            'vis_agente' => $agente,
            'vis_method' => $method,
            'vis_url' => $url,
        ]);
    }
}
