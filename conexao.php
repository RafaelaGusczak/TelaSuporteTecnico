<?php
$servername = "localhost:3306"; // Ou o endereço do servidor de banco de dados
$username = "root"; // Seu usuário do MySQL
$password = "root"; // Sua senha do MySQL
$dbname = "Suporte"; // Nome do banco de dados

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
