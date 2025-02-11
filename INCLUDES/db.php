<?php

//Conexao com o banco de dados
$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = '';

//Criar conexao com o banco de dados

$conn = new mysqli($host,$user,$pass,$dbName);

//Condicao caso haja erro de conexao

if($conn -> connect_error){

    die("Erro ao tentar se conectar com o banco de dados: " . $conn->connect_error);
}






?>