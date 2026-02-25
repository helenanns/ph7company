<?php global $theme_uri; ?>

<header class="m-header is-fixed">
    <div class="m-header__wrapper">

        <section class="m-header__main">
            <div class="container">

                <a href="<?= home_url() ?>" class="m-header__main__logo" title="Voltar para a Home">
                    <picture>
                        <img src="<?= $theme_uri ?>/assets/img/logo.png" width="73" height="71" alt="PH7 Company">
                    </picture>
                </a>
                
                <div class="m-header__main__wrapper">

                    <div class="m-header-search JS__header-search">
                        <div class="m-header-search__body">
                            <button class="m-search-button reset-button JS__header-openSearch">
                                <?php echo file_get_contents(
                                	$theme_uri . '/assets/img/icons/search.svg',
                                ); ?>
                            </button>
                            
                            <form role="search" method="get" action="/" class="m-header-search__form">
                                <input class="m-input-search" type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="Buscar">
                                <button class="m-search-button reset-button" type="submit" aria-label="Pesquisar termo">
                                    <?php echo file_get_contents(
                                    	$theme_uri . '/assets/img/icons/search.svg',
                                    ); ?>
                                </button>
                                <span class="m-search-close" title="Fechar busca">
                                </span>
                            </form>
                        </div>
                    </div>

                    <ul class="m-header__main__icons">
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
                            <div class="icon">
                                <?php get_template_part(
                                	'/template-parts/modules/cart',
                                	'cart',
                                	[],
                                ); ?>
                            </div>
                        </li>
                    </ul>
                    
                    <button class="m-button-hamburger desktop-none JS__toggle-menu" aria-label="Abrir menu de navegação">
                        <span class="m-button-hamburger-inner"></span>
                    </button>
                </div>
            </div>
        </section>

        <section class="m-header__menu JS__header-menu">
            <div class="container">
                <?php wp_nav_menu([
                	'menu' => 'header',
                	'menu_class' => 'm-header__menu__nav',
                ]); ?>
            </div>
        </section>

    </div>    
</header>
