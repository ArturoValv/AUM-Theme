<?php
if ($post_id = null) {
  global $post;
  $post_id =  $post->ID;
}
$section_carousel = get_field('maestros', $post_id);
$title = '<' . $section_carousel['tag_del_titulo'] . ' class="txt-center section-title">' . $section_carousel['titulo'] . '</' . $section_carousel['tag_del_titulo'] . '>';
$button = $section_carousel['boton'];
$toggle_section = $section_carousel['mostrar_seccion'];

if ($toggle_section) :

  $args = array(
    'post_type' => 'maestros',
    array(
      'key'     => 'maestro_destacado',
      'value'   => true,
    ),
  );

  $query = new WP_Query($args);
?>

  <div class="cont-slider maestros">

    <?= $title ?>

    <div class="container">
      <div class="swiper maestros_carousel">
        <div class="swiper-wrapper">
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="swiper-slide">
              <a href="<?= get_the_permalink() ?>" class="cont-cards">
                <picture>
                  <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'portrait') ?>" />
                </picture>
                <h4><?= get_field('titulo'); ?></h4>
                <h5><?= get_the_title() ?></h5>
              </a>
            </div>
          <?php endwhile;
          ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>

      <?php if (!is_page_template('page-templates/template-about.php')) : ?>
        <div class="flx-center">
          <?php if ($button) : ?>
            <a href="<?= $button['url'] ?>" class="btn-primary txt-center"><?= $button['title'] ?></a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

    </div>

  </div>

<?php
  wp_reset_postdata();
endif;
?>