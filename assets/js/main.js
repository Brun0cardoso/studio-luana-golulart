/*
|--------------------------------------------------------------------------
| Studio Luana Goulart
| Arquivo Principal
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {

    iniciarMenuMobile();
    iniciarScrollSuave();
    iniciarAnimacoes();
    iniciarAlertas();
    iniciarHorariosDisponiveis();

});


/* ==========================================================================
   MENU MOBILE
========================================================================== */

function iniciarMenuMobile() {

    const botao = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu-nav");

    if (!botao || !menu) return;

    function abrirFecharMenu() {

        botao.classList.toggle("ativo");
        menu.classList.toggle("ativo");
        document.body.classList.toggle("menu-open");

    }

    function fecharMenu() {

        botao.classList.remove("ativo");
        menu.classList.remove("ativo");
        document.body.classList.remove("menu-open");

    }

    botao.addEventListener("click", abrirFecharMenu);

    menu.querySelectorAll("a").forEach((link) => {

        link.addEventListener("click", fecharMenu);

    });

    document.addEventListener("keydown", (event) => {

        if (event.key === "Escape") {

            fecharMenu();

        }

    });

    document.addEventListener("click", (event) => {

        const clicouNoBotao = botao.contains(event.target);
        const clicouNoMenu = menu.contains(event.target);

        if (!clicouNoBotao && !clicouNoMenu) {

            fecharMenu();

        }

    });

}

/* ==========================================================================
   SCROLL SUAVE
========================================================================== */

function iniciarScrollSuave() {

    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach((link) => {

        link.addEventListener("click", (event) => {

            const id = link.getAttribute("href");

            if (id === "#") return;

            const destino = document.querySelector(id);

            if (!destino) return;

            event.preventDefault();

            destino.scrollIntoView({

                behavior: "smooth",
                block: "start"

            });

        });

    });

}

/* ==========================================================================
   ANIMAÇÕES
========================================================================== */

function iniciarAnimacoes() {

    const elementos = document.querySelectorAll(".reveal");

    if (elementos.length === 0) return;

    const observer = new IntersectionObserver((entries, observer) => {

        entries.forEach((entry) => {

            if (!entry.isIntersecting) return;

            entry.target.classList.add("active");

            observer.unobserve(entry.target);

        });

    }, {

        threshold: 0.2,
        rootMargin: "0px 0px -80px 0px"

    });

    elementos.forEach((elemento) => {

        observer.observe(elemento);

    });

}

/* ==========================================================================
   ALERTAS
========================================================================== */

function iniciarAlertas() {

    const alerta = document.querySelector(".alert");

    if (!alerta) return;

    setTimeout(() => {

        alerta.style.opacity = "0";

        alerta.style.transform = "translateY(-15px)";

        setTimeout(() => {

            alerta.remove();

        }, 300);

    }, 5000);

}

/* ==========================================================================
   HORÁRIOS DISPONÍVEIS
========================================================================== */

function iniciarHorariosDisponiveis() {

    const campoData = document.querySelector("#data");
    const campoHorario = document.querySelector("#horario");

    if (!campoData || !campoHorario) return;

    campoData.addEventListener("change", async () => {

        campoHorario.innerHTML =
            '<option value="">Carregando...</option>';

        try {

            const resposta = await fetch(
                `php/buscar_horarios.php?data=${campoData.value}`
            );

            const horarios = await resposta.json();

            campoHorario.innerHTML =
                '<option value="">Selecione</option>';

            horarios.forEach((horario) => {

                const option = document.createElement("option");

                option.value = horario.id;

                option.textContent =
                    horario.horario.substring(0,5);

                campoHorario.appendChild(option);

            });

        } catch (erro) {

            campoHorario.innerHTML =
                '<option value="">Erro ao carregar</option>';

        }

    });

}