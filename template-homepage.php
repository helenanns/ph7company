<?php
/** Template Name: Homepage */
get_header();

$fields = function_exists('get_fields') ? get_fields(get_the_ID()) : [];
$products = $fields['products'] ?? [];
?>


<main class="l-main">

    <?php
    echo '<h1 class="hide">' . get_bloginfo('title') . ' - ' . get_bloginfo('description') . '</h1>';

    if (!empty($fields['hero'])):
        get_template_part('/template-parts/modules/banners/banner-hero', 'banner-hero', [
            'banners' => $fields['hero'],
        ]);
    endif;

    /* get_template_part('/template-parts/modules/grid-icons', ''); */


    if (have_rows('products')): $index = 0;

        while (have_rows('products')): the_row();
            $block = $products[$index];

            get_template_part('/template-parts/modules/products/product-list', '', [
                'fields' => $block,
            ]);

            $index++;
        endwhile;
    endif; 
    
    get_footer();
?> 



