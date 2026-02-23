import { toggleMenu, toggleSubmenu, toggleSearch } from './modules/header';

document.addEventListener('DOMContentLoaded', () => {
	function header() {
		toggleMenu();
		toggleSubmenu();
		toggleSearch();
	}
	header();
});
