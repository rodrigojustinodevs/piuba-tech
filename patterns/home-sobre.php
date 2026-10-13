<?php
/**
 * Title: Início — Sobre (painel com foto recortada)
 * Slug: piuba-tech/home-sobre
 * Categories: piuba-tech
 * Description: Painel escuro com a frase do fundador, a foto do Mucuripe recortada em arco e dois blocos de texto.
 */
?>
<!-- wp:group {"tagName":"section","className":"about ch ch--foam","layout":{"type":"default"}} -->
<section class="wp-block-group about ch ch--foam">
<!-- wp:group {"className":"about__panel ch--graphite","layout":{"type":"default"}} -->
<div class="wp-block-group about__panel ch--graphite">
<!-- wp:heading {"className":"about__title"} -->
<h2 class="wp-block-heading about__title">Quem vende é quem constrói</h2>
<!-- /wp:heading -->

<?php echo piuba_image_block( 'mucuripe', 'about__photo', 'large' ); // phpcs:ignore ?>

<!-- wp:group {"className":"about__text","layout":{"type":"default"}} -->
<div class="wp-block-group about__text">
<!-- wp:heading {"level":3,"className":"about__sub"} -->
<h3 class="wp-block-heading about__sub">Engenharia sênior de verdade</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>O fundador é desenvolvedor full-stack há mais de sete anos e presta serviço para uma fintech. É o mesmo rigor de segurança e confiabilidade que entra no seu projeto.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"about__sub"} -->
<h3 class="wp-block-heading about__sub">Dono de produto também</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mantemos um SaaS de aquicultura e uma operação de e-commerce próprios. Toda decisão de tecnologia é medida pelo que faz no caixa — no nosso e no seu.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/sobre/">Conhecer a história</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
