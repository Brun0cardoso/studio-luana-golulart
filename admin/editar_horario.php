<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Editar Horário
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_horarios.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            horario,
            ativo
        FROM horarios
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $horario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$horario) {

        header("Location: listar_horarios.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o horário: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Horário | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Horário</h1>

    <p class="subtitulo">

        Atualize as informações do horário.

    </p>

    <form action="atualizar_horario.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $horario["id"]; ?>">

        <label for="horario">

            Horário

        </label>

        <input
            type="time"
            id="horario"
            name="horario"
            value="<?= date('H:i', strtotime($horario["horario"])); ?>"
            required>

        <label for="ativo">

            Status

        </label>

        <select
            id="ativo"
            name="ativo">

            <option
                value="1"
                <?= $horario["ativo"] ? "selected" : ""; ?>>

                Ativo

            </option>

            <option
                value="0"
                <?= !$horario["ativo"] ? "selected" : ""; ?>>

                Inativo

            </option>

        </select>

        <br><br>

        <button type="submit">

            Salvar Alterações

        </button>

        <a href="listar_horarios.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>