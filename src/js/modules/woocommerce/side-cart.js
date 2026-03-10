export const initSideCart = () => {
    const $ = window.jQuery;
    if (!$) return;

    const $body = $('body');
    const $cartPanel = $('#ph7-side-cart');
    
    if (!$cartPanel.length) return;

    const $overlay = $('.ph7-side-cart-overlay');
    const $closeBtn = $('.ph7-side-cart-close');

    // Abre e fecha
    function openCart() {
        $cartPanel.addClass('is-open');
        $body.css('overflow', 'hidden');
    }

    function closeCart() {
        $cartPanel.removeClass('is-open');
        $body.css('overflow', '');
    }

    $closeBtn.on('click', closeCart);
    $overlay.on('click', closeCart);

    // Escapar pelo teclado
    $(document).on('keyup', (e) => {
        if (e.key === 'Escape' && $cartPanel.hasClass('is-open')) {
            closeCart();
        }
    });

    // Função helper para puxar o html do carrinho nativo sem enroscar nos handlers do WooCommerce blocks e cache sessionStorage
    function fetchFragmentsAndRender() {
        $.ajax({
            url: window.ph7_ajax.refresh_url,
            type: 'POST',
            data: { time: new Date().getTime() },
            dataType: 'json',
            success: function(res) {
                if (res && res.fragments) {
                    $.each(res.fragments, function(key, value) {
                        $(key).replaceWith(value);
                    });
                }
            },
            complete: function() {
                $('.ph7-side-cart-panel').removeClass('is-loading');
            }
        });
    }

    // Toggle by clicking cart icon on header if it exists
    $('.js-toggle-side-cart, .custom-cart-icon').on('click', (e) => {
        e.preventDefault();
        openCart();
    });

    // Abrir carrinho pelo dispatcher do add-to-cart-ajax customizado
    $(document.body).on('ph7_open_side_cart', () => {
        openCart();
    });

    // Interações com os itens do carrinho
    let qtyTimeout;

    $cartPanel.on('click', '.qty-btn', function() {
        const $btn = $(this);
        const $input = $btn.siblings('.qty');
        let currentVal = parseFloat($input.val());
        const max = parseFloat($input.attr('max'));
        const min = parseFloat($input.attr('min'));
        const step = parseFloat($input.attr('step'));

        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        if ($btn.hasClass('qty-btn--plus')) {
            if (max && (currentVal >= max)) {
                $input.val(max);
            } else {
                $input.val(currentVal + parseFloat(step));
            }
        } else {
            if (min && (currentVal <= min)) {
                $input.val(min);
            } else if (currentVal > 0) {
                $input.val(currentVal - parseFloat(step));
            }
        }
        
        $input.trigger('change');
    });

    $cartPanel.on('change', '.qty', function() {
        const $input = $(this);
        const itemKey = $input.closest('.woocommerce-mini-cart-item').find('a.remove').data('cart_item_key');
        const qty = $input.val();

        if (window.ph7_ajax && window.ph7_ajax.is_cart) return;

        clearTimeout(qtyTimeout);
        qtyTimeout = setTimeout(() => {
            updateCartQuantity(itemKey, qty);
        }, 500); 
    });

    $cartPanel.on('click', 'a.remove', function(e) {
        if (window.ph7_ajax && window.ph7_ajax.is_cart) return;
        
        e.preventDefault();
        e.stopPropagation(); // Evita que o WooCommerce native (cart-fragments.js) faça ajax duplicado
        const itemKey = $(this).data('cart_item_key');
        removeCartItem(itemKey);
    });

    function updateCartQuantity(itemKey, qty) {
        if (!window.ph7_ajax || !itemKey) return;

        $cartPanel.find('.ph7-side-cart-panel').addClass('is-loading');

        $.ajax({
            type: 'POST',
            url: window.ph7_ajax.store_api_url + '/update-item',
            headers: {
                'Nonce': window.ph7_ajax.store_api_nonce
            },
            data: JSON.stringify({
                key: itemKey,
                quantity: parseFloat(qty)
            }),
            contentType: 'application/json',
            success: (response) => {
                fetchFragmentsAndRender();
            },
            error: () => {
                $cartPanel.find('.ph7-side-cart-panel').removeClass('is-loading');
                alert('Erro ao atualizar quantidade no carrinho. Recarregue a página.');
            }
        });
    }

    function removeCartItem(itemKey) {
        if (!window.ph7_ajax || !itemKey) return;

        $cartPanel.find('.ph7-side-cart-panel').addClass('is-loading');

        $.ajax({
            type: 'POST',
            url: window.ph7_ajax.store_api_url + '/remove-item',
            headers: {
                'Nonce': window.ph7_ajax.store_api_nonce
            },
            data: JSON.stringify({
                key: itemKey
            }),
            contentType: 'application/json',
            success: (response) => {
                fetchFragmentsAndRender();
            },
            error: () => {
                $cartPanel.find('.ph7-side-cart-panel').removeClass('is-loading');
            }
        });
    }
};
