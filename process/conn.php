<?php
session_start();

$host = '127.0.0.1'; // ou 'localhost'
$db = 'pizzaria'; // Nome do banco de dados
$user = 'root'; // Nome de usuário
$pass = 'Gabriel9112'; // Senha do usuário

try {

    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    print "Erro: " . $e->getMessage() . "<br/>";
    die();
    
}
?>
