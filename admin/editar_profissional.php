<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Editar Profissional
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_profissionais.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            nome,
            especialidade,
            ativo
        FROM profissionais
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $profissional = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$profissional) {

        header("Location: listar_profissionais.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o profissional: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Profissional | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Profissional</h1>

    <p class="subtitulo">

        Atualize as informações do profissional.

    </p>

    <form action="atualizar_profissional.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $profissional["id"]; ?>">

        <label for="nome">

            Nome

        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="120"
            value="<?= htmlspecialchars($profissional["nome"]); ?>"
            required>

        <label for="especialidade">

            Especialidade

        </label>

        <input
            type="text"
            id="especialidade"
            name="especialidade"
            maxlength="120"
            value="<?= htmlspecialchars($profissional["especialidade"]); ?>"
            required>

        <label for="ativo">

            Status

        </label>

        <select
            id="ativo"
            name="ativo">

            <option
                value="1"
                <?= $profissional["ativo"] ? "selected" : ""; ?>>

                Ativo

            </option>

            <option
                value="0"
                <?= !$profissional["ativo"] ? "selected" : ""; ?>>

                Inativo

            </option>

        </select>

        <br><br>

        <button type="submit">

            Salvar Alterações

        </button>

        <a href="listar_profissionais.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>