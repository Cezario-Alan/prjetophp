<?php


$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'sistema_produtos';



$conn = new mysqli($host,$user,$pass,$dbName);



if($conn -> connect_error){

    die("Erro ao tentar se conectar com o banco de dados: " . $conn->connect_error);
}






?>