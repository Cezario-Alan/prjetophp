<?php

require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

//Validando se foi passado o id do produto;

if (isset($_GET['user_id'])) {

    header('Location: conteudo.php');
    exit();
}

//Validacao de usuario cadastrado

if (isset($_SESSION['user_id'])) {

    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículos</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">
        <h1>Editar Procuto</h1>
        <a href="conteudo.php">Voltar</a>

        <?php if (isset($sucess_edition)): ?>
            <p class="sucesso"><?php echo $sucess_edition; ?></p>
        <?php endif; ?>

        <?php if (isset($erro_edition)): ?>
            <p class="erro"><?php echo $erro_edition; ?></p>
        <?php endif; ?>

        <form method="POST">
           
            <input type="text" name="modelo" placeholder="quantidade" value="<?php echo $product['quantity']; ?>" required>
            <input type="date" name="validity" placeholder="validity" value="<?php echo $product['validity']; ?>" required>
            <button type="submit" name="edit_product">Salvar Alterações</button>

        </form>
    </div>
</body>

</html>