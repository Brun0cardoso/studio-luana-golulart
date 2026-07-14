<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Excluir Horário
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_horarios.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se o horário existe
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM horarios
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if (!$stmt->fetch()) {

        header("Location: listar_horarios.php");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Verifica se o horário está sendo utilizado
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE horario_id = ?
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->fetch()) {

        header("Location: listar_horarios.php?erro=horario_em_uso");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Exclui o horário
    |--------------------------------------------------------------------------
    */

    $sql = "
        DELETE FROM horarios
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: listar_horarios.php?sucesso=excluido");
    exit();

} catch (PDOException $e) {

    die("Erro ao excluir o horário: " . $e->getMessage());

}

?>