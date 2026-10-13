<?php
/**
 * Montagem inicial do site na ativação do tema: importa as imagens, cria as
 * cinco páginas a partir dos padrões, define a página inicial e os links
 * permanentes. Páginas que já existem não são tocadas.
 *
 * Para recriar o conteúdo de uma página, apague-a e reative o tema
 * (ou rode: wp eval 'piuba_setup_site();').
 *
 * @package piuba-tech
 */

defined( 'ABSPATH' ) || exit;

/**
 * Páginas do site: slug => título, resumo (meta description) e padrões.
 */
function piuba_pages() {
	return array(
		'inicio'   => array(
			'title'    => 'Início',
			'excerpt'  => 'Piuba Tech: sites, sistemas sob medida, tráfego pago, SEO e automação com IA numa operação só. Agência de Fortaleza com diagnóstico em 48h.',
			'patterns' => array( 'home-hero', 'home-stats', 'home-diagnostico', 'home-servicos', 'home-processo', 'home-cases', 'home-sobre', 'cta' ),
		),
		'servicos' => array(
			'title'    => 'Serviços',
			'excerpt'  => 'Sites e landing pages, sistemas sob medida, tráfego pago (Google e Meta Ads), SEO e automação com IA: o que está incluso e para quem cada serviço é indicado.',
			'patterns' => array( 'servicos-page', 'cta' ),
		),
		'cases'    => array(
			'title'    => 'Cases',
			'excerpt'  => 'Três projetos contados por dentro: SaaS multi-tenant para aquicultura, checkout pelo WhatsApp para e-commerce e Instagram no WordPress sem plugin pesado.',
			'patterns' => array( 'cases-page', 'cta' ),
		),
		'sobre'    => array(
			'title'    => 'Sobre',
			'excerpt'  => 'A Piuba Tech nasceu em Fortaleza da ideia de juntar engenharia sênior e marketing de performance numa operação só, sem repasse entre fornecedores.',
			'patterns' => array( 'sobre-page', 'cta' ),
		),
		'contato'  => array(
			'title'    => 'Contato',
			'excerpt'  => 'Me conta o que trava o crescimento do seu negócio. Você recebe um diagnóstico em até 48h, sem compromisso.',
			'patterns' => array( 'contato-page' ),
		),
	);
}

/**
 * Conteúdo de um padrão do tema (o arquivo PHP é executado, então
 * as imagens já saem com o ID da biblioteca de mídia).
 */
function piuba_pattern_markup( $slug ) {
	$file = get_theme_file_path( "patterns/{$slug}.php" );
	if ( ! file_exists( $file ) ) {
		return '';
	}
	ob_start();
	include $file;
	return trim( ob_get_clean() );
}

/**
 * Cria o que falta. Com $force = true, reescreve o conteúdo das páginas do tema.
 */
function piuba_setup_site( $force = false ) {
	piuba_import_images();

	$ids = array();
	foreach ( piuba_pages() as $slug => $page ) {
		$content = implode( "\n\n", array_map( 'piuba_pattern_markup', $page['patterns'] ) );
		$found   = get_page_by_path( $slug );

		if ( $found && ! $force ) {
			$ids[ $slug ] = $found->ID;
			continue;
		}

		$data = array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => $page['title'],
			'post_excerpt' => $page['excerpt'],
			'post_content' => $content,
		);
		if ( $found ) {
			$data['ID'] = $found->ID;
		}
		// O conteúdo já é marcação de blocos confiável, vinda do próprio tema.
		kses_remove_filters();
		$ids[ $slug ] = wp_insert_post( wp_slash( $data ) );
		kses_init_filters();
	}

	if ( ! empty( $ids['inicio'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['inicio'] );
	}

	if ( '' === get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
	if ( in_array( get_option( 'blogdescription' ), array( '', 'Just another WordPress site', 'Só mais um site WordPress' ), true ) ) {
		update_option( 'blogdescription', 'Tecnologia e marketing que fazem seu negócio crescer de verdade.' );
	}
	flush_rewrite_rules();

	return $ids;
}
add_action( 'after_switch_theme', 'piuba_setup_site' );
