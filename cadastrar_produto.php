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
    <title>CADASTRO</title>
    <link rel="stylesheet" href="CSS/cadastroProd.css">
</head>

<body>
    <div class="container">
        <form method="POST">
            <h1>CADASTRO DE PRODUTOS</h1>
            <section id="cadastroProduto">


                <?php if (isset($error_message)): ?>
                    <p class="erro"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <?php if (isset($success_message)): ?>
                    <p class="sucesso"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <div class="container">

                    <label for="productName">Nome:</label>
                    <input type="text" id="productName" name="productName" required><br>


                    <label for="category">Categoria:</label><br>
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
                    </select><br><br>


                    <label for="quantity">Quantidade:</label>
                    <input type="number" id="quantity" name="quantity" required><br>


                    <label for="unitPrice">Preço Unitário:</label>
                    <input type="text" id="unitPrice" name="unitPrice" required><br>


                    <label for="supplier">Fornecedor:</label>
                    <input type="text" id="supplier" name="supplier" required><br>


                    <label for="entryDate">Data Entrada:</label>
                    <input type="date" id="entryDate" name="entryDate" required><br>


                    <label for="expiryDate">Vencimento:</label>
                    <input type="date" id="expiryDate" name="expiryDate" required><br>

                    <label for="productStatus">Status:</label><br>
                    <select id="productStatus" name="productStatus">
                        <
                            <option value="">Selecione um status</option>
                            <option value="Em estoque">Em estoque</option>
                            <option value="Estoque mínimo ">Estoque mínimo </option>
                            <option value="próximo da validade">próximo da validade</option>
                    </select><br><br>


                    <label for="location">Local:</label>
                    <input type="text" id="location" name="location" placeholder="Ex: Corredor A, Prateleira 5 (Digite A5)" required><br>


                    <label for="description">Descrição:</label>
                    <input type="text" id="description" name="description" required><br>


                    <label for="note">Observação:</label>
                    <input type="text" id="note" name="note"> <br>

                    <input type="submit" name="register_product" id="register_produc">Cadastrar</button>

                </div>

        </form>
        </section>
        </form>

</body>

</html>