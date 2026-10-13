<?php
/**
 * Title: Início — Como funciona (acordeão do fundo à superfície)
 * Slug: piuba-tech/home-processo
 * Categories: piuba-tech
 * Description: Cinco etapas num acordeão horizontal, do tom mais profundo ao mais claro. Sem JavaScript, as etapas aparecem empilhadas e abertas.
 */

$piuba_steps = array(
	array( 'Diagnóstico', 'Você conta o que trava. Em até 48h devolvemos um diagnóstico com o que atacar primeiro, o que pode esperar e o que não vale fazer.' ),
	array( 'Plano', 'Escopo fechado, prazo e os indicadores que vão dizer se deu certo — combinados antes de qualquer linha de código ou real em mídia.' ),
	array( 'Construção', 'Site, sistema ou campanha sobem com a mesma equipe, em entregas curtas que você acompanha e aprova.' ),
	array( 'Medição', 'Rastreamento de ponta a ponta, do clique no anúncio ao pedido no sistema. Você vê o que dá retorno e o que só dá trabalho.' ),
	array( 'Escala', 'Com o que funciona comprovado, ampliamos: mais verba onde converte, automação onde a equipe trava, sistema onde a planilha não dá mais conta.' ),
);
?>
<!-- wp:group {"tagName":"section","className":"steps ch ch--graphite","layout":{"type":"default"}} -->
<section class="wp-block-group steps ch ch--graphite">
<!-- wp:group {"className":"steps__intro","layout":{"type":"default"}} -->
<div class="wp-block-group steps__intro">
<!-- wp:heading {"className":"steps__title"} -->
<h2 class="wp-block-heading steps__title">Do diagnóstico à escala</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"steps__lead"} -->
<p class="steps__lead">Como uma criação bem manejada: primeiro entender a água, depois alimentar, medir e só então ampliar. Cada etapa tem entrega e critério claros.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"steps__row","layout":{"type":"default"}} -->
<div class="wp-block-group steps__row">
<?php foreach ( $piuba_steps as $i => $s ) : ?>
<!-- wp:group {"className":"step step--<?php echo (int) $i + 1; ?>","layout":{"type":"default"}} -->
<div class="wp-block-group step step--<?php echo (int) $i + 1; ?>">
<!-- wp:heading {"level":3,"className":"step__name"} -->
<h3 class="wp-block-heading step__name"><?php echo esc_html( $s[0] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"step__text"} -->
<p class="step__text"><?php echo esc_html( $s[1] ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
