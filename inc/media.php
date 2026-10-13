<?php
/**
 * Imagens do tema: importação para a biblioteca de mídia (para o WordPress
 * gerar srcset, WebP e lazy load) e o bloco de imagem usado nos padrões.
 *
 * Todas são fotos e gravuras de acervos abertos, mostrando o mundo ao redor
 * da marca (Fortaleza, o mar, a aquicultura). Nenhuma é apresentada como foto
 * de cliente, equipe ou produto. Os créditos aparecem no rodapé.
 *
 * @package piuba-tech
 */

defined( 'ABSPATH' ) || exit;

/**
 * Catálogo das imagens: arquivo, texto alternativo e crédito.
 */
function piuba_images() {
	return array(
		'mar'      => array(
			'file'    => 'mar-iracema.jpg',
			'alt'     => 'Mar verde de Fortaleza sob um céu claro, com uma jangada de vela amarela no horizonte',
			'title'   => 'Jangada na Praia de Iracema',
			'credit'  => 'Luciano Viana, CC BY 2.0',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Jangada_na_Praia_de_Iracema.jpg',
		),
		'mucuripe' => array(
			'file'    => 'mucuripe.jpg',
			'alt'     => 'Fim de tarde no Mucuripe, em Fortaleza: jangadas na areia e os prédios da orla ao fundo',
			'title'   => 'Mucuripe - Fortaleza',
			'credit'  => 'Otávio Nogueira, CC BY 2.0',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Mucuripe_-_Fortaleza_(2701771665).jpg',
		),
		'piaba'    => array(
			'file'    => 'piaba-1859.jpg',
			'alt'     => 'Gravura científica de 1859 de um Astyanax, peixe da família das piabas, desenhado de perfil',
			'title'   => 'Astyanax argentatus illustration (1859)',
			'credit'  => 'domínio público',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Astyanax_argentatus_illustration_(1859).jpg',
		),
		'tanques'  => array(
			'file'    => 'viveiro-tanques.jpg',
			'alt'     => 'Tanques-rede de aquicultura flutuando em um rio cercado de mata',
			'title'   => 'Tiang Sabah Fish-aquaculture-01',
			'credit'  => 'CEphoto, Uwe Aranas, CC BY-SA 3.0',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Tiang_Sabah_Fish-aquaculture-01.jpg',
		),
		'lagoa'    => array(
			'file'    => 'viveiro-lagoa.jpg',
			'alt'     => 'Viveiro escavado de criação de peixes, com água parada e margens de grama',
			'title'   => 'Fish pond at Aquaculture Research and Development Centre, Kajjansi',
			'credit'  => 'Faintsmoke, CC BY-SA 4.0',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Fish_pond_at_Aquaculture_Research_and_Development_Centre,_Kajjansi.JPG',
		),
		'calcadao' => array(
			'file'    => 'calcadao.jpg',
			'alt'     => 'Calçadão arborizado na orla de Fortaleza',
			'title'   => 'Calçadão na orla da praia - Fortaleza',
			'credit'  => 'RonaldoMorais, CC BY-SA 4.0',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Cal%C3%A7ad%C3%A3o_na_orla_da_praia-_Fortaleza.jpg',
		),
		'beiramar' => array(
			'file'    => 'beira-mar.jpg',
			'alt'     => 'Ciclofaixa vermelha da Avenida Beira Mar, no Meireles, entre coqueiros e prédios',
			'title'   => 'Avenida Beira Mar, Meireles, Fortaleza',
			'credit'  => 'Fronteira, CC BY-SA 4.0',
			'source'  => 'https://commons.wikimedia.org/wiki/File:Avenida_Beira_Mar,_Meireles,_Fortaleza,_setembro_de_2023_(1).jpg',
		),
	);
}

/**
 * Importa as imagens do tema para a biblioteca de mídia (uma vez).
 *
 * @return array<string,int> chave => ID do anexo.
 */
function piuba_import_images() {
	$ids = get_option( 'piuba_media', array() );

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	foreach ( piuba_images() as $key => $img ) {
		if ( ! empty( $ids[ $key ] ) && get_post( $ids[ $key ] ) ) {
			continue;
		}
		$tmp = wp_tempnam( $img['file'] );
		copy( get_theme_file_path( 'assets/img/' . $img['file'] ), $tmp );
		$id = media_handle_sideload(
			array(
				'name'     => $img['file'],
				'tmp_name' => $tmp,
			),
			0,
			$img['title'],
			array( 'post_excerpt' => 'Foto: ' . $img['credit'] )
		);
		if ( is_wp_error( $id ) ) {
			@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
			continue;
		}
		update_post_meta( $id, '_wp_attachment_image_alt', $img['alt'] );
		$ids[ $key ] = $id;
	}

	update_option( 'piuba_media', $ids, false );
	return $ids;
}

/**
 * ID do anexo de uma imagem do tema, ou 0 se ainda não foi importada.
 */
function piuba_image_id( $key ) {
	$ids = get_option( 'piuba_media', array() );
	return ! empty( $ids[ $key ] ) ? (int) $ids[ $key ] : 0;
}

/**
 * URL de uma imagem do tema, preferindo a cópia da biblioteca.
 */
function piuba_image_url( $key, $size = 'large' ) {
	$id = piuba_image_id( $key );
	if ( $id ) {
		$url = wp_get_attachment_image_url( $id, $size );
		if ( $url ) {
			return $url;
		}
	}
	$images = piuba_images();
	return get_theme_file_uri( 'assets/img/' . $images[ $key ]['file'] );
}

/**
 * Marcação de um bloco core/image para uso nos padrões.
 *
 * @param string $key   Chave em piuba_images().
 * @param string $class Classes extras do bloco.
 * @param string $size  Tamanho registrado.
 * @param string $alt     Texto alternativo (padrão: o do catálogo).
 * @param string $caption Legenda opcional.
 */
function piuba_image_block( $key, $class = '', $size = 'large', $alt = null, $caption = '' ) {
	$images = piuba_images();
	$alt    = null === $alt ? $images[ $key ]['alt'] : $alt;
	$id     = piuba_image_id( $key );
	$attrs  = array(
		'sizeSlug'        => $size,
		'linkDestination' => 'none',
	);
	if ( $id ) {
		$attrs = array( 'id' => $id ) + $attrs;
	}
	if ( $class ) {
		$attrs['className'] = $class;
	}
	$img_class = $id ? ' class="wp-image-' . $id . '"' : '';

	return sprintf(
		'<!-- wp:image %1$s --><figure class="wp-block-image size-%2$s%3$s"><img src="%4$s" alt="%5$s"%6$s/>%7$s</figure><!-- /wp:image -->',
		wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES ),
		esc_attr( $size ),
		$class ? ' ' . esc_attr( $class ) : '',
		esc_url( piuba_image_url( $key, $size ) ),
		esc_attr( $alt ),
		$img_class,
		$caption ? '<figcaption class="wp-element-caption">' . esc_html( $caption ) . '</figcaption>' : ''
	);
}

/**
 * Linha de créditos das imagens, para o rodapé.
 */
function piuba_credits_html() {
	$parts = array();
	foreach ( piuba_images() as $img ) {
		$parts[] = sprintf(
			'<a href="%s" rel="nofollow noopener">%s</a> (%s)',
			esc_url( $img['source'] ),
			esc_html( $img['title'] ),
			esc_html( $img['credit'] )
		);
	}
	return 'Imagens de acervos abertos, via Wikimedia Commons: ' . implode( '; ', $parts ) . '.';
}
add_shortcode( 'piuba_credits', 'piuba_credits_html' );
