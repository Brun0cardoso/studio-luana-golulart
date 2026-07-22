<?php

require_once "../config/conexao.php";

/*
|--------------------------------------------------------------------------
| Retorna os horários disponíveis
|--------------------------------------------------------------------------
*/

if (!isset($_GET["data"])) {

    exit;

}

$data = $_GET["data"];

/*
|--------------------------------------------------------------------------
| Busca todos os horários livres
|--------------------------------------------------------------------------
*/

$sql = "

SELECT
    h.id,
    h.horario

FROM horarios h

WHERE h.id NOT IN (

    SELECT horario_id

    FROM agendamentos

    WHERE data_agendamento = ?

    AND status <> 'Cancelado'

)

ORDER BY h.horario

";

$stmt = $pdo->prepare($sql);

$stmt->execute([$data]);

$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json; charset=utf-8");

echo json_encode($horarios);