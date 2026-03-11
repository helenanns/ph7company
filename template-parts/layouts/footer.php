<?php global $theme_uri;
$email = get_field('email', 'options');
$endereco = get_field('endereco', 'options');
$facebook = get_field('facebook', 'options');
$instagram = get_field('instagram', 'options');
$phone = get_field('whatsapp', 'options');

if ($phone):
	$whatsapp = preg_replace('/[^0-9]/', '', $phone);
endif;
?>

<section class="m-footer">

    <section class="m-footer__content">
        <div class="container">

            <div class="logo-wrapper">
                <img src="<?= $theme_uri ?>/assets/img/logo-footer.png" width="153" height="108" alt="PH7 Company" class="logo">

                <ul class="m-footer__social">
                    <?php if ($instagram): ?>
                        <li>
                            <a href="<?php echo $instagram; ?>" target="_blank">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/instagram.svg',
                                ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($facebook): ?>
                        <li>
                            <a href="<?php echo $facebook; ?>" target="_blank">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/facebook.svg',
                                ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($whatsapp): ?>
                        <li>
                            <a href="https://wa.me/<?php echo $whatsapp; ?>" target="_blank">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/whatsapp.svg',
                                ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                    
            </div>

            <div>
                <span class="title">Navegue</span>
                <?php wp_nav_menu([
                	'theme_location' => 'footer',
                	'menu_class' => 'm-footer__menu',
                ]); ?>
            </div>

            <div>
                <span class="title">Institucional</span>
                <?php wp_nav_menu([
                	'theme_location' => 'footer-nav',
                	'menu_class' => 'm-footer__menu',
                ]); ?>
            </div>

            <div>
                <span class="title">Fale Conosco</span>
                <ul class="m-footer__menu">
                <?php if ($phone): ?>
                    <li>
                        <?php echo file_get_contents(
                        	$theme_uri . '/assets/img/icons/whatsapp.svg',
                        ); ?>
                        <a href="wa.me/<?php echo $whatsapp; ?>" target="_blank">
                            +55 <?php echo $phone; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($email): ?>
                    <li class="mail">
                        <?php echo file_get_contents($theme_uri . '/assets/img/icons/email.svg'); ?>
                        <a href="mailto:<?php echo $email; ?>" target="_blank">
                            <?php echo $email; ?>
                        </a>
                    </li>
                <?php endif; ?>
                    <li>
                        <?php echo file_get_contents($theme_uri . '/assets/img/icons/clock.svg'); ?>
                        <span>seg. à sex. das 09h às 18h</span>
                    </li>
                </ul>
            </div>
            
            <div class="payments">
                <span class="title">Formas de Pagamento</span>
                <ul>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/visa.svg" alt="Visa"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/mastercard.png" alt="Mastercard"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/american-express.svg" alt="American Express"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/discover.png" alt="Discovery"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/elo.svg" alt="Elo"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/aura.png" alt="Aura"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/jcb.png" alt="JCB"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/hipercard.svg" alt="Hipercard"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/hiper.png" alt="Hiper"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/pix.svg" alt="Pix"  width="" height="">
                    </li>
                </ul>

                <span class="title">Formas de envio</span>
                <ul class="payments">
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/pac.png" alt="Visa"  width="" height="">
                    </li>
                    <li>
                        <img src="<?= $theme_uri ?>/assets/img/payments/sedex.png" alt="Mastercard"  width="" height="">
                    </li>
                </ul>  
            </div>

        </div>
    </section>

    <section class="m-footer-copyright">
        <div class="container">
            <span>
                <span class="registrado">®</span> <?php echo date(
                	'Y',
                ); ?>, PH7 Company. <b>CNPJ:</b> 35.865.044/0001-69
            </span>
        </div>
    </section>

</section>
