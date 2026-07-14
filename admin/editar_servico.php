<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Editar Serviço
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_servicos.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            nome,
            valor,
            duracao,
            ativo
        FROM servicos
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $servico = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$servico) {

        header("Location: listar_servicos.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o serviço: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Serviço</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Serviço</h1>

    <p class="subtitulo">

        Atualize as informações do serviço.

    </p>

    <form action="atualizar_servico.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $servico["id"] ?>">

        <label for="nome">Nome do Serviço</label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="120"
            value="<?= htmlspecialchars($servico["nome"]) ?>"
            required>

        <label for="valor">Valor (R$)</label>

        <input
            type="number"
            id="valor"
            name="valor"
            step="0.01"
            min="0"
            value="<?= $servico["valor"] ?>"
            required>

        <label for="duracao">Duração (minutos)</label>

        <input
            type="number"
            id="duracao"
            name="duracao"
            min="1"
            value="<?= $servico["duracao"] ?>"
            required>

        <label for="ativo">Status</label>

        <select
            id="ativo"
            name="ativo">

            <option
                value="1"
                <?= $servico["ativo"] ? "selected" : "" ?>>

                Ativo

            </option>

            <option
                value="0"
                <?= !$servico["ativo"] ? "selected" : "" ?>>

                Inativo

            </option>

        </select>

        <br><br>

        <button type="submit">

            Salvar Alterações

        </button>

        <a href="listar_servicos.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>