<?php
/*
|--------------------------------------------------------------------------
| Sidebar - Painel Administrativo
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Página atual
|--------------------------------------------------------------------------
*/

$paginaAtual = basename($_SERVER["PHP_SELF"]);

?>

<aside class="sidebar">

    <!-- =====================================================
         LOGO
    ====================================================== -->

    <div>

        <div class="sidebar-logo">

            <div class="logo-circle">

                LG

            </div>

            <h2>Studio</h2>

            <span>Luana Goulart</span>

        </div>

        <!-- =====================================================
             MENU
        ====================================================== -->

        <nav class="sidebar-menu">

            <ul>

                <li>

                    <a href="dashboard.php"
                       class="<?= $paginaAtual == 'dashboard.php' ? 'ativo' : ''; ?>">

                        <i class="fa-solid fa-chart-line"></i>

                        <span>Dashboard</span>

                    </a>

                </li>

                <li>

                    <a href="listar_agendamentos.php"
                       class="<?= $paginaAtual == 'listar_agendamentos.php' ? 'ativo' : ''; ?>">

                        <i class="fa-solid fa-calendar-days"></i>

                        <span>Agendamentos</span>

                    </a>

                </li>

                <li>

                    <a href="listar_clientes.php"
                       class="<?= $paginaAtual == 'listar_clientes.php' ? 'ativo' : ''; ?>">

                        <i class="fa-solid fa-users"></i>

                        <span>Clientes</span>

                    </a>

                </li>

                <li>

                    <a href="listar_profissionais.php"
                       class="<?= $paginaAtual == 'listar_profissionais.php' ? 'ativo' : ''; ?>">

                        <i class="fa-solid fa-user-tie"></i>

                        <span>Profissionais</span>

                    </a>

                </li>

                <li>

                    <a href="listar_servicos.php"
                       class="<?= $paginaAtual == 'listar_servicos.php' ? 'ativo' : ''; ?>">

                        <i class="fa-solid fa-scissors"></i>

                        <span>Serviços</span>

                    </a>

                </li>

                <li>

                    <a href="listar_horarios.php"
                       class="<?= $paginaAtual == 'listar_horarios.php' ? 'ativo' : ''; ?>">

                        <i class="fa-regular fa-clock"></i>

                        <span>Horários</span>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

    <!-- =====================================================
         RODAPÉ
    ====================================================== -->

    <div class="sidebar-footer">

        <div class="usuario-sidebar">

            <small>Administrador</small>

            <strong>

                <?= htmlspecialchars($_SESSION["admin_nome"] ?? "Administrador"); ?>

            </strong>

        </div>

        <a href="logout.php" class="logout">

            <i class="fa-solid fa-right-from-bracket"></i>

            <span>Sair</span>

        </a>

    </div>

</aside>