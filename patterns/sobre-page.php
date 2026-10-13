<?php
/**
 * Title: Página — Sobre
 * Slug: piuba-tech/sobre-page
 * Categories: piuba-tech
 * Description: A história, o fundador, o porquê do nome e o jeito de trabalhar.
 */
?>
<!-- wp:group {"tagName":"section","className":"page-intro ch ch--graphite","layout":{"type":"default"}} -->
<section class="wp-block-group page-intro ch ch--graphite">
<!-- wp:heading {"level":1,"className":"page-intro__title"} -->
<h1 class="wp-block-heading page-intro__title">Quem vende é quem constrói</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"page-intro__lead"} -->
<p class="page-intro__lead">Nascemos em Fortaleza de um incômodo: um fornecedor para o site, outro para o anúncio, outro para o sistema — e ninguém respondendo pelo resultado.</p>
<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"bio ch ch--abyss","layout":{"type":"default"}} -->
<section class="wp-block-group bio ch ch--abyss">
<!-- wp:group {"className":"bio__text","layout":{"type":"default"}} -->
<div class="wp-block-group bio__text">
<!-- wp:heading {"className":"bio__title"} -->
<h2 class="wp-block-heading bio__title">Sete anos em produção</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>O fundador é desenvolvedor full-stack sênior, com mais de sete anos construindo software que roda de verdade, com usuário, dinheiro e prazo do outro lado. Hoje presta serviço para uma fintech, onde segurança, auditoria e disponibilidade são o dia a dia.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Em paralelo, mantém dois produtos próprios no ar: um SaaS de gestão para aquicultura e uma operação de e-commerce. Ter produto próprio muda a régua. Cada escolha de tecnologia e cada real de mídia é medido pelo que faz no caixa — e é essa régua que a Piuba Tech leva para os clientes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Daí a tese da empresa: tecnologia e marketing não são dois fornecedores. São uma operação só, com um responsável só.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<?php echo piuba_image_block( 'mucuripe', 'bio__photo', 'large', null, 'Mucuripe, Fortaleza — a cidade de onde a Piuba Tech opera.' ); // phpcs:ignore ?>

<!-- wp:group {"className":"bio__strip","layout":{"type":"default"}} -->
<div class="wp-block-group bio__strip">
<?php echo piuba_image_block( 'beiramar', 'bio__thumb', 'medium_large' ); // phpcs:ignore ?>
<?php echo piuba_image_block( 'calcadao', 'bio__thumb', 'medium_large' ); // phpcs:ignore ?>
<?php echo piuba_image_block( 'mar', 'bio__thumb', 'medium_large', null, 'Fortaleza: Beira Mar, o calçadão da orla e a Praia de Iracema.' ); // phpcs:ignore ?>
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"name ch ch--mist","layout":{"type":"default"}} -->
<section class="wp-block-group name ch ch--mist">
<!-- wp:heading {"className":"name__title"} -->
<h2 class="wp-block-heading name__title">Por que Piuba</h2>
<!-- /wp:heading -->

<?php echo piuba_image_block( 'piaba', 'name__plate', 'full', null, 'Astyanax, parente das piabas. Gravura científica de 1859, domínio público.' ); // phpcs:ignore ?>

<!-- wp:paragraph {"className":"name__text"} -->
<p class="name__text">O nome vem do peixe e da aquicultura, o mundo de um dos nossos produtos. Ficou como lembrete: crescer exige manejo, medição e paciência — não mágica.</p>
<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"ways ch ch--tide","layout":{"type":"default"}} -->
<section class="wp-block-group ways ch ch--tide">
<!-- wp:heading {"className":"ways__title"} -->
<h2 class="wp-block-heading ways__title">Como trabalhamos</h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"ways__list"} -->
<ul class="wp-block-list ways__list"><!-- wp:list-item -->
<li><strong>Diagnóstico antes de proposta.</strong> Em até 48h você sabe o que atacar primeiro, mesmo que decida não contratar.</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li><strong>Uma equipe do código à campanha.</strong> Quem mexe no site entende do anúncio, e vice-versa.</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li><strong>Métrica combinada no início.</strong> Antes de começar, fica escrito o número que vai dizer se deu certo.</li>
<!-- /wp:list-item --><!-- wp:list-item -->
<li><strong>O que é seu fica no seu nome.</strong> Código, domínio e contas de anúncio pertencem ao cliente.</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
</section>
<!-- /wp:group -->
