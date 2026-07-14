<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Atualizar Horário
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_horarios.php");
    exit();

}

$id       = (int) ($_POST["id"] ?? 0);
$horario  = trim($_POST["horario"] ?? "");
$ativo    = isset($_POST["ativo"]) ? (int) $_POST["ativo"] : 1;

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (
    $id <= 0 ||
    empty($horario)
) {

    header("Location: listar_horarios.php");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se existe outro horário igual
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM horarios
        WHERE horario = ?
        AND id <> ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $horario,
        $id
    ]);

    if ($stmt->fetch()) {

        header("Location: editar_horario.php?id={$id}&erro=duplicado");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Atualiza o horário
    |--------------------------------------------------------------------------
    */

    $sql = "
        UPDATE horarios
        SET
            horario = ?,
            ativo = ?
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $horario,
        $ativo,
        $id
    ]);

    header("Location: listar_horarios.php?sucesso=atualizado");
    exit();

} catch (PDOException $e) {

    die("Erro ao atualizar o horário: " . $e->getMessage());

}

?>