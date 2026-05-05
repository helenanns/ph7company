export function initProductAccordion() {
	const accordion = document.querySelector('.ph7-accordion');
	if (!accordion) return;

	accordion.addEventListener('click', e => {
		const trigger = e.target.closest('.ph7-accordion__trigger');
		if (!trigger) return;

		const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
		const panelId = trigger.getAttribute('aria-controls');
		const panel = document.getElementById(panelId);
		if (!panel) return;

		accordion.querySelectorAll('.ph7-accordion__trigger').forEach(t => {
			if (t !== trigger) {
				t.setAttribute('aria-expanded', 'false');
				const p = document.getElementById(t.getAttribute('aria-controls'));
				if (p) collapsePanel(p);
			}
		});

		if (isExpanded) {
			trigger.setAttribute('aria-expanded', 'false');
			collapsePanel(panel);
		} else {
			trigger.setAttribute('aria-expanded', 'true');
			expandPanel(panel);
		}
	});
}

function expandPanel(panel) {
	panel.removeAttribute('hidden');
	panel.style.height = '0';
	requestAnimationFrame(() => {
		panel.style.transition = 'height 0.3s ease';
		panel.style.height = panel.scrollHeight + 'px';
		panel.addEventListener(
			'transitionend',
			() => {
				panel.style.height = '';
			},
			{ once: true }
		);
	});
}

function collapsePanel(panel) {
	panel.style.height = panel.scrollHeight + 'px';
	requestAnimationFrame(() => {
		panel.style.transition = 'height 0.3s ease';
		panel.style.height = '0';
		panel.addEventListener(
			'transitionend',
			() => {
				panel.setAttribute('hidden', '');
				panel.style.height = '';
			},
			{ once: true }
		);
	});
}
