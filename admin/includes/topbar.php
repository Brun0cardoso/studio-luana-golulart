<?php
/*
|--------------------------------------------------------------------------
| Topbar - Painel Administrativo
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Página atual
|--------------------------------------------------------------------------
*/

$paginaAtual = basename($_SERVER["PHP_SELF"]);

/*
|--------------------------------------------------------------------------
| Define o título da página
|--------------------------------------------------------------------------
*/

$tituloPagina = "Painel Administrativo";

switch ($paginaAtual) {

    case "dashboard.php":
        $tituloPagina = "Dashboard";
        break;

    case "listar_agendamentos.php":
        $tituloPagina = "Agendamentos";
        break;

    case "listar_clientes.php":
        $tituloPagina = "Clientes";
        break;

    case "listar_profissionais.php":
        $tituloPagina = "Profissionais";
        break;

    case "listar_servicos.php":
        $tituloPagina = "Serviços";
        break;

    case "listar_horarios.php":
        $tituloPagina = "Horários";
        break;
}

/*
|--------------------------------------------------------------------------
| Data atual
|--------------------------------------------------------------------------
*/

$dataAtual = date("d/m/Y");

 /*
    |--------------------------------------------------------------------------
    | Notificações
    |--------------------------------------------------------------------------
    */

    $notificacoes = $pdo->query("
    SELECT COUNT(*)
    FROM agendamentos
    WHERE status = 'Pendente'
    ")->fetchColumn();


?>

<header class="topbar">

   
    <!-- =====================================================
         LADO ESQUERDO
    ====================================================== -->

    <div class="topbar-left">

        <button
            type="button"
            class="menu-toggle"
            id="menuToggle"
            aria-label="Abrir menu">

            <i class="fa-solid fa-bars"></i>

        </button>

        <div class="topbar-title">

            <h1><?= $tituloPagina; ?></h1>

            <p>Studio Luana Goulart • Painel Administrativo</p>

        </div>

    </div>

    <!-- =====================================================
         LADO DIREITO
    ====================================================== -->

    <div class="topbar-right">

        <!-- Data -->

        <div class="topbar-date">

            <i class="fa-solid fa-calendar-days"></i>

            <span><?= $dataAtual; ?></span>

        </div>

        <!-- Notificações -->

        <div class="notification">

            <i class="fa-regular fa-bell"></i>

            <span class="badge">

                <?= $notificacoes ?>

            </span>

        </div>

        <!-- Usuário -->

        <div class="user-box">

            <div class="user-avatar">

                <?= strtoupper(substr($_SESSION["admin_nome"] ?? "A", 0, 1)); ?>

            </div>

            <div class="user-info">

                <strong>

                    <?= htmlspecialchars($_SESSION["admin_nome"] ?? "Administrador"); ?>

                </strong>

                <span>Administrador</span>

            </div>

        </div>

    </div>

</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const botao = document.getElementById("menuToggle");
        const sidebar = document.querySelector(".sidebar");

        if (botao && sidebar) {

            botao.addEventListener("click", () => {

                sidebar.classList.toggle("ativo");

            });

        }

    });
</script>