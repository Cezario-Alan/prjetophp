<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Produtos (admin)</title>
    <link rel="stylesheet" href="CSS/cadastroProd.css">
</head>
<body>

    <form method="POST"">

    <div class="container">
    <h1>Gestão produtos (adimin)</h1>
    <section id="cadastroProduto">

  

    <label for="productName" >Nome:</label>
    <input type="text" id="productName" name="productName">

    <label for="category" >Categoria: </label>
    <input type="number" id="category" name="category">
    <label for="quantity" >Quantidade:</label>
    <input type="number" id="quantity" name="quantity">

    <label for="unitPrice" >Preço Un:</label>
    <input type="text" id="unitPrice" name="unitPrice"><br><br>

    <label for="suplier" >Fornecedor:</label>
    <input type="text" id="suplier" name="suplier">
    <label for="entryDate" >Data entrada:</label>
    <input type="date" id="entryDate" name="entryDate">
    <label for="expiryDate" >Vencimento:</label>
    <input type="date" id="expiryDate" name="expidate">
    
    <label for="productStatus" >Status:</label>
    <input type="text" id="productStatus" name="productStatus"><br><br>
    <label for="location"> Local:</label>
    <input type="text" id="location" name="location">

    <label for="description" >Descrição:</label>
    <input type="text" id="description" name="description">

    <label for="note" >Observação</label>
    <input type="text" id="note" name="note">

    <input type="submit" value="Cadastrar">

    </section>


    </div>



</form>
    
</body>
</html>