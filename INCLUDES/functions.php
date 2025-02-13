<?php





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
function doLogin($email, $password, $conn) {
    $stmt = $conn->prepare("SELECT user_id, userName, userPassword, profileType FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


    if ($user && password_verify($password, $user['userPassword'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['userName'];
        $_SESSION['profileType'] = $user['profileType'];
        return true;  
    }

    return false;  
}




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