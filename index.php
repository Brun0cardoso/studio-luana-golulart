<?php

require_once "config/conexao.php";
require_once "php/funcoes.php";

$servicos = listarServicos($pdo);
$horarios = listarHorarios($pdo);

include "includes/head.php";
include "includes/header.php";
include "includes/alertas.php";
include "includes/hero.php";
include "includes/sobre.php";
include "includes/servicos.php";
include "includes/galeria.php";
include "includes/depoimentos.php";
include "includes/formulario.php";
include "includes/footer.php";