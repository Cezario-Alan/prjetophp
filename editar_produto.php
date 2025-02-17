 <?php
session_start();

require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

// Validando se foi passado o id do produto;
if (!isset($_POST['id_product'])) {
    header('Location: conteudo.php');
    exit();
}

$product_id = $_POST['id_product'];

// Buscar o produto no banco de dados
$stmt = $conn->prepare("SELECT * FROM products WHERE id_product = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_assoc();


//Colocando os valores de cada  [produto a uma variavel
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {

    $productName = trim($_POST['productName']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unitPrice'];
    $supplier = trim($_POST['supplier']);
    $entryDate = $_POST['entryDate'];
    $expiryDate = $_POST['expiryDate'];
    $location = trim($_POST['location']);
    $productStatus = trim($_POST['productStatus']);
    $note = trim($_POST['note']);

    if (editProduct($product_id, $productName, $description, $category, $quantity, $unitPrice, $supplier, $entryDate, $expiryDate, $location, $productStatus, $note, $conn)) {
        $sucess_edition = "Editado com sucesso!";

        // Atualiza os valores na variável

        $products['productName'] = $productName;
        $products['description'] = $description;
        $products['category'] = $category;
        $products['quantity'] = $quantity;
        $products['unitPrice'] = $unitPrice;
        $products['supplier'] = $supplier;
        $products['entryDate'] = $entryDate;
        $products['expiryDate'] = $expiryDate;
        $products['location'] = $location;
        $products['productStatus'] = $productStatus;
        $products['note'] = $note;

        header('Location: conteudo.php');
    } else {
        $erro_edition = "Erro ao editar produto";
    }
}
?> 

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/editarPro.css">
    <title>Editar Produto</title>
</head>

<body>

    <?php if (isset($sucess_edition)): ?>
        <p class="sucess_edition"><?php echo $sucess_edition; ?></p>
    <?php endif; ?>

    <?php if (isset($erro_edition)): ?>
        <p class="erro_edition"><?php echo $erro_edition; ?></p>
    <?php endif; ?>

    <h1>EDITAR PRODUTO</h1>

    <section>
    <form method="post">
        <!-- <input type="hidden" name="id_product" value="<?php echo $product_id; ?>"> -->

        <label for="productName">Nome do Produto</label><br>
        <input type="text" id="productName" name="productName" value="<?php echo $products['productName']; ?>" required> <br>

        <label for="category">Categoria</label><br>
        <select name="category" id="category">
            <option value="">Selecione uma categoria</option>
            <option value="Açougue" <?php echo ($products['category'] == 'Açougue') ? 'selected' : ''; ?>>Açougue</option>
            <option value="Frios e laticínios" <?php echo ($products['category'] == 'Frios e laticínios') ? 'selected' : ''; ?>>Frios e laticínios</option>
            <option value="Adega e bebidas" <?php echo ($products['category'] == 'Adega e bebidas') ? 'selected' : ''; ?>>Adega e bebidas</option>
            <option value="Higiene e limpeza" <?php echo ($products['category'] == 'Higiene e limpeza') ? 'selected' : ''; ?>>Higiene e limpeza</option>
            <option value="Hortifruti e mercearia" <?php echo ($products['category'] == 'Hortifruti e mercearia') ? 'selected' : ''; ?>>Hortifruti e mercearia</option>
            <option value="Padaria" <?php echo ($products['category'] == 'Padaria') ? 'selected' : ''; ?>>Padaria</option>
            <option value="Enlatados" <?php echo ($products['category'] == 'Enlatados') ? 'selected' : ''; ?>>Enlatados</option>
            <option value="Cereais" <?php echo ($products['category'] == 'Cereais') ? 'selected' : ''; ?>>Cereais</option>
        </select><br><br>

        <label for="quantity">Quantidade em Estoque</label><br><br>
        <input type="number" id="quantity" name="quantity" value="<?php echo $products['quantity']; ?>" required><br>

        <label for="unitPrice">Preço</label><br><br>
        <input type="text" id="unitPrice" name="unitPrice" value="<?php echo $products['unitPrice']; ?>"><br>

        <label for="supplier">Fornecedor</label><br><br>
        <input type="text" id="supplier" name="supplier" value="<?php echo $products['supplier']; ?>"><br>

        <label for="entryDate">Data de entrada</label><br><br>
        <input type="date" id="entryDate" name="entryDate" value="<?php echo $products['entryDate']; ?>"><br>

        <label for="expiryDate">Data de validade</label><br><br>
        <input type="date" id="expiryDate" name="expiryDate" value="<?php echo $products['expiryDate']; ?>"><br>

        <label for="location">Localização no Armazém</label><br><br>
        <input type="text" id="location" name="location" value="<?php echo $products['location']; ?>"><br>

        <label for="productStatus">Status</label><br><br>
        <select name="productStatus" id="productStatus">
            <option value="">Selecione o Status</option>
            <option value="Em estoque" <?php echo ($products['productStatus'] == 'Em estoque') ? 'selected' : ''; ?>>Em estoque</option>
            <option value="Estoque mínimo" <?php echo ($products['productStatus'] == 'Estoque mínimo') ? 'selected' : ''; ?>>Estoque mínimo</option>
            <option value="próximo da validade" <?php echo ($products['productStatus'] == 'próximo da validade') ? 'selected' : ''; ?>>Próximo da validade</option>
        </select><br><br>

        <label for="description">Descrição</label><br><br>
        <input type="text" id="description" name="description" value="<?php echo $products['description']; ?>"><br>

        <label for="note">Observações</label><br><br>
        <input type="text" id="note" name="note" value="<?php echo $products['note']; ?>"><br><br>
        <input type="hidden" name="id_product" value="<?php echo $product_id; ?>">


        <input   type="submit" name="edit_product" value="Editar"></input>
    </form>
</section>

</body>

</html>