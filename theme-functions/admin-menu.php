<?php

function create_theme_options_page()
{
    add_menu_page('Opciones del Tema', 'Opciones del Tema', 'administrator', 'aum_theme_admin_menu', 'build_options_page', '', 90);
}
add_action('admin_menu', 'create_theme_options_page');

function build_options_page()
{ ?>
    <div id="theme-options-wrap">
        <div class="icon32" id="icon-tools"> <br /> </div>
        <h2>Opciones del Tema</h2>
        <p>Tome el control de su tema sobreescribiendo la configuración predeterminada con sus preferencias específicas.</p>
        <form method="post" action="options.php" enctype="multipart/form-data" class="theme-options-form">
            <div class="field-groups">
                <?php settings_fields('theme_options'); ?>
                <?php do_settings_sections('aum_theme_admin_menu'); ?>
            </div>
            <p class="submit">
                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Guardar Cambios'); ?>" />
            </p>
        </form>
    </div>
<?php
}

// Add stylesheet
function admin_register_head()
{
    $url = get_stylesheet_directory_uri() . '/theme-functions/options_page.css';
    $scripts = get_stylesheet_directory_uri() . '/theme-functions/options_page.js';
    echo "<link rel='stylesheet' href='$url' />";
    echo "<script type='text/javascript' src='$scripts'/>";
    wp_enqueue_media();
}
add_action('admin_head', 'admin_register_head');

function register_and_build_fields()
{
    /* 
    $option_group: a string representing the name of the settings group
    $option_name: the name of the option
    $sanitize_callback: a callback function that can handle any specific operations or sanitizing
    */

    register_setting('theme_options', 'theme_options', 'validate_setting');

    /* 
    $id: a unique ID for the section
    title: a heading that will be displayed above the fields on the page
    $callback: can handle the creation of the section; if it’s declared, you must create the function, or an error will be thrown
    $page: defines the type of settings page that this section should be applied to; in our case, it should apply to our custom page, so we used 'aum_theme_admin_menu' as the name
    */

    add_settings_section('page_options', 'Configuración de las Páginas Internas', 'section_pages', 'aum_theme_admin_menu', array(
        "section_class" => "section-tab",
        "before_section" => "<button class='tab-button'>Páginas Internas</button><div class='field-group'>",
        "after_section" => "</div>"
    ));

    add_settings_section('banner_footer', 'Configuración del Footer', 'section_footer', 'aum_theme_admin_menu', array(
        "section_class" => "section-tab",
        "before_section" => "<button class='tab-button'>Footer</button><div class='field-group'>",
        "after_section" => "</div>"
    ));

    add_settings_section('contact_info', 'Información de Contacto', 'section_contact_info', 'aum_theme_admin_menu', array(
        "section_class" => "section-tab",
        "before_section" => "<button class='tab-button'>Contacto</button><div class='field-group'>",
        "after_section" => "</div>"
    ));

    add_settings_section('social', 'Redes Sociales', 'section_social', 'aum_theme_admin_menu', array(
        "section_class" => "section-tab",
        "before_section" => "<button class='tab-button'>Redes Sociales</button><div class='field-group'>",
        "after_section" => "</div>"
    ));

    add_settings_section('banco', 'Datos Bancarios', 'section_banco', 'aum_theme_admin_menu', array(
        "section_class" => "section-tab",
        "before_section" => "<button class='tab-button'>Datos Bancarios</button><div class='field-group'>",
        "after_section" => "</div>"
    ));

    /* 
    $id: a unique ID for the attribute
    $title: the title of the field; this will essentially be the label for the input
    $callback: handles the creation of the input; from this function, we’ll echo out the necessary HTML
    $page: the type of settings page to which this section should be applied; again, in this case, we use 'aum_theme_admin_menu' as the name
    $section: the name of the section to which this field relates; we called ours banner_footer
    $args (optional): any additional arguments, passed as an array
    */
    //Internal Pages
    add_settings_field('default_cover_image', 'Imagen de Portada por Defecto', 'set_default_cover_image', 'aum_theme_admin_menu', 'page_options');

    //Footer Banner
    add_settings_field('toggle_footer_banner', 'Mostrar Banner', 'set_toggle_footer_banner', 'aum_theme_admin_menu', 'banner_footer');
    add_settings_field('banner_footer_heading', 'Encabezado del Banner', 'set_banner_footer_heading', 'aum_theme_admin_menu', 'banner_footer');
    add_settings_field('banner_footer_text', 'Texto del Banner', 'set_banner_footer_text', 'aum_theme_admin_menu', 'banner_footer');
    add_settings_field('banner_footer_button_link', 'Link del Botón', 'set_banner_footer_button_link', 'aum_theme_admin_menu', 'banner_footer');
    add_settings_field('banner_footer_button_text', 'Texto del Botón', 'set_banner_footer_button_text', 'aum_theme_admin_menu', 'banner_footer');
    add_settings_field('footer_menus_title', 'Título de la Columna de Menús', 'set_footer_menus_title', 'aum_theme_admin_menu', 'banner_footer');

    //Contact Info
    add_settings_field('contact_info_main_phone', 'Teléfono de Contacto', 'set_main_phone', 'aum_theme_admin_menu', 'contact_info');
    add_settings_field('contact_info_email', 'Correo Electrónico', 'set_email', 'aum_theme_admin_menu', 'contact_info');

    //Redes Sociales
    add_settings_field('social_fb_link', 'Facebook Link', 'set_fb_link', 'aum_theme_admin_menu', 'social');
    add_settings_field('social_x_link', 'X Link', 'set_x_link', 'aum_theme_admin_menu', 'social');
    add_settings_field('social_ig_link', 'Instagram Link', 'set_ig_link', 'aum_theme_admin_menu', 'social');
    add_settings_field('social_yt_link', 'YouTube Link', 'set_yt_link', 'aum_theme_admin_menu', 'social');

    //Datos Bancarios
    add_settings_field('heading_banco', 'Encabezado para Cuentas Bancarias', 'set_heading_banco', 'aum_theme_admin_menu', 'banco');
    add_settings_field('cuenta_principal', 'Cuenta Principal', 'set_cuenta_principal', 'aum_theme_admin_menu', 'banco');
    add_settings_field('cuenta_secundaria', 'Cuenta Secundaria', 'set_cuenta_secundaria', 'aum_theme_admin_menu', 'banco');
}
add_action('admin_init', 'register_and_build_fields');

function validate_setting($theme_options)
{
    return $theme_options;
}

function section_pages()
{
}

function section_footer()
{
}

function section_contact_info()
{
}

function section_banco()
{
}

function section_social()
{
}

// Internal Pages
function set_default_cover_image()
{
    $options = get_option('theme_options');
    $input_value = $options['default_cover_image'] ?? '';
    $style = $input_value !== '' ? '' : 'style="display:none"';


    echo "<div class='image-preview-wrapper'>";

    echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' id='image-placeholder'>
    <path d='M448 80c8.8 0 16 7.2 16 16l0 319.8-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3L48 96c0-8.8 7.2-16 16-16l384 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z'/>
    </svg>";

    echo  "<img id='image-preview' src='" . wp_get_attachment_url($input_value) . "' {$style}>";
    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="remove">
        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
        </svg>';

    echo "
    </div>
	<input id='upload_image_button' type='button' class='button' value='Seleccionar Imagen' />
	<input type='hidden' name='theme_options[default_cover_image]' id='default_cover_image' value='{$input_value}'>";
}

// Banner Footer
function set_toggle_footer_banner()
{
    $options = get_option('theme_options');
    echo "<input type='checkbox' name='theme_options[toggle_footer_banner]' value='1'". checked( 1, $options['toggle_footer_banner'], false ) ." id='toggle_footer_banner' />";
}

function set_banner_footer_heading()
{
    $options = get_option('theme_options');
    $input_value = $options['banner_footer_heading'] ?? '';
    echo "<input name='theme_options[banner_footer_heading]' type='text' value='{$input_value}' id='banner_footer_heading' />";
}

function set_banner_footer_text()
{
    $options = get_option('theme_options');
    $input_value = $options['banner_footer_text'] ?? '';
    echo "<input name='theme_options[banner_footer_text]' type='text' value='{$input_value}' id='banner_footer_text' />";
}

function set_banner_footer_button_link()
{
    $options = get_option('theme_options');
    $input_value = $options['banner_footer_button_link'] ?? '';
    echo "<input name='theme_options[banner_footer_button_link]' type='url' value='{$input_value}' placeholder='https://example.com' id='banner_footer_button_link' />";
}


function set_banner_footer_button_text()
{
    $options = get_option('theme_options');
    $input_value = $options['banner_footer_button_text'] ?? '';
    echo "<input name='theme_options[banner_footer_button_text]' type='text' value='{$input_value}'  id='banner_footer_button_text' />";
}

function set_footer_menus_title()
{
    $options = get_option('theme_options');
    $input_value = $options['footer_menus_title'] ?? '';
    echo "<input name='theme_options[footer_menus_title]' type='text' value='{$input_value}'  id='footer_menus_title' />";
}
//Contact Info
function set_main_phone()
{
    $options = get_option('theme_options');
    $input_value = $options['contact_info_main_phone'] ?? '';
    echo "<input name='theme_options[contact_info_main_phone]' type='phone' value='{$input_value}'  id='contact_info_main_phone' />";
}

function set_email()
{
    $options = get_option('theme_options');
    $input_value = $options['contact_info_email'] ?? '';
    echo "<input name='theme_options[contact_info_email]' type='mail' value='{$input_value}' id='contact_info_email' />";
}

//Contact Info
function set_heading_banco()
{
    $options = get_option('theme_options');
    $input_value = $options['heading_banco'] ?? '';
    echo "<input name='theme_options[heading_banco]' type='text' value='{$input_value}'  id='heading_banco' />";
}

function set_cuenta_principal()
{
    $options = get_option('theme_options');
    $input_value = $options['cuenta_principal'] ?? '';
    echo "<textarea name='theme_options[cuenta_principal]' id='cuenta_principal' />{$input_value}</textarea>";
}

function set_cuenta_secundaria()
{
    $options = get_option('theme_options');
    $input_value = $options['cuenta_secundaria'] ?? '';
    echo "<textarea name='theme_options[cuenta_secundaria]' id='cuenta_secundaria' />{$input_value}</textarea>";
}

//Social
function set_fb_link()
{
    $options = get_option('theme_options');
    $input_value = $options['social_fb_link'] ?? '';
    echo "<input name='theme_options[social_fb_link]' type='url' value='{$input_value}' placeholder='https://example.com' id='social_fb_link' />";
}
function set_x_link()
{
    $options = get_option('theme_options');
    $input_value = $options['social_x_link'] ?? '';
    echo "<input name='theme_options[social_x_link]' type='url' value='{$input_value}' placeholder='https://example.com' id='social_x_link' />";
}
function set_ig_link()
{
    $options = get_option('theme_options');
    $input_value = $options['social_ig_link'] ?? '';
    echo "<input name='theme_options[social_ig_link]' type='url' value='{$input_value}' placeholder='https://example.com' id='social_ig_link' />";
}
function set_yt_link()
{
    $options = get_option('theme_options');
    $input_value = $options['social_yt_link'] ?? '';
    echo "<input name='theme_options[social_yt_link]' type='url' value='{$input_value}' placeholder='https://example.com' id='social_yt_link' />";
}
