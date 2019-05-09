<?php

/*
  Plugin Name: LAMANU-cookie-law
  Version: 0.1
  Plugin URI: https://www.lamanu.fr
  Description: WordPress Plugin for european cookie law.
  Author: LA MANU
  Author URI: https://www.lamanu.fr
 */

//Ajout du lien de manu de configuraton dans l'admin de Wordpress
add_action('admin_menu', 'LAMANU_admin_menu');
add_action('admin_init', 'register_settings');
//Chargement dans la balise head de la fonction LAMANU_scripts
add_action('wp_head', 'LAMANU_scripts');

/**
 * Ce n'est pas dans les exercices. C'est à titre d'exemple pour les formateurs !!!!!! 
 *  Ajout d'un widget pour Facebook.
 */
include_once plugin_dir_path(__FILE__) . '/cookie/LAMANU_facebook_Widget.php';
add_action('widgets_init', function() {
    register_widget('LAMANU_facebook_Widget');
});

/**
 * Fin d'ajout de ce qui n'est pas dans les exercices !!!!!
 */
function LAMANU_scripts() {
    //initialisation du script Tarte au citron
    echo '<script type="text/javascript" src="' . plugin_dir_url(__FILE__) . 'js/tarteaucitron/tarteaucitron.js"></script>

        <script type="text/javascript">
        tarteaucitron.init({
            "hashtag": "#tarteaucitron",
            "highPrivacy": false,
            "orientation": "bottom",
            "adblocker": false,
            "showAlertSmall": true,
            "cookieslist": true,
            "removeCredit": false
        });
        tarteaucitron.user.analyticsUa = \'' . get_option('google_analytics', 'UA-00000000-0') . '\';
        tarteaucitron.user.analyticsMore = function () { /* add here your optionnal ga.push() */
};
        </script>
        <script type="text/javascript" src="'.plugin_dir_url( __FILE__ ).'js/googleAnalytics.js"></script>';
}

//fonction pour la création du lien de menu.
function LAMANU_admin_menu() {
    add_menu_page('Page de configuration du plugin de gestion des cookies', 'Gestion des cookies', 'manage_options', 'Configuration', 'LAMANU_admin_menu_page');
}

//fonction permettant de faire des champs dans la partie admin.
function register_settings() {
    //décalaration du champ pour récupérer l'UA du compte Google Analytics. Il faut le mettre en liste blanche pour que WP l'enregistre en base.
    register_setting('LAMANU_GoogleAnalytics', 'google_analytics');
}

//fonction permettant de charger la vue de la page de configuration.
function LAMANU_admin_menu_page() {
    require_once( plugin_dir_path(__FILE__) . 'view/option.php' );
}
