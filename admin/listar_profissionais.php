<?php

/*
|--------------------------------------------------------------------------
| Listagem de Profissionais
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

try {

    $sql = "
        SELECT
            id,
            nome,
            especialidade,
            ativo
        FROM profissionais
        ORDER BY nome ASC
    ";

    $profissionais = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Erro ao carregar os profissionais: " . $e->getMessage());
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

                        Profissionais

                    </h1>

                    <p class="page-description">

                        Gerencie os profissionais cadastrados no Studio.

                    </p>

                </div>

                <a href="novo_profissional.php" class="btn">

                    <i class="fa-solid fa-user-plus"></i>

                    Novo Profissional

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
                                <th>Especialidade</th>
                                <th>Status</th>
                                <th width="220">Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($profissionais)): ?>

                                <tr>

                                    <td colspan="4" style="text-align:center; padding:30px;">

                                        Nenhum profissional cadastrado.

                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($profissionais as $profissional): ?>

                                    <tr>

                                        <td>

                                            <?= htmlspecialchars($profissional["nome"]); ?>

                                        </td>

                                        <td>

                                            <?= htmlspecialchars($profissional["especialidade"]); ?>

                                        </td>

                                        <td>

                                            <?php if ($profissional["ativo"]): ?>

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

                                            <a href="editar_profissional.php?id=<?= $profissional["id"]; ?>" class="btn">

                                                <i class="fa-solid fa-pen"></i>

                                                Editar

                                            </a>

                                            <a
                                                href="excluir_profissional.php?id=<?= $profissional["id"]; ?>"
                                                class="btn btn-perigo"
                                                onclick="return confirm('Deseja realmente excluir este profissional?')">

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