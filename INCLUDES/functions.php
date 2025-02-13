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

// Fazer Login

function doLogin($email, $password, $conn)
{

    //CRUD

    $stmt = $conn->prepare("SELECT user_id,userName,userPassword,profileType FROM  users WHERE email = ?");

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();


    //condicao para validar o login


    if ($user && password_verify($password, $user['userPassword'])) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['userName'];

        return true;
    }
    return false;
}




?>