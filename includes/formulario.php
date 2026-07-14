<section class="section" id="contato">

    <div class="container">

        <h2 class="section-title">

            Agende seu Horário

        </h2>

        <p class="section-subtitle">

            Preencha o formulário abaixo para solicitar seu atendimento.

        </p>

        <form
            action="php/enviar.php"
            method="POST"
            class="formulario-agendamento">

            <div class="form-group">

                <label for="nome">

                    Nome Completo

                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite seu nome completo"
                    required>

            </div>

            <div class="form-group">

                <label for="telefone">

                    Telefone

                </label>

                <input
                    type="tel"
                    id="telefone"
                    name="telefone"
                    placeholder="(41) 99999-9999"
                    required>

            </div>

            <div class="form-group">

                <label for="email">

                    E-mail

                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    maxlength="120">

            </div>

            <div class="form-group">

                <label for="servico">

                    Serviço

                </label>

                <select
                    id="servico"
                    name="servico"
                    required>

                    <option value="">

                        Selecione

                    </option>

                    <?php foreach ($servicos as $servico): ?>

                        <option value="<?= $servico["id"]; ?>">

                            <?= htmlspecialchars($servico["nome"]); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label for="data">

                    Data

                </label>

                <input
                    type="date"
                    id="data"
                    name="data"
                    required>

            </div>

            <div class="form-group">

                <label for="horario">

                    Horário

                </label>

                <select
                    id="horario"
                    name="horario"
                    required>

                    <option value="">

                        Selecione

                    </option>

                    <?php foreach ($horarios as $horario): ?>

                        <option value="<?= $horario["id"]; ?>">

                            <?= date("H:i", strtotime($horario["horario"])); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group form-group-full">

                <label for="observacoes">

                    Observações

                </label>

                <textarea
                    id="observacoes"
                    name="observacoes"
                    rows="4"
                    placeholder="Caso tenha alguma observação, escreva aqui."></textarea>

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Agendar

            </button>

            <p class="form-info">

                Seus dados serão utilizados apenas para realizar o agendamento.

            </p>

        </form>

    </div>

</section>