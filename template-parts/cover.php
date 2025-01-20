<?php
if ($post_id = null) {
    global $post;
    $post_id =  $post->ID;
}
$section_cover = get_field('cover');
$options = get_option('theme_options');
$input_value = $options['default_cover_image'] ?? '';

if (is_front_page()) :
?>
    <section class="cover">
        <div class="bg-image">
            <img src="<?= $section_cover['imagen_de_fondo']['url'] ? $section_cover['imagen_de_fondo']['url'] : wp_get_attachment_url($input_value) ?>" alt="<?= $section_cover['imagen_de_fondo']['alt'] ? $section_cover['imagen_de_fondo']['alt'] : get_post_meta($input_value, '_wp_attachment_image_alt', TRUE) ?>">
        </div>
        <<?= $section_cover['tag_del_titulo'] ?> class="cover__title h1"><?= $section_cover['titulo'] ?></<?= $section_cover['tag_del_titulo'] ?>>
    </section>

<?php elseif (is_page()) : ?>
    <section class="cover">
        <div class="bg-image"><img src="<?= get_the_post_thumbnail_url($post_id, 'cover') ? get_the_post_thumbnail_url($post_id, 'cover') : wp_get_attachment_url($input_value) ?>" alt="<?= get_post_meta(get_post_thumbnail_id() ? get_post_thumbnail_id() : $input_value, '_wp_attachment_image_alt', TRUE); ?>"></div>
        <h1 class="cover__title h1"><?= get_the_title(); ?></h1>
    </section>

<?php elseif (is_home()) : ?>
    <section class="cover">
        <div class="bg-image"><img src="<?= get_the_post_thumbnail_url(get_option('page_for_posts')) ? get_the_post_thumbnail_url(get_option('page_for_posts')) : wp_get_attachment_url($input_value) ?>" alt="<?= get_post_meta(get_post_thumbnail_id(get_option('page_for_posts')) ? get_post_thumbnail_id(get_option('page_for_posts')) : $input_value, '_wp_attachment_image_alt', TRUE); ?>"></div>
        <h1 class="cover__title h1"><?= get_the_title(get_option('page_for_posts')); ?></h1>
    </section>
<?php endif; ?>