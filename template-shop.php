<?php

/** Template Name: Loja WooCommerce */
get_header();

$fields = get_fields();


$content = @$fields['content'];
?>


<main class="l-main">

    <h1 class="hide"><?= get_bloginfo('title') . ' - ' . get_bloginfo('description'); ?></h1>

    <?php
        // Loop do WooCommerce para exibir produtos
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                wc_get_template_part( 'content', 'product' );
            }
        }
        ?>

<?php get_footer();?>   