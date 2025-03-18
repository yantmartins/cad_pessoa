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
}