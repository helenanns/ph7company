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

    <section class="m-footer-content">
        <div class="container">

            <div class="m-footer-contentWrapper">
                <div class="logo-wrapper">
                    <img src="<?= $theme_uri ?>/assets/img/logo-footer.png" width="153" height="108" alt="PH7 Company" class="logo">

                    
                    <ul class="m-footer-social">
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
                            <li class="wpp">
                                <a href="https://wa.me/<?php echo $whatsapp; ?>" target="_blank">
                                    <?php echo file_get_contents(
                                    	$theme_uri . '/assets/img/icons/whatsapp-white.svg',
                                    ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                        
                </div>

                <div class="m-footer-item">
                    <span class="title">Minha Conta</span>
                    <div class="m-footer-menuWrapper">
                        <?php wp_nav_menu([
                        	'theme_location' => 'footer-account',
                        	'menu_class' => 'm-footer__menu',
                        ]); ?>
                    </div>
                </div>

                <div class="m-footer-item">
                    <span class="title">Institucional</span>
                    <div class="m-footer-menuWrapper">
                        <?php wp_nav_menu([
                        	'theme_location' => 'footer-nav',
                        	'menu_class' => 'm-footer__menu',
                        ]); ?>
                    </div>
                </div>
                
                <div class="m-footer-item">
                    <span class="title">Atendimento</span>
                    <div class="m-footer-menuWrapper">
                        <?php wp_nav_menu([
                        	'theme_location' => 'footer-support',
                        	'menu_class' => 'm-footer__menu',
                        ]); ?>
                    </div>
                </div>

                <div class="m-footer-item">
                    <span class="title">Fale Conosco</span>
                    <div class="m-footer-menuWrapper">
                        <ul class="m-footer__menu">
                            <?php if ($phone): ?>
                                <li>
                                    <a href="wa.me/<?php echo $whatsapp; ?>" target="_blank">
                                        +55 <?php echo $phone; ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($email): ?>
                                <li class="mail">
                                    <a href="mailto:<?php echo $email; ?>" target="_blank">
                                        <?php echo $email; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <span>R. Dom Barreto, 811 - Paraíso <br> Americana - SP, 13465-700</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <ul class="payments">
                <li>
                    <img src="<?= $theme_uri ?>/assets/img/payments/visa.svg" alt="Visa" width="60" height="60" loading="lazy">
                </li>
                <li>
                    <img src="<?= $theme_uri ?>/assets/img/payments/mastercard.svg" alt="Mastercard" width="60" height="60" loading="lazy">
                </li>
                <li>
                    <img src="<?= $theme_uri ?>/assets/img/payments/american-express.svg" alt="American Express" width="60" height="60" loading="lazy">
                </li>
                <li>
                    <img src="<?= $theme_uri ?>/assets/img/payments/pix.svg" alt="Pix" width="60" height="60" loading="lazy">
                </li>
                <li>
                    <img src="<?= $theme_uri ?>/assets/img/payments/elo.svg" alt="Elo" width="60" height="60" loading="lazy">
                </li>
                <li>
                    <img src="<?= $theme_uri ?>/assets/img/payments/mercadopago.svg" alt="Elo" width="60" height="60" loading="lazy">
                </li>
            </ul>

        </div>
    </section>

    <section class="m-footer-copyright">
        <div class="container">
            <span>
                <span class="registrado">®</span> <?php echo date(
                	'Y',
                ); ?>, PH7 Company. <b>CNPJ:</b> 35.865.044/0001-69
            </span>

            <ul class="m-footer-social">
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
                    <li class="wpp">
                        <a href="https://wa.me/<?php echo $whatsapp; ?>" target="_blank">
                            <?php echo file_get_contents(
                            	$theme_uri . '/assets/img/icons/whatsapp-white.svg',
                            ); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            
            <span><a href="https://api.whatsapp.com/send/?phone=19994813114" target="_blank">teyastud.io</a></span>
        </div>
    </section>

</section>
