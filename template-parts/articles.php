<?php
if ($post_id = null) {
    global $post;
    $post_id =  $post->ID;
}
$section_articles = get_field('articulos');
if (!$args) {
    $title = '<' . $section_articles['tag_del_titulo'] . ' class="txt-center section-title">' . $section_articles['titulo'] . '</' . $section_articles['tag_del_titulo'] . '>';
    $category = '';
} else {
    $title = '<h3 class="txt-center section-title">Artículos Relacionados</h3>';
    $category = $args['category__in'] ?? '';
}

$button = $section_articles['boton'] ?? '';
$toggle_section = $section_articles['mostrar_seccion'] ?? '';

if ($toggle_section) :

    $args = array(
        'post_type' => 'post',
        'category__in' => $category,
        'post__not_in' => $post_id,
        'posts_per_page' => 8,
        array(
            'key'     => $category ? '' : 'articulo_destacado',
            'value'   => $category ? '' : true,
        ),
    );

    $query = new WP_Query($args);
?>

    <section id="articles" class="articles">

        <div class="container">
            <?= $title ?>

            <div class="articles__wrapper swiper">
                <div class="articles__loop swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <article class="article swiper-slide">
                            <div class="article__wrapper">
                                <h4 class="article__title">
                                    <a href="<?= get_the_permalink() ?>">
                                        <?= get_the_title() ?>
                                    </a>
                                </h4>
                                <a href="<?= get_the_permalink(); ?>">
                                    <div class="article__image">
                                        <img src="<?= get_the_post_thumbnail_url(); ?>" alt="">
                                    </div>
                                </a>
                                <p class="article__date"><?= get_the_date('F j') . ' del ' . get_the_date('Y') ?></p>
                                <p class="article__excerpt"><?= get_the_excerpt() ?></p>
                                <p class="article__author">Publicado por <a href="<?= get_the_author_url() ?>" class="article__link"><?= get_the_author() ?></a></p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

            </div>

            <a href="#" class="btn-primary">Ver Todos</a>

        </div>

    </section>

<?php
    wp_reset_postdata();
endif;
?>