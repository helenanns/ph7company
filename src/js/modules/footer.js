const toggleFooter = () => {
	document.querySelectorAll('.m-footer-item .title').forEach(title => {
		title.addEventListener('click', function () {
			const item = this.closest('.m-footer-item');
			const wrapper = item.querySelector('.m-footer-menuWrapper');

			if (item.classList.contains('active')) {
				wrapper.style.maxHeight = null;
				item.classList.remove('active');
			} else {
				wrapper.style.maxHeight = wrapper.scrollHeight + 'px';
				item.classList.add('active');
			}
		});
	});
};

export { toggleFooter };
