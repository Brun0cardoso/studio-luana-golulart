<?php

include("config/conexao.php");

$nome = "Luana";
$email = "admin@studio.com";
$senha = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios(nome, email, senha)
        VALUES('$nome','$email','$senha')";

if (mysqli_query($conexao, $sql)) {
    echo "Administrador criado com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conexao);
}