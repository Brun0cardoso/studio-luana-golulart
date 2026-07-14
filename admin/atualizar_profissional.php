<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Atualizar Profissional
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_profissionais.php");
    exit();

}

$id = (int) ($_POST["id"] ?? 0);
$nome = trim($_POST["nome"] ?? "");
$especialidade = trim($_POST["especialidade"] ?? "");
$ativo = isset($_POST["ativo"]) ? (int) $_POST["ativo"] : 1;

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (
    $id <= 0 ||
    empty($nome) ||
    empty($especialidade)
) {

    header("Location: listar_profissionais.php");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se já existe outro profissional com o mesmo nome
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM profissionais
        WHERE nome = ?
        AND id <> ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nome,
        $id
    ]);

    if ($stmt->fetch()) {

        header("Location: editar_profissional.php?id={$id}&erro=duplicado");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Atualiza o profissional
    |--------------------------------------------------------------------------
    */

    $sql = "
        UPDATE profissionais
        SET
            nome = ?,
            especialidade = ?,
            ativo = ?
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $especialidade,
        $ativo,
        $id
    ]);

    header("Location: listar_profissionais.php?sucesso=atualizado");
    exit();

} catch (PDOException $e) {

    die("Erro ao atualizar o profissional: " . $e->getMessage());

}

?>