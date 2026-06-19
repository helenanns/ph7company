<article class="m-card-news">
    <a href="<?php the_permalink(); ?>">
        <picture class="m-card-news__image">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        </picture>
        <div class="m-card-news__content">
            <h3><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
        </div>
    </a>
</article>