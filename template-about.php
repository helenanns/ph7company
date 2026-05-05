<?php
/** Template Name: Sobre */

get_header();

$id = get_the_id();
$banner = get_post_thumbnail_id($id);

if ($banner) {
	$image_data = wp_get_attachment_image_src($banner, 'full');
	if ($image_data) {
		$image_url = $image_data[0];
	}
} else {
	$image_url = '';
}
?>

<main class="l-about l-main">

    <section class="l-about-hero">
        <picture class="image">
            <img src="<?php echo $image_url; ?>" alt="<?php get_the_title(
	$id,
); ?>" width="343" height="198">
        </picture>

        <div class="container">
            <h1>Ph7 Company</h1>
            <p>像水一样吧，朋友。</p>
        </div>
    </section>

    <section class="l-about-content">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </section>


<?php get_footer(); ?>
