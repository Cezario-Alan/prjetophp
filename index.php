<?php

// Incluindo arquivos de conexão com o banco de dados
require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

$erro_login = '';

// Teste e atribuir valores nas variaveis com metodo post

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])) {
    $email =trim($_POST['email']);
    $password = trim($_POST['userPassword']);

    // Verificar se os campos estão vazios
    if (empty($email) || empty($password)) {
        $erro_login = "Todos os campos são obrigatórios.";
    } else {

        // Tenta fazer o login e redirecionar usuario com base em seu perfil
        if (doLogin($email, $password, $conn)) {
            $profile = $_SESSION['profileType'];


            switch ($profile) {
                case 'employer':
                    header('Location: conteudo.php');
                    exit();
                case 'admin':
                    header('Location: conteudo.php');
                    exit();
                default:
                    echo "usuario nao encontrado";
                    exit();
                }
            }
}}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="CSS/main.css">
=======
<<<<<<< HEAD
    <link rel="stylesheet" href="CSS/main.css">
=======
    
>>>>>>> 85e7eb4dade6a83ae0324aa19568dd1bb6b7e0fd
>>>>>>> b3f04e8d5a9a3dc0b9157ad41e476820fa9b4243
</head>

<body>
    <form method="POST">
        <div class="container">
            <section>
                <h1>Login</h1>

                <?php if ($erro_login): ?>
                    <p class="erro"><?php echo ($erro_login); ?></p>
                <?php endif; ?>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Senha:</label>
                <input type="password" id="userPassword" name="userPassword" required><br><br>

                <input type="submit" name="logar" value="Logar">

                <p>Fazer <a href="cadastro.php">cadastro</a></p>
            </section>
        </div>
    </form>
</body>

</html>