/* eslint-disable no-unused-vars */
import Swiper, { Navigation, Thumbs } from 'swiper';

const productThumbnail = () => {
	const productThumb = new Swiper('.JS__product-thumbs .swiper', {
		modules: [Navigation],
		spaceBetween: 20,
		slidesPerView: 6,
		// watchSlidesProgress: true,
		navigation: {
			nextEl: '.JS__product-thumbs .swiper-button-next',
			prevEl: '.JS__product-thumbs .swiper-button-prev',
		},
		breakpoints: {
			1024: {
				direction: 'vertical',
			},
		},
	});

	const productSwiper = new Swiper('.JS__product-images', {
		modules: [Thumbs],
		slidesPerView: 1,
		thumbs: {
			swiper: productThumb,
		},
	});
};
export default productThumbnail;
