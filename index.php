<?php

//Incluindo arquivos de conexao com o banco de dados

require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';




$erro_login = '';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(doLogin($email,$password,$conn)){

        header('Location: conteudo.php');
        exit();
    
    }else{
    
        $erro_login = "Email e ou senha incorretos";
    
    }
    

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/main.css">
</head>
<body>
    <form method="POST">
<div class="container">
    <section>

        <h1>Login</h1>

        <?php if($erro_login): ?>
        <p class="erro"><?php echo $erro_login;?></p> 

        <?php endif; ?>

        <?php if(isset($Sucess_login)): ?>

         <p class = "sucess"><?php echo $Sucess_login; ?></p> 

        <?php endif; ?>


        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email"><br><br>

        <label for="pass">Senha:</label>
        <input type="text" id="password" name="password"><br><br>
         <input type="submit" value="Logar">

         <p>Fazer  <a href="cadastro.php">cadastro</a></p>
        



    </section>
    




</div>


    </form>
    

    
    
</body>
</html>