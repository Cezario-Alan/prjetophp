<?php
session_start();
require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Processamento do formulário de cadastro de produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_product'])) {
    $productName = trim($_POST['productName']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : null;
    $unitPrice = isset($_POST['unitPrice']);
    $supplier = trim($_POST['supplier']);
    $entryDate = $_POST['entryDate'];
    $expiryDate = $_POST['expiryDate'];
    $location = trim($_POST['location']);
    $productStatus = trim($_POST['productStatus']);
    $note = trim($_POST['note']);

    $user_id = $_SESSION['user_id']; 

    // Verificar se os campos obrigatórios estão preenchidos corretamente
    if ($productName === '' || $description === '' || $category === '' || 
        $quantity === null || $unitPrice === null || $supplier === '' || 
        $entryDate === '' || $expiryDate === '' || $location === '') {
        
        $error_message = "Todos os campos obrigatórios devem ser preenchidos corretamente.";
    } else {
        // Chama a função registerProduct para salvar o produto no banco
        if (registerProduct($user_id, $productName, $description, $category, $quantity, $unitPrice, $supplier, $entryDate, $expiryDate, $location, $productStatus, $note, $conn)) {
            $success_message = "Produto cadastrado com sucesso!";
            header("Location: conteudo.php");
            exit();
        } else {
            $error_message = "Erro ao cadastrar produto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos (Admin)</title>
    <link rel="stylesheet" href="CSS/cadPro.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <section id="cadastroProduto">
                <h1>Gestão de Produtos(admin)</h1>

                <?php if (isset($error_message)): ?>
                    <p class="erro"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <?php if (isset($success_message)): ?>
                    <p class="sucesso"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <div class="form-group">
                    <label for="productName">Nome:</label>
                    <input type="text" id="productName" name="productName" required>
                </div>

                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <input type="text" id="category" name="category" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantidade:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>

                <div class="form-group">
                    <label for="unitPrice">Preço Unitário:</label>
                    <input type="text" id="unitPrice" name="unitPrice" required>
                </div>

                <div class="form-group">
                    <label for="supplier">Fornecedor:</label>
                    <input type="text" id="supplier" name="supplier" required> 
                </div>

                <div class="form-group">
                    <label for="entryDate">Data Entrada:</label>
                    <input type="date" id="entryDate" name="entryDate" required>
                </div>

                <div class="form-group">
                    <label for="expiryDate">Vencimento:</label>
                    <input type="date" id="expiryDate" name="expiryDate" required>
                </div>

                <div class="form-group">
                    <label for="productStatus">Status:</label>
                    <input type="text" id="productStatus" name="productStatus">
                </div>

                <div class="form-group">
                    <label for="location">Local:</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" id="description" name="description" required>
                </div>

                <div class="form-group">
                    <label for="note">Observação:</label>
                    <input type="text" id="note" name="note">
                </div>

                <button type="submit" name="register_product">Cadastrar</button>
            </section>
        </form>
    </div>
</body>
</html>
