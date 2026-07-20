/*
|--------------------------------------------------------------------------
| Máscara de Telefone
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {

    const telefones = document.querySelectorAll('input[type="tel"]');

    telefones.forEach((campo) => {

        campo.addEventListener("input", () => {

            let valor = campo.value.replace(/\D/g, "");

            if (valor.length > 11) {
                valor = valor.substring(0, 11);
            }

            if (valor.length > 10) {

                valor = valor.replace(
                    /^(\d{2})(\d{5})(\d{4}).*/,
                    "($1) $2-$3"
                );

            } else if (valor.length > 6) {

                valor = valor.replace(
                    /^(\d{2})(\d{4})(\d{0,4}).*/,
                    "($1) $2-$3"
                );

            } else if (valor.length > 2) {

                valor = valor.replace(
                    /^(\d{2})(\d+)/,
                    "($1) $2"
                );

            } else if (valor.length > 0) {

                valor = valor.replace(
                    /^(\d*)/,
                    "($1"
                );

            }

            campo.value = valor;

        });

    });

});