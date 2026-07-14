<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

try {

    $sql = "
        SELECT
            ag.id,
            c.nome AS cliente,
            c.telefone,
            c.email,
            s.nome AS servico,
            p.nome AS profissional,
            h.horario,
            ag.data_agendamento,
            ag.status,
            ag.observacoes

        FROM agendamentos ag

        INNER JOIN clientes c
            ON c.id = ag.cliente_id

        INNER JOIN servicos s
            ON s.id = ag.servico_id

        INNER JOIN horarios h
            ON h.id = ag.horario_id

        LEFT JOIN profissionais p
            ON p.id = ag.profissional_id

        ORDER BY ag.data_agendamento ASC, h.horario ASC
    ";

    $stmt = $pdo->query($sql);

    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erro ao carregar os agendamentos: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agendamentos | Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Agendamentos</h1>

    <p class="subtitulo">
        Gerencie todos os agendamentos cadastrados.
    </p>

    <table>

        <thead>

            <tr>

                <th>Cliente</th>
                <th>Telefone</th>
                <th>Serviço</th>
                <th>Profissional</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php if (empty($agendamentos)): ?>

            <tr>

                <td colspan="8" style="text-align:center">

                    Nenhum agendamento encontrado.

                </td>

            </tr>

        <?php else: ?>

            <?php foreach ($agendamentos as $agendamento): ?>

                <tr>

                    <td><?= htmlspecialchars($agendamento["cliente"]) ?></td>

                    <td><?= htmlspecialchars($agendamento["telefone"]) ?></td>

                    <td><?= htmlspecialchars($agendamento["servico"]) ?></td>

                    <td>

                        <?= $agendamento["profissional"]
                            ? htmlspecialchars($agendamento["profissional"])
                            : "-" ?>

                    </td>

                    <td><?= date("d/m/Y", strtotime($agendamento["data_agendamento"])) ?></td>

                    <td><?= date("H:i", strtotime($agendamento["horario"])) ?></td>

                    <td>

                        <?php

                        switch ($agendamento["status"]) {

                            case "Confirmado":
                                echo "🟢 Confirmado";
                                break;

                            case "Cancelado":
                                echo "🔴 Cancelado";
                                break;

                            default:
                                echo "🟡 Pendente";

                        }

                        ?>

                    </td>

                    <td>

                        <a href="confirmar_agendamento.php?id=<?= $agendamento["id"] ?>">

                            Confirmar

                        </a>

                        |

                        <a href="editar_agendamento.php?id=<?= $agendamento["id"] ?>">

                            Editar

                        </a>

                        |

                        <a
                            href="excluir_agendamento.php?id=<?= $agendamento["id"] ?>"
                            onclick="return confirm('Deseja realmente excluir este agendamento?');">

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