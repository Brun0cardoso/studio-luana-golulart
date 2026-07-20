<?php

/*
|--------------------------------------------------------------------------
| Listagem de Agendamentos
|--------------------------------------------------------------------------
*/

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

        ORDER BY
            ag.data_agendamento ASC,
            h.horario ASC
    ";

    $agendamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Erro: " . $e->getMessage());
}

require_once "includes/admin_header.php";

?>

<div class="admin-layout">

    <?php require_once "includes/sidebar.php"; ?>

    <div class="conteudo-admin">

        <?php require_once "includes/topbar.php"; ?>

        <main class="container-admin fade">

            <div class="page-header">

                <div>

                    <h1 class="page-title">

                        Agendamentos

                    </h1>

                    <p class="page-description">

                        Gerencie todos os agendamentos do Studio Luana Goulart.

                    </p>

                </div>

                <div class="flex">

                    <a href="novo_agendamento.php" class="btn">

                        <i class="fa-solid fa-calendar-plus"></i>

                        Novo Agendamento

                    </a>

                    <a href="dashboard.php" class="btn btn-secundario">

                        <i class="fa-solid fa-arrow-left"></i>

                        Dashboard

                    </a>

                </div>

            </div>
            <div class="painel">

                <div class="table-responsive">

                    <table class="tabela">

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

                                        <td><?= htmlspecialchars($agendamento["profissional"] ?? "-") ?></td>

                                        <td><?= date("d/m/Y", strtotime($agendamento["data_agendamento"])) ?></td>

                                        <td><?= date("H:i", strtotime($agendamento["horario"])) ?></td>

                                        <td>

                                            <?php if ($agendamento["status"] == "Confirmado"): ?>

                                                <span class="badge badge-sucesso">

                                                    Confirmado

                                                </span>

                                            <?php elseif ($agendamento["status"] == "Cancelado"): ?>

                                                <span class="badge badge-erro">

                                                    Cancelado

                                                </span>

                                            <?php else: ?>

                                                <span class="badge badge-alerta">

                                                    Pendente

                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td>

                                            <a href="confirmar_agendamento.php?id=<?= $agendamento["id"] ?>" class="btn btn-sucesso">

                                                Confirmar

                                            </a>

                                            <a href="editar_agendamento.php?id=<?= $agendamento["id"] ?>" class="btn">

                                                Editar

                                            </a>

                                            <a
                                                href="excluir_agendamento.php?id=<?= $agendamento["id"] ?>"
                                                class="btn btn-perigo"
                                                onclick="return confirm('Deseja realmente excluir este agendamento?');">

                                                Excluir

                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>

<?php

require_once "includes/admin_footer.php";

?>