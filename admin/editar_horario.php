<?php

/*
|--------------------------------------------------------------------------
| Editar Horário
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Busca o horário
|--------------------------------------------------------------------------
*/

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: listar_horarios.php");
    exit();

}

$id = (int) $_GET["id"];

try {

    $sql = "
        SELECT
            id,
            horario,
            ativo
        FROM horarios
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $horario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$horario) {

        header("Location: listar_horarios.php");
        exit();

    }

} catch (PDOException $e) {

    die("Erro ao carregar o horário: " . $e->getMessage());

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

            <h1>Editar Horário</h1>

            <p>Atualize o horário disponível para agendamento.</p>

        </div>

    </div>

    <div class="container-admin">

        <div class="painel">

            <form action="atualizar_horario.php" method="POST" class="form-admin">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $horario["id"]; ?>">

                <div class="form-group">

                    <label for="horario">Horário</label>

                    <input
                        type="time"
                        id="horario"
                        name="horario"
                        value="<?= date("H:i", strtotime($horario["horario"])); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="ativo">Status</label>

                    <select
                        id="ativo"
                        name="ativo">

                        <option
                            value="1"
                            <?= $horario["ativo"] ? "selected" : ""; ?>>

                            Ativo

                        </option>

                        <option
                            value="0"
                            <?= !$horario["ativo"] ? "selected" : ""; ?>>

                            Inativo

                        </option>

                    </select>

                </div>

                <div class="form-acoes">

                    <button type="submit" class="btn">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Salvar Alterações

                    </button>

                    <a href="listar_horarios.php" class="btn btn-secundario">

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