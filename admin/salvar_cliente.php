<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Salvar Cliente
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_clientes.php");
    exit();

}

$nome      = trim($_POST["nome"] ?? "");
$telefone  = trim($_POST["telefone"] ?? "");
$email     = trim($_POST["email"] ?? "");

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (
    empty($nome) ||
    empty($telefone)
) {

    header("Location: novo_cliente.php?erro=campos");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se já existe cliente com o mesmo e-mail
    |--------------------------------------------------------------------------
    */

    if (!empty($email)) {

        $sql = "
            SELECT id
            FROM clientes
            WHERE email = ?
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->fetch()) {

            header("Location: novo_cliente.php?erro=email");
            exit();

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Salva o cliente
    |--------------------------------------------------------------------------
    */

    $sql = "
        INSERT INTO clientes
        (
            nome,
            telefone,
            email
        )
        VALUES
        (
            ?, ?, ?
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $telefone,
        $email
    ]);

    header("Location: listar_clientes.php?sucesso=cadastrado");
    exit();

} catch (PDOException $e) {

    die("Erro ao cadastrar o cliente: " . $e->getMessage());

}

?>