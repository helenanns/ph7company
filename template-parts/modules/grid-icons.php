<?php global $theme_uri; ?>

<section class="grid-icons">
    <ul class="grid-icons__list container">
        <li class="grid-icons__item frete">
            <?php echo file_get_contents($theme_uri . '/assets/img/icons/home/frete.svg'); ?>
            <div class="grid-icons__item__content">
                <span class="title">Frete Grátis</span>
                Compras acima de R$ 399
            </div>
        </li>
        <li class="grid-icons__item card">
            <?php echo file_get_contents($theme_uri . '/assets/img/icons/home/payment.svg'); ?>
            <div class="grid-icons__item__content">
                <span class="title">Parcelamento</span>
                Em até 4x sem juros
            </div>
        </li>
        <li class="grid-icons__item trade">
            <?php echo file_get_contents($theme_uri . '/assets/img/icons/trade.svg'); ?>
            <div class="grid-icons__item__content">
                <span class="title">Primeira troca grátis</span>
                Em até 7 dias
            </div>
        </li>
        <li class="grid-icons__item security">
            <?php echo file_get_contents($theme_uri . '/assets/img/icons/home/seguranca.svg'); ?>
            <div class="grid-icons__item__content">
                <span class="title">Segurança</span>
                Loja com SSL de proteção
            </div>
        </li>
    </ul>

</section>