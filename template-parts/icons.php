<?php
$section_icons = get_field('iconos');
$toggle_section = $section_icons['mostrar_seccion'];

if ($toggle_section) :
    $icons = array($section_icons['primer_icono'], $section_icons['segundo_icono'], $section_icons['tercer_icono'], $section_icons['cuarto_icono']);
?>
    <section class="cont-icons">
        <div class="container icons-wrapper">
            <?php
            foreach ($icons as $icon) :
                $icon_image = $icon['icono']['mime_type'] === "image/svg+xml" ? file_get_contents($icon['icono']['url']) : '<img src="' . $icon['icono']['url'] . '>';
            ?>
                <div class="txt-center cont-icons__boxes flx-center">
                    <a href="<?= $icon['link']['url'] ?>" class="cont-icon">
                        <?= $icon_image ?>
                    </a>
                    <h3 class="heading"><?= $icon['encabezado'] ?></h3>
                    <p class="formatted-content"><?= $icon['contenido'] ?></p>
                    <a href="<?= $icon['link']['url'] ?>"><?= $icon['link']['title'] ?></a>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </section>

<?php endif ?>