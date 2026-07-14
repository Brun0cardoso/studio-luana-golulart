<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Excluir Serviço
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_servicos.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se o serviço existe
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM servicos
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if (!$stmt->fetch()) {

        header("Location: listar_servicos.php");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Verifica se o serviço está sendo utilizado
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE servico_id = ?
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->fetch()) {

        header("Location: listar_servicos.php?erro=servico_em_uso");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Exclui o serviço
    |--------------------------------------------------------------------------
    */

    $sql = "
        DELETE FROM servicos
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: listar_servicos.php?sucesso=excluido");
    exit();

} catch (PDOException $e) {

    die("Erro ao excluir o serviço: " . $e->getMessage());

}

?>