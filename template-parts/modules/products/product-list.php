<?php
$block = @$args['fields'];

$is_carousel    =   (@$block['layout'] == 'carousel') ? 1 : null;
$theme          =   @$block['theme'];
$title          =   @$block['title'];
$products       =   @$block['products'];
$link           =   @$block['link'];

if ($block) :
?>

<section class="m-products --<?= $theme; ?> JS__products-slider">

    <?php if($title) : ?>
        <div class="m-products-header">
            <div class="container">
                <h2><?= $title;?></h2>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <ul class="<?php if ($is_carousel): echo 'swiper'; else: echo 'm-products-list'; endif;?>">
            <?php if ($is_carousel): 
                echo '<div class="swiper-wrapper">'; 
            endif;
            
            foreach ($products as $post) : setup_postdata($post); ?>
                <li <?php if ($is_carousel): echo 'class="swiper-slide"'; endif;?>>
                    <?php get_template_part('/template-parts/modules/products/product-card', 'product', []); ?>
                </li>
            <?php endforeach;

            if ($is_carousel): 
                echo '</div>'; 
            endif;
            wp_reset_postdata(); ?>
        </ul>

        <?php if ($is_carousel): ?>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        <?php endif; ?>
    </div>
    <?php if ($link) : 
        echo '<a href="'. $link .'" class="m-button m-products__link">' . @$block['link']['title'] . '</a>';
    endif; ?>
</section>
<?php endif; ?>
