import '../scss/single-product.scss';
import productThumbnail from './modules/product-gallery';
import quantityInput from './modules/quantity-input';
import { initProductAccordion } from './modules/product-accordion';

document.addEventListener('DOMContentLoaded', () => {
	productThumbnail();
	quantityInput();
	initProductAccordion();
});
