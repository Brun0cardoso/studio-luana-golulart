<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Salvar Horário
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_horarios.php");
    exit();

}

$horario = trim($_POST["horario"] ?? "");
$ativo   = isset($_POST["ativo"]) ? (int) $_POST["ativo"] : 1;

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (empty($horario)) {

    header("Location: novo_horario.php?erro=campos");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se o horário já existe
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM horarios
        WHERE horario = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$horario]);

    if ($stmt->fetch()) {

        header("Location: novo_horario.php?erro=duplicado");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Salva o horário
    |--------------------------------------------------------------------------
    */

    $sql = "
        INSERT INTO horarios
        (
            horario,
            ativo
        )
        VALUES
        (
            ?, ?
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $horario,
        $ativo
    ]);

    header("Location: listar_horarios.php?sucesso=cadastrado");
    exit();

} catch (PDOException $e) {

    die("Erro ao salvar o horário: " . $e->getMessage());

}

?>