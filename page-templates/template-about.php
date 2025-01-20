<?php
/*Template Name: Template Acerca de*/
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
    </div>

    <?php
    global $post;
    $post_id =  $post->ID;
    $args = array('ID' => $post_id);
    get_sidebar('sidebar', $args);
    ?>

    <div class="last-row">
        <?php get_template_part('template-parts/carousel', '', $args)  ?>
    </div>
</div>

<?php get_footer() ?>