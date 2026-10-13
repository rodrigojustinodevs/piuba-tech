<?php
/**
 * Title: Início — Onde seu crescimento trava? (diagnóstico interativo)
 * Slug: piuba-tech/home-diagnostico
 * Categories: piuba-tech
 * Description: O visitante escolhe o sintoma e vê por onde o diagnóstico começa; o botão leva ao contato já preenchido. Funciona sem JavaScript.
 */

$piuba_dx = array(
	array(
		'id'      => 'site',
		'sintoma' => 'Tenho site, mas ele não vende',
		'servico' => 'sites',
		'nome'    => 'Sites e Landing Pages',
		'olhamos' => array(
			'Velocidade e Core Web Vitals no celular, que é onde seu cliente está',
			'O caminho da visita até o contato ou a compra, clique a clique',
			'Se as conversões estão sendo medidas — ou só as visitas',
		),
	),
	array(
		'id'      => 'google',
		'sintoma' => 'Ninguém me encontra no Google',
		'servico' => 'seo',
		'nome'    => 'SEO',
		'olhamos' => array(
			'Erros técnicos que impedem o Google de indexar suas páginas',
			'O que seu cliente pesquisa e para quais termos você aparece hoje',
			'Quem ocupa o seu lugar na primeira página, e por quê',
		),
	),
	array(
		'id'      => 'anuncio',
		'sintoma' => 'Anúncio gasta e não volta em venda',
		'servico' => 'trafego',
		'nome'    => 'Tráfego pago',
		'olhamos' => array(
			'Estrutura de campanhas, públicos e palavras-chave negativas',
			'Rastreamento: pixel, GA4 e conversões chegando de verdade',
			'A página que recebe o clique e o que ela pede ao visitante',
		),
	),
	array(
		'id'      => 'planilha',
		'sintoma' => 'A operação vive em planilha',
		'servico' => 'sistemas',
		'nome'    => 'Sistemas sob medida',
		'olhamos' => array(
			'Onde o mesmo dado é digitado duas ou três vezes',
			'O fluxo do pedido ao financeiro e onde ele emperra',
			'O menor sistema que resolveria o maior gargalo primeiro',
		),
	),
	array(
		'id'      => 'manual',
		'sintoma' => 'A equipe repete tarefa o dia inteiro',
		'servico' => 'automacao',
		'nome'    => 'Automação e IA aplicada',
		'olhamos' => array(
			'As tarefas repetidas que mais consomem horas da equipe',
			'Integrações possíveis entre as ferramentas que você já usa',
			'Onde a IA ajuda no fluxo sem virar risco para o negócio',
		),
	),
);
?>
<!-- wp:group {"tagName":"section","anchor":"diagnostico","className":"dx ch ch--shallow","layout":{"type":"default"}} -->
<section id="diagnostico" class="wp-block-group dx ch ch--shallow">
<!-- wp:heading {"className":"dx__title"} -->
<h2 class="wp-block-heading dx__title">Onde seu crescimento trava?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"dx__lead"} -->
<p class="dx__lead">Escolha o sintoma mais parecido com o seu. Mostramos por onde o diagnóstico começa — e você chega ao contato com isso já preenchido.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="dx__tool">
	<fieldset class="dx__options">
		<legend class="screen-reader-text">Sintoma</legend>
		<?php foreach ( $piuba_dx as $i => $d ) : ?>
		<label class="dx__opt"><input type="radio" name="dx" value="<?php echo esc_attr( $d['id'] ); ?>" <?php checked( 0, $i ); ?>><span><?php echo esc_html( $d['sintoma'] ); ?></span></label>
		<?php endforeach; ?>
	</fieldset>
	<div class="dx__panels">
		<?php foreach ( $piuba_dx as $d ) : ?>
		<div class="dx__panel" data-dx="<?php echo esc_attr( $d['id'] ); ?>">
			<p class="dx__start">Começamos por <strong><?php echo esc_html( $d['nome'] ); ?></strong></p>
			<p class="dx__sub">No diagnóstico de 48h, olhamos:</p>
			<ul class="dx__list">
				<?php foreach ( $d['olhamos'] as $item ) : ?>
				<li><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
			<a class="btn btn--lime" href="<?php echo esc_url( '/contato/?servico=' . $d['servico'] . '&sintoma=' . rawurlencode( $d['sintoma'] . '. ' ) ); ?>#diagnostico-form">Pedir este diagnóstico <span class="btn__arrow" aria-hidden="true">→</span></a>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<!-- /wp:html -->
</section>
<!-- /wp:group -->
