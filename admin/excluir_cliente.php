<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Excluir Cliente
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_clientes.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se o cliente existe
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM clientes
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if (!$stmt->fetch()) {

        header("Location: listar_clientes.php");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Verifica se o cliente possui agendamentos
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM agendamentos
        WHERE cliente_id = ?
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->fetch()) {

        header("Location: listar_clientes.php?erro=cliente_em_uso");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Exclui o cliente
    |--------------------------------------------------------------------------
    */

    $sql = "
        DELETE FROM clientes
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: listar_clientes.php?sucesso=excluido");
    exit();

} catch (PDOException $e) {

    die("Erro ao excluir o cliente: " . $e->getMessage());

}

?>