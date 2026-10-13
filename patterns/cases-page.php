<?php
/**
 * Title: Página — Cases (três capítulos)
 * Slug: piuba-tech/cases-page
 * Categories: piuba-tech
 * Description: Abertura e três cases em capítulos de cor: desafio, solução, resultado e stack.
 */

$piuba_cases = array(
	array(
		'id'      => 'aquicultura',
		'tone'    => 'abyss',
		'name'    => 'SaaS de gestão para aquicultura',
		'kind'    => 'Produto próprio · Sistema sob medida',
		'media'   => 'tanques',
		'desafio' => 'Produtores acompanhavam biometria, ração e qualidade da água em cadernos e planilhas soltas, sem visão do ciclo inteiro. E cada fazenda precisava enxergar só os próprios dados.',
		'solucao' => 'Plataforma multi-tenant com isolamento por empresa, autenticação JWT e controle de acesso por papel (RBAC). Os eventos de campo trafegam por Kafka, e modelos de IA ajudam a projetar crescimento e consumo de ração.',
		'result'  => 'O ciclo produtivo passou a ser acompanhado num só lugar, com permissões por função, e a base recebe novos clientes sem retrabalho de infraestrutura.',
		'stack'   => array( 'Multi-tenant', 'RBAC', 'JWT', 'Kafka', 'IA aplicada' ),
	),
	array(
		'id'      => 'whatsapp',
		'tone'    => 'shallow',
		'name'    => 'Checkout pelo WhatsApp',
		'kind'    => 'E-commerce · Automação',
		'media'   => 'whatsapp',
		'desafio' => 'Boa parte das vendas começava no WhatsApp e se perdia no caminho: o cliente pedia o link, esperava a resposta e desistia antes de pagar.',
		'solucao' => 'Um fluxo automatizado consulta o estoque, monta o pedido e gera o pagamento dentro da própria conversa. O pedido entra direto no sistema da loja, sem digitação.',
		'result'  => 'A conversa virou canal de venda de ponta a ponta, e a equipe ficou livre para os atendimentos que realmente pedem uma pessoa.',
		'stack'   => array( 'API do WhatsApp', 'Webhooks', 'Pix', 'Integração com a loja' ),
	),
	array(
		'id'      => 'instagram',
		'tone'    => 'mist',
		'name'    => 'Instagram no site, sem plugin pesado',
		'kind'    => 'WordPress · Performance',
		'media'   => 'instagram',
		'desafio' => 'O site exibia o feed do Instagram com um plugin que carregava scripts de terceiros, deixava a página lenta e quebrava a cada mudança da API.',
		'solucao' => 'Sincronização própria pela API oficial: as publicações são importadas em segundo plano, guardadas como conteúdo do WordPress e servidas como imagens otimizadas.',
		'result'  => 'O feed segue atualizado, a página deixou de depender de script externo e o conteúdo passou a ser indexável pelo Google.',
		'stack'   => array( 'WordPress', 'API do Instagram', 'WP-Cron', 'WebP e lazy load' ),
	),
);
?>
<!-- wp:group {"tagName":"section","className":"page-intro ch ch--graphite","layout":{"type":"default"}} -->
<section class="wp-block-group page-intro ch ch--graphite">
<!-- wp:heading {"level":1,"className":"page-intro__title"} -->
<h1 class="wp-block-heading page-intro__title">Três cases, contados por dentro</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"page-intro__lead"} -->
<p class="page-intro__lead">Sem nome de cliente, com o que importa: o problema, a solução que foi ao ar e o que mudou na operação.</p>
<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

<?php foreach ( $piuba_cases as $c ) : ?>
<!-- wp:group {"tagName":"article","anchor":"<?php echo esc_attr( $c['id'] ); ?>","className":"case ch ch--<?php echo esc_attr( $c['tone'] ); ?>","layout":{"type":"default"}} -->
<article id="<?php echo esc_attr( $c['id'] ); ?>" class="wp-block-group case ch ch--<?php echo esc_attr( $c['tone'] ); ?>">
<!-- wp:group {"className":"case__head","layout":{"type":"default"}} -->
<div class="wp-block-group case__head">
<!-- wp:heading {"className":"case__name"} -->
<h2 class="wp-block-heading case__name"><?php echo esc_html( $c['name'] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"case__kind"} -->
<p class="case__kind"><?php echo esc_html( $c['kind'] ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"case__media","layout":{"type":"default"}} -->
<div class="wp-block-group case__media">
<?php
if ( 'whatsapp' === $c['media'] ) {
	echo piuba_ui_whatsapp(); // phpcs:ignore
} elseif ( 'instagram' === $c['media'] ) {
	echo piuba_ui_instagram(); // phpcs:ignore
} else {
	echo piuba_image_block( $c['media'], 'case__photo', 'large', null, 'Tanques-rede de aquicultura. Foto ilustrativa de acervo aberto.' ); // phpcs:ignore
	echo piuba_image_block( 'lagoa', 'case__photo case__photo--2', 'large', null, 'Viveiro escavado de criação de peixes. Foto ilustrativa de acervo aberto.' ); // phpcs:ignore
}
?>
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"case__story","layout":{"type":"default"}} -->
<div class="wp-block-group case__story">
<!-- wp:heading {"level":3,"className":"case__h"} -->
<h3 class="wp-block-heading case__h">Desafio</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $c['desafio'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"case__h"} -->
<h3 class="wp-block-heading case__h">Solução</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $c['solucao'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"case__h"} -->
<h3 class="wp-block-heading case__h">Resultado</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $c['result'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"case__stack"} -->
<ul class="wp-block-list case__stack"><?php foreach ( $c['stack'] as $t ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $t ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->
</article>
<!-- /wp:group -->

<?php endforeach; ?>
