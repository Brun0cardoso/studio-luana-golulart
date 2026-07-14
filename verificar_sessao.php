<?php

/*
|--------------------------------------------------------------------------
| Verificação de Sessão
|--------------------------------------------------------------------------
| Este arquivo protege as páginas administrativas.
| Caso o administrador não esteja autenticado,
| ele será redirecionado para a tela de login.
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o administrador está logado
if (!isset($_SESSION["admin_id"])) {

    header("Location: admin/login.php");
    exit();

}