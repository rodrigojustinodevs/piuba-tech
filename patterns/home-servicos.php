<?php
/**
 * Title: Início — Serviços (folhas de cor empilhadas)
 * Slug: piuba-tech/home-servicos
 * Categories: piuba-tech
 * Description: As cinco frentes como folhas de cor que sobem uma sobre a outra ao rolar, do fundo à superfície.
 */

$piuba_sheets = array(
	array( 'sites', 'abyss', 'Sites e Landing Pages', 'Páginas rápidas, escritas para converter e estruturadas para o Google entender. O site deixa de ser cartão de visita e vira canal de venda.', array( 'Copy e estrutura pensadas para conversão', 'Core Web Vitals no verde, no celular', 'SEO técnico e rastreamento desde o primeiro dia' ) ),
	array( 'sistemas', 'deep', 'Sistemas sob medida', 'ERP leve, portais e ferramentas internas que seguem o seu processo — não o contrário. Arquitetura feita para crescer sem reescrever tudo.', array( 'Pedidos, estoque e financeiro num lugar só', 'Portal do cliente com permissões por papel', 'Integrações com ERP, gateways e marketplaces' ) ),
	array( 'trafego', 'tide', 'Tráfego pago', 'Google Ads e Meta Ads com a conta feita: cada real rastreado do clique até a venda, e a verba indo para o que dá retorno.', array( 'Campanhas, públicos e criativos testados', 'Conversões medidas de ponta a ponta', 'Relatório com custo por resultado e ROI' ) ),
	array( 'seo', 'shallow', 'SEO', 'Tráfego orgânico que se acumula mês a mês: técnica, conteúdo e autoridade para aparecer quando o cliente pesquisa o problema que você resolve.', array( 'Auditoria técnica e correções no código', 'Palavras-chave com intenção de compra', 'SEO local e dados estruturados' ) ),
	array( 'automacao', 'mist', 'Automação e IA aplicada', 'Sistemas conversando entre si e IA trabalhando dentro do fluxo do negócio — para a equipe parar de copiar dado e voltar a vender.', array( 'Integrações entre ERP, CRM e e-commerce', 'Atendimento e vendas automatizados no WhatsApp', 'IA para classificar, resumir e responder' ) ),
);
?>
<!-- wp:group {"tagName":"section","anchor":"servicos","className":"sheets ch ch--graphite","layout":{"type":"default"}} -->
<section id="servicos" class="wp-block-group sheets ch ch--graphite">
<!-- wp:heading {"className":"sheets__title"} -->
<h2 class="wp-block-heading sheets__title">Cinco frentes, uma equipe</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"sheets__lead"} -->
<p class="sheets__lead">Quem escreve o código conversa todo dia com quem compra a mídia. Nada se perde no repasse entre fornecedores.</p>
<!-- /wp:paragraph -->

<?php foreach ( $piuba_sheets as $i => $s ) : ?>
<!-- wp:group {"className":"sheet ch--<?php echo esc_attr( $s[1] ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group sheet ch--<?php echo esc_attr( $s[1] ); ?>">
<!-- wp:heading {"level":3,"className":"sheet__name"} -->
<h3 class="wp-block-heading sheet__name"><a href="/servicos/#<?php echo esc_attr( $s[0] ); ?>"><?php echo esc_html( $s[2] ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:group {"className":"sheet__body","layout":{"type":"default"}} -->
<div class="wp-block-group sheet__body">
<!-- wp:paragraph {"className":"sheet__text"} -->
<p class="sheet__text"><?php echo esc_html( $s[3] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"sheet__list"} -->
<ul class="wp-block-list sheet__list"><?php foreach ( $s[4] as $item ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $item ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<?php endforeach; ?>
</section>
<!-- /wp:group -->
