<?php
session_start();

require 'INCLUDES/db.php';
require 'INCLUDES/functions.php';


//Verificar se esta logado

if(!isset($_SESSION['usuario_id'])){
    header('Location: index.php');
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">

    <h2>PRODUTOS EM ESTOQUE</h2>

        <table>
            <thead>
                <tr>
                    <th>Nome:</th>
                    <th>Categoria:</th>
                    <th>Quantidade:</th>
                    <th>Preço un:</th>
                    <th>Fornecedor:</th>
                    <th>Data ent</th>
                    <th>Data val:</th>
                    <th>Status:</th>
                    <th>Local:</th>
                    <th>Descrição:</th>
                    <th>Observação:</th>

                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['Name'];?></td>
                        <td><?php echo $product['category'];?></td>
                        <td><?php echo $product['quantity'];?></td>
                        <td><?php echo $product['unitPrice'];?></td>
                        <!-- <td><?php echo $product['suplier'];?></td>
                        <td><?php echo $product['dateEntry'];?></td>
                        <td><?php echo $product['date'];?></td> -->
                       
                        <td>
                             <a href="viw_product.php?id=<?php echo $product['id'];?>">Visualizar</a>
                            <a href="edit_product.php?id=<?php echo $product['id'];?>">Editar</a>
                            <a href="?remover=<?php echo $product['id']; ?>"onclick="return confirm('Tem certeza?')">Remover</a>
                         </td>                
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>
</html>
