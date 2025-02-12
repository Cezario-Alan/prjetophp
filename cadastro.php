<?php
require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

$erro_register = "";
$sucess_register = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm']; 
    $profileType = $_POST['profileType']; 

    // Validação básica
    if (empty($name) || empty($email) || empty($password) || empty($profileType)) {
        $erro_register = "Todos os campos são obrigatórios.";
    } elseif ($password !== $passwordConfirm) {
        $erro_register = "As senhas não coincidem.";
    } else {
        // Criptografa a senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Tenta registrar o usuário
        if (registerUser($name, $email, $hashedPassword, $profileType, $conn)) {
            $sucess_register = 'Cadastro realizado com sucesso!';
        } else {
            $erro_register = 'Erro ao cadastrar. E-mail já cadastrado.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form method="POST">
        <div class="container">
            <section>
                <h1>Cadastro</h1>
                <?php if ($erro_register): ?>
                    <p class="erro"><?php echo $erro_register; ?></p>
                <?php endif; ?>

                <?php if (isset($sucess_register)): ?>
                    <p class="sucess"><?php echo $sucess_register; ?></p>
                <?php endif; ?>

                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required><br><br>

                <label for="passwordConfirm">Confirmar Senha:</label>
                <input type="password" id="passwordConfirm" name="passwordConfirm" required><br><br>

                <label for="profileType">Tipo de perfil:</label>
                <select id="profileType" name="profileType"> 
                    <option value="admin">Administrador</option>
                    <option value="employer">Funcionário</option>
                </select><br><br>

                <input type="submit" name="register" value="Cadastrar">
                <p>Fazer <a href="index.php">Login</a></p>
            </section>
        </div>
    </form>
</body>
</html>