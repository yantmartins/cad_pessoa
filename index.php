<?php

require 'Usuario.php'; 

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];

    $objUser = new Usuario();
    $objUser->nome = $nome;
    $objUser->idade = $idade;
    $objUser->email = $email;

    $res = $objUser->cadastrar();

    if($res){
        echo '<script> alert("Cadastrado com sucesso") </script>';
    }else{
        echo '<script> alert("Não foi cadastrado") </script>';
    }
}

// $db = new Database("dados_pessoais");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form method="POST">
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            <br>
            <input type="number" id="idade" name="idade" placeholder="Digite sua idade">
            <br>
            <input type="email" id="email" name="email" placeholder="Digite seu email">
            <br>
            <button type="submit" name="cadastrar">Cadastrar</button>
        </form>
    </div>   
</body>
</html>