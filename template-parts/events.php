<?php
$section_events = get_field('eventos');
$title = '<' . $section_events['tag_del_titulo'] . ' class="txt-center section-title">' . $section_events['titulo'] . '</' . $section_events['tag_del_titulo'] . '>';
$banner = get_field('cta_banner');
$button = $banner['boton'];
$banner_tx = $banner['encabezado'];
$banner_hd = $banner['texto'];
$toggle_section = $section_events['mostrar_seccion'];

if ($toggle_section) :
    $options = get_option('theme_options');

    $args = array(
        'post_type' => 'tribe_events',
        'posts_per_page' => 10,
    );

    $query = new WP_Query($args);
?>

    <section id="events" class="events">

        <div class="container">
            <?= $title ?>

            <div class="events__wrapper swiper">
                <div class="events__carousel swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post();
                        $start_date = date_i18n("M d", strtotime(get_post_meta(get_the_ID())["_EventStartDate"][0]));
                        $end_date = date_i18n("M d", strtotime(get_post_meta(get_the_ID())["_EventEndDate"][0]));
                        $event_dates = "";
                        if ($start_date !== $end_date) {
                            $event_dates = $start_date . "-" . $end_date;
                        } else {
                            $event_dates = $start_date;
                        }
                        $event_time = date_i18n("l G:i", strtotime(get_post_meta(get_the_ID())["_EventStartDate"][0]));
                    ?>
                        <div class="event swiper-slide">
                            <p class="event__date"><?= $event_dates; ?></p>
                            <p class="event__name"><?= get_the_title(); ?></p>
                            <p class="event__day"><?= $event_time; ?></p>
                            <a href="<?= get_the_permalink(get_the_ID()) ?>" class="event__link">Ver Evento</a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

            <div class="cta-banner">
                <div class="banner-content">
                    <p class="cta-tagline"><?= $banner_hd ? $banner_hd : $options['banner_footer_heading']; ?></p>
                    <p class="cta-title"><?= $banner_tx ? $banner_tx : $options['banner_footer_text']; ?></p>
                </div>

                <a href="<?= $button ? $button['url'] : $options['banner_footer_button_link']; ?>" class="btn-primary arrow"><?= $button ? $button['title'] : $options['banner_footer_button_text']; ?></a>
            </div>

        </div>

    </section>

<?php endif ?>