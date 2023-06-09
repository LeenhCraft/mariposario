<?php

namespace App\Models;

use Exception;
use mysqli;

class Model
{
    protected $db_host;
    protected $db_user;
    protected $db_pass;
    protected $db_name;
    protected $db_charset = "utf8mb4";
    protected $connection;
    protected $query;
    protected $table;
    protected $id = "id";

    protected $sql, $data = [], $params = null;

    protected $join = "", $orderBy = "", $limit = "";

    public function __construct()
    {
        $this->db_host = $_ENV['DB_HOST'];
        $this->db_user = $_ENV['DB_USERNAME'];
        $this->db_pass = $_ENV['DB_PASSWORD'];
        $this->db_name = $_ENV['DB_DATABASE'];
        $this->db_charset = $_ENV['DB_CHARSET'];
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        $this->connection->set_charset($this->db_charset);
    }

    public function query($sql, $data = [], $params = null)
    {
        $this->sql = $sql;
        if ($data) { //si data es diferente de null
            if ($params == null) {
                $params = str_repeat("s", count($data));
            }
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();
            $this->query = $stmt->get_result();
        } else {
            $this->query = $this->connection->query($sql);
        }
        return $this;
    }

    // funcion para vaciar querys
    public function emptyQuery()
    {
        $this->query = null;
        $this->sql = null;
        $this->data = [];
        $this->params = null;
        $this->join = "";
        $this->orderBy = "";
        $this->limit = "";
        return $this;
    }

    public function orderBy($column, $order = "ASC")
    {
        if (empty($this->orderBy)) {
            $this->orderBy = " ORDER BY {$column} {$order}";
        } else {
            $this->orderBy .= ", {$column} {$order}";
        }

        return $this;
    }

    public function limit($limit)
    {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }

    public function first()
    {
        if (empty($this->query)) {

            if (empty($this->sql)) {
                $this->sql = "SELECT * FROM {$this->table}";
            }

            $this->sql .= $this->orderBy;

            $this->query($this->sql, $this->data, $this->params);
        }
        return $this->query->fetch_assoc();
    }

    public function get()
    {
        if (empty($this->query)) {

            if (empty($this->sql)) {
                $this->sql = "SELECT * FROM {$this->table}";
            }

            $this->sql .= $this->join;

            $this->sql .= $this->orderBy;

            $this->sql .= $this->limit;

            $this->query($this->sql, $this->data, $this->params);
        }
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function paginate($cant = 15)
    {
        $start = $last_page = 0;
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        // $cant = isset($_GET['perpage']) && is_numeric($_GET['perpage']) ? $_GET['perpage'] : $cant;
        if (isset($_GET['perpage'])) {
            $cant = is_numeric($_GET["perpage"]) ? $_GET["perpage"] : 'all';
        }
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if (is_numeric($cant))
            $start = ($page - 1) * $cant;

        // if ($this->sql) {
        //     if (!is_numeric($cant))
        //         $sql = $this->sql . ($this->orderBy ?? '');

        //     if (is_numeric($cant))
        //         $sql = $this->sql . ($this->orderBy ?? '') . " LIMIT {$start}, {$cant}";

        //     $data = $this->query($sql, $this->data, $this->params)->get();
        // } else {
        //     if (!is_numeric($cant))
        //         $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} " . ($this->orderBy ?? '');

        //     if (is_numeric($cant))
        //         $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} " . $this->join . " " . ($this->orderBy ?? '') . " LIMIT {$start}, {$cant}";
        //     $data = $this->query($sql)->get();
        // }

        if (!is_numeric($cant)) {
            $sql = ($this->sql ? $this->sql : "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table}" . $this->join) . ($this->orderBy ?? '');
        } else {
            $sql = ($this->sql ? $this->sql : "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table}" . $this->join) . ($this->orderBy ?? '') . " LIMIT {$start}, {$cant}";
        }

        $data = $this->query($sql, $this->data, $this->params)->get();



        $total = $this->query("SELECT FOUND_ROWS() as total")->first()['total'];
        if (is_numeric($cant)) {
            $last_page = ceil($total / $cant);
            $next_page_url = $page < $last_page ?  "/{$uri}?page=" . ($page + 1) . "&perpage=" . $cant : null;
            $prev_page_url = $page > 1 ? "/{$uri}?page=" . ($page - 1) . "&perpage=" . $cant  : null;
        } else {
            $next_page_url = null;
            $prev_page_url = null;
        }
        return [
            'total' => $total,
            'from' => $start + 1, //desde que registro se muestra
            'to' => $start + count($data), // hasta que registro se muestra
            'current_page' => $page, //pagina actual
            'per_page' => $cant, //cantidad de registros por pagina
            'next_page_url' => $next_page_url, //pagina siguiente
            'prev_page_url' => $prev_page_url, //pagina anterior
            'last_page' => $last_page, //ultimo numero de pagina
            'data' => $data,
        ];
    }

    public function paginate_int($cant = 15, $pg = 1, $srt = "", $ordr = "")
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        // $cant = isset($_GET['limit']) && is_numeric($_GET['limit']) ? $_GET['limit'] : $cant;
        $page = $pg != 1 && is_numeric($pg) ? $pg : 1;
        $sort = $srt != "" ? "ORDER BY " . strClean($srt) : $this->orderBy;
        $order = $ordr != "" ? strClean($ordr) : "";
        $start = ($page - 1) * $cant;

        if ($this->sql) {
            $sql = $this->sql . ' ' . $sort . ' ' . $order . " LIMIT {$start}, {$cant}";
            $data = $this->query($sql, $this->data, $this->params)->get();
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} " . $sort . ' ' . $order . " LIMIT {$start}, {$cant}";
            $data = $this->query($sql)->get();
        }

        $total = $this->query("SELECT FOUND_ROWS() as total")->first()['total'];
        $last_page = ceil($total / $cant);
        $next_page_url = $page < $last_page ?  "/{$uri}?page=" . ($page + 1) . "&limit=" . $cant : null;
        $prev_page_url = $page > 1 ? "/{$uri}?page=" . ($page - 1) . "&limit=" . $cant  : null;
        return [
            'total' => $total,
            'from' => $start + 1, //desde que registro se muestra
            'to' => $start + count($data), // hasta que registro se muestra
            'current_page' => $page, //pagina actual
            'per_page' => $cant, //cantidad de registros por pagina
            'next_page_url' => $next_page_url, //pagina siguiente
            'prev_page_url' => $prev_page_url, //pagina anterior
            'last_page' => $last_page, //ultimo numero de pagina
            'data' => $data,
        ];
    }


    //consulttas preparadas
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->id} = ?";
        return $this->query($sql, [$id], "i")->first();
    }

    public function where($column, $operator = "=", $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = "=";
        }

        if (empty($this->sql)) {
            $this->sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$column} {$operator} ?";

            $this->data[] = $value;
        } else {
            $this->sql .= " AND {$column} {$operator} ?";
            $this->data[] = $value;
        }


        // $this->query($sql, [$value]);
        return $this;
    }

    public function orWhere($column, $operator = "=", $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = "=";
        }

        if (empty($this->sql)) {
            $this->sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$column} {$operator} ?";

            $this->data[] = $value;
        } else {
            $this->sql .= " OR {$column} {$operator} ?";
            $this->data[] = $value;
        }
        return $this;
    }

    public function create($data)
    {
        $columns = implode(", ", array_keys($data));
        // $values = "'" . implode("', '", array_values($data)) . "'";
        $values = array_values($data);

        // $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat("?,", count($values) - 1) . "?)";
        $this->query($sql, $values);
        $insert_id = $this->connection->insert_id;
        return $this->find($insert_id);
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
        }
        $fields = implode(", ", $fields);
        $sql = "UPDATE {$this->table} SET {$fields} WHERE {$this->id} = ?";
        $values = array_values($data);
        $values[] = $id;
        $this->query($sql, $values);
        return $this->find($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->id} = ?";
        $this->query($sql, [$id], 'i');
        return $this->connection->affected_rows;
    }

    // funcion para ejecutar multiples consultas en una sola linea con mysqli_multi_query
    public function multiQuery($sql)
    {
        return $this->connection->multi_query($sql);
    }

    // funcion inner join
    public function join($table, $first, $operator = "=", $second = null)
    {
        if ($second === null) {
            $second = $first;
        }

        $this->join .= " INNER JOIN {$table} ON {$table}.{$first} {$operator} {$this->table}.{$second}";
        return $this;
    }

    // funcion inner join
    public function otherJoin($table, $first, $operator = "=", $table_seconn = null, $second = null)
    {
        if ($second === null) {
            $second = $first;
        }

        if ($table_seconn === null) {
            $table_second = $this->table;
        }

        $this->join .= " INNER JOIN {$table} ON {$table}.{$first} {$operator} {$table_seconn}.{$second}";
        return $this;
    }


    // fuccion left join
    public function leftJoin($table, $first, $operator = "=", $second = null)
    {
        if ($second === null) {
            $second = $first;
        }

        $this->join .= " LEFT JOIN {$table} ON {$table}.{$first} {$operator} {$this->table}.{$second}";
        return $this;
    }
}
