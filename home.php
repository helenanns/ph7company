<?php
get_header();

$id = get_option('page_for_posts');
$fields = get_fields($id);
?>

<main class="l-page l-main">

    <?php
    // if (!empty($fields['hero'])):
    //     get_template_part('/template-parts/modules/banners/banner-hero', 'banner-hero', [
    //         'banners' => $fields['hero'],
    //     ]);
    // endif;

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = [
    	'posts_per_page' => 9,
    	'paged' => $paged,
    ];
    $recent_posts_query = new WP_Query($args);
    $big = 999999999;

    if ($recent_posts_query->have_posts()):

    	$recent_posts = $recent_posts_query->posts;
    	get_template_part('/template-parts/modules/news', '', [
    		'news' => $recent_posts,
    		'title' => get_the_title($id),
    	]);
    	?>
    
        <section class="m-pagination">
            <?php echo paginate_links([
            	'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            	'format' => '?paged=%#%',
            	'current' => max(1, $paged),
            	'total' => $recent_posts_query->max_num_pages,
            	'next_text' => ' &raquo;',
            	'prev_text' => '&laquo; ',
            ]); ?>
        </section>

    <?php
    endif;

    wp_reset_postdata();

    get_footer();
     ?>
