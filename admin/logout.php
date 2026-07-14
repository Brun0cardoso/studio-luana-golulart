<?php

/*
|--------------------------------------------------------------------------
| Logout do Administrador
|--------------------------------------------------------------------------
| Encerra a sessão do administrador e impede que as páginas
| protegidas permaneçam em cache no navegador.
|--------------------------------------------------------------------------
*/

// Inicia a sessão caso ainda não exista
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Remove todas as variáveis da sessão
$_SESSION = [];

// Remove o cookie da sessão (se existir)
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();

/*
|--------------------------------------------------------------------------
| Evita cache das páginas protegidas
|--------------------------------------------------------------------------
*/

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redireciona para o login
header("Location: login.php");
exit();