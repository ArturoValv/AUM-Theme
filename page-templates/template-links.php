<?php
/*Template Name: Template Enlaces con Organizaciones*/
?>
<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<?php get_template_part('template-parts/cover') ?>

<div class="container page page__wrapper">

    <div class="content">
        <div class="formatted-text">

            <?php while (have_posts()) : the_post(); ?>

                <?php the_content() ?>

            <?php endwhile;
            wp_reset_postdata(); ?>

        </div>

        <div class="links-menu">
            <ul class="links-menu__wrapper">
                <?php
                $theme_locations = get_nav_menu_locations()['orgs_links_menu'];
                $menu_obj = wp_get_nav_menu_items($theme_locations);

                for ($i = 0; $i < sizeof($menu_obj); $i++) :
                    $item = $menu_obj[$i];
                    $id = $item->ID;
                ?>

                    <li class="links-menu__item">
                        <p class="menu-item-title"><?= $item->title ?></p>
                        <p class="menu-item-person"><?= get_field('representante', $id) ?></p>
                        <a href="mailto:<?= get_field('correo_electronico_de_contacto', $id) ?>" class="menu-item-mail"><?= get_field('correo_electronico_de_contacto', $id) ?></a>
                        <a href="mailto:<?= $item->url ?>" class="menu-item-mail"><?= $item->url ?></a>
                    </li>

                <?php endfor ?>
            </ul>
        </div>
    </div>

    <?php
    global $post;
    $post_id =  $post->ID;
    $args = array('ID' => $post_id);
    get_sidebar('sidebar', $args);
    ?>

</div>

<?php get_footer() ?>