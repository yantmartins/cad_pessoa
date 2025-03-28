<?php

require 'Usuario.php'; 

$objUser = new Usuario();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];

    
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

$usuarios = [];

if (isset($_GET['listar'])){
    $usuarios = $objUser->buscar_todos();
}

if(isset($_GET['delete_id'])){
    $deleteId = $_GET['delete_id'];
    $objUser->excluir($deleteId);
    $usuarios = $objUser->buscar_todos();
}

if(isset($_POST['editar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];

    $objUser->id = $id;
    $objUser->nome = $nome;
    $objUser->idade = $idade;
    $objUser->email = $email;

    $res = $objUser->atualizar();
    echo '<script> alert("' . ($res ? 'Editado com sucesso' : 'Não foi editado') . '") </script>';

    $usuarios = $objUser->buscar_todos();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function carregaDados(id, nome, idade, email){
            document.getElementById('id').value = id;
            document.getElementById('nome').value = nome;
            document.getElementById('idade').value = idade;
            document.getElementById('email').value = email;
            document.getElementById('submitButton').name = 'editar';
            document.getElementById('submitButton').innerText = 'Editar';
        }
    </script>
</head>
<body>
    <div>
        <form method="POST">
            <input type="hidden" id="id" name="id">
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            <br>
            <input type="number" id="idade" name="idade" placeholder="Digite sua idade">
            <br>
            <input type="email" id="email" name="email" placeholder="Digite seu email">
            <br>
            <button type="submit" name="cadastrar" id="submitButton">Cadastrar</button>
        </form>

        <form method="GET">
            <button type="submit" name="listar">Listar</button>
        </form>

        <?php if(!empty($usuarios)): ?>
            <h2>Usuários Cadastrados</h2>

            <table  border="1" collapse="collapse">
                <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Idade</td>
                <td>E-mail</td>
                </tr>
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['idade']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td>
                            <form method="POST">
                                <a name="deletar" href="?delete_id=<?= $usuario['id']?>">
                                    <img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/filled-trash.png" alt="filled-trash"/>
                                </a>
                            </form>
                        </td>
                        <td>
                            <button type="button" onclick="carregaDados(
                                '<?= htmlspecialchars($usuario['id']) ?>',
                                '<?= htmlspecialchars($usuario['nome']) ?>',
                                '<?= htmlspecialchars($usuario['idade']) ?>', 
                                '<?= htmlspecialchars($usuario['email']) ?>')">
                                <img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/edit--v3.png" alt="edit--v3"/>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php else: ?>
                <h2>Nenhum registro encontrado</h2>
            <?php endif ?>
    </div>   
</body>
</html>