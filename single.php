<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <div class="title-wrapper">
        <h1 class="title h1"><?= get_the_title(); ?></h1>
    </div>
    <div class="container page page__wrapper">


        <article class="article content">

            <?php if (is_singular('sedes')) : ?>
                <?= get_field('google_maps_codigo_para_mapa_embebido') ?>
            <?php else : ?>
                <picture class="ft-image"><img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'cover') ?>" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE); ?>"></picture>
            <?php endif ?>

            <div class="formatted-text">

                <div class="post-meta">
                    <p class="">
                        Publicado el
                        <span class="article__date"> <?= get_the_date('F j Y') ?></span> por
                        <span class="article__author"><a href="<?= get_the_permalink() ?>" class="article__link"><?= get_the_author() ?></a></span>
                    </p>
                </div>


                <?php the_content() ?>


            </div>
        </article>

        <?php
        $post_id =  get_the_ID();
        $args = array('ID' => $post_id);
        get_sidebar('blog', $args);
        ?>

        <?php if (is_singular('post')) : ?>
            <div class="last-row">
                <?php
                $args['category__in'] = wp_get_post_categories($post->ID);
                get_template_part('template-parts/articles', '', $args);
                ?>
            </div>
        <?php endif ?>
    </div>
<?php endwhile;
wp_reset_postdata(); ?>

<?php get_footer() ?>