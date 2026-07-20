<?php

/*
|--------------------------------------------------------------------------
| Listagem de Serviços
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

try {

    $sql = "
        SELECT
            id,
            nome,
            valor,
            duracao,
            ativo
        FROM servicos
        ORDER BY nome ASC
    ";

    $servicos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Erro ao carregar os serviços: " . $e->getMessage());
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

                        Serviços

                    </h1>

                    <p class="page-description">

                        Gerencie os serviços oferecidos pelo Studio.

                    </p>

                </div>

                <a href="novo_servico.php" class="btn">

                    <i class="fa-solid fa-plus"></i>

                    Novo Serviço

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
                                <th>Valor</th>
                                <th>Duração</th>
                                <th>Status</th>
                                <th width="220">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($servicos)): ?>

                                <tr>

                                    <td colspan="5" style="text-align:center; padding:30px;">

                                        Nenhum serviço cadastrado.

                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($servicos as $servico): ?>

                                    <tr>

                                        <td>

                                            <?= htmlspecialchars($servico["nome"]); ?>

                                        </td>

                                        <td>

                                            R$ <?= number_format($servico["valor"], 2, ",", "."); ?>

                                        </td>

                                        <td>

                                            <?= (int) $servico["duracao"]; ?> min

                                        </td>

                                        <td>

                                            <?php if ($servico["ativo"]): ?>

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

                                            <a href="editar_servico.php?id=<?= $servico["id"]; ?>" class="btn">

                                                <i class="fa-solid fa-pen"></i>

                                                Editar

                                            </a>

                                            <a
                                                href="excluir_servico.php?id=<?= $servico["id"]; ?>"
                                                class="btn btn-perigo"
                                                onclick="return confirm('Deseja realmente excluir este serviço?');">

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