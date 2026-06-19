<?php
/**
 * Template for displaying book archive
 */
get_header(); ?>

<main class="l-page book-archive">
    <div class="container">
        <h1 class="archive-title">Books</h1>

        <?php if (have_posts()): ?>
            <div class="book-list">
                <?php while (have_posts()):
                	the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('book-item'); ?>>
                        <a href="<?php the_permalink(); ?>" class="book-thumb">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php endif; ?>
                        </a>
                        <div class="book-content">
                            <h2 class="book-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php if (has_excerpt()): ?>
                                <div class="book-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php
                endwhile; ?>
            </div>
            <div class="pagination">
                <?php the_posts_pagination([
                	'mid_size' => 2,
                	'prev_text' => __('Previous', 'ph7company'),
                	'next_text' => __('Next', 'ph7company'),
                ]); ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <h2>No books found.</h2>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
