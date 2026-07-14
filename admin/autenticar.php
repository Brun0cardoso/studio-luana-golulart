<?php

/*
|--------------------------------------------------------------------------
| Autenticação do Administrador
|--------------------------------------------------------------------------
| Responsável por validar o login do administrador e criar a sessão.
|--------------------------------------------------------------------------
*/

session_start();

require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Permite acesso apenas via POST
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: login.php");
    exit();

}

/*
|--------------------------------------------------------------------------
| Recebe os dados do formulário
|--------------------------------------------------------------------------
*/

$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

/*
|--------------------------------------------------------------------------
| Validação dos campos
|--------------------------------------------------------------------------
*/

if (empty($email) || empty($senha)) {

    header("Location: login.php?erro=campos");
    exit();

}

/*
|--------------------------------------------------------------------------
| Busca o administrador pelo e-mail
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        id,
        nome,
        email,
        senha
    FROM administradores
    WHERE email = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

$usuario = $stmt->fetch();

/*
|--------------------------------------------------------------------------
| Verifica a senha
|--------------------------------------------------------------------------
*/

if ($usuario && password_verify($senha, $usuario["senha"])) {

    /*
    |--------------------------------------------------------------------------
    | Cria a sessão do administrador
    |--------------------------------------------------------------------------
    */

    $_SESSION["admin_id"]    = $usuario["id"];
    $_SESSION["admin_nome"]  = $usuario["nome"];
    $_SESSION["admin_email"] = $usuario["email"];

    /*
    |--------------------------------------------------------------------------
    | Redireciona para o painel administrativo
    |--------------------------------------------------------------------------
    */

    header("Location: dashboard.php");
    exit();

}

/*
|--------------------------------------------------------------------------
| Login inválido
|--------------------------------------------------------------------------
*/

header("Location: login.php?erro=login");
exit();