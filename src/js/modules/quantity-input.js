export default function quantityInput() {
	document.addEventListener('click', e => {
		const minus = e.target.closest('.qty-btn--minus');
		const plus = e.target.closest('.qty-btn--plus');

		if (!minus && !plus) return;

		const wrapper = e.target.closest('.quantity');
		if (!wrapper) return;

		const input = wrapper.querySelector('input.qty');
		if (!input || input.disabled || input.readOnly) return;

		const min = input.min !== '' ? parseFloat(input.min) : 0;
		const max = input.max !== '' ? parseFloat(input.max) : Infinity;
		const step = input.step !== '' ? parseFloat(input.step) : 1;

		let value = input.value !== '' ? parseFloat(input.value) : min;

		if (plus) value = Math.min(max, value + step);
		if (minus) value = Math.max(min, value - step);

		// evita bug float
		value = Math.round(value * 100000) / 100000;

		input.value = value;
		input.dispatchEvent(new Event('change', { bubbles: true }));
	});
}
