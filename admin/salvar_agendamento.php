<?php

/*
|--------------------------------------------------------------------------
| Salvar Agendamento
|--------------------------------------------------------------------------
*/

require_once "../verificar_sessao.php";
require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Verifica envio do formulário
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: listar_agendamentos.php");
    exit;

}

/*
|--------------------------------------------------------------------------
| Recebe os dados
|--------------------------------------------------------------------------
*/

$cliente_id      = (int) $_POST["cliente_id"];
$servico_id      = (int) $_POST["servico_id"];
$profissional_id = (int) $_POST["profissional_id"];
$horario_id      = (int) $_POST["horario_id"];

$data_agendamento = $_POST["data_agendamento"];

$status = trim($_POST["status"]);

$observacoes = trim($_POST["observacoes"] ?? "");

/*
|--------------------------------------------------------------------------
| Validação
|--------------------------------------------------------------------------
*/

if (

    empty($cliente_id) ||
    empty($servico_id) ||
    empty($profissional_id) ||
    empty($horario_id) ||
    empty($data_agendamento)

) {

    die("Preencha todos os campos obrigatórios.");

}

/*
|--------------------------------------------------------------------------
| Salva no banco
|--------------------------------------------------------------------------
*/

try {

    $sql = "

        INSERT INTO agendamentos (

            cliente_id,
            servico_id,
            profissional_id,
            horario_id,
            data_agendamento,
            status,
            observacoes

        ) VALUES (

            :cliente,
            :servico,
            :profissional,
            :horario,
            :data,
            :status,
            :observacoes

        )

    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        ":cliente"      => $cliente_id,
        ":servico"      => $servico_id,
        ":profissional" => $profissional_id,
        ":horario"      => $horario_id,
        ":data"         => $data_agendamento,
        ":status"       => $status,
        ":observacoes"  => $observacoes

    ]);

    header("Location: listar_agendamentos.php?sucesso=1");
    exit;

} catch (PDOException $e) {

    die("Erro ao salvar o agendamento: " . $e->getMessage());

}

?>