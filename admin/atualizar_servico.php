<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Atualizar Serviço
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_servicos.php");
    exit();

}

$id       = (int) ($_POST["id"] ?? 0);
$nome     = trim($_POST["nome"] ?? "");
$valor    = str_replace(",", ".", $_POST["valor"] ?? "");
$duracao  = (int) ($_POST["duracao"] ?? 0);
$ativo    = isset($_POST["ativo"]) ? (int) $_POST["ativo"] : 1;

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (
    $id <= 0 ||
    empty($nome) ||
    !is_numeric($valor) ||
    $duracao <= 0
) {

    header("Location: listar_servicos.php");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se já existe outro serviço com o mesmo nome
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM servicos
        WHERE nome = ?
        AND id <> ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $id]);

    if ($stmt->fetch()) {

        header("Location: editar_servico.php?id={$id}&erro=duplicado");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Atualiza o serviço
    |--------------------------------------------------------------------------
    */

    $sql = "
        UPDATE servicos
        SET
            nome = ?,
            valor = ?,
            duracao = ?,
            ativo = ?
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $valor,
        $duracao,
        $ativo,
        $id
    ]);

    header("Location: listar_servicos.php?sucesso=atualizado");
    exit();

} catch (PDOException $e) {

    die("Erro ao atualizar o serviço: " . $e->getMessage());

}

?>