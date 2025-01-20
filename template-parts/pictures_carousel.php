<?php
if ($post_id = null) {
    global $post;
    $post_id =  $post->ID;
}
$section_carousel = get_field('carrusel_de_imagenes', $post_id);
$title = '<' . $section_carousel['tag_del_titulo'] . ' class="txt-center section-title">' . $section_carousel['titulo'] . '</' . $section_carousel['tag_del_titulo'] . '>';
$toggle_section = $section_carousel['mostrar_seccion'];

if ($toggle_section) :

    // WP_Query arguments
    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'asignar_al_carrusel_de_imagenes',
                'value' => true,
                'compare' => 'IN',
            ),
        )
    );

    $query = new WP_Query($args);
?>

    <div class="cont-slider pictures_carousel">

        <?= $title ?>

        <div class="container">
            <div class="pic_carousel swiper">

                <div class="pic-carousel-wrapper swiper-wrapper">
                    <?php
                    $x = 1;
                    while ($query->have_posts()) : $query->the_post();
                        global $post;
                        $id = $post->ID;
                    ?>
                        <div class="pic-slide lightbox-enabled swiper-slide" data-id=<?= $x ?>>
                            <div class="slide-picture">
                                <img src="<?= wp_get_attachment_image_url($id, 'square') ?>" alt="<?= get_post_meta($id, '_wp_attachment_image_alt', TRUE) ?>" />
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>

                            <template class="lightbox-template" data-id=<?= $x ?>>
                                <div class="lightbox" data-id=<?= $x ?>>
                                    <button class="close"> &#9747; </button>
                                    <div class="lightbox__wrapper">
                                        <div class="lightbox__inner">
                                            <picture>
                                                <img src="<?= wp_get_attachment_image_url($id, 'Medium') ?>" alt="<?= get_post_meta($id, '_wp_attachment_image_alt', TRUE) ?>"
                                                class="skip-lazy"
                                                />
                                            </picture>
                                            <div class="lightbox__content">
                                                <p><?= $post->post_content ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    <?php
                        $x++;
                    endwhile;
                    ?>
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>

    </div>

<?php
    wp_reset_postdata();
endif;
?>