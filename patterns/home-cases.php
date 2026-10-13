<?php
/**
 * Title: Início — Cases (grade escalonada)
 * Slug: piuba-tech/home-cases
 * Categories: piuba-tech
 * Description: Os três cases em uma grade escalonada, com o título ocupando a célula vazia.
 */
?>
<!-- wp:group {"tagName":"section","className":"work ch ch--foam","layout":{"type":"default"}} -->
<section class="wp-block-group work ch ch--foam">
<!-- wp:group {"className":"work__grid","layout":{"type":"default"}} -->
<div class="wp-block-group work__grid">
<!-- wp:group {"className":"tile tile--wide tile--a","layout":{"type":"default"}} -->
<div class="wp-block-group tile tile--wide tile--a">
<?php echo piuba_image_block( 'tanques', 'tile__media', 'large' ); // phpcs:ignore ?>

<!-- wp:paragraph {"className":"tile__cap"} -->
<p class="tile__cap"><a href="/cases/#aquicultura">SaaS de gestão para aquicultura</a><span>Multi-tenant · Kafka · IA</span></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"className":"work__title"} -->
<h2 class="wp-block-heading work__title">Cases reais</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"tile tile--b","layout":{"type":"default"}} -->
<div class="wp-block-group tile tile--b">
<?php echo piuba_ui_whatsapp(); // phpcs:ignore ?>

<!-- wp:paragraph {"className":"tile__cap"} -->
<p class="tile__cap"><a href="/cases/#whatsapp">Checkout pelo WhatsApp</a><span>E-commerce · Automação</span></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"tile tile--wide tile--c","layout":{"type":"default"}} -->
<div class="wp-block-group tile tile--wide tile--c">
<?php echo piuba_ui_instagram(); // phpcs:ignore ?>

<!-- wp:paragraph {"className":"tile__cap"} -->
<p class="tile__cap"><a href="/cases/#instagram">Instagram no site, sem plugin pesado</a><span>WordPress · Performance</span></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"work__note"} -->
<p class="work__note">Sem nome de cliente, com o que importa: o problema, a solução e o que mudou na operação. <a href="/cases/">Ler os três cases</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
