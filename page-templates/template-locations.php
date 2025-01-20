<?php
/*Template Name: Template Sedes*/
?>
<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();


$args = array(
    'post_type' => 'sedes',
    'posts_per_page' => -1,
    'meta_key'          => 'pais',
    'orderby'           => 'meta_value',
    'order'             => 'ASC'
);

$query = new WP_Query($args);
$posts = $query->get_posts();
$paises = array();

foreach ($posts as $post) {
    $id = $post->ID;
    $pais =  strtolower(get_field('pais', $id));
    array_push($paises, $pais);
}

$list_paises = array_unique($paises);
?>

<?php get_template_part('template-parts/cover') ?>
<div class="container page__wrapper locations-container">
    <main class="locations content">
        <?php foreach ($list_paises as $pais) : ?>
            <details class="location" <?= count($list_paises) < 2 ? 'open' : '' ?>>
                <summary class="location__area">
                    <p class="title"><?= $pais ?></p>
                </summary>
                <?php
                while ($query->have_posts()) : $query->the_post();
                    if ($pais ===  strtolower(get_field('pais'))) :
                ?>
                        <div class="location__content content">
                            <div class="location__info">
                                <p class="location__name"><?= get_field('ciudad') . ' - ' . get_field('nombre_de_la_sede') ?></p>
                                <p class="location__address formatted-text"><?= get_field('direccion') ?></p>
                                <a href="<?= get_the_permalink() ?>" class="location__link">Conocer Más de esta Sede</a>

                                <div class="contact-info formatted-text">
                                    <p class="h4">Informes</p>
                                    <?php if (get_field('persona_a_contactar')) : ?>
                                        <p class="name"><?= get_field('persona_a_contactar') ?></p>
                                    <?php endif ?>
                                    <?php if (get_field('correo_electronico')) : ?>
                                        <a href="mailto:<?= get_field('correo_electronico') ?>"><?= get_field('correo_electronico') ?></a>
                                    <?php endif ?>
                                    <?php if (get_field('telefono_de_contacto_1')) : ?>
                                        <p class="phone">Tel:<a href="tel:+<?= preg_replace("/[^0-9]/", "", get_field('telefono_de_contacto_1')); ?>"><?= get_field('telefono_de_contacto_1') ?></a></p>
                                    <?php endif ?>
                                    <?php if (get_field('telefono_de_contacto_2')) : ?>
                                        <p class="phone">Tel:<a href="tel:+<?= preg_replace("/[^0-9]/", "", get_field('telefono_de_contacto_2')); ?>"><?= get_field('telefono_de_contacto_2') ?></a></p>
                                    <?php endif ?>
                                </div>

                            </div>

                            <?php if (get_field('google_maps_codigo_para_mapa_embebido')) : ?>
                                <div class="location__map">
                                    <?= get_field('google_maps_codigo_para_mapa_embebido') ?>
                                </div>
                            <?php endif ?>

                        </div>
                <?php
                    endif;
                endwhile;
                ?>
            </details>
        <?php endforeach;
        wp_reset_postdata();
        ?>
    </main>

    <?php
    global $post;
    $post_id =  $post->ID;
    $args = array('ID' => $post_id);
    get_sidebar('sidebar', $args);
    ?>

</div>

<?php get_footer() ?>