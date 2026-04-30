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

	const productThumb = new Swiper(thumbsEl, {
		modules: [Navigation, Thumbs],
		spaceBetween: 4,
		slidesPerView: 6,
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
	});

	new Swiper(imagesEl, {
		modules: [Thumbs, EffectFade],
		slidesPerView: 1,
		speed: 300,
		autoHeight: false,
		thumbs: {
			swiper: productThumb,
		},
		breakpoints: {
			1024: {
				effect: 'fade',
				fadeEffect: {
					crossFade: true,
				},
			},
		},
	});
};

export default productThumbnail;
