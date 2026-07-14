<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Lista todos os clientes
|--------------------------------------------------------------------------
*/

try {

    $sql = "
        SELECT
            id,
            nome,
            telefone,
            email,
            criado_em
        FROM clientes
        ORDER BY nome
    ";

    $stmt = $pdo->query($sql);

    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erro ao carregar os clientes: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clientes | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Clientes</h1>

    <p class="subtitulo">

        Gerencie os clientes cadastrados.

    </p>

    <p>

        <a href="novo_cliente.php" class="btn">

            + Novo Cliente

        </a>

    </p>

    <table>

        <thead>

            <tr>

                <th>Nome</th>

                <th>Telefone</th>

                <th>E-mail</th>

                <th>Cadastro</th>

                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php if (count($clientes) > 0): ?>

            <?php foreach ($clientes as $cliente): ?>

                <tr>

                    <td><?= htmlspecialchars($cliente["nome"]); ?></td>

                    <td><?= htmlspecialchars($cliente["telefone"]); ?></td>

                    <td><?= htmlspecialchars($cliente["email"]); ?></td>

                    <td><?= date("d/m/Y H:i", strtotime($cliente["criado_em"])); ?></td>

                    <td>

                        <a href="editar_cliente.php?id=<?= $cliente["id"]; ?>">

                            Editar

                        </a>

                        |

                        <a
                            href="excluir_cliente.php?id=<?= $cliente["id"]; ?>"
                            onclick="return confirm('Deseja realmente excluir este cliente?')">

                            Excluir

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="5">

                    Nenhum cliente cadastrado.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

    <br>

    <a href="dashboard.php" class="btn">

        ← Voltar ao Painel

    </a>

</div>

</body>

</html>