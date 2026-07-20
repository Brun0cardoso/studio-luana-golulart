<?php

/*
|--------------------------------------------------------------------------
| Editar Serviço
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Busca o serviço
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_servicos.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            nome,
            valor,
            duracao,
            ativo
        FROM servicos
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $servico = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$servico) {

        header("Location: listar_servicos.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o serviço: " . $e->getMessage());

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

            <h1>Editar Serviço</h1>

            <p>Atualize as informações do serviço.</p>

        </div>

    </div>

    <div class="container-admin">

        <div class="painel">

            <form action="atualizar_servico.php" method="POST" class="form-admin">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $servico["id"] ?>">

                <div class="form-group">

                    <label for="nome">Nome do Serviço</label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        maxlength="120"
                        value="<?= htmlspecialchars($servico["nome"]) ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="valor">Valor (R$)</label>

                    <input
                        type="number"
                        id="valor"
                        name="valor"
                        step="0.01"
                        min="0"
                        value="<?= $servico["valor"] ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="duracao">Duração (minutos)</label>

                    <input
                        type="number"
                        id="duracao"
                        name="duracao"
                        min="1"
                        value="<?= $servico["duracao"] ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="ativo">Status</label>

                    <select
                        id="ativo"
                        name="ativo">

                        <option
                            value="1"
                            <?= $servico["ativo"] ? "selected" : "" ?>>

                            Ativo

                        </option>

                        <option
                            value="0"
                            <?= !$servico["ativo"] ? "selected" : "" ?>>

                            Inativo

                        </option>

                    </select>

                </div>

                <div class="form-acoes">

                    <button type="submit" class="btn">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Salvar Alterações

                    </button>

                    <a href="listar_servicos.php" class="btn btn-secundario">

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