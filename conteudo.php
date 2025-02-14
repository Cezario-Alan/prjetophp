<?php
session_start();
require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Processar o formulário de cadastro de produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_product'])) {
    $product_id = $_POST['product_id'];
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unitPrice'];
    $dataEntry = $_POST['entryDate'];
    $valitDate = $_POST['expidate'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    $note = $_POST['note'];
    $user_id = $_SESSION['user_id'];

    if (registerProduct($user_id, $product_id, $productName, $description, $category, $quantity, $unitPrice, $dataEntry, $valitDate, $location, $status, $note, $conn)) {
        $sucess_product = 'Produto cadastrado com sucesso!';
    } else {
        $erro_product = 'Erro ao cadastrar produto.';
    }
}

// Processar a remoção do produto
if (isset($_GET['remover'])) {
    $id = $_GET['remover'];
    if (delectProduct($id, $conn)) {
        $sucess_product = 'Produto removido com sucesso!';
    } else {
        $erro_product = 'Erro ao remover produto';
    }
}

// Buscar os produtos do banco de dados
$products = [];

$sqli = "SELECT * FROM products";
$result = $conn->query($sqli);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos em Estoque</title>
    <link rel="stylesheet" href="CSS/table.css">
</head>

<body>
    <h2>PRODUTOS EM ESTOQUE</h2>
    <div class="container">
<section>
    
    
            <table border="1">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Fornecedor</th>
                        <th>Data de Entrada</th>
                        <th>Data de Validade</th>
                        <th>Localização</th>
                        <th>Status do Produto</th>
                        <th>Descrição</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                            <tr>
                                 <td><?php echo htmlspecialchars($product['productName']); ?></td>
                                <td><?php echo htmlspecialchars($product['productName']); ?></td>
                                <td><?php echo htmlspecialchars($product['category']); ?></td>
                                <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                                <td>R$ <?php echo number_format($product['unitPrice'], 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($product['supplier'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($product['entryDate']); ?></td>
                                <td><?php echo htmlspecialchars($product['expiryDate']); ?></td>
                                <td><?php echo htmlspecialchars($product['location']); ?></td>
                                <td><?php echo htmlspecialchars($product['productStatus'] ?? 'Sem status'); ?></td>
                                <td><?php echo htmlspecialchars($product['description']); ?></td>
                                <td><?php echo htmlspecialchars($product['note'] ?? 'Sem observações'); ?></td>
                            </tr>
                            <!-- <a href="viw_product.php?id=<?php echo $product['id']; ?>">Visualizar</a> |
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>">Editar</a> | -->
                            <!-- <a href="?remover=<?php echo $product['id']; ?>" onclick="return confirm('Tem certeza?')">Remover</a> -->
                            </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8">Nenhum produto encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
</section>
    </div>
</body>

</html>