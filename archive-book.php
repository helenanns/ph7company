<?php
/**
 * Template for displaying book archive
 */
get_header(); ?>

<main class="l-page book-archive">
	<div class="container">
		<header class="book-archive__header">
			<p class="book-archive__eyebrow">Archive</p>
			<h1 class="archive-title">Book</h1>
			<p class="book-archive__description">
				Coleções anteriores com looks, inspirações e peças marcantes da nossa história.
			</p>
		</header>

		<?php if (have_posts()): ?>
			<div class="book-archive__grid">
				<?php while (have_posts()):
    	the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('book-card'); ?>>
						<a href="<?php the_permalink(); ?>" class="book-card__link">
							<div class="book-card__media">
								<?php if (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('large', ['class' => 'book-card__image']); ?>
								<?php endif; ?>
							</div>

							<div class="book-card__content">
								<span class="book-card__meta">Collection</span>
								<h2 class="book-card__title"><?php the_title(); ?></h2>
								<?php if (has_excerpt()): ?>
									<p class="book-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
								<?php endif; ?>
							</div>
						</a>
					</article>
				<?php
    endwhile; ?>
			</div>

			<div class="book-archive__pagination">
				<?php the_posts_pagination([
    	'mid_size' => 2,
    	'prev_text' => __('Previous', 'ph7company'),
    	'next_text' => __('Next', 'ph7company'),
    ]); ?>
			</div>
		<?php else: ?>
			<div class="book-archive__empty">
				<h2>Nenhuma coleção encontrada.</h2>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
