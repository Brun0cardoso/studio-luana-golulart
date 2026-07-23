<?php

/*
|--------------------------------------------------------------------------
| Painel Administrativo
|--------------------------------------------------------------------------
| Dashboard principal do sistema.
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Estatísticas
|--------------------------------------------------------------------------
*/

try {

    $totalClientes = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();

    $totalProfissionais = $pdo->query("SELECT COUNT(*) FROM profissionais")->fetchColumn();

    $totalServicos = $pdo->query("SELECT COUNT(*) FROM servicos")->fetchColumn();

    $totalHorarios = $pdo->query("SELECT COUNT(*) FROM horarios")->fetchColumn();

    $agendamentosHoje = $pdo->query("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE data_agendamento = CURDATE()
    ")->fetchColumn();

    $agendamentosMes = $pdo->query("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE MONTH(data_agendamento)=MONTH(CURDATE())
        AND YEAR(data_agendamento)=YEAR(CURDATE())
    ")->fetchColumn();

    $confirmados = $pdo->query("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE status='Confirmado'
    ")->fetchColumn();

    $pendentes = $pdo->query("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE status='Pendente'
    ")->fetchColumn();

    $cancelados = $pdo->query("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE status='Cancelado'
    ")->fetchColumn();

} catch(PDOException $e){

    die("Erro ao carregar dashboard: ".$e->getMessage());

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
                        Dashboard
                    </h1>

                    <p class="page-description">

                        Bem-vinda,
                        <strong><?= htmlspecialchars($_SESSION["admin_nome"]); ?></strong>

                    </p>

                </div>

            </div>

            <!-- =====================================================
                 CARDS
            ====================================================== -->

            <div class="dashboard-grid">

                <div class="stat-card card-clientes">

                    <div class="stat-info">

                        <span class="stat-title">

                            Clientes

                        </span>

                        <h2 class="stat-value">

                            <?= $totalClientes ?>

                        </h2>

                        <span class="stat-description">

                            Clientes cadastrados

                        </span>

                    </div>

                    <div class="stat-icon">

                        <i class="fa-solid fa-users"></i>

                    </div>

                </div>

                <div class="stat-card card-profissionais">

                    <div class="stat-info">

                        <span class="stat-title">

                            Profissionais

                        </span>

                        <h2 class="stat-value">

                            <?= $totalProfissionais ?>

                        </h2>

                        <span class="stat-description">

                            Equipe cadastrada

                        </span>

                    </div>

                    <div class="stat-icon">

                        <i class="fa-solid fa-user-tie"></i>

                    </div>

                </div>

                <div class="stat-card card-servicos">

                    <div class="stat-info">

                        <span class="stat-title">

                            Serviços

                        </span>

                        <h2 class="stat-value">

                            <?= $totalServicos ?>

                        </h2>

                        <span class="stat-description">

                            Serviços disponíveis

                        </span>

                    </div>

                    <div class="stat-icon">

                        <i class="fa-solid fa-scissors"></i>

                    </div>

                </div>

                <div class="stat-card card-agendamentos">

                    <div class="stat-info">

                        <span class="stat-title">

                            Horários

                        </span>

                        <h2 class="stat-value">

                            <?= $totalHorarios ?>

                        </h2>

                        <span class="stat-description">

                            Horários cadastrados

                        </span>

                    </div>

                    <div class="stat-icon">

                        <i class="fa-regular fa-clock"></i>

                    </div>

                </div>

            </div>
                        <!-- =====================================================
                 RESUMO E STATUS
            ====================================================== -->

            <div class="dashboard-row">

                <!-- Resumo -->

                <div class="widget">

                    <div class="widget-header">

                        <h2>Resumo Geral</h2>

                    </div>

                    <div class="widget-body">

                        <div class="activity">

                            <div class="activity-icon">

                                <i class="fa-solid fa-calendar-day"></i>

                            </div>

                            <div class="activity-content">

                                <strong>Agendamentos de Hoje</strong>

                                <span>

                                    <?= $agendamentosHoje ?> atendimento(s) agendado(s).

                                </span>

                            </div>

                        </div>

                        <div class="activity">

                            <div class="activity-icon">

                                <i class="fa-solid fa-calendar-check"></i>

                            </div>

                            <div class="activity-content">

                                <strong>Agendamentos do Mês</strong>

                                <span>

                                    <?= $agendamentosMes ?> atendimento(s) registrados neste mês.

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Status -->

                <div class="widget">

                    <div class="widget-header">

                        <h2>Status</h2>

                    </div>

                    <div class="widget-body">

                        <div class="status-list">

                            <div class="status-item">

                                <span class="status-label">

                                    Confirmados

                                </span>

                                <span class="badge badge-sucesso">

                                    <?= $confirmados ?>

                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width:100%"></div>

                            </div>

                            <div class="status-item">

                                <span class="status-label">

                                    Pendentes

                                </span>

                                <span class="badge badge-alerta">

                                    <?= $pendentes ?>

                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width:70%"></div>

                            </div>

                            <div class="status-item">

                                <span class="status-label">

                                    Cancelados

                                </span>

                                <span class="badge badge-erro">

                                    <?= $cancelados ?>

                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width:35%"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- =====================================================
                 ACESSO RÁPIDO
            ====================================================== -->

            <div class="painel">

                <div class="painel-header">

                    <h2>Acesso Rápido</h2>

                </div>

                <div class="dashboard-grid">

                    <a href="listar_agendamentos.php" class="stat-card">

                        <div class="stat-info">

                            <span class="stat-title">

                                Agendamentos

                            </span>

                        </div>

                        <div class="stat-icon">

                            <i class="fa-solid fa-calendar-days"></i>

                        </div>

                    </a>

                    <a href="listar_clientes.php" class="stat-card">

                        <div class="stat-info">

                            <span class="stat-title">

                                Clientes

                            </span>

                        </div>

                        <div class="stat-icon">

                            <i class="fa-solid fa-users"></i>

                        </div>

                    </a>

                    <a href="listar_profissionais.php" class="stat-card">

                        <div class="stat-info">

                            <span class="stat-title">

                                Profissionais

                            </span>

                        </div>

                        <div class="stat-icon">

                            <i class="fa-solid fa-user-tie"></i>

                        </div>

                    </a>

                    <a href="listar_servicos.php" class="stat-card">

                        <div class="stat-info">

                            <span class="stat-title">

                                Serviços

                            </span>

                        </div>

                        <div class="stat-icon">

                            <i class="fa-solid fa-scissors"></i>

                        </div>

                    </a>

                    <a href="listar_horarios.php" class="stat-card">

                        <div class="stat-info">

                            <span class="stat-title">

                                Horários

                            </span>

                        </div>

                        <div class="stat-icon">

                            <i class="fa-regular fa-clock"></i>

                        </div>

                    </a>

                    <a href="logout.php" class="stat-card">

                        <div class="stat-info">

                            <span class="stat-title">

                                Sair do Sistema

                            </span>

                        </div>

                        <div class="stat-icon">

                            <i class="fa-solid fa-right-from-bracket"></i>

                        </div>

                    </a>

                </div>

            </div>

    </div>

</div>

<?php

require_once "includes/admin_footer.php";

?>