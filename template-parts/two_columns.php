<?php
$section_cols = get_field('dos_columnas');
$toggle_section = $section_cols['mostrar_seccion'];

if ($toggle_section) :
?>

    <section class="cont-about container">
        <div class="cont-about__text">
            <<?= $section_cols['tag_del_titulo'] ?> class="section-title"><?= $section_cols['titulo'] ?></<?= $section_cols['tag_del_titulo'] ?>>
            <div class="formatted-text">
                <?= $section_cols['contenido'] ?>
            </div>

            <a href="<?= $section_cols['boton']['url'] ?>" class="btn-primary"><?= $section_cols['boton']['title'] ?></a>

        </div>
        <div class="cont-about__img">
            <img src="<?= $section_cols['imagen']['url'] ?>" alt="<?= $section_cols['imagen']['alt'] ?>" />
        </div>
    </section>

<?php endif ?>