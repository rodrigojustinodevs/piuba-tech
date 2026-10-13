<?php
/**
 * Formulário de diagnóstico: shortcode [piuba_contact], envio via
 * admin-post.php e registro de cada pedido como "Lead" no painel.
 *
 * @package piuba-tech
 */

defined( 'ABSPATH' ) || exit;

/**
 * Serviços oferecidos no campo "serviço de interesse".
 */
function piuba_services() {
	return array(
		'sites'     => 'Sites e Landing Pages',
		'sistemas'  => 'Sistemas sob medida',
		'trafego'   => 'Tráfego pago',
		'seo'       => 'SEO',
		'automacao' => 'Automação e IA aplicada',
		'nao-sei'   => 'Ainda não sei — quero o diagnóstico',
	);
}

/**
 * Leads ficam num tipo de post privado, visível só no painel.
 */
add_action(
	'init',
	function () {
		register_post_type(
			'piuba_lead',
			array(
				'labels'          => array(
					'name'          => 'Leads',
					'singular_name' => 'Lead',
					'menu_name'     => 'Leads',
					'all_items'     => 'Todos os leads',
					'edit_item'     => 'Ver lead',
				),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'menu_position'   => 25,
				'menu_icon'       => 'dashicons-email-alt',
				'supports'        => array( 'title', 'editor' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

add_filter(
	'manage_piuba_lead_posts_columns',
	function ( $cols ) {
		return array(
			'cb'            => $cols['cb'],
			'title'         => 'Nome',
			'piuba_email'   => 'E-mail',
			'piuba_servico' => 'Serviço',
			'date'          => 'Recebido em',
		);
	}
);

add_action(
	'manage_piuba_lead_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'piuba_email' === $col ) {
			$email = get_post_meta( $post_id, '_piuba_email', true );
			printf( '<a href="mailto:%1$s">%1$s</a>', esc_html( $email ) );
		}
		if ( 'piuba_servico' === $col ) {
			$services = piuba_services();
			$key      = get_post_meta( $post_id, '_piuba_servico', true );
			echo esc_html( $services[ $key ] ?? $key );
		}
	},
	10,
	2
);

/**
 * Assinatura do carimbo de tempo, para recusar envios feitos por robôs
 * em menos de 3 segundos.
 */
function piuba_form_stamp( $time ) {
	return $time . '.' . substr( wp_hash( 'piuba-lead|' . $time ), 0, 16 );
}

/**
 * Renderiza o formulário.
 */
function piuba_contact_shortcode() {
	$services = piuba_services();
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- só leitura para pré-preencher.
	$status   = isset( $_GET['enviado'] ) ? 'ok' : ( isset( $_GET['erro'] ) ? sanitize_key( $_GET['erro'] ) : '' );
	$selected = isset( $_GET['servico'] ) ? sanitize_key( $_GET['servico'] ) : '';
	$sintoma  = isset( $_GET['sintoma'] ) ? sanitize_text_field( wp_unslash( $_GET['sintoma'] ) ) : '';
	// phpcs:enable
	$messages = array(
		'ok'      => 'Recebido. Em até 48h você recebe nosso diagnóstico no e-mail informado.',
		'campos'  => 'Faltou algo: preencha nome, um e-mail válido e conte o problema em pelo menos 20 caracteres.',
		'tempo'   => 'O envio foi rápido demais para um humano. Confira os campos e envie de novo.',
		'limite'  => 'Recebemos vários envios seguidos deste endereço. Tente de novo em uma hora ou escreva direto para o e-mail abaixo.',
		'sessao'  => 'A página ficou aberta por muito tempo. Recarregue e envie de novo.',
	);

	ob_start();
	?>
	<form class="lead-form" id="diagnostico-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
		<p class="lead-form__status<?php echo 'ok' === $status ? ' is-ok' : ( $status ? ' is-error' : '' ); ?>" role="status" aria-live="polite"><?php echo isset( $messages[ $status ] ) ? esc_html( $messages[ $status ] ) : ''; ?></p>
		<?php if ( 'ok' !== $status ) : ?>
		<input type="hidden" name="action" value="piuba_lead">
		<input type="hidden" name="stamp" value="<?php echo esc_attr( piuba_form_stamp( time() ) ); ?>">
		<input type="hidden" name="back" value="<?php echo esc_url( get_permalink() ); ?>">
		<?php wp_nonce_field( 'piuba_lead', 'piuba_nonce' ); ?>
		<div class="lead-form__hp" aria-hidden="true">
			<label for="lf-website">Site</label>
			<input type="text" id="lf-website" name="website" tabindex="-1" autocomplete="off">
		</div>
		<div class="lead-form__row">
			<p class="lead-form__field">
				<label for="lf-nome">Seu nome</label>
				<input type="text" id="lf-nome" name="nome" required autocomplete="name" maxlength="120">
			</p>
			<p class="lead-form__field">
				<label for="lf-email">E-mail para o diagnóstico</label>
				<input type="email" id="lf-email" name="email" required autocomplete="email" inputmode="email" maxlength="160">
			</p>
		</div>
		<p class="lead-form__field">
			<label for="lf-servico">Serviço de interesse</label>
			<select id="lf-servico" name="servico" required>
				<?php foreach ( $services as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>"<?php selected( $selected ? $selected : 'nao-sei', $key ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p class="lead-form__field">
			<label for="lf-problema">O que trava seu crescimento hoje?</label>
			<textarea id="lf-problema" name="problema" rows="6" required minlength="20" maxlength="4000" placeholder="Ex.: investimos em anúncio, o site recebe visita, mas quase ninguém chama no WhatsApp."><?php echo esc_textarea( $sintoma ); ?></textarea>
		</p>
		<p class="lead-form__submit">
			<button type="submit" class="btn btn--lime">Quero meu diagnóstico em 48h <span class="btn__arrow" aria-hidden="true">→</span></button>
			<span class="lead-form__note">Sem compromisso. Seus dados servem só para responder este pedido.</span>
		</p>
		<?php endif; ?>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'piuba_contact', 'piuba_contact_shortcode' );

/**
 * Processa o envio.
 */
function piuba_handle_lead() {
	$back = isset( $_POST['back'] ) ? esc_url_raw( wp_unslash( $_POST['back'] ) ) : home_url( '/contato/' );
	$back = wp_validate_redirect( $back, home_url( '/contato/' ) );

	$fail = function ( $code ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'erro', $code, $back ) . '#diagnostico-form' );
		exit;
	};

	if ( ! isset( $_POST['piuba_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['piuba_nonce'] ), 'piuba_lead' ) ) {
		$fail( 'sessao' );
	}

	// Honeypot: humanos não veem este campo.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'enviado', '1', $back ) . '#diagnostico-form' );
		exit;
	}

	$stamp = isset( $_POST['stamp'] ) ? sanitize_text_field( wp_unslash( $_POST['stamp'] ) ) : '';
	$time  = (int) strtok( $stamp, '.' );
	if ( ! $time || piuba_form_stamp( $time ) !== $stamp || ( time() - $time ) < 3 ) {
		$fail( 'tempo' );
	}

	$ip_key = 'piuba_lead_' . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	$count  = (int) get_transient( $ip_key );
	if ( $count >= 5 ) {
		$fail( 'limite' );
	}

	$services = piuba_services();
	$nome     = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$servico  = isset( $_POST['servico'] ) ? sanitize_key( $_POST['servico'] ) : '';
	$problema = isset( $_POST['problema'] ) ? sanitize_textarea_field( wp_unslash( $_POST['problema'] ) ) : '';

	if ( '' === $nome || ! is_email( $email ) || ! isset( $services[ $servico ] ) || mb_strlen( $problema ) < 20 ) {
		$fail( 'campos' );
	}

	set_transient( $ip_key, $count + 1, HOUR_IN_SECONDS );

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'piuba_lead',
			'post_status'  => 'private',
			'post_title'   => $nome,
			'post_content' => $problema,
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_piuba_email', $email );
		update_post_meta( $post_id, '_piuba_servico', $servico );
	}

	$body = sprintf(
		"Novo pedido de diagnóstico\n\nNome: %s\nE-mail: %s\nServiço: %s\n\nO que trava o crescimento:\n%s\n\nVer no painel: %s",
		$nome,
		$email,
		$services[ $servico ],
		$problema,
		$post_id ? admin_url( 'post.php?post=' . $post_id . '&action=edit' ) : admin_url( 'edit.php?post_type=piuba_lead' )
	);
	wp_mail(
		get_option( 'admin_email' ),
		'[Piuba Tech] Diagnóstico: ' . $services[ $servico ] . ' — ' . $nome,
		$body,
		array( 'Reply-To: ' . $nome . ' <' . $email . '>' )
	);

	wp_safe_redirect( add_query_arg( 'enviado', '1', remove_query_arg( array( 'erro', 'servico', 'sintoma' ), $back ) ) . '#diagnostico-form' );
	exit;
}
add_action( 'admin_post_nopriv_piuba_lead', 'piuba_handle_lead' );
add_action( 'admin_post_piuba_lead', 'piuba_handle_lead' );
