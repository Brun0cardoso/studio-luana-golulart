<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: listar_agendamentos.php");
    exit();
}

$id = (int) ($_POST["id"] ?? 0);
$clienteId = (int) ($_POST["cliente_id"] ?? 0);
$servicoId = (int) ($_POST["servico_id"] ?? 0);
$profissionalId = !empty($_POST["profissional_id"]) ? (int) $_POST["profissional_id"] : null;
$horarioId = (int) ($_POST["horario_id"] ?? 0);
$data = $_POST["data_agendamento"] ?? "";
$status = $_POST["status"] ?? "Pendente";
$observacoes = trim($_POST["observacoes"] ?? "");

if (
    $id <= 0 ||
    $clienteId <= 0 ||
    $servicoId <= 0 ||
    $horarioId <= 0 ||
    empty($data)
) {
    header("Location: listar_agendamentos.php");
    exit();
}

try {

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE data_agendamento = ?
          AND horario_id = ?
          AND id <> ?
          AND status <> 'Cancelado'
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data,
        $horarioId,
        $id
    ]);

    if ($stmt->fetch()) {
        die("Já existe outro agendamento para este horário.");
    }

    $sql = "
        UPDATE agendamentos
        SET
            cliente_id = ?,
            servico_id = ?,
            profissional_id = ?,
            horario_id = ?,
            data_agendamento = ?,
            status = ?,
            observacoes = ?
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $clienteId,
        $servicoId,
        $profissionalId,
        $horarioId,
        $data,
        $status,
        $observacoes,
        $id
    ]);

    header("Location: listar_agendamentos.php?sucesso=atualizado");
    exit();

} catch (PDOException $e) {

    die("Erro ao atualizar o agendamento: " . $e->getMessage());

}