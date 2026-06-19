<?php
$news = @$args['news'];
$title = @$args['title'];
?>
<section class="m-news">
    <div class="container">

        <div class="m-news-header">
            <h2><?= $title ?></h2>
        </div>
            
        <ul class="m-news-list">
            <?php
            foreach ($news as $post):
            	setup_postdata($post); ?>
                <li>
                    <?php get_template_part('/template-parts/modules/news/news-card', 'new', []); ?>
                </li>   
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
        </ul>

        <?php if (!is_home()): ?>
        <a href="<?php echo home_url(
        	'/novidades',
        ); ?>" class="m-button m-news__link"> Ir para o blog</a>
        <?php endif; ?>
    </div>
</section>