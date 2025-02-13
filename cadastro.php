<?php

require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

$erro_register = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $name = $_SERVER['name'];
    $email = $_SERVER['email'];
    $password = $_SERVER['password'];
    $profileType = $_SERVER['profileType'];

    if (registerUser($name, $email,$password, $profileType, $conn)) {

        $sucess_register = 'cadastro realizado com sucesso!!';
    } else {

        $erro_reister = 'Erro ao cadastrar. Email ja cadastrado';
    }
}







?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="CSS/main.css">
</head>

<body>
    <form method="POST">
        <div class="container">


            <section>

                <h1>CADASTRO</h1>
                <?php if ($erro_register): ?>
                    <p class="erro"><?php echo $erro_register; ?></p>

                <?php endif; ?>

                <?php if (isset($sucess_register)): ?>
                    <p class="sucess"><?php echo $sucess_register; ?></p>

                <?php endif; ?>

                <label for="name">Nome:</label>
                <input type="text" id="name" name="name"><br><br>

                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email"><br><br>

                <label for="pass">Senha:</label>
                <input type="text" id="password" name="password"><br><br>

                <label for="passConfirm">Confirmar Senha:</label>
                <input type="text" id="passwordConfirm" name="passwordConfirm"><br><br>

                <label for="profileType">Tipo de perfil</label>

                <select id="profileType" name="proifileType">

                    <option value="admin">Administrador</option>
                    <option value="employer">Funcionario</option>


                </select><br><br>



                <input type="submit" value="cadastrar">
                <p>Fazer <a href="index.php">Login</a></p>







            </section>





        </div>


    </form>




</body>

</html>