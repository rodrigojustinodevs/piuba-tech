<?php
/**
 * Title: Página — Serviços (cinco capítulos)
 * Slug: piuba-tech/servicos-page
 * Categories: piuba-tech
 * Description: Abertura e os cinco serviços, cada um num capítulo de cor com o que está incluso e para quem é indicado.
 */

$piuba_services = array(
	array(
		'id'     => 'sites',
		'tone'   => 'mist',
		'name'   => 'Sites e Landing Pages',
		'lead'   => 'Sites rápidos, escritos para converter e para o Google entender.',
		'inclui' => array( 'Estratégia de página e copy orientada a conversão', 'Design responsivo, pensado primeiro para o celular', 'WordPress ou desenvolvimento sob medida, com Core Web Vitals no verde', 'SEO técnico de base: headings, schema, sitemap e meta tags', 'Rastreamento de conversões com GA4, pixels e eventos', 'Integração com WhatsApp, CRM e formulários' ),
		'quem'   => 'Negócios com site lento, desatualizado ou que não gera contato — e quem vai investir em tráfego pago e precisa de uma página que segure o clique.',
	),
	array(
		'id'     => 'sistemas',
		'tone'   => 'abyss',
		'name'   => 'Sistemas sob medida',
		'lead'   => 'Software que se encaixa na operação, não o contrário: ERP leve, portais e ferramentas internas feitas para durar.',
		'inclui' => array( 'ERP leve: pedidos, estoque e financeiro num lugar só', 'Portal do cliente e áreas restritas', 'Painéis com os números que importam para decidir', 'APIs e integrações com ERPs, gateways e marketplaces', 'Autenticação, permissões por papel (RBAC) e logs de auditoria', 'Hospedagem, monitoramento e manutenção contínua' ),
		'quem'   => 'Empresas que cresceram além das planilhas e dos sistemas de prateleira e precisam de uma ferramenta que siga o próprio processo.',
	),
	array(
		'id'     => 'trafego',
		'tone'   => 'shallow',
		'name'   => 'Tráfego pago',
		'lead'   => 'Mídia com a conta feita: cada real rastreado do clique até a venda, e a verba indo para onde dá retorno.',
		'inclui' => array( 'Google Ads: Pesquisa, Performance Max e Shopping', 'Meta Ads: Facebook e Instagram', 'Estrutura de campanhas, públicos e criativos', 'Conversões rastreadas de ponta a ponta, server-side quando faz sentido', 'Testes A/B de anúncio e de página de destino', 'Relatório mensal com custo por resultado e ROI' ),
		'quem'   => 'Negócios que querem demanda previsível — e quem já investe em anúncio, mas não sabe dizer qual campanha paga a conta.',
	),
	array(
		'id'     => 'seo',
		'tone'   => 'deep',
		'name'   => 'SEO',
		'lead'   => 'Tráfego orgânico que se acumula mês a mês, com técnica, conteúdo e autoridade trabalhando juntos.',
		'inclui' => array( 'Auditoria técnica: indexação, velocidade e estrutura', 'Pesquisa de palavras-chave com intenção de compra', 'Arquitetura de conteúdo e otimização de páginas', 'SEO local e Perfil da Empresa no Google', 'Dados estruturados (schema.org)', 'Acompanhamento de posições e cliques no Search Console' ),
		'quem'   => 'Quem quer depender menos de anúncio e aparecer quando o cliente pesquisa o problema que a empresa resolve.',
	),
	array(
		'id'     => 'automacao',
		'tone'   => 'tide',
		'name'   => 'Automação e IA aplicada',
		'lead'   => 'Menos tarefa repetida, mais tempo para vender: sistemas conversando entre si e IA dentro do fluxo do negócio.',
		'inclui' => array( 'Integrações entre ERP, CRM, e-commerce e planilhas', 'Atendimento e vendas automatizados no WhatsApp', 'Filas e eventos para processos que não podem falhar', 'IA para classificar, resumir e responder dentro do fluxo', 'Rotinas agendadas e alertas', 'Documentação e treinamento da equipe' ),
		'quem'   => 'Equipes que passam horas copiando dados entre ferramentas, respondendo as mesmas perguntas ou conferindo tudo à mão.',
	),
);
?>
<!-- wp:group {"tagName":"section","className":"page-intro ch ch--graphite","layout":{"type":"default"}} -->
<section class="wp-block-group page-intro ch ch--graphite">
<!-- wp:heading {"level":1,"className":"page-intro__title"} -->
<h1 class="wp-block-heading page-intro__title">Cinco frentes. Uma operação.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"page-intro__lead"} -->
<p class="page-intro__lead">Contrate uma frente ou todas. Site, sistema e mídia sentam na mesma mesa e respondem pelo mesmo resultado.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<nav class="page-intro__index" aria-label="Serviços nesta página">
<?php foreach ( $piuba_services as $s ) : ?>
	<a class="ch--<?php echo esc_attr( $s['tone'] ); ?>" href="#<?php echo esc_attr( $s['id'] ); ?>"><?php echo esc_html( $s['name'] ); ?></a>
<?php endforeach; ?>
</nav>
<!-- /wp:html -->
</section>
<!-- /wp:group -->

<?php foreach ( $piuba_services as $s ) : ?>
<!-- wp:group {"tagName":"section","anchor":"<?php echo esc_attr( $s['id'] ); ?>","className":"svc ch ch--<?php echo esc_attr( $s['tone'] ); ?>","layout":{"type":"default"}} -->
<section id="<?php echo esc_attr( $s['id'] ); ?>" class="wp-block-group svc ch ch--<?php echo esc_attr( $s['tone'] ); ?>">
<!-- wp:heading {"className":"svc__name"} -->
<h2 class="wp-block-heading svc__name"><?php echo esc_html( $s['name'] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"svc__lead"} -->
<p class="svc__lead"><?php echo esc_html( $s['lead'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"svc__ui","layout":{"type":"default"}} -->
<div class="wp-block-group svc__ui"><?php echo piuba_ui_service( $s['id'] ); // phpcs:ignore ?></div>
<!-- /wp:group -->

<!-- wp:group {"className":"svc__cols","layout":{"type":"default"}} -->
<div class="wp-block-group svc__cols">
<!-- wp:group {"className":"svc__col","layout":{"type":"default"}} -->
<div class="wp-block-group svc__col">
<!-- wp:heading {"level":3,"className":"svc__h"} -->
<h3 class="wp-block-heading svc__h">O que está incluso</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"svc__list"} -->
<ul class="wp-block-list svc__list"><?php foreach ( $s['inclui'] as $item ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $item ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"svc__col svc__who","layout":{"type":"default"}} -->
<div class="wp-block-group svc__col svc__who">
<!-- wp:heading {"level":3,"className":"svc__h"} -->
<h3 class="wp-block-heading svc__h">Para quem é</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"svc__quem"} -->
<p class="svc__quem"><?php echo esc_html( $s['quem'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"svc__go"} -->
<p class="svc__go"><a href="/contato/?servico=<?php echo esc_attr( $s['id'] ); ?>#diagnostico-form">Quero um diagnóstico de <?php echo esc_html( $s['name'] ); ?> <span aria-hidden="true">→</span></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<?php endforeach; ?>
