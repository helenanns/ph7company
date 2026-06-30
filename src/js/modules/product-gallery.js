/* eslint-disable no-unused-vars */
import Swiper, { Navigation, Thumbs, EffectFade } from 'swiper';

import 'swiper/css';
// import 'swiper/css/navigation';
import 'swiper/css/effect-fade';

const productThumbnail = () => {
	const thumbsEl = document.querySelector('.JS__product-thumbs');
	const imagesEl = document.querySelector('.JS__product-images');

	if (!thumbsEl || !imagesEl) {
		return;
	}

	const swiperConfig = {
		thumbs: {
			spaceBetween: 8,
			slidesPerView: 'auto',
			watchSlidesProgress: true,
			navigation: {
				nextEl: '.JS__product-thumbs-next',
				prevEl: '.JS__product-thumbs-prev',
			},
			breakpoints: {
				1024: {
					direction: 'vertical',
				},
			},
		},
		images: {
			slidesPerView: 1,
			speed: 300,
			autoHeight: false,
			breakpoints: {
				1024: {
					effect: 'fade',
					fadeEffect: {
						crossFade: true,
					},
				},
			},
		},
	};

	let productThumb;
	let productImages;

	const initSwipers = () => {
		productThumb = new Swiper(thumbsEl, {
			modules: [Navigation, Thumbs],
			...swiperConfig.thumbs,
		});

		productImages = new Swiper(imagesEl, {
			modules: [Thumbs, EffectFade],
			...swiperConfig.images,
			thumbs: {
				swiper: productThumb,
			},
		});
	};

	const destroySwipers = () => {
		if (productImages) productImages.destroy(true, false);
		if (productThumb) productThumb.destroy(true, false);
	};

	initSwipers();

	// ----- Troca de galeria por variação -----

	const buildMainSlide = img => `
		<div class="swiper-slide" data-large="${img.full}">
			<img src="${img.thumb}" alt="" />
		</div>
	`;

	const buildThumbSlide = img => `
		<div class="swiper-slide">
			<img src="${img.mini}" alt="" />
		</div>
	`;

	const originalImagesHTML = imagesEl.querySelector('.swiper-wrapper').innerHTML;
	const originalThumbsHTML = thumbsEl.querySelector('.swiper-wrapper').innerHTML;

	const rebuildGalleries = images => {
		destroySwipers();

		imagesEl.querySelector('.swiper-wrapper').innerHTML = images.map(buildMainSlide).join('');

		thumbsEl.querySelector('.swiper-wrapper').innerHTML = images.map(buildThumbSlide).join('');

		initSwipers();
	};

	const restoreOriginalGalleries = () => {
		destroySwipers();

		imagesEl.querySelector('.swiper-wrapper').innerHTML = originalImagesHTML;
		thumbsEl.querySelector('.swiper-wrapper').innerHTML = originalThumbsHTML;

		initSwipers();
	};

	// ----- Atualização da URL com o atributo escolhido -----

	const updateUrl = $form => {
		const params = new URLSearchParams(window.location.search);

		$form.find('select[name^="attribute_"], input[name^="attribute_"]:checked').each(function () {
			const name = jQuery(this).attr('name');
			const value = jQuery(this).val();
			value ? params.set(name, value) : params.delete(name);
		});

		const query = params.toString();
		const newUrl = window.location.pathname + (query ? `?${query}` : '');
		window.history.replaceState(null, '', newUrl);
	};

	// ----- Eventos do WooCommerce (precisam de jQuery) -----

	if (window.jQuery) {
		const $ = window.jQuery;
		const $form = $('.variations_form');

		$form.on('found_variation', (e, variation) => {
			if (variation.custom_gallery && variation.custom_gallery.length) {
				rebuildGalleries(variation.custom_gallery);
			}
			updateUrl($form);
		});

		$form.on('reset_data', () => {
			restoreOriginalGalleries();
			updateUrl($form);
		});
	}
};

export default productThumbnail;
