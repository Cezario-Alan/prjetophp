<?php
session_start(); 

require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

$erro_login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['userPassword']);

    if (empty($email) || empty($password)) {
        $erro_login = "Todos os campos são obrigatórios.";
    } else {
  
        if (doLogin($email, $password, $conn)) {
            $profile = $_SESSION['profileType'];

           
 

            switch ($profile) {
                case 'employer':
                    header('Location: conteudoEmployer.php');
                    exit();
                case 'admin':
                    header('Location: conteudo.php');
                    exit();
                default:
                    echo "Usuário não encontrado.";
                    exit();
            }
        } else {
            $erro_login = "Credenciais inválidas.";
        }
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

                <?php if ($erro_login): ?>
                    <p class="erro"><?php echo $erro_login; ?></p>
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
