<?php

Class Database {
    private $conn;

    private string $server = "localhost";

    private string $db = "pessoas";

    private string $user = "root";

    private string $pass = "";

    private $table;

    public function __construct($table = null){
        $this->table = $table;
        $this->conectar();
    }

    public function conectar(){
        try {
            $this->conn = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db . ";", $this->user, $this->pass);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Conectado com sucesso!";
        } catch (\Throwable $th) {
            echo "<pre>";
            print_r($th->getMessage());
            echo "</pre>";
        }
    }

    public function execute($query, $binds = []){
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);

            return $stmt;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function insert($values){
        try {
            $fields = array_keys($values);
            $binds = array_fill(0, count($fields), '?');

            $query = 'INSERT INTO ' .$this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

            $res = $this->execute($query, array_values($values));

            return $res ? true : false;
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function select($fields = '*'){
        try {
            $query = " SELECT " . $fields . " FROM " . $this->table . ";";

            return $this->execute($query);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}

?>