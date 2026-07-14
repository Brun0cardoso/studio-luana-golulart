<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Atualizar Cliente
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_clientes.php");
    exit();

}

$id        = (int) ($_POST["id"] ?? 0);
$nome      = trim($_POST["nome"] ?? "");
$telefone  = trim($_POST["telefone"] ?? "");
$email     = trim($_POST["email"] ?? "");

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (
    $id <= 0 ||
    empty($nome) ||
    empty($telefone)
) {

    header("Location: listar_clientes.php");
    exit();

}

try {

    /*
    |--------------------------------------------------------------------------
    | Verifica se existe outro cliente com o mesmo e-mail
    |--------------------------------------------------------------------------
    */

    if (!empty($email)) {

        $sql = "
            SELECT id
            FROM clientes
            WHERE email = ?
            AND id <> ?
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $email,
            $id
        ]);

        if ($stmt->fetch()) {

            header("Location: editar_cliente.php?id={$id}&erro=email");
            exit();

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Atualiza o cliente
    |--------------------------------------------------------------------------
    */

    $sql = "
        UPDATE clientes
        SET
            nome = ?,
            telefone = ?,
            email = ?
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $telefone,
        $email,
        $id
    ]);

    header("Location: listar_clientes.php?sucesso=atualizado");
    exit();

} catch (PDOException $e) {

    die("Erro ao atualizar o cliente: " . $e->getMessage());

}

?>