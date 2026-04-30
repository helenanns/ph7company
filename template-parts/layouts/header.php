<?php global $theme_uri; ?>

<header class="m-header">
    <div class="m-header-wrapper">

        <section class="m-header-main">
            <a href="<?= home_url() ?>" class="m-header-main__logo" title="Voltar para a Home">
                <picture>
                    <img src="<?= $theme_uri ?>/assets/img/logo.png" width="73" height="71" alt="PH7 Company">
                </picture>
            </a>
            
            <div class="m-header-icons">

                <div class="m-header-search JS__header-search">
                    <div class="m-header-search-body">
                        <button class="m-search-button JS__header-openSearch">
                            <?php echo file_get_contents(
                            	$theme_uri . '/assets/img/icons/search.svg',
                            ); ?>
                        </button>
                        
                        <form role="search" method="get" action="/" class="m-header-search-form">
                            <input class="m-input-search" type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="Buscar">
                            <button class="m-search-button" type="submit" aria-label="Pesquisar termo">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/search.svg',
                                ); ?>
                            </button>
                            <span class="m-search-close" title="Fechar busca">
                            </span>
                        </form>
                    </div>
                </div>

                <ul class="m-header-icons__list">
                    <li>
                        <a href="<?php echo home_url(); ?>/minha-conta">
                            <div class="icon account">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/account.svg',
                                ); ?>
                            </div>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo home_url(); ?>/lista-de-desejos">
                            <div class="icon wishlist">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/heart.svg',
                                ); ?>
                            </div>
                        </a>
                    </li> 
                    <li>
                        <?php get_template_part('/template-parts/modules/cart', 'cart', []); ?>
                    </li>
                </ul>
                
                <button class="m-button-hamburger desktop-none JS__toggle-menu" aria-label="Abrir menu de navegação">
                    <span class="m-button-hamburger-inner"></span>
                </button>
            </div>
        </section>

        <section class="m-header-menu JS__header-menu">
            <div class="container">
                <?php wp_nav_menu([
                	'menu' => 'header',
                	'menu_class' => 'm-header-menu__nav',
                ]); ?>
            </div>
        </section>

    </div>    
</header>
