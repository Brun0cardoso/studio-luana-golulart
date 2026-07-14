<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Lista todos os profissionais
|--------------------------------------------------------------------------
*/

try {

    $sql = "
        SELECT
            id,
            nome,
            especialidade,
            ativo
        FROM profissionais
        ORDER BY nome
    ";

    $stmt = $pdo->query($sql);

    $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erro ao carregar os profissionais: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profissionais | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Profissionais</h1>

    <p class="subtitulo">

        Gerencie os profissionais do Studio.

    </p>

    <p>

        <a href="novo_profissional.php" class="btn">

            + Novo Profissional

        </a>

    </p>

    <table>

        <thead>

            <tr>

                <th>Nome</th>

                <th>Especialidade</th>

                <th>Status</th>

                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php if (count($profissionais) > 0): ?>

            <?php foreach ($profissionais as $profissional): ?>

                <tr>

                    <td><?= htmlspecialchars($profissional["nome"]); ?></td>

                    <td><?= htmlspecialchars($profissional["especialidade"]); ?></td>

                    <td>

                        <?= $profissional["ativo"] ? "🟢 Ativo" : "🔴 Inativo"; ?>

                    </td>

                    <td>

                        <a href="editar_profissional.php?id=<?= $profissional["id"]; ?>">

                            Editar

                        </a>

                        |

                        <a
                            href="excluir_profissional.php?id=<?= $profissional["id"]; ?>"
                            onclick="return confirm('Deseja realmente excluir este profissional?')">

                            Excluir

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="4">

                    Nenhum profissional cadastrado.

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