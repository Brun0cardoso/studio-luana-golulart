<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

require_once "includes/admin_header.php";
require_once "includes/sidebar.php";
?>

<main class="conteudo-admin">

    <div class="topbar">
        <div>
            <h1>Novo Serviço</h1>
            <p>Cadastre um novo serviço oferecido pelo Studio.</p>
        </div>
    </div>

    <div class="container-admin">
        <div class="painel">
            <form action="salvar_servico.php" method="POST" class="form-admin">
                
                <div class="form-group">
                    <label for="nome">Nome do Serviço</label>
                    <input 
                        type="text" 
                        id="nome" 
                        name="nome" 
                        maxlength="120" 
                        placeholder="Ex.: Extensão de Cílios Volume Brasileiro" 
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
                        placeholder="0.00" 
                        required>
                </div>

                <div class="form-group">
                    <label for="duracao">Duração (minutos)</label>
                    <input 
                        type="number" 
                        id="duracao" 
                        name="duracao" 
                        min="1" 
                        placeholder="90" 
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
                        Salvar Serviço
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