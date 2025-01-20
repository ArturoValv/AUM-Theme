<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<div class="title-wrapper">
    <h1 class="title h1"><?= get_the_archive_title(); ?></h1>
</div>

<div class="container page blog__wrapper">

    <main class="articles">
        <div class="articles__loop">

            <?php while (have_posts()) : the_post() ?>
                <article class="article">
                    <div class="article__wrapper">
                        <h4 class="article__title">
                            <a href="<?= get_the_permalink() ?>">
                                <?= get_the_title() ?>
                            </a>
                        </h4>
                        <a href="<?= get_the_permalink() ?>">
                            <picture class="article__image">
                                <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'square') ?>" alt="<?= get_post_meta(get_the_ID(), '_wp_attachment_image_alt', TRUE); ?>">
                            </picture>
                        </a>
                        <p class="article__date"><?= get_the_date('F j Y') ?></p>
                        <p class="article__excerpt"><?= get_the_excerpt() ?></p>
                        <p class="article__author">Publicado por <a href="<?= get_the_permalink() ?>" class="article__link"><?= get_the_author() ?></a></p>
                    </div>
                </article>
            <?php endwhile ?>

            <div class="post-pagination">
                <?php
                get_previous_posts_link();
                the_posts_pagination();
                get_next_posts_link();
                ?>
            </div>


        </div>
    </main>

</div>

<?php get_footer() ?>