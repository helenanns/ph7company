const toggleMenu = () => {
	const menu = document.querySelector('.JS__header-menu');
	const btnOpenMenu = document.querySelector('.JS__toggle-menu');
	const header = document.querySelector('.m-header');

	const closeMenu = () => {
		if (menu.style.display === 'block') {
			menu.style.opacity = '0';
			btnOpenMenu.classList.remove('active');
			header.classList.remove('active');
			setTimeout(() => {
				menu.style.display = 'none';
			}, 300);
		}
	};

	btnOpenMenu.addEventListener('click', () => {
		if (menu.style.display === 'block') {
			closeMenu();
		} else {
			menu.style.display = 'block';
			btnOpenMenu.classList.add('active');
			header.classList.add('active');
			setTimeout(() => {
				menu.style.opacity = '1';
			}, 10);
		}
	});

	const menuItems = document.querySelectorAll('.menu-item a');
	menuItems.forEach(menuItem => {
		menuItem.addEventListener('click', () => {
			closeMenu();
		});
	});
};

const toggleSubmenu = () => {
	const hasChildren = document.querySelectorAll('.menu-item-has-children');

	hasChildren.forEach(item => {
		const link = item.querySelector('a');

		const span = document.createElement('span');
		span.innerHTML = link.innerHTML;
		span.className = link.className;
		link.parentNode.replaceChild(span, link);

		item.addEventListener('click', () => {
			item.classList.toggle('is-active');
		});
	});
};

const toggleSearch = () => {
	const openSearch = document.querySelector('.JS__header-openSearch');
	const closeSearch = document.querySelector('.m-search-close');
	const search = document.querySelector('.JS__header-search');

	openSearch.addEventListener('click', () => {
		search.classList.add('is-active');
	});

	closeSearch.addEventListener('click', () => {
		search.classList.remove('is-active');
	});
};

export { toggleMenu, toggleSubmenu, toggleSearch };
