export default function initAddToCartAjax() {
    const $ = window.jQuery;
    if (!$) return;

    const $body = $('body');

    // Interceptar o submit do form de carrinho da página de produto
    $body.on('submit', 'form.cart', function(e) {
        const $form = $(this);
        
        // Se for form de produto externo não deve interferir
        if ($form.closest('.product').hasClass('product-type-external')) {
            return;
        }

        e.preventDefault();

        const $submitBtn = $form.find('button[type="submit"]');
        const originalText = $submitBtn.text();
        const $cartPanel = $('#ph7-side-cart');

        // Adicionar state de loading no botão
        $submitBtn.text('Adicionando...').addClass('loading').prop('disabled', true);

        // Reunir dados do form via FormData cru
        const formData = new FormData($form[0]);
        formData.append('add-to-cart', $submitBtn.val() || $form.find('input[name="add-to-cart"]').val());

        let endpointUrl = window.location.href;
        if (endpointUrl.indexOf('?') > -1) {
            endpointUrl += '&wc-ajax=add_to_cart';
        } else {
            endpointUrl += '?wc-ajax=add_to_cart';
        }

        $.ajax({
            url: endpointUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                }

                $('.woocommerce-notices-wrapper').empty();
                
                // Em vez de depender do buggy cart-fragments.js que se confunde quando a view difere do banco com Storage,
                // vamos nós mesmos forçar a busca do HTML mais recente que a action de add no banco acima acabou de registrar.
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
                        // Abrir o painel com as informações mais atuais já renderizadas pelo jQuery acima.
                        $(document.body).trigger('ph7_open_side_cart');
                    }
                });
            },
            error: function() {
                alert('Houve um erro ao processar sua requisição. Tente novamente.');
            },
            complete: function() {
                $submitBtn.text(originalText).removeClass('loading').prop('disabled', false);
            }
        });
    });
}
