<?php

/*
|--------------------------------------------------------------------------
| Editar Profissional
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Busca o profissional
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_profissionais.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            nome,
            especialidade,
            ativo
        FROM profissionais
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $profissional = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$profissional) {

        header("Location: listar_profissionais.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o profissional: " . $e->getMessage());

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

            <h1>Editar Profissional</h1>

            <p>Atualize as informações do profissional.</p>

        </div>

    </div>

    <div class="container-admin">

        <div class="painel">

            <form action="atualizar_profissional.php" method="POST" class="form-admin">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $profissional["id"]; ?>">

                <div class="form-group">

                    <label for="nome">Nome Completo</label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        maxlength="120"
                        value="<?= htmlspecialchars($profissional["nome"]); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="especialidade">Especialidade</label>

                    <input
                        type="text"
                        id="especialidade"
                        name="especialidade"
                        maxlength="120"
                        placeholder="Ex.: Extensão de Cílios"
                        value="<?= htmlspecialchars($profissional["especialidade"]); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="ativo">Status</label>

                    <select id="ativo" name="ativo">

                        <option
                            value="1"
                            <?= $profissional["ativo"] ? "selected" : ""; ?>>

                            Ativo

                        </option>

                        <option
                            value="0"
                            <?= !$profissional["ativo"] ? "selected" : ""; ?>>

                            Inativo

                        </option>

                    </select>

                </div>

                <div class="form-acoes">

                    <button type="submit" class="btn">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Salvar Alterações

                    </button>

                    <a href="listar_profissionais.php" class="btn btn-secundario">

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