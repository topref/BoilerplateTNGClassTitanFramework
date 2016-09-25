<!DOCTYPE html>
<html class="no-js" lang="ru">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <!--[if IE]><script src="<?php bloginfo('template_url'); ?>/js/html5shiv.min.js"></script><![endif]-->
    <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
<?php wp_head(); ?>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="header-table table">
                <div class="header-cell cell">
                    <a href="" class="header__logo"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt=""/></a>
                </div>
                <div class="header-cell header-cell_menu cell">
                    <div class="header-menu__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="header-menu">
                        <li><a href="" class="header-menu__link active"><span>Главная</span></a></li>
                        <li><a href="" class="header-menu__link"><span>Туры</span></a></li>
                        <li><a href="" class="header-menu__link"><span>Памятка туристу</span></a></li>
                        <li><a href="" class="header-menu__link"><span>Отзывы</span></a></li>
                        <li><a href="" class="header-menu__link"><span>Новости</span></a></li>
                        <li><a href="" class="header-menu__link"><span>Контакты</span></a></li>
                    </ul>
                </div>
                <div class="header-cell cell">
                    <div class="header-contacts row">
                        <a href="" class="header__callback btn-bg">Заказать звонок</a>
                        <div class="header-contacts-phones">
                            <div class="header__phone"><span>+7 (982)</span> 705 49 00</div>
                            <div class="header__phone"><span>+7 (913)</span> 699 51 12</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>