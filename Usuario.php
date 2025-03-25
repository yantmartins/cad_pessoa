<?php

require 'Database.php';

Class Usuario{
    public int $id;

    public string $nome;

    public int $idade;

    public string $email;

    public function cadastrar(){
        $db = new Database('dados_pessoais');

        $res = $db->insert(
            [
                "nome" => $this->nome,
                "idade" => $this->idade,
                "email" => $this->email
            ]
        );
        return $res;
    }

    public function buscar_todos(){
        try {
            $db = new Database('dados_pessoais');

            $res = $db->select();

            $res = $res->fetchAll(PDO::FETCH_ASSOC);

            return $res;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function excluir($id){
        try {
            $db = new Database('dados_pessoais');

            $res = $db->delete('id = '. $id);

            return $res;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}