<?php

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

require_once "includes/admin_header.php";
require_once "includes/sidebar.php";
?>

<main class="conteudo-admin">

    <div class="topbar">
        <div>
            <h1>Novo Cliente</h1>
            <p>Cadastre um novo cliente para o Studio.</p>
        </div>
    </div>

    <div class="container-admin">
        <div class="painel">
            <form action="salvar_cliente.php" method="POST" class="form-admin">
                
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input 
                        type="text" 
                        id="nome" 
                        name="nome" 
                        maxlength="120" 
                        placeholder="Digite o nome completo" 
                        required>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input 
                        type="tel" 
                        id="telefone" 
                        name="telefone" 
                        maxlength="20" 
                        placeholder="(00) 00000-0000" 
                        required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        maxlength="120" 
                        placeholder="cliente@email.com">
                </div>

                <div class="form-acoes">
                    <button type="submit" class="btn">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Salvar Cliente
                    </button>
                    <a href="listar_clientes.php" class="btn btn-secundario">
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