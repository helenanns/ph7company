<?php
    $id = @$args['id'];
    $banner = get_post_thumbnail_id($id);

    if ($banner) {
        $image_data = wp_get_attachment_image_src($banner, 'full');
        if ($image_data) {
            $image_url = $image_data[0];
        }
    } else {
        $image_url = '';
    }

    $video_type = get_field('video_type', $id);
    $video = $video_type === 'mp4' ? get_field('mp4', $id) : get_field('video_id', $id);
?>

<section class="m-page-banner">
    <div class="container">
        <?php get_template_part('/template-parts/modules/breadcrumb', '', ['post_id' => $id]); ?>
        <h1><?php the_title();?></h1>
    </div>
</section>

<?php if ( $image_url || $video ) : ?>
    <section class="m-single-banner-thumbnail">
        <?php if($video) : ?>
            <div class="m-single-banner-thumbnail__figure video">
                <?php make_video($video_type, $video, $image_url); ?>
            </div>
        <?php elseif ($image_url): ?>
            <picture class="m-single-banner-thumbnail__figure">
                <img src="<?php echo $image_url; ?>" alt="<?php get_the_title($id); ?>" width="343" height="198">
            </picture>
        <?php endif;?>
    </section>
<?php endif;?>