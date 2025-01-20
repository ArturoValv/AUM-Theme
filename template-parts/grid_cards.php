<?php
$section_grid = get_field('cuadricula_de_contenido');
$toggle_section = $section_grid['mostrar_seccion'];
$title = '<' . $section_grid['tag_del_titulo'] . ' class="txt-center section-title">' . $section_grid['titulo'] . '</' . $section_grid['tag_del_titulo'] . '>';

if ($toggle_section) :
?>

    <div class="cont-grid">
        <?= $title ?>
        <div class="container">
            <div class="cont-grid__wrapper">
                <?php
                $cards = array($section_grid['primer_cuadro'], $section_grid['segundo_cuadro'], $section_grid['tercer_cuadro'], $section_grid['cuarto_cuadro']);
                foreach ($cards as $card) :
                ?>
                    <div class="cont__cards">
                        <div class="bg-img">
                            <img src="<?= $card['imagen_de_fondo']['url'] ?>" alt="<?= $card['imagen_de_fondo']['alt'] ?>">
                            <div class="bg-screen">
                                <div class="border-blue">
                                    <h3 class="txt-center heading"><?= $card['encabezado'] ?></h3>
                                    <p class="txt-center tx">
                                        <?= $card['contenido'] ?>
                                    </p>
                                    <a href="<?= $card['link']['url'] ?>"><?= $card['link']['title'] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>

<?php endif ?>