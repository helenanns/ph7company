<?php
get_header(); ?>

<main class="l-page l-search-results">
    <div class="container">
    <h1 class="search-title">Resultados da pesquisa por: <?php echo get_search_query(); ?></h1>

    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = [
    	'post_type' => 'product',
    	'post_status' => 'publish',
    	's' => get_search_query(),
    	'paged' => $paged,
    ];
    $products_query = new WP_Query($args);
    ?>

    <?php if ($products_query->have_posts()): ?>
        <div class="m-products">
            <ul class="m-products-list">
                <?php while ($products_query->have_posts()):
                	$products_query->the_post(); ?>
                    <li><?php wc_get_template_part('content', 'product'); ?></li>
                <?php
                endwhile; ?>
            </ul>
        </div>
        <div class="pagination">
            <?php echo paginate_links([
            	'total' => $products_query->max_num_pages,
            	'current' => $paged,
            	'mid_size' => 2,
            	'prev_text' => __('Anterior', 'ph7company'),
            	'next_text' => __('Próxima', 'ph7company'),
            ]); ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <div class="no-results">
            <h2>Nenhum produto encontrado.</h2>
            <p>Tente outros termos de pesquisa.</p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
    </div>

<?php get_footer(); ?>
