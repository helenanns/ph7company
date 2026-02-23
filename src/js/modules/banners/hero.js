/* eslint-disable no-unused-vars */
import Swiper, { Navigation, Pagination, Autoplay, EffectFade } from 'swiper';

const heroSlider = () => {
	const heroSwiper = new Swiper('.JS__hero-slider', {
		// eslint-disable-line no-unused-vars
		modules: [Navigation, Pagination, Autoplay, EffectFade],
		autoplay: {
			delay: 30000,
		},
		loop: false,
		speed: 800,
		effect: 'fade',
		fadeEffect: {
			crossFade: true,
		},
		slidesPerView: 1,
		pagination: {
			el: '.JS__hero-slider .swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.JS__hero-slider .swiper-button-next',
			prevEl: '.JS__hero-slider .swiper-button-prev',
		},
	});
};
export default heroSlider;
