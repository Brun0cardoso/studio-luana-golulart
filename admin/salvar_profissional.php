<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Salvar Profissional
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_profissionais.php");
    exit();

}

$nome = trim($_POST["nome"] ?? "");
$especialidade = trim($_POST["especialidade"] ?? "");
$ativo = isset($_POST["ativo"]) ? (int) $_POST["ativo"] : 1;

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (
    empty($nome) ||
    empty($especialidade)
) {

    header("Location: novo_profissional.php?erro=campos");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se já existe profissional cadastrado
    |--------------------------------------------------------------------------
    */

    $sql = "
        SELECT id
        FROM profissionais
        WHERE nome = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);

    if ($stmt->fetch()) {

        header("Location: novo_profissional.php?erro=duplicado");
        exit();

    }

    /*
    |--------------------------------------------------------------------------
    | Salva o profissional
    |--------------------------------------------------------------------------
    */

    $sql = "
        INSERT INTO profissionais
        (
            nome,
            especialidade,
            ativo
        )
        VALUES
        (
            ?, ?, ?
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $especialidade,
        $ativo
    ]);

    header("Location: listar_profissionais.php?sucesso=cadastrado");
    exit();

} catch (PDOException $e) {

    die("Erro ao cadastrar o profissional: " . $e->getMessage());

}

?>