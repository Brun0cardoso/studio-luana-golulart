<section class="section section-galeria" id="galeria">

    <div class="container">

        <h2 class="section-title">

            Nossa Galeria

        </h2>

        <p class="section-subtitle">

            Confira alguns dos resultados realizados no Studio Luana Goulart e inspire-se para o seu próximo atendimento.

        </p>

        <div class="galeria-grid">

            <?php for ($i = 1; $i <= 8; $i++): ?>

                <figure class="galeria-item">

                    <img
                        src="assets/images/foto-<?= $i; ?>.jpeg"
                        alt="Trabalho <?= $i; ?> - Extensão de cílios realizada no Studio Luana Goulart"
                        class="img-galeria"
                        loading="lazy">

                </figure>

            <?php endfor; ?>

        </div>

    </div>

</section>