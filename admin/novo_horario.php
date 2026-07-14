<?php

require_once "../verificar_sessao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Horário | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Novo Horário</h1>

    <p class="subtitulo">

        Cadastre um novo horário disponível para agendamento.

    </p>

    <form action="salvar_horario.php" method="POST">

        <label for="horario">

            Horário

        </label>

        <input
            type="time"
            id="horario"
            name="horario"
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

            Salvar Horário

        </button>

        <a href="listar_horarios.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>