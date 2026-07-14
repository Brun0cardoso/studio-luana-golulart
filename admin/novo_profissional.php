<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Profissional | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Novo Profissional</h1>

    <p class="subtitulo">

        Cadastre um novo profissional.

    </p>

    <form action="salvar_profissional.php" method="POST">

        <label for="nome">

            Nome

        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="120"
            required>

        <label for="especialidade">

            Especialidade

        </label>

        <input
            type="text"
            id="especialidade"
            name="especialidade"
            maxlength="120"
            required>

        <label for="ativo">

            Status

        </label>

        <select
            id="ativo"
            name="ativo">

            <option value="1" selected>

                Ativo

            </option>

            <option value="0">

                Inativo

            </option>

        </select>

        <br><br>

        <button type="submit">

            Salvar

        </button>

        <a href="listar_profissionais.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>