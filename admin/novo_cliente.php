<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Cliente | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Novo Cliente</h1>

    <p class="subtitulo">

        Cadastre um novo cliente.

    </p>

    <form action="salvar_cliente.php" method="POST">

        <label for="nome">

            Nome

        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="120"
            required>

        <label for="telefone">

            Telefone

        </label>

        <input
            type="tel"
            id="telefone"
            name="telefone"
            maxlength="20"
            required>

        <label for="email">

            E-mail

        </label>

        <input
            type="email"
            id="email"
            name="email"
            maxlength="120">

        <br><br>

        <button type="submit">

            Salvar

        </button>

        <a href="listar_clientes.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>