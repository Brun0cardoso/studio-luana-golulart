<?php

/*
|--------------------------------------------------------------------------
| Painel Administrativo
|--------------------------------------------------------------------------
| Exibe estatísticas e atalhos do sistema.
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Estatísticas do Sistema
|--------------------------------------------------------------------------
*/

try {

    // Total de clientes
    $totalClientes = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();

    // Total de profissionais
    $totalProfissionais = $pdo->query("SELECT COUNT(*) FROM profissionais")->fetchColumn();

    // Total de serviços
    $totalServicos = $pdo->query("SELECT COUNT(*) FROM servicos")->fetchColumn();

    // Total de horários
    $totalHorarios = $pdo->query("SELECT COUNT(*) FROM horarios")->fetchColumn();

    // Agendamentos de hoje
    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE data_agendamento = CURDATE()
    ");
    $stmt->execute();
    $agendamentosHoje = $stmt->fetchColumn();

    // Agendamentos do mês
    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE MONTH(data_agendamento) = MONTH(CURDATE())
          AND YEAR(data_agendamento) = YEAR(CURDATE())
    ");
    $stmt->execute();
    $agendamentosMes = $stmt->fetchColumn();

    // Confirmados
    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE status = 'Confirmado'
    ");
    $stmt->execute();
    $confirmados = $stmt->fetchColumn();

    // Pendentes
    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE status = 'Pendente'
    ");
    $stmt->execute();
    $pendentes = $stmt->fetchColumn();

    // Cancelados
    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM agendamentos
        WHERE status = 'Cancelado'
    ");
    $stmt->execute();
    $cancelados = $stmt->fetchColumn();

} catch (PDOException $e) {

    die("Erro ao carregar o dashboard: " . $e->getMessage());

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel Administrativo</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <header class="dashboard-header">

        <div>

            <h1>Studio Luana Goulart</h1>

            <p class="subtitulo">
                Bem-vindo ao Painel Administrativo
            </p>

        </div>

        <div class="usuario">

            <strong>

                Olá,
                <?= htmlspecialchars($_SESSION["admin_nome"]); ?>

            </strong>

            <br>

            <small>

                <?= date("d/m/Y"); ?>

            </small>

        </div>

    </header>

    <h2>📊 Estatísticas Gerais</h2>

    <div class="dashboard-cards">

        <div class="card">
            <h3><?= $totalClientes ?></h3>
            <p>Clientes</p>
        </div>

        <div class="card">
            <h3><?= $totalProfissionais ?></h3>
            <p>Profissionais</p>
        </div>

        <div class="card">
            <h3><?= $totalServicos ?></h3>
            <p>Serviços</p>
        </div>

        <div class="card">
            <h3><?= $totalHorarios ?></h3>
            <p>Horários</p>
        </div>

    </div>

    <h2>📅 Agendamentos</h2>

    <div class="dashboard-cards">

        <div class="card">

            <h3><?= $agendamentosHoje ?></h3>

            <p>Hoje</p>

        </div>

        <div class="card">

            <h3><?= $agendamentosMes ?></h3>

            <p>Este Mês</p>

        </div>

    </div>

    <h2>📌 Situação dos Agendamentos</h2>

    <div class="dashboard-cards">

        <div class="card">

            <h3><?= $confirmados ?></h3>

            <p>Confirmados</p>

        </div>

        <div class="card">

            <h3><?= $pendentes ?></h3>

            <p>Pendentes</p>

        </div>

        <div class="card">

            <h3><?= $cancelados ?></h3>

            <p>Cancelados</p>

        </div>

    </div>

    <h2>Acesso Rápido</h2>

    <div class="painel-cards">

        <a href="listar_agendamentos.php" class="btn">
            📅 Agendamentos
        </a>

        <a href="listar_clientes.php" class="btn">
            👥 Clientes
        </a>

        <a href="listar_profissionais.php" class="btn">
            👩‍💼 Profissionais
        </a>

        <a href="listar_servicos.php" class="btn">
            💇 Serviços
        </a>

        <a href="listar_horarios.php" class="btn">
            🕒 Horários
        </a>

        <a href="logout.php" class="btn btn-sair">
            🚪 Sair
        </a>

    </div>

</div>

</body>

</html>