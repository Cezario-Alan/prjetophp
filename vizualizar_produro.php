<?php
require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';

if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit();
}

// verificar se o ID do usuário foi passado

if(!isset($_GET['user_id'])){
    header('Location: conteudo.php');
    exit();
}

$id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];

// buscar os detalhes do veículo
$stmt = $conn->prepare("SELECT * FROM products");
// $stmt->bind_param("ii",$id,$user_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if(!$product){
    header('Location: conteudo.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdo</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container">
        <h1>Detalhes do produto</h1>
        <a href="conteudo.php"></a>

    <p><strong>Nome:</strong> <?php echo $product['productName']; ?></p>
    <p><strong>Categoria:</strong> <?php echo $product['category']; ?></p>
    <p><strong>Quantidade:</strong> <?php echo $product['quantity']; ?></p>
    <p><strong>Preço Unitário:</strong> <?php echo $product['unitPrice']; ?></p>
    <p><strong>Fornecedor:</strong> <?php echo $product['suplier']; ?></p>
    <p><strong>Data de Entrada:</strong> <?php echo $product['dateEntry']; ?></p>
    <p><strong>Data de Validade:</strong> <?php echo $product['date']; ?></p>

    </div>
</body>
</html>