<?php

/*
|--------------------------------------------------------------------------
| Funções do Site
|--------------------------------------------------------------------------
*/

/**
 * Lista os serviços ativos.
 */
function listarServicos(PDO $pdo)
{
    $sql = "
        SELECT
            id,
            nome,
            valor,
            duracao
        FROM servicos
        WHERE ativo = 1
        ORDER BY nome
    ";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Lista os horários ativos.
 */
function listarHorarios(PDO $pdo)
{
    $sql = "
        SELECT
            id,
            horario
        FROM horarios
        WHERE ativo = 1
        ORDER BY horario
    ";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}