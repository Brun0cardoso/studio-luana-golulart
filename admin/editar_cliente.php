<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Editar Cliente
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_clientes.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            nome,
            telefone,
            email
        FROM clientes
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {

        header("Location: listar_clientes.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o cliente: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Cliente | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Cliente</h1>

    <p class="subtitulo">

        Atualize os dados do cliente.

    </p>

    <form action="atualizar_cliente.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $cliente["id"]; ?>">

        <label for="nome">

            Nome

        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="120"
            value="<?= htmlspecialchars($cliente["nome"]); ?>"
            required>

        <label for="telefone">

            Telefone

        </label>

        <input
            type="tel"
            id="telefone"
            name="telefone"
            maxlength="20"
            value="<?= htmlspecialchars($cliente["telefone"]); ?>"
            required>

        <label for="email">

            E-mail

        </label>

        <input
            type="email"
            id="email"
            name="email"
            maxlength="120"
            value="<?= htmlspecialchars($cliente["email"]); ?>">

        <br><br>

        <button type="submit">

            Salvar Alterações

        </button>

        <a href="listar_clientes.php" class="btn">

            Cancelar

        </a>

    </form>

</div>

</body>

</html>