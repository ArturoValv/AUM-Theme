
        <aside class="sidebar">

            <?php if (get_field('sidebar_menu', $args['ID'])) : ?>

                <div class="widget">

                    <h3 class="txt-center widget__title h3"><?= get_field('titulo_del_menu', $args['ID']) ?></h3>

                    <?php wp_nav_menu(array('menu' => get_field('sidebar_menu', $args['ID']), 'menu_class' => 'categories__items categories widget__content', 'container_class' => '')) ?>

                </div>

            <?php endif ?>

            <?php if (get_field('mostrar_sidebar_eventos', $args['ID'])) :

                $args = array(
                    'post_type' => 'tribe_events',
                    'posts_per_page' => 4,
                );

                $query = new WP_Query($args);
            ?>

                <div class="widget events">

                    <div class="widget__title-wrapper">
                        <h3 class="txt-center widget__title h3">Eventos Próximos</h3>
                    </div>

                    <div class="events__sidebar">
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
                            <div class="event">
                                <p class="event__date"><?= $event_dates; ?></p>
                                <p class="event__name"><?= get_the_title(); ?></p>
                                <p class="event__day"><?= $event_time; ?></p>
                                <a href="<?= get_the_permalink() ?>" class="event__link">Ver Evento</a>
                            </div>
                        <?php endwhile; ?>
                    </div>

                </div>

            <?php endif ?>

            <?php dynamic_sidebar('default_sidebar') ?>

        </aside>

