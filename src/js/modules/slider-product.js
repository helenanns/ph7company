import Swiper, { Navigation, Pagination } from 'swiper';

const productSliders = () => {
	let i = 1;
	const str = 'JS__products-slider-';

	const sliders = document.querySelectorAll('.JS__products-slider');

	sliders.forEach(e => {
		const classAdd = str + i;

		e.classList.add(classAdd);

		// eslint-disable-next-line no-unused-vars
		const slider = new Swiper(`.${classAdd} .swiper`, {
			modules: [Navigation, Pagination],
			slidesPerView: 2,
			spaceBetween: 20,
			breakpoints: {
				1024: {
					slidesPerView: 4,
					slidesPerGroup: 1,
					spaceBetween: 26,
				},
			},
			navigation: {
				nextEl: `.${classAdd} .swiper-button-next`,
				prevEl: `.${classAdd} .swiper-button-prev`,
			},
		});

		i += 1;
	});
};
export default productSliders;
