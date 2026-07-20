<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

require_once "includes/admin_header.php";
require_once "includes/sidebar.php";
?>

<main class="conteudo-admin">

    <div class="topbar">
        <div>
            <h1>Novo Horário</h1>
            <p>Cadastre um novo horário disponível para agendamentos.</p>
        </div>
    </div>

    <div class="container-admin">
        <div class="painel">
            <form action="salvar_horario.php" method="POST" class="form-admin">
                
                <div class="form-group">
                    <label for="horario">Horário</label>
                    <input 
                        type="time" 
                        id="horario" 
                        name="horario" 
                        required>
                </div>

                <div class="form-group">
                    <label for="ativo">Status</label>
                    <select id="ativo" name="ativo">
                        <option value="1" selected>Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>

                <div class="form-acoes">
                    <button type="submit" class="btn">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Salvar Horário
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