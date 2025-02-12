<?php
// Incluindo arquivos de conexão com o banco de dados
require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

$erro_login = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])) {
    $email = $_POST['email'];
    $password = $_POST['userPassword'];

    if (empty($email) || empty($password)) {
        $erro_login = "Todos os campos são obrigatórios.";
    } else {

        // Tenta fazer o login
        if (doLogin($email, $password, $conn)) {
            header('Location: conteudo.php');
            exit();
        } else {
            $erro_login = "E-mail e/ou senha incorretos.";
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