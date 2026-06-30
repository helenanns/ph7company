/* eslint-disable no-unused-vars */
import Swiper, { Navigation, Thumbs, EffectFade } from 'swiper';
import 'swiper/css';
import 'swiper/css/effect-fade';

const SWIPER_CONFIG = {
  thumbs: {
    spaceBetween: 8,
    slidesPerView: 'auto',
    watchSlidesProgress: true,
    navigation: {
      nextEl: '.JS__product-thumbs-next',
      prevEl: '.JS__product-thumbs-prev',
    },
    breakpoints: {
      1024: { direction: 'vertical' },
    },
  },
  images: {
    slidesPerView: 1,
    speed: 300,
    autoHeight: false,
    breakpoints: {
      1024: {
        effect: 'fade',
        fadeEffect: { crossFade: true },
      },
    },
  },
};

const DOMUtils = {
  qs: (selector, context = document) => context.querySelector(selector),
  qsa: (selector, context = document) => [...context.querySelectorAll(selector)],
  
  buildSlide: (img, className, isFirst = false) => {
    const imgSrc = img.thumb || img.mini;
    const loadingAttr = isFirst ? 'eager' : 'lazy';
    const fetchPriority = isFirst ? 'high' : 'auto';
    
    return `
      <div class="swiper-slide" ${className === 'image' ? `data-large="${img.full}"` : ''}>
        <img 
          class="l-product-gallery__${className}" 
          src="${imgSrc}" 
          alt="" 
          loading="${loadingAttr}" 
          decoding="async"
          fetchpriority="${fetchPriority}"
        />
      </div>
    `;
  },
};


class GalleryManager {
	constructor(thumbsEl, imagesEl) {
		this.thumbsEl = thumbsEl;
		this.imagesEl = imagesEl;

		this.productThumb = null;
		this.productImages = null;

		this.currentGalleryKey = 'original';

		this.imagesWrapper =
			this.imagesEl.querySelector('.swiper-wrapper');

		this.thumbsWrapper =
			this.thumbsEl.querySelector('.swiper-wrapper');

		this.originalImagesHTML =
			this.imagesWrapper.innerHTML;

		this.originalThumbsHTML =
			this.thumbsWrapper.innerHTML;

		this.init();
	}

	init() {
		this.initSwipers();
		this.bindImageLoadState();
	}

	initSwipers() {
		this.productThumb = new Swiper(this.thumbsEl, {
			modules: [Navigation, Thumbs],
			...SWIPER_CONFIG.thumbs,
		});

		this.productImages = new Swiper(this.imagesEl, {
			modules: [Thumbs, EffectFade],
			...SWIPER_CONFIG.images,
			thumbs: {
				swiper: this.productThumb,
			},
		});
	}

	destroySwipers() {
		this.productImages?.destroy(true, false);
		this.productThumb?.destroy(true, false);
	}

	bindImageLoadState() {
		this.imagesEl
			.querySelectorAll('.l-product-gallery__image')
			.forEach(image => {
				if (image.complete) {
					image.classList.add('is-loaded');
					return;
				}

				image.addEventListener(
					'load',
					() => image.classList.add('is-loaded'),
					{ once: true }
				);
			});
	}

	getGalleryKey(images) {
		return images.map(img => img.full).join('|');
	}

	rebuildGalleries(images) {
		const nextGalleryKey = this.getGalleryKey(images);

		if (nextGalleryKey === this.currentGalleryKey) {
			return;
		}

		this.destroySwipers();

		this.imagesWrapper.innerHTML =
			images
				.map((img, index) => DOMUtils.buildSlide(img, 'image', index === 0))
				.join('');

		this.thumbsWrapper.innerHTML =
			images
				.map(img => DOMUtils.buildSlide(img, 'thumb'))
				.join('');

		this.currentGalleryKey = nextGalleryKey;

		this.init();
	}

	restoreOriginalGalleries() {
		if (this.currentGalleryKey === 'original') {
			return;
		}

		this.destroySwipers();

		this.imagesWrapper.innerHTML =
			this.originalImagesHTML;

		this.thumbsWrapper.innerHTML =
			this.originalThumbsHTML;

		this.currentGalleryKey = 'original';

		this.init();
	}
}

class VariationManager {
  constructor($form, galleryManager) {
		this.$form = $form;
		this.galleryManager = galleryManager;
		this.$ = window.jQuery;
		this.variationCache = new Map();
	this.baseTitle = this.getTitleText();
	this.basePriceHtml = this.getPriceHtml();

		this.init();
	}

  init() {
    if (!this.$) return;

    this.bindEvents();
  }

  getSelectedAttributes() {
    const attributes = {};
    this.$form.find('select[name^="attribute_"], input[name^="attribute_"]:checked').each((_, el) => {
      const $el = this.$(el);
      const name = $el.attr('name');
      const value = $el.val();
      if (name && value) attributes[name] = value;
    });
    return attributes;
  }

  getTitleText() {
    const titleEl = document.querySelector('.product_title, .entry-title');
    return titleEl?.dataset.baseTitle || titleEl?.textContent?.trim() || '';
  }

  getPriceHtml() {
    const priceEl = document.querySelector('.summary .price, .price');
    return priceEl?.innerHTML || '';
  }

  updateProductSummary(variation) {
    const titleEl = document.querySelector('.product_title, .entry-title');
    const priceEl = document.querySelector('.summary .price, .price');

    if (titleEl) {
      if (!titleEl.dataset.baseTitle) {
        titleEl.dataset.baseTitle = titleEl.textContent.trim();
      }

      const variationTitle = variation?.variation_title || variation?.name || '';
      const selectedAttributes = Object.values(this.getSelectedAttributes()).filter(Boolean);

      if (variationTitle) {
        titleEl.textContent = variationTitle;
      } else if (selectedAttributes.length) {
        titleEl.textContent = `${titleEl.dataset.baseTitle} - ${selectedAttributes.join(' / ')}`;
      } else {
        titleEl.textContent = titleEl.dataset.baseTitle;
      }
    }

    if (priceEl) {
      if (variation?.price_html) {
        priceEl.innerHTML = variation.price_html;
      } else if (variation?.display_price != null) {
        const priceText = Number(variation.display_price).toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL',
        });
        priceEl.innerHTML = `<span class="amount">${priceText}</span>`;
      } else {
        priceEl.innerHTML = this.basePriceHtml;
      }
    }
  }

  findSelectedVariation() {
    const variations = this.$form.data('product_variations') || [];
    const selected = this.getSelectedAttributes();
    
    if (!Object.keys(selected).length) return null;

		const cacheKey = Object.entries(selected)
    .sort(([a], [b]) => a.localeCompare(b))
    .map(([k,v]) => `${k}:${v}`)
    .join('|');
		
    if (this.variationCache.has(cacheKey)) {
      return this.variationCache.get(cacheKey);
    }

    const exactMatch = variations.find(variation => 
      variation?.attributes && 
      Object.keys(selected).every(key => variation.attributes[key] === selected[key])
    );
    
    if (exactMatch) {
      this.variationCache.set(cacheKey, exactMatch);
      return exactMatch;
    }

     const colorKey = Object.keys(selected).find(key => 
      key.toLowerCase().includes('cor') || key.toLowerCase().includes('color')
    );
    
    if (colorKey) {
      const colorMatch = variations.find(variation => 
        variation?.attributes?.[colorKey] === selected[colorKey]
      ) || null;
      
      if (colorMatch) {
        this.variationCache.set(cacheKey, colorMatch);
      }
      return colorMatch;
    }

    this.variationCache.set(cacheKey, null);
    return null;
  }

  updateUrl() {
    const params = new URLSearchParams(window.location.search);
    
    this.$form.find('select[name^="attribute_"], input[name^="attribute_"]:checked').each((_, el) => {
      const $el = this.$(el);
      const name = $el.attr('name');
      const value = $el.val();
      value ? params.set(name, value) : params.delete(name);
    });

    const newUrl = window.location.pathname + (params.toString() ? `?${params}` : '');
   	const current = window.location.pathname + window.location.search;

		if (current !== newUrl) {
			window.history.replaceState(null, '', newUrl);
		}
  }

  handleVariationFound(variation) {
		if (variation?.custom_gallery?.length) {
			this.galleryManager?.rebuildGalleries(variation.custom_gallery);
		}

		this.updateProductSummary(variation);
		this.updateUrl();
	}

  handleResetData() {
    setTimeout(() => {
      const selectedVariation = this.findSelectedVariation();
      if (selectedVariation?.custom_gallery?.length) {
        this.galleryManager?.rebuildGalleries(selectedVariation.custom_gallery);
      } else {
        this.galleryManager?.restoreOriginalGalleries();
      }
      this.updateProductSummary(selectedVariation);
      this.updateUrl();
    }, 50);
  }

  handleAttributeChange() {
    const selected = this.getSelectedAttributes();
    const selectedVariation = this.findSelectedVariation();
    const hasColor = Object.keys(selected).some(key => 
      key.toLowerCase().includes('cor') || key.toLowerCase().includes('color')
    );

    if (selectedVariation?.custom_gallery?.length) {
      this.galleryManager?.rebuildGalleries(selectedVariation.custom_gallery);
    } else if (!hasColor) {
      this.galleryManager?.restoreOriginalGalleries();
    }
    this.updateProductSummary(selectedVariation);
    this.updateUrl();
  }

  bindEvents() {
    const events = {
      'found_variation': this.handleVariationFound.bind(this),
      'show_variation': this.handleVariationFound.bind(this),
      'reset_data': this.handleResetData.bind(this),
    };

    Object.entries(events).forEach(([event, handler]) => {
      this.$form.on(event, handler);
    });

    this.$form.find('select[name^="attribute_"], input[name^="attribute_"]')
      .on('change', this.handleAttributeChange.bind(this));
  }
}

const productThumbnail = () => {
  const thumbsEl = document.querySelector('.JS__product-thumbs');
  const imagesEl = document.querySelector('.JS__product-images');

  if (!thumbsEl || !imagesEl) return;

  const galleryManager = new GalleryManager(thumbsEl, imagesEl);

  if (window.jQuery) {
    const $form = window.jQuery('.variations_form');
    if ($form.length) {
      new VariationManager($form, galleryManager);
    }
  }

};

export default productThumbnail;