<?php

require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Salvar Agendamento
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}

try {

    // Recebe os dados do formulário
    $nome         = trim($_POST["nome"] ?? "");
    $telefone     = trim($_POST["telefone"] ?? "");
    $email        = trim($_POST["email"] ?? "");
    $data         = $_POST["data"] ?? "";
    $horarioId    = (int) ($_POST["horario"] ?? 0);
    $servicoId    = (int) ($_POST["servico"] ?? 0);
    $observacoes  = trim($_POST["observacoes"] ?? "");

    /*
    |--------------------------------------------------------------------------
    | Validação
    |--------------------------------------------------------------------------
    */

    if (
        empty($nome) ||
        empty($telefone) ||
        empty($data) ||
        $horarioId <= 0 ||
        $servicoId <= 0
    ) {

        header("Location: ../index.php?erro=campos");
        exit;

    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        header("Location: ../index.php?erro=email");
        exit;

    }

    if ($data < date("Y-m-d")) {

        header("Location: ../index.php?erro=data");
        exit;

    }

    $pdo->beginTransaction();

    /*
    |--------------------------------------------------------------------------
    | Cliente
    |--------------------------------------------------------------------------
    */

    $clienteId = null;

    if (!empty($email)) {

        $sql = "SELECT id
                FROM clientes
                WHERE email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {

            $clienteId = $cliente["id"];

            $sql = "UPDATE clientes
                    SET nome = ?, telefone = ?
                    WHERE id = ?";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $nome,
                $telefone,
                $clienteId
            ]);

        }

    }

    if (!$clienteId) {

        $sql = "INSERT INTO clientes
        (
            nome,
            telefone,
            email
        )
        VALUES
        (
            ?, ?, ?
        )";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $nome,
            $telefone,
            $email
        ]);

        $clienteId = $pdo->lastInsertId();

    }

    /*
    |--------------------------------------------------------------------------
    | Profissional
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM profissionais
        WHERE ativo = 1
        LIMIT 1
    ";

    $stmt = $pdo->query($sql);

    $profissional = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$profissional) {

        throw new Exception("Nenhum profissional ativo cadastrado.");

    }

    $profissionalId = $profissional["id"];

    /*
    |--------------------------------------------------------------------------
    | Verifica conflito de horário
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE data_agendamento = ?
        AND horario_id = ?
        AND status <> 'Cancelado'
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $data,
        $horarioId
    ]);

    if ($stmt->fetch()) {

        $pdo->rollBack();

        header("Location: ../index.php?erro=horario");

        exit;

    }

    /*
    |--------------------------------------------------------------------------
    | Salva o agendamento
    |--------------------------------------------------------------------------
    */

    $sql = "
        INSERT INTO agendamentos
        (
            cliente_id,
            profissional_id,
            servico_id,
            horario_id,
            data_agendamento,
            observacoes,
            status
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $clienteId,
        $profissionalId,
        $servicoId,
        $horarioId,
        $data,
        $observacoes,
        "Pendente"
    ]);

    $pdo->commit();

    header("Location: ../index.php?sucesso=1");
    exit;

} catch (Exception $e) {

    if ($pdo->inTransaction()) {

        $pdo->rollBack();

    }

    die("Erro ao salvar o agendamento: " . $e->getMessage());

}