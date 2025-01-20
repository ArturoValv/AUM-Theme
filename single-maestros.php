<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$thumbnail_id = get_post_thumbnail_id($post->ID);
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
?>

<?php get_template_part('./template-parts/cover') ?>

<div class="container page maestro">

    <div class="heading">
        <h2 class="title"><?= get_field('titulo') ?></h2>
        <h1 class="name"><?= get_field('nombre') ?></h1>
    </div>

    <div class="maestro__image">
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= $thumbnail_id ?>" />
        <?php endif; ?>
    </div>

    <main class="maestro__bio formatted-text">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post();

                the_content();
            }
        } ?>
    </main>

    <aside class="maestro__estudios formatted-text">
        <h3 class="title">Estudios: </h3>
        <?= get_field('estudios') ?>
    </aside>

</div>

<?php //get_template_part('template-parts/slide')  ?>

<?php get_footer() ?>