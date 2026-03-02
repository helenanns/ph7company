<?php get_header(); ?>

<main class="l-page l-main">

    <section class="l-page-wrapper">
        <div class="container">

            <div class="l-page-header">
                <h1><?php the_title();?></h1>
            </div>

            <?php the_content();?>
        </div>

    </section>


<?php get_footer(); ?>
