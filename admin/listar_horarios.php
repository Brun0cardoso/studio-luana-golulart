<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Lista todos os horários
|--------------------------------------------------------------------------
*/

try {

    $sql = "
        SELECT
            id,
            horario,
            ativo
        FROM horarios
        ORDER BY horario
    ";

    $stmt = $pdo->query($sql);

    $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erro ao carregar os horários: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Horários | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Horários</h1>

    <p class="subtitulo">

        Gerencie os horários disponíveis para agendamento.

    </p>

    <p>

        <a href="novo_horario.php" class="btn">

            + Novo Horário

        </a>

    </p>

    <table>

        <thead>

            <tr>

                <th>Horário</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php if (count($horarios) > 0): ?>

            <?php foreach ($horarios as $horario): ?>

                <tr>

                    <td>

                        <?= date("H:i", strtotime($horario["horario"])) ?>

                    </td>

                    <td>

                        <?= $horario["ativo"] ? "🟢 Ativo" : "🔴 Inativo" ?>

                    </td>

                    <td>

                        <a href="editar_horario.php?id=<?= $horario["id"] ?>">

                            Editar

                        </a>

                        |

                        <a
                            href="excluir_horario.php?id=<?= $horario["id"] ?>"
                            onclick="return confirm('Deseja realmente excluir este horário?')">

                            Excluir

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="3">

                    Nenhum horário cadastrado.

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