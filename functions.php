<?php
/**
 * Piuba Tech — funções do tema.
 *
 * @package piuba-tech
 */

defined( 'ABSPATH' ) || exit;

define( 'PIUBA_VERSION', '1.0.0' );

require_once get_theme_file_path( 'inc/media.php' );
require_once get_theme_file_path( 'inc/fragments.php' );
require_once get_theme_file_path( 'inc/lead-form.php' );
require_once get_theme_file_path( 'inc/seo.php' );
require_once get_theme_file_path( 'inc/setup.php' );

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/site.css' );
		add_post_type_support( 'page', 'excerpt' );
		remove_theme_support( 'core-block-patterns' );
	}
);

/**
 * CSS e JS do site. Um arquivo de cada, sem dependências.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'piuba-site', get_theme_file_uri( 'assets/css/site.css' ), array(), PIUBA_VERSION . '.' . filemtime( get_theme_file_path( 'assets/css/site.css' ) ) );
		wp_enqueue_script(
			'piuba-motion',
			get_theme_file_uri( 'assets/js/motion.js' ),
			array(),
			PIUBA_VERSION . '.' . filemtime( get_theme_file_path( 'assets/js/motion.js' ) ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
);

/**
 * Marca o documento como "com JS" antes da pintura, para que os estados
 * iniciais das animações só existam quando o script vai rodar.
 * Também pré-carrega as duas fontes.
 */
add_action(
	'wp_head',
	function () {
		echo "<script>document.documentElement.classList.add('js')</script>\n";
		foreach ( array( 'space-grotesk', 'inter' ) as $font ) {
			printf(
				'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
				esc_url( get_theme_file_uri( "assets/fonts/{$font}.woff2" ) )
			);
		}
	},
	1
);

/* Menos peso no front-end. */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/** Gera as miniaturas em WebP: arquivos bem menores para 3G/4G. */
add_filter(
	'image_editor_output_format',
	function ( $formats ) {
		$formats['image/jpeg'] = 'image/webp';
		return $formats;
	}
);

/** Categoria própria para os padrões do tema. */
add_action(
	'init',
	function () {
		register_block_pattern_category( 'piuba-tech', array( 'label' => 'Piuba Tech' ) );
		register_block_style(
			'core/button',
			array(
				'name'  => 'graphite',
				'label' => 'Grafite',
			)
		);
	}
);

/** Só a primeira imagem (o mar da abertura) carrega sem lazy load. */
add_filter(
	'wp_omit_loading_attr_threshold',
	function () {
		return 1;
	}
);
