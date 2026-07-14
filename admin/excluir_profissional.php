<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Excluir Profissional
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_profissionais.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se o profissional existe
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM profissionais
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if (!$stmt->fetch()) {

        header("Location: listar_profissionais.php");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Verifica se o profissional possui agendamentos
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE profissional_id = ?
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->fetch()) {

        header("Location: listar_profissionais.php?erro=profissional_em_uso");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Exclui o profissional
    |--------------------------------------------------------------------------
    */

    $sql = "
        DELETE FROM profissionais
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: listar_profissionais.php?sucesso=excluido");
    exit();

} catch (PDOException $e) {

    die("Erro ao excluir o profissional: " . $e->getMessage());

}

?>