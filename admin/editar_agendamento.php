<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Verifica se foi informado o ID
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || empty($_GET["id"])) {

    header("Location: listar_agendamentos.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    /*
    |--------------------------------------------------------------------------
    | Busca o agendamento
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT *
        FROM agendamentos
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $agendamento = $stmt->fetch();

    if (!$agendamento) {

        header("Location: listar_agendamentos.php");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Clientes
    |--------------------------------------------------------------------------
    */

    $clientes = $pdo->query("
        SELECT id, nome
        FROM clientes
        ORDER BY nome
    ")->fetchAll();

    /*
    |--------------------------------------------------------------------------
    | Serviços
    |--------------------------------------------------------------------------
    */

    $servicos = $pdo->query("
        SELECT id, nome
        FROM servicos
        ORDER BY nome
    ")->fetchAll();

    /*
    |--------------------------------------------------------------------------
    | Profissionais
    |--------------------------------------------------------------------------
    */

    $profissionais = $pdo->query("
        SELECT id, nome
        FROM profissionais
        ORDER BY nome
    ")->fetchAll();

    /*
    |--------------------------------------------------------------------------
    | Horários
    |--------------------------------------------------------------------------
    */

    $horarios = $pdo->query("
        SELECT id, horario
        FROM horarios
        ORDER BY horario
    ")->fetchAll();

} catch (PDOException $e) {

    die("Erro ao carregar o agendamento: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Agendamento</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Agendamento</h1>

    <form action="atualizar_agendamento.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $agendamento["id"] ?>">

        <label>Cliente</label>

        <select name="cliente_id" required>

            <?php foreach ($clientes as $cliente): ?>

                <option
                    value="<?= $cliente["id"] ?>"
                    <?= $cliente["id"] == $agendamento["cliente_id"] ? "selected" : "" ?>>

                    <?= htmlspecialchars($cliente["nome"]) ?>

                </option>

            <?php endforeach; ?>

        </select>

        <label>Serviço</label>

        <select name="servico_id" required>

            <?php foreach ($servicos as $servico): ?>

                <option
                    value="<?= $servico["id"] ?>"
                    <?= $servico["id"] == $agendamento["servico_id"] ? "selected" : "" ?>>

                    <?= htmlspecialchars($servico["nome"]) ?>

                </option>

            <?php endforeach; ?>

        </select>

        <label>Profissional</label>

        <select name="profissional_id">

            <option value="">Selecione</option>

            <?php foreach ($profissionais as $profissional): ?>

                <option
                    value="<?= $profissional["id"] ?>"
                    <?= $profissional["id"] == $agendamento["profissional_id"] ? "selected" : "" ?>>

                    <?= htmlspecialchars($profissional["nome"]) ?>

                </option>

            <?php endforeach; ?>

        </select>

        <label>Data</label>

        <input
            type="date"
            name="data_agendamento"
            value="<?= $agendamento["data_agendamento"] ?>"
            required>

        <label>Horário</label>

        <select name="horario_id" required>

            <?php foreach ($horarios as $horario): ?>

                <option
                    value="<?= $horario["id"] ?>"
                    <?= $horario["id"] == $agendamento["horario_id"] ? "selected" : "" ?>>

                    <?= date("H:i", strtotime($horario["horario"])) ?>

                </option>

            <?php endforeach; ?>

        </select>

        <label>Status</label>

        <select name="status">

            <option value="Pendente" <?= $agendamento["status"] == "Pendente" ? "selected" : "" ?>>
                Pendente
            </option>

            <option value="Confirmado" <?= $agendamento["status"] == "Confirmado" ? "selected" : "" ?>>
                Confirmado
            </option>

            <option value="Cancelado" <?= $agendamento["status"] == "Cancelado" ? "selected" : "" ?>>
                Cancelado
            </option>

        </select>

        <label>Observações</label>

        <textarea
            name="observacoes"
            rows="4"><?= htmlspecialchars($agendamento["observacoes"]) ?></textarea>

        <br><br>

        <button type="submit" class="btn">

            Salvar Alterações

        </button>

        <a href="listar_agendamentos.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>