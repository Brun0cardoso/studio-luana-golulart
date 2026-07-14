<?php
/**
 * ======================================================
 * PROJETO STUDIO
 * Arquivo de conexão com o banco de dados
 * ======================================================
 */

$host = "localhost";
$banco = "studio";
$usuario = "root";
$senha = "100991";

try {

    $pdo = new PDO(
    "mysql:host=$host;dbname=$banco;charset=utf8mb4",
    $usuario,
    $senha,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
);
    

} catch (PDOException $erro) {

    die("Erro ao conectar ao banco de dados: " . $erro->getMessage());

}