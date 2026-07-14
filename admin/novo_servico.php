<?php

require_once "../verificar_sessao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Serviço | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Novo Serviço</h1>

    <p class="subtitulo">

        Cadastre um novo serviço oferecido pelo Studio.

    </p>

    <form action="salvar_servico.php" method="POST">

        <label for="nome">

            Nome do Serviço

        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="120"
            required>

        <label for="valor">

            Valor (R$)

        </label>

        <input
            type="number"
            id="valor"
            name="valor"
            step="0.01"
            min="0"
            required>

        <label for="duracao">

            Duração (minutos)

        </label>

        <input
            type="number"
            id="duracao"
            name="duracao"
            min="1"
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

            Salvar Serviço

        </button>

        <a href="listar_servicos.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>