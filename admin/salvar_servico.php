<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Salvar Serviço
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_servicos.php");
    exit();

}

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
    empty($nome) ||
    !is_numeric($valor) ||
    $duracao <= 0
) {

    header("Location: novo_servico.php?erro=campos");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se já existe um serviço com o mesmo nome
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM servicos
        WHERE nome = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);

    if ($stmt->fetch()) {

        header("Location: novo_servico.php?erro=duplicado");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Salva o serviço
    |--------------------------------------------------------------------------
    */

    $sql = "
        INSERT INTO servicos
        (
            nome,
            valor,
            duracao,
            ativo
        )
        VALUES
        (
            ?, ?, ?, ?
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $valor,
        $duracao,
        $ativo
    ]);

    header("Location: listar_servicos.php?sucesso=cadastrado");
    exit();

} catch (PDOException $e) {

    die("Erro ao salvar o serviço: " . $e->getMessage());

}