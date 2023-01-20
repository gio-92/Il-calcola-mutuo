<?php
/*
Plugin Name: Il Calcola Mutuo
Author: Giorgio Gabatel
Description: Il Calcola Mutuo è un plugin pensato per calcolare le rate del mutuo con relativo piano di ammortamento alla francese.
Version: 2.0.0
*/

// Importare script e fogli di stile
function il_calcola_mutuo_script()
{
    // Aggiungi un file CSS
    wp_enqueue_style('style-css', plugin_dir_url(__FILE__) . 'asset/css/style.css');

    // Aggiungi un file JS
    wp_enqueue_script('script-js', plugin_dir_url(__FILE__) . 'asset/js/script.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'il_calcola_mutuo_script');

// Importare le impostazioni di attivazione del plugin con relative options
require_once plugin_dir_path(__FILE__) . "activation.php";
register_activation_hook(__FILE__, array('Il_calcola_mutuo_activation', 'activate'));

// Importare le impostazioni di disattivazione del plugin con relative options
require_once plugin_dir_path(__FILE__) . "deactivation.php";
register_deactivation_hook( __FILE__, array( 'Il_calcola_mutuo_deactivation', 'deactivate'));

// Importare le notices con le istruzioni del plugin
require_once plugin_dir_path(__FILE__) . "notices.php";

// Importare shortcode con Form HTML
require_once plugin_dir_path(__FILE__) . "shortcode.php";

// Importare il menu del plugin
require_once plugin_dir_path(__FILE__) . "menu.php";