<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Confirmar Agendamento
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_agendamentos.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se o agendamento existe
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if (!$stmt->fetch()) {

        header("Location: listar_agendamentos.php");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Atualiza o status
    |--------------------------------------------------------------------------
    */

    $sql = "
        UPDATE agendamentos
        SET status = 'Confirmado'
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: listar_agendamentos.php?sucesso=confirmado");
    exit();

} catch (PDOException $e) {

    die("Erro ao confirmar o agendamento: " . $e->getMessage());

}