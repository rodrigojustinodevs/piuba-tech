<?php
/**
 * SEO básico: meta description (do resumo da página), Open Graph e
 * JSON-LD da empresa. Sai de cena se Yoast, Rank Math ou SEOPress estiverem ativos.
 *
 * @package piuba-tech
 */

defined( 'ABSPATH' ) || exit;

function piuba_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

/**
 * Descrição da página atual: resumo da página, ou a descrição do site.
 */
function piuba_meta_description() {
	$desc = '';
	if ( is_singular() ) {
		$post = get_queried_object();
		$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 28, '…' );
	}
	if ( is_front_page() || '' === trim( $desc ) ) {
		$front = (int) get_option( 'page_on_front' );
		$desc  = $front && has_excerpt( $front ) ? get_the_excerpt( $front ) : get_bloginfo( 'description' );
	}
	return trim( preg_replace( '/\s+/', ' ', $desc ) );
}

add_action(
	'wp_head',
	function () {
		if ( piuba_seo_plugin_active() ) {
			return;
		}
		$desc  = piuba_meta_description();
		$title = wp_get_document_title();
		$url   = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
		$image = function_exists( 'piuba_image_url' ) ? piuba_image_url( 'mar', 'large' ) : '';

		if ( $desc ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		printf( '<meta property="og:type" content="%s">' . "\n", is_front_page() ? 'website' : 'article' );
		printf( '<meta property="og:locale" content="pt_BR">' . "\n" );
		printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
		if ( $desc ) {
			printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
		if ( $image ) {
			printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
		}
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

		if ( is_front_page() ) {
			$data = array(
				'@context'    => 'https://schema.org',
				'@type'       => 'ProfessionalService',
				'name'        => 'Piuba Tech',
				'url'         => home_url( '/' ),
				'description' => $desc,
				'image'       => $image,
				'areaServed'  => 'BR',
				'address'     => array(
					'@type'           => 'PostalAddress',
					'addressLocality' => 'Fortaleza',
					'addressRegion'   => 'CE',
					'addressCountry'  => 'BR',
				),
				'knowsAbout'  => array( 'Desenvolvimento de sites', 'Sistemas sob medida', 'Google Ads', 'Meta Ads', 'SEO', 'Automação', 'Inteligência artificial aplicada' ),
			);
			echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
		}
	},
	2
);
