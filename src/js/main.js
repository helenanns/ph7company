import 'normalize.css';
import 'swiper/css';
import '../scss/main.scss';
import { toggleMenu, toggleSubmenu, toggleSearch } from './modules/header';
import { toggleFooter } from './modules/footer';
// import TooltipSystem from './tooltip';

// new TooltipSystem();

document.addEventListener('DOMContentLoaded', () => {
	function header() {
		toggleMenu();
		toggleSubmenu();
		toggleSearch();
		toggleFooter();
	}
	header();
});

document.addEventListener('mouseover', e => {
	const img = e.target.closest('.m-card-product')?.querySelector('.m-card__img-hover');

	if (img && !img.src) {
		img.src = img.dataset.src;
	}
});
