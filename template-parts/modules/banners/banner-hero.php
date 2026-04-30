<?php

$banners = @$args['banners'];

if ($banners): ?>

<section class="m-banner-hero ">
    <?php get_template_part('/includes/modules/banners/hero', 'home-hero', $args); ?>

    <div class="swiper JS__hero-slider">
        <div class="swiper-wrapper">
            <?php foreach ($banners as $banner):
            	if ($banner['imagem']): ?>  
                <div class="swiper-slide">

                    <?php if ($banner['link'] && !$banner['link']['title']): ?>
                    <a href="<?= $banner['link']['url'] ?>"> 
                    <?php endif; ?>

                    <figure>
                        <picture>
                            <source media="(min-width: 1280px)" srcset="<?= $banner['imagem'][
                            	'mobile'
                            ]['url'] ?>">
                            <img data-skip-lazy src="<?= $banner['imagem']['desktop'][
                            	'url'
                            ] ?>" width="1920" height="909">
                        </picture>
                    </figure>

                    <?php if ($banner['descricao']): ?>
                        <div class="m-banner-hero-content container">
                            <span class="subtitle"><?= $banner['titulo'] ?></span>
                            <h2><?= $banner['descricao'] ?></h2>
                            
                            <?php if ($banner['link'] && $banner['link']['title']): ?>
                            <a href="<?= $banner['link']['url'] ?>" class="m-button m-button-black">
                                <?= $banner['link']['title'] ?> 
                            </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>


                    <?php if ($banner['link'] && !$banner['link']['title']): ?> 
                    </a>
                    <?php endif; ?>

                </div>
            <?php endif;
            endforeach; ?>
        </div>

        <?php if (count($banners) > 1): ?>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        <?php endif; ?>
    </div>

</section>

<?php endif; ?>
