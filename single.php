<?php
$id = get_the_id();
get_header();
?>

<main class="l-single l-main">

    <?php get_template_part('/template-parts/modules/banners/banner-single', '', ['id' => $id]); ?>

    <section class="l-page-wrapper">
        <div class="container">
            <?php the_content(); ?>
            <?php get_template_part('/template-parts/modules/share', '', ['id' => $id]); ?>
        </div>
    </section>

<?php get_footer(); ?>
