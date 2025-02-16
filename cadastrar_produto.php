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
    $quantity = isset($_POST['quantity']);
    $unitPrice = trim($_POST['unitPrice']);
    $supplier = trim($_POST['supplier']);
    $entryDate = $_POST['entryDate'];
    $expiryDate = $_POST['expiryDate'];
    $location = trim($_POST['location']);
    $productStatus = trim($_POST['productStatus']);
    $note = trim($_POST['note']);

    $user_id = $_SESSION['user_id'];

    // Verificar se os campos obrigatórios estão preenchidos corretamente
    if (
        $productName === '' || $description === '' || $category === '' ||
        $quantity === null || $unitPrice === null || $supplier === '' ||
        $entryDate === '' || $expiryDate === '' || $location === ''
    ) {

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

                <div class="container">
                    
                        <label for="productName">Nome:</label>
                        <input type="text" id="productName" name="productName" required>
                    
                    
                        <label for="category">Categoria:</label>
                        <select id="category" name="category" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="Açougue">Açougue</option>
                            <option value="Frios e laticínios">Frios e laticínios</option>
                            <option value="Adega e bebidas">Adega e bebidas</option>
                            <option value="Higiene e limpeza">Higiene e limpeza</option>
                            <option value="Hortifruti e mercearia">Hortifruti e mercearia</option>
                            <option value="Padaria">Padaria</option>
                            <option value="Enlatados">Enlatados</option>
                            <option value="Cereais">Cereais</option>
                        </select>
                    
                    
                        <label for="quantity">Quantidade:</label>
                        <input type="number" id="quantity" name="quantity" required>
                    
                    
                        <label for="unitPrice">Preço Unitário:</label>
                        <input type="text" id="unitPrice" name="unitPrice" required>
                    
                    
                        <label for="supplier">Fornecedor:</label>
                        <input type="text" id="supplier" name="supplier" required>
                    
                    
                        <label for="entryDate">Data Entrada:</label>
                        <input type="date" id="entryDate" name="entryDate" required>
                    
                    
                        <label for="expiryDate">Vencimento:</label>
                        <input type="date" id="expiryDate" name="expiryDate" required>
                    
                        <label for="productStatus">Status:</label>
                        <select id="productStatus" name="productStatus">
                            <option value="">Selecione um status</option>
                            <option value="Em estoque">Em estoque</option>
                            <option value="Estoque mínimo ">Estoque mínimo </option>
                            <option value="próximo da validade">próximo da validade/option>
                        </select>
                    
                    
                        <label for="location">Local:</label>
                        <input type="text" id="location" name="location" required>
                    
                    
                        <label for="description">Descrição:</label>
                        <input type="text" id="description" name="description" required>
                    
                    
                        <label for="note">Observação:</label>
                        <input type="text" id="note" name="note">
                    
                    <input type="submit" name="register_product"></input>
                </div>

        </form>
        </section>
        </form>
    
</body>

</html>