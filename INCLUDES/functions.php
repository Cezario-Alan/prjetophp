<?php

session_start();



//Criando funcoes


//Cadastrar usuario

function registerUser($name,$email,$password,$profileType,$conn){
    
        //CRUD

        $passHash = password_hash($password,PASSWORD_DEFAULT);

        $stmt = $conn = $conn -> prepare("INSERT INTO users(userName,email,userPassword,profileType) VALUES (?,?,?,?)");

        $stmt ->bind_param("ssss",$name,$email,$passHash,$profileType);

        return $stmt ->execute();



}

// Fazer Login

function doLogin($email,$password,$conn){

    //CRUD

    $stmt = $conn -> prepare("SELECT user_id,userName,userPassword,profileType FROM  users WHERE email = ?");
    
    $stmt -> blind_param("s", $email);

    $stmt -> execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();


    //condicao para validar o login


    if ($user && password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user ['userName'];

        return true;
    }
    return false;









}







?>