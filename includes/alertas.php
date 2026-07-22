<?php

/*
|--------------------------------------------------------------------------
| Alertas do Sistema
|--------------------------------------------------------------------------
| Exibe mensagens de sucesso e erro após operações do sistema.
|--------------------------------------------------------------------------
*/

if (isset($_GET["sucesso"])) {

?>

    <div class="alert alert-success">

        Agendamento realizado com sucesso!

    </div>

<?php

}

if (isset($_GET["erro"])) {

    $mensagens = [

        "campos"   => "Preencha todos os campos obrigatórios.",

        "email"    => "E-mail inválido.",

        "telefone" => "Telefone inválido.",

        "nome"     => "Nome inválido.",

        "data"     => "Data inválida.",

        "horario"  => "Este horário já está reservado.",

        "sistema"  => "Ocorreu um erro interno. Tente novamente."

    ];

    $erro = $_GET["erro"];

    if (isset($mensagens[$erro])) {

?>

        <div class="alert alert-error">

            <?= htmlspecialchars($mensagens[$erro]); ?>

        </div>

<?php

    }

}