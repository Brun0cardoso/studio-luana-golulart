<?php

/*
|--------------------------------------------------------------------------
| Novo Agendamento
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Carrega os dados dos selects
|--------------------------------------------------------------------------
*/

try {

    $clientes = $pdo->query("
        SELECT id, nome
        FROM clientes
        ORDER BY nome
    ")->fetchAll(PDO::FETCH_ASSOC);

    $servicos = $pdo->query("
        SELECT id, nome, valor
        FROM servicos
        WHERE ativo = 1
        ORDER BY nome
    ")->fetchAll(PDO::FETCH_ASSOC);

    $profissionais = $pdo->query("
        SELECT id, nome
        FROM profissionais
        WHERE ativo = 1
        ORDER BY nome
    ")->fetchAll(PDO::FETCH_ASSOC);

    $horarios = $pdo->query("
        SELECT id, horario
        FROM horarios
        WHERE ativo = 1
        ORDER BY horario
    ")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erro ao carregar os dados: " . $e->getMessage());

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

            <h1>Novo Agendamento</h1>

            <p>Cadastre um novo agendamento para o Studio.</p>

        </div>

    </div>

    <div class="container-admin">

        <div class="painel">

            <form action="salvar_agendamento.php" method="POST" class="form-admin">

                <div class="form-group">

                    <label for="cliente_id">Cliente</label>

                    <select id="cliente_id" name="cliente_id" required>

                        <option value="">Selecione o cliente</option>

                        <?php foreach ($clientes as $cliente): ?>

                            <option value="<?= $cliente["id"]; ?>">

                                <?= htmlspecialchars($cliente["nome"]); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="servico_id">Serviço</label>

                    <select id="servico_id" name="servico_id" required>

                        <option value="">Selecione o serviço</option>

                        <?php foreach ($servicos as $servico): ?>

                            <option value="<?= $servico["id"]; ?>">

                                <?= htmlspecialchars($servico["nome"]); ?>

                                - R$ <?= number_format($servico["valor"], 2, ",", "."); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="profissional_id">Profissional</label>

                    <select id="profissional_id" name="profissional_id" required>

                        <option value="">Selecione o profissional</option>

                        <?php foreach ($profissionais as $profissional): ?>

                            <option value="<?= $profissional["id"]; ?>">

                                <?= htmlspecialchars($profissional["nome"]); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="data_agendamento">Data</label>

                    <input
                        type="date"
                        id="data_agendamento"
                        name="data_agendamento"
                        min="<?= date("Y-m-d"); ?>"
                        required>

                </div>

                <div class="form-group">

                    <label for="horario_id">Horário</label>

                    <select id="horario_id" name="horario_id" required>

                        <option value="">Selecione o horário</option>

                        <?php foreach ($horarios as $horario): ?>

                            <option value="<?= $horario["id"]; ?>">

                                <?= date("H:i", strtotime($horario["horario"])); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="status">Status</label>

                    <select id="status" name="status">

                        <option value="Confirmado">Confirmado</option>

                        <option value="Pendente" selected>Pendente</option>

                        <option value="Cancelado">Cancelado</option>

                    </select>

                </div>

                <div class="form-group">

                    <label for="observacoes">Observações</label>

                    <textarea
                        id="observacoes"
                        name="observacoes"
                        rows="5"
                        placeholder="Observações sobre o agendamento..."></textarea>

                </div>

                <div class="form-acoes">

                    <button type="submit" class="btn">

                        <i class="fa-solid fa-calendar-check"></i>

                        Salvar Agendamento

                    </button>

                    <a href="listar_agendamentos.php" class="btn btn-secundario">

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