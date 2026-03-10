import '../scss/single-product.scss';
import productThumbnail from './modules/product-gallery';
import quantityInput from './modules/quantity-input';
import initAddToCartAjax from './modules/woocommerce/add-to-cart-ajax';

document.addEventListener('DOMContentLoaded', () => {
	productThumbnail();
	quantityInput();
	initAddToCartAjax();
});
