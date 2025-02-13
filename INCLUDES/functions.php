<?php

session_start();



//Criando funcões


//Cadastrar usuario

function registerUser($name, $email, $password, $profileType, $conn)
{

    //CRUD

    $passHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn = $conn->prepare("INSERT INTO users(userName,email,userPassword,profileType) VALUES (?,?,?,?)");

    $stmt->bind_param("ssss", $name, $email, $passHash, $profileType);

    return $stmt->execute();
}

// funcao para fazer Login



function doLogin($email,$password,$conn){

    //prepara a query  SQL para buscar o usuário pelo email
    $stmt = $conn->prepare("SELECT user_id,userName,userPassword FROM users WHERE email = ?");

    //associa o parâmetro da query com a variável $email
    $stmt->bind_param("s",$email);

    //executar a query 
    $stmt->execute();
    //pegar o resulta da query
    $result = $stmt->get_result();

    ////converter o resultado em um array associativo
    $user = $result->fetch_assoc();

    //verificar se o usuário foi encontrado e se a senha está correta
    if($user && password_verify($password,$user['userPassword']) ){
        //caso o login for bem sucedido
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['userName'];
        return true;

    }
    return false;
}




//Cadastrar produto

 function registerProduct($usuario_id,$codigoProduto,$nomeProduto,$descricaoProduto,$categoria,$quant,$preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs,$conn){

    $stmt = $conn->prepare("INSERT INTO produtos (usuario_id, codigoProduto, nomeProduto, descricaoProduto, categoria, quant, preco, dataEntrada, dataValidade, localizacao, stat, obs) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param("iisssidsdsss", $usuario_id,$codigoProduto,$nomeProduto, $descricaoProduto, $categoria, $quant, $preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs);

    return $stmt->execute();


}

//Visualizar produto

function viwProduct(){}

// Editar produto

function editProduct(){}



//Deletar produto

function delectProduct(){}




?>