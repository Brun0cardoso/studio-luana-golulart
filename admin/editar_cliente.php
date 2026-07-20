<?php

/*
|--------------------------------------------------------------------------
| Editar Cliente
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Busca o cliente
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_clientes.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            nome,
            telefone,
            email
        FROM clientes
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {

        header("Location: listar_clientes.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o cliente: " . $e->getMessage());

}

/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
*/

require_once "includes/admin_header.php";
require_once "includes/sidebar.php";

?>

<main class="conteudo-admin">

    <div class="topbar">

        <div>

            <h1>Editar Cliente</h1>

            <p>Atualize os dados do cliente.</p>

        </div>

    </div>

    <div class="container-admin">

        <div class="painel">

            <form action="atualizar_cliente.php" method="POST" class="form-admin">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $cliente["id"]; ?>">

                <div class="form-group">

                    <label for="nome">Nome Completo</label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        maxlength="120"
                        value="<?= htmlspecialchars($cliente["nome"]); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="telefone">Telefone</label>

                    <input
                        type="tel"
                        id="telefone"
                        name="telefone"
                        maxlength="20"
                        value="<?= htmlspecialchars($cliente["telefone"]); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="email">E-mail</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        maxlength="120"
                        value="<?= htmlspecialchars($cliente["email"]); ?>">

                </div>

                <div class="form-acoes">

                    <button type="submit" class="btn">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Salvar Alterações

                    </button>

                    <a href="listar_clientes.php" class="btn btn-secundario">

                        <i class="fa-solid fa-arrow-left"></i>

                        Voltar

                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

<?php

require_once "includes/admin_footer.php";

?>