<?php
/**
 * Title: Início — Abertura (mar + coluna de capítulos)
 * Slug: piuba-tech/home-hero
 * Categories: piuba-tech, banner
 * Description: Foto do mar de Fortaleza com o título principal e, ao lado, a coluna de cores que é a navegação do site.
 */
?>
<!-- wp:group {"tagName":"section","className":"hero ch ch--mist","layout":{"type":"default"}} -->
<section class="wp-block-group hero ch ch--mist">
<!-- wp:group {"className":"hero__panel","layout":{"type":"default"}} -->
<div class="wp-block-group hero__panel">
<?php echo piuba_image_block( 'mar', 'hero__photo', 'full' ); // phpcs:ignore ?>

<!-- wp:paragraph {"className":"hero__mark"} -->
<p class="hero__mark"><a href="/">Piuba Tech</a></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"hero__title"} -->
<h1 class="wp-block-heading hero__title">Tecnologia e marketing que fazem crescer</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"hero__lead"} -->
<p class="hero__lead">Site, sistema, tráfego pago e SEO feitos pela mesma equipe, em Fortaleza — para o seu negócio crescer de verdade, sem repasse entre fornecedores.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"hero__action"} -->
<div class="wp-block-buttons hero__action"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contato/">Quero um diagnóstico em 48h</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<nav class="hero__swatches" aria-label="Principal">
	<a class="swatch ch--shallow" href="#diagnostico">Diagnóstico</a>
	<a class="swatch ch--tide" href="/servicos/">Serviços</a>
	<a class="swatch ch--foam" href="/cases/">Cases</a>
	<a class="swatch ch--graphite" href="/sobre/">Sobre</a>
	<a class="swatch ch--lime" href="/contato/">Contato</a>
</nav>
<!-- /wp:html -->
</section>
<!-- /wp:group -->
