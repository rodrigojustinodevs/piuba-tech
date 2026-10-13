<?php
/**
 * Title: Página — Contato (formulário de diagnóstico)
 * Slug: piuba-tech/contato-page
 * Categories: piuba-tech
 * Description: Título, promessa de diagnóstico em 48h, próximos passos e o formulário.
 */
?>
<!-- wp:group {"tagName":"section","className":"contact ch ch--abyss","layout":{"type":"default"}} -->
<section class="wp-block-group contact ch ch--abyss">
<!-- wp:group {"className":"contact__intro","layout":{"type":"default"}} -->
<div class="wp-block-group contact__intro">
<!-- wp:heading {"level":1,"className":"contact__title"} -->
<h1 class="wp-block-heading contact__title">Me conta o que trava seu crescimento</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"contact__lead"} -->
<p class="contact__lead">Retorno com diagnóstico em até 48h, sem compromisso: o que atacar primeiro e por quê.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"className":"contact__h"} -->
<h2 class="wp-block-heading contact__h">O que acontece depois</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true,"className":"contact__steps"} -->
<ol class="wp-block-list contact__steps"><!-- wp:list-item -->
<li>Você descreve o problema aqui, do seu jeito.</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li>Em até 48h, respondemos por e-mail com o diagnóstico.</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li>Se fizer sentido, montamos a proposta juntos, com a métrica de sucesso escrita.</li>
<!-- /wp:list-item --></ol>
<!-- /wp:list -->

<!-- wp:group {"className":"contact__pics","layout":{"type":"default"}} -->
<div class="wp-block-group contact__pics">
<?php echo piuba_image_block( 'mucuripe', 'contact__pic', 'medium_large' ); // phpcs:ignore ?>
<?php echo piuba_image_block( 'mar', 'contact__pic', 'medium_large', null, 'Atendemos de Fortaleza, Ceará, para empresas de todo o Brasil.' ); // phpcs:ignore ?>
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"contact__mail"} -->
<p class="contact__mail">Prefere e-mail? <a href="mailto:contato@piubatech.com.br">contato@piubatech.com.br</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"contact__form ch--mist","layout":{"type":"default"}} -->
<div class="wp-block-group contact__form ch--mist">
<!-- wp:shortcode -->
[piuba_contact]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
