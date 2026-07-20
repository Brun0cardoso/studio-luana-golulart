<?php

/*
|--------------------------------------------------------------------------
| Listagem de Clientes
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

try {

    $sql = "
        SELECT
            id,
            nome,
            telefone,
            email,
            criado_em
        FROM clientes
        ORDER BY nome ASC
    ";

    $clientes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Erro ao carregar os clientes: " . $e->getMessage());
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

                        Clientes

                    </h1>

                    <p class="page-description">

                        Gerencie todos os clientes cadastrados.

                    </p>

                </div>

                <a href="novo_cliente.php" class="btn">

                    <i class="fa-solid fa-user-plus"></i>

                    Novo Cliente

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

                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Cadastro</th>
                                <th width="220">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($clientes)): ?>

                                <tr>

                                    <td colspan="5" style="text-align:center; padding:30px;">

                                        Nenhum cliente cadastrado.

                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($clientes as $cliente): ?>

                                    <tr>

                                        <td>

                                            <?= htmlspecialchars($cliente["nome"]); ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars($cliente["telefone"]); ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars($cliente["email"]); ?>

                                        </td>

                                        <td>

                                            <?= date("d/m/Y H:i", strtotime($cliente["criado_em"])); ?>

                                        </td>

                                        <td class="acoes">

                                            <a href="editar_cliente.php?id=<?= $cliente["id"]; ?>" class="btn">

                                                <i class="fa-solid fa-pen"></i>

                                                Editar

                                            </a>

                                            <a
                                                href="excluir_cliente.php?id=<?= $cliente["id"]; ?>"
                                                class="btn btn-perigo"
                                                onclick="return confirm('Deseja realmente excluir este cliente?')">

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