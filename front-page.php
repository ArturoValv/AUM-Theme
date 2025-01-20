<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();

global $post;

//Obtiene todos los fields de una pagina
$fields = get_fields($post->ID);
$ordered_fields = array();

//Asocia el numero de orden de seccion con el nombre de la seccion y los guarda en un arreglo
foreach ($fields as $key => $field) {
    $section_order = isset($field['orden_de_seccion']) ? $field['orden_de_seccion'] : 0;
    if (empty($ordered_fields[$section_order])) {
        $ordered_fields[$section_order] = $key;
    } else {

        $value = $ordered_fields[$section_order];
        if (gettype($value) !== "array") {
            $ordered_fields[$section_order] = array();
            array_push($ordered_fields[$section_order], $value);
        }

        array_push($ordered_fields[$section_order], $key);
    }
}

//Ordena el arreglo de secciones
ksort($ordered_fields);

//Imprime una template part dado el nombre de la seccion proporcionada
function printTemplatePart($key)
{
    switch ($key) {
        case 'cover':
            get_template_part('template-parts/cover');
            break;

        case 'dos_columnas':
            get_template_part('template-parts/two_columns');
            break;

        case 'iconos':
            get_template_part('template-parts/icons');
            break;

        case 'maestros':
            get_template_part('template-parts/carousel');
            break;

        case 'cuadricula_de_contenido':
            get_template_part('template-parts/grid_cards');
            break;

        case 'articulos':
            get_template_part('template-parts/articles');
            break;

        case 'eventos':
            get_template_part('template-parts/events');
            break;

        case 'carrusel_de_imagenes':
            get_template_part('template-parts/pictures_carousel');
            break;

        default:
            break;
    }
}

//Itera el arreglo de secciones para llamar a la funcion que imprime las template parts
foreach ($ordered_fields as $key) {
    if (gettype($key) === "array") {
        foreach ($key as $value) {
            printTemplatePart($value);
        }
    } else {
        printTemplatePart($key);
    }
}
?>


<?php get_footer() ?>