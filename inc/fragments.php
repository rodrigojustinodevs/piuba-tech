<?php
/**
 * Fragmentos de interface desenhados em HTML para os cases: a conversa de
 * checkout no WhatsApp e o feed do Instagram sincronizado no WordPress.
 * São ilustrações do tipo de entrega, com dados de exemplo.
 *
 * @package piuba-tech
 */

defined( 'ABSPATH' ) || exit;

function piuba_ui_whatsapp() {
	return <<<'HTML'
<!-- wp:html -->
<div class="ui ui-chat" data-ui role="img" aria-label="Exemplo de conversa: o cliente pede um produto no WhatsApp, recebe preço e estoque e paga por Pix sem sair da conversa">
	<p class="ui-chat__head"><span class="ui-chat__avatar" aria-hidden="true">L</span><span><strong>Loja</strong><br>pedido automático</span></p>
	<p class="ui-chat__msg is-in">Oi! O kit café da manhã ainda tem?</p>
	<p class="ui-chat__msg is-out">Tem sim: 14 em estoque. Kit café da manhã, R$ 189,90. Quer fechar por aqui?</p>
	<p class="ui-chat__msg is-in">Quero, entrega no Meireles</p>
	<p class="ui-chat__msg is-out">Frete R$ 12,00. Total R$ 201,90. Seu Pix está pronto: <span class="ui-chat__code">00020126…5204</span></p>
	<p class="ui-chat__msg is-out is-sys">Pagamento confirmado. Pedido #4821 enviado para separação.</p>
</div>
<!-- /wp:html -->
HTML;
}

function piuba_ui_instagram() {
	$tiles = '';
	foreach ( array( 'mucuripe', 'beiramar', 'mar', 'calcadao', 'lagoa', 'tanques' ) as $key ) {
		$tiles .= sprintf( '<span class="ui-feed__tile" style="background-image:url(%s)"></span>', esc_url( piuba_image_url( $key, 'medium' ) ) );
	}
	return '<!-- wp:html -->
<div class="ui ui-feed" data-ui role="img" aria-label="Exemplo de feed do Instagram exibido no site WordPress, sincronizado sem plugin de terceiros">
	<p class="ui-feed__head"><strong>@sualoja</strong> no site<span class="ui-feed__sync">sincronizado há 4 min</span></p>
	<div class="ui-feed__grid">' . $tiles . '</div>
	<p class="ui-feed__foot">0 scripts de terceiros · imagens servidas pelo próprio WordPress</p>
</div>
<!-- /wp:html -->';
}

/**
 * Fragmento de interface para cada serviço (dados de exemplo).
 */
function piuba_ui_service( $id ) {
	$html = array(
		'sites'     => '<div class="ui ui-vitals" data-ui role="img" aria-label="Exemplo de relatório de Core Web Vitals no celular, com as três métricas aprovadas">
	<p class="ui-vitals__head"><strong>Core Web Vitals</strong> · celular</p>
	<ul class="ui-vitals__list">
		<li><span>Maior renderização (LCP)</span><b>Bom</b></li>
		<li><span>Resposta à interação (INP)</span><b>Bom</b></li>
		<li><span>Estabilidade visual (CLS)</span><b>Bom</b></li>
	</ul>
	<p class="ui-vitals__foot">Avaliação: <b>aprovado</b> · dados de campo, últimos 28 dias</p>
</div>',
		'sistemas'  => '<div class="ui ui-table" data-ui role="img" aria-label="Exemplo de tela de pedidos de um ERP leve">
	<p class="ui-table__head"><strong>Pedidos</strong><span>hoje</span></p>
	<table>
		<thead><tr><th>Pedido</th><th>Etapa</th><th>Total</th></tr></thead>
		<tbody>
			<tr><td>#1042</td><td><i class="is-ok">Faturado</i></td><td>R$ 3.480,00</td></tr>
			<tr><td>#1043</td><td><i class="is-run">Separação</i></td><td>R$ 912,50</td></tr>
			<tr><td>#1044</td><td><i class="is-run">Separação</i></td><td>R$ 1.205,00</td></tr>
			<tr><td>#1045</td><td><i>Novo</i></td><td>R$ 268,90</td></tr>
		</tbody>
	</table>
</div>',
		'trafego'   => '<div class="ui ui-path" data-ui role="img" aria-label="Exemplo de caminho de conversão rastreado do anúncio até a venda">
	<p class="ui-path__head"><strong>Caminho da conversão</strong> · lead 8231</p>
	<ol class="ui-path__list">
		<li><b>Clique no anúncio</b><span>Google Ads · campanha Pesquisa</span></li>
		<li><b>Visita à landing page</b><span>gclid recebido · 1,4 s para carregar</span></li>
		<li><b>Formulário enviado</b><span>evento generate_lead no GA4</span></li>
		<li><b>Venda no sistema</b><span>conversão offline enviada ao Google Ads</span></li>
	</ol>
</div>',
		'seo'       => '<div class="ui ui-serp" data-ui role="img" aria-label="Exemplo de resultado orgânico no Google com dados estruturados">
	<p class="ui-serp__q">sistema para gestão de piscicultura</p>
	<div class="ui-serp__item">
		<p class="ui-serp__url">suaempresa.com.br › gestao-piscicultura</p>
		<p class="ui-serp__title">Sistema de gestão para piscicultura: ração, biometria e lotes</p>
		<p class="ui-serp__desc">Acompanhe o ciclo inteiro em um só lugar: consumo de ração, biometria e qualidade da água por viveiro. Teste grátis por 14 dias.</p>
		<p class="ui-serp__faq">Perguntas frequentes · Preços · Como funciona</p>
	</div>
</div>',
		'automacao' => '<div class="ui ui-log" data-ui role="img" aria-label="Exemplo de registro de automações rodando entre sistemas">
	<p class="ui-log__head"><strong>Automações</strong><span>ao vivo</span></p>
	<ul class="ui-log__list">
		<li><time>14:02</time><span>pedido.criado → ERP</span><b>ok</b></li>
		<li><time>14:02</time><span>estoque.reservado → loja</span><b>ok</b></li>
		<li><time>14:03</time><span>WhatsApp: confirmação enviada ao cliente</span><b>ok</b></li>
		<li><time>14:05</time><span>IA: mensagem classificada como “troca”</span><b>ok</b></li>
		<li><time>14:05</time><span>chamado aberto para o time de pós-venda</span><b>ok</b></li>
	</ul>
</div>',
	);
	return isset( $html[ $id ] ) ? "<!-- wp:html -->\n" . $html[ $id ] . "\n<!-- /wp:html -->" : '';
}
