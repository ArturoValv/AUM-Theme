<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="cont-nav">
            <a href="/" id="logo">
                <img src="<?= esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))) ?>" alt="">
            </a>

            <?php
            $args = array(
                'theme_location' => 'main_menu',
                'container' => 'nav',
                'container_class' => 'main-menu',
            );
            wp_nav_menu($args);
            ?>

            <div id="menu-mobile">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </header>