<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Painel Administrativo - Studio Luana Goulart</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="icon" href="../assets/images/favicon.ico">
    
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

    <!-- =====================================================
         PÁGINA DE LOGIN
    ====================================================== -->

    <div class="login-page">

        <!-- Card -->

        <div class="login-card">

            <!-- Logo -->

            <div class="login-logo">

                <div class="logo-circle">

                    LG

                </div>

                <h1>Studio</h1>

                <span>Luana Goulart</span>

            </div>

            <!-- Título -->

            <h2>Painel Administrativo</h2>

            <p class="subtitulo">

                Faça login para acessar o sistema.

            </p>

            <!-- Mensagens -->

            <?php

            if (isset($_GET["erro"])) {

                if ($_GET["erro"] === "login") {

                    echo '
                    <div class="mensagem-erro">

                        Login inválido.<br>
                        Verifique o e-mail e a senha.

                    </div>';
                }

                if ($_GET["erro"] === "campos") {

                    echo '
                    <div class="mensagem-erro">

                        Preencha todos os campos.

                    </div>';
                }
            }

            ?>

            <!-- Formulário -->

            <form action="autenticar.php" method="POST">

                <div class="form-group">

                    <label for="email">

                        E-mail

                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu e-mail"
                        autocomplete="email"
                        required>

                </div>

                <div class="form-group">

                    <label for="senha">

                        Senha

                    </label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        autocomplete="current-password"
                        required>

                </div>

                <button type="submit" class="btn btn-block">

                    Entrar no Painel

                </button>

            </form>

            <!-- Botão voltar -->

            <div class="acoes-login">

                <a href="../index.php" class="btn-secundario">

                    ← Voltar ao Site

                </a>

            </div>

            <!-- Informação -->

            <div class="dica-navegacao">

                <strong>Fluxo:</strong>

                Login → Painel → Confirmar ou Reagendar Atendimento.

            </div>

        </div>

    </div>

</body>

</html>