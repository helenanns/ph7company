// import 'normalize.css'
// import 'swiper/css'
// import 'select2/dist/css/select2.css'
import '../scss/main.scss';
import { toggleMenu, toggleSubmenu, toggleSearch } from './modules/header';

document.addEventListener('DOMContentLoaded', () => {
	function header() {
		toggleMenu();
		toggleSubmenu();
		toggleSearch();
	}
	header();
});
