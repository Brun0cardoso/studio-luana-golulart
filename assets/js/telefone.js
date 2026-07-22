/*
|--------------------------------------------------------------------------
| Máscara de Telefone
|--------------------------------------------------------------------------
| Aplica automaticamente a máscara em todos os campos
| do tipo "tel".
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {

    const telefones = document.querySelectorAll('input[type="tel"]');

    if (!telefones.length) {
        return;
    }

    /**
     * Formata o telefone
     */
    function aplicarMascaraTelefone(valor) {

        valor = valor.replace(/\D/g, "");

        if (valor.length > 11) {
            valor = valor.substring(0, 11);
        }

        if (valor.length > 10) {

            return valor.replace(
                /^(\d{2})(\d{5})(\d{4}).*/,
                "($1) $2-$3"
            );

        }

        if (valor.length > 6) {

            return valor.replace(
                /^(\d{2})(\d{4})(\d{0,4}).*/,
                "($1) $2-$3"
            );

        }

        if (valor.length > 2) {

            return valor.replace(
                /^(\d{2})(\d+)/,
                "($1) $2"
            );

        }

        if (valor.length > 0) {

            return valor.replace(
                /^(\d*)/,
                "($1"
            );

        }

        return valor;

    }

    telefones.forEach((campo) => {

        campo.addEventListener("input", () => {

            campo.value = aplicarMascaraTelefone(campo.value);

        });

    });

});