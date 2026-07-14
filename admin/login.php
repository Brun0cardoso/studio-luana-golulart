<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Administrativo | Studio Luana Goulart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/favicon.ico">
</head>

<body>

    <div class="container">

        <h1>Studio Luana Goulart</h1>
        <p class="subtitulo">Faça login para acessar o sistema ADM.</p>

        <?php

        if (isset($_GET["erro"])) {

            if ($_GET["erro"] === "login") {

                echo '<div class="mensagem-erro">
                Login inválido. Verifique o e-mail e a senha.
              </div>';
            }

            if ($_GET["erro"] === "campos") {

                echo '<div class="mensagem-erro">
                Preencha todos os campos.
              </div>';
            }
        }

        ?>
        <form action="autenticar.php" method="POST">

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    autocomplete="email"
                    required>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    autocomplete="current-password"
                    required>
            </div>

            <button type="submit" class="btn btn-block">
                Entrar
            </button>

        </form>

        <!-- Coloque aqui -->
        <div class="acoes-login">

            <a href="../index.php" class="btn-secundario">

                ← Voltar ao Site

            </a>

        </div>

        <div class="dica-navegacao">
            <strong>Fluxo:</strong> Login -> Painel -> Confirmar ou reagendar atendimento.
        </div>

    </div>

</body>

</html>