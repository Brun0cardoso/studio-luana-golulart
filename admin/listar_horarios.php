<?php

/*
|--------------------------------------------------------------------------
| Listagem de Horários
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

try {

    $sql = "
        SELECT
            id,
            horario,
            ativo
        FROM horarios
        ORDER BY horario ASC
    ";

    $horarios = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Erro ao carregar os horários: " . $e->getMessage());
}

require_once "includes/admin_header.php";

?>

<div class="admin-layout">

    <?php require_once "includes/sidebar.php"; ?>

    <div class="conteudo-admin">

        <?php require_once "includes/topbar.php"; ?>

        <main class="container-admin fade">

            <!-- =====================================================
                 CABEÇALHO DA PÁGINA
            ====================================================== -->

            <div class="page-header">

                <div>

                    <h1 class="page-title">

                        Horários

                    </h1>

                    <p class="page-description">

                        Gerencie os horários disponíveis para agendamento.

                    </p>

                </div>

                <a href="novo_horario.php" class="btn">

                    <i class="fa-solid fa-clock"></i>

                    Novo Horário

                </a>

            </div>

            <!-- =====================================================
                 TABELA
            ====================================================== -->

            <div class="painel">

                <div class="table-responsive">

                    <table class="tabela">

                        <thead>

                            <tr>

                                <th>Horário</th>
                                <th>Status</th>
                                <th width="220">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($horarios)): ?>

                                <tr>

                                    <td colspan="3" style="text-align:center; padding:30px;">

                                        Nenhum horário cadastrado.

                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($horarios as $horario): ?>

                                    <tr>

                                        <td>

                                            <?= date("H:i", strtotime($horario["horario"])); ?>

                                        </td>

                                        <td>

                                            <?php if ($horario["ativo"]): ?>

                                                <span class="badge badge-sucesso">

                                                    Ativo

                                                </span>

                                            <?php else: ?>

                                                <span class="badge badge-erro">

                                                    Inativo

                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td class="acoes">

                                            <a href="editar_horario.php?id=<?= $horario["id"]; ?>" class="btn">

                                                <i class="fa-solid fa-pen"></i>

                                                Editar

                                            </a>

                                            <a
                                                href="excluir_horario.php?id=<?= $horario["id"]; ?>"
                                                class="btn btn-perigo"
                                                onclick="return confirm('Deseja realmente excluir este horário?')">

                                                <i class="fa-solid fa-trash"></i>

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