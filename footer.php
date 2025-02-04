<?php
$options = get_option('theme_options');
if (!is_front_page() && $options['toggle_footer_banner']) :
?>
    <section class="footer-banner">
        <div class="cta-banner container">
            <div class="banner-content">
                <p class="cta-tagline"><?= $options['banner_footer_heading']; ?></p>
                <p class="cta-title"><?= $options['banner_footer_text']; ?></p>
            </div>

            <a href="<?= $options['banner_footer_button_link']; ?>" class="btn-primary arrow"><?= $options['banner_footer_button_text']; ?></a>
        </div>
    </section>
<?php endif; ?>

<footer id="site-footer">
    <div class="footer-inner container">
        <a href="<?= get_site_url() ?>" class="logo">
            <img src="<?= esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))) ?>" alt="">
            <!--<p class="footer-title"><?php get_bloginfo('name') ?></p>-->
        </a>

        <?php if ($options['contact_info_main_phone'] || $options['contact_info_email']) : ?>
            <div class="contact-info txt-center">
                <p class="footer-title">Contacto</p>
                <?php if ($options['contact_info_main_phone']) : ?>
                    <p class="tel">
                        <span>Teléfono: </span>
                        <a href="tel:+52<?= preg_replace('/[^0-9]/', '', $options['contact_info_main_phone']) ?>"><?= $options['contact_info_main_phone'] ?></a>
                    </p>
                <?php endif ?>

                <?php if ($options['contact_info_email']) : ?>
                    <p class="tel">
                        <span>Correo: </span>
                        <a href="mailto:<?= $options['contact_info_email'] ?>"><?= $options['contact_info_email'] ?></a>
                    </p>
                <?php endif ?>
            </div>
        <?php endif ?>

        <?php if ($options['cuenta_principal'] !== '' || $options['cuenta_secundaria'] !== '') : ?>
            <div class="bank-info txt-center">

                <p class="footer-title"><?= $options['heading_banco'] ?></p>
                <?php if ($options['cuenta_principal']) : ?>
                    <p class="bank-info__content"><?= $options['cuenta_principal'] ?></p>
                <?php endif ?>
                <?php if ($options['cuenta_secundaria']) : ?>
                    <p class="bank-info__content"><?= $options['cuenta_secundaria'] ?></p>
                <?php endif ?>

            </div>
        <?php endif ?>

        <div class="locations ">
            <h2 class="footer-title"><?= get_option('theme_options')['footer_menus_title'] ?></h2>

            <?php
            $theme_locations = array_key_exists('footer_menu_first', get_nav_menu_locations()) ? get_nav_menu_locations()['footer_menu_first'] : '';
            $menu_obj = get_term($theme_locations, 'nav_menu');
            if ($theme_locations !== 0) :
            ?>
                <div class="footer-menu-container">
                    <h3 class="footer-title"><?= $menu_obj->name ?></h3>
                    <?php
                    $args = array(
                        'theme_location' => 'footer_menu_first',
                        'container' => 'nav',
                        'container_class' => 'footer_menu',
                    );
                    wp_nav_menu($args);
                    ?>
                </div>
            <?php endif ?>

            <?php
            $theme_locations = array_key_exists('footer_menu_second', get_nav_menu_locations()) ? get_nav_menu_locations()['footer_menu_second'] : '';
            $menu_obj = get_term($theme_locations, 'nav_menu');
            if ($theme_locations !== 0) :
            ?>
                <div class="footer-menu-container">
                    <h3 class="footer-title"><?= $menu_obj->name ?></h3>
                    <?php
                    $args = array(
                        'theme_location' => 'footer_menu_second',
                        'container' => 'nav',
                        'container_class' => 'footer_menu',
                    );
                    wp_nav_menu($args);
                    ?>
                </div>
            <?php endif ?>

        </div>

        <div class="social">

            <h2 class="footer-title">Visita Nuestras Redes Sociales</h2>

            <div class="social__icons">

                <?php
                if (!empty($options['social_x_link'])) :
                ?>

                    <a href="<?= $options['social_x_link'] ?>" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM351.3 199.3v0c0 86.7-66 186.6-186.6 186.6c-37.2 0-71.7-10.8-100.7-29.4c5.3 .6 10.4 .8 15.8 .8c30.7 0 58.9-10.4 81.4-28c-28.8-.6-53-19.5-61.3-45.5c10.1 1.5 19.2 1.5 29.6-1.2c-30-6.1-52.5-32.5-52.5-64.4v-.8c8.7 4.9 18.9 7.9 29.6 8.3c-9-6-16.4-14.1-21.5-23.6s-7.8-20.2-7.7-31c0-12.2 3.2-23.4 8.9-33.1c32.3 39.8 80.8 65.8 135.2 68.6c-9.3-44.5 24-80.6 64-80.6c18.9 0 35.9 7.9 47.9 20.7c14.8-2.8 29-8.3 41.6-15.8c-4.9 15.2-15.2 28-28.8 36.1c13.2-1.4 26-5.1 37.8-10.2c-8.9 13.1-20.1 24.7-32.9 34c.2 2.8 .2 5.7 .2 8.5z" />
                        </svg>
                    </a>

                <?php endif ?>

                <?php if (!empty($options['social_ig_link'])) : ?>

                    <a href="<?= $options['social_x_link'] ?>" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z" />
                        </svg>
                    </a>

                <?php endif ?>

                <?php if (!empty($options['social_fb_link'])) : ?>

                    <a href="<?= $options['social_x_link'] ?>" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z" />
                        </svg>
                    </a>

                <?php endif ?>

                <?php if (!empty($options['social_yt_link'])) : ?>

                    <a href="<?= $options['social_x_link'] ?>" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M186.8 202.1l95.2 54.1-95.2 54.1V202.1zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-42 176.3s0-59.6-7.6-88.2c-4.2-15.8-16.5-28.2-32.2-32.4C337.9 128 224 128 224 128s-113.9 0-142.2 7.7c-15.7 4.2-28 16.6-32.2 32.4-7.6 28.5-7.6 88.2-7.6 88.2s0 59.6 7.6 88.2c4.2 15.8 16.5 27.7 32.2 31.9C110.1 384 224 384 224 384s113.9 0 142.2-7.7c15.7-4.2 28-16.1 32.2-31.9 7.6-28.5 7.6-88.1 7.6-88.1z" />
                        </svg>
                    </a>

                <?php endif ?>

            </div>
        </div>
    </div>

    <div class="legal">
        <p class="container"> <?= get_bloginfo('name') . ' &copy; - ' . date('Y') ?></p>
    </div>

</footer>


<?php wp_footer(); ?>
</body>

</html>