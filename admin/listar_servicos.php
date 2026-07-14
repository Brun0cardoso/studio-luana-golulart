<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

try {

    $sql = "
        SELECT
            id,
            nome,
            valor,
            duracao,
            ativo
        FROM servicos
        ORDER BY nome ASC
    ";

    $stmt = $pdo->query($sql);

    $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erro ao carregar os serviços: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Serviços | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Serviços</h1>

    <p class="subtitulo">

        Gerencie os serviços oferecidos pelo Studio.

    </p>

    <p>

        <a href="novo_servico.php" class="btn">

            + Novo Serviço

        </a>

    </p>

    <table>

        <thead>

            <tr>

                <th>Nome</th>
                <th>Valor</th>
                <th>Duração</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php if (empty($servicos)): ?>

            <tr>

                <td colspan="5" style="text-align:center">

                    Nenhum serviço cadastrado.

                </td>

            </tr>

        <?php else: ?>

            <?php foreach ($servicos as $servico): ?>

                <tr>

                    <td><?= htmlspecialchars($servico["nome"]) ?></td>

                    <td>

                        R$ <?= number_format($servico["valor"], 2, ",", ".") ?>

                    </td>

                    <td>

                        <?= $servico["duracao"] ?> min

                    </td>

                    <td>

                        <?= $servico["ativo"] ? "🟢 Ativo" : "🔴 Inativo" ?>

                    </td>

                    <td>

                        <a href="editar_servico.php?id=<?= $servico["id"] ?>">

                            Editar

                        </a>

                        |

                        <a
                            href="excluir_servico.php?id=<?= $servico["id"] ?>"
                            onclick="return confirm('Deseja realmente excluir este serviço?');">

                            Excluir

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

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