<?php
/**
* Package Pays
* Version 1.0.0
*/
/*
Plugin name: pays.js
Plugin uri: https://github.com/eddytuto
Version: 1.0.0
Description: Permet d'afficher les destinations par pays.
*/
header("Access-Control-Allow-Origin: http://localhost:8080");
 
function efp_enqueue()
{
    // filemtime // retourne en milliseconde le temps de la dernière modification
    // plugin_dir_path // retourne le chemin du répertoire du plugin
    // __FILE__ // le fichier en train de s'exécuter
    // wp_enqueue_style() // Intègre le link:css dans la page
    // wp_enqueue_script() // intègre le script dans la page
    // wp_enqueue_scripts // le hook
 
    $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/pays.js");
    wp_enqueue_style('em_plugin_efp_css',
        plugin_dir_url(__FILE__) . "style.css",
        array(),
        $version_css);
 
    wp_enqueue_script('em_plugin_efp_js',
        plugin_dir_url(__FILE__) . "js/pays.js",
        array(),
        $version_js,
        true);
 
    // Passer les pays IDs à JavaScript
    wp_localize_script('em_plugin_efp_js', 'countryData', array(
        'France' => 1,
        'États-Unis' => 2,
        'Canada' => 3,
        'Argentine' => 4,
        'Chili' => 5,
        'Belgique' => 6,
        'Maroc' => 7,
        'Mexique' => 8,
        'Japon' => 9,
        'Italie' => 10,
        'Islande' => 11,
        'Chine' => 12,
        'Grèce' => 13,
        'Suisse' => 14,
        // Ajouter plus de pays si nécessaire
    ));
}
add_action('wp_enqueue_scripts', 'efp_enqueue');
 
/* Création de la liste des destinations en HTML */
function creation_pays()
{
    $contenu = '<div class="country-menu">
                    <button class="country-button" data-country="France">France</button>
                    <button class="country-button" data-country="États-Unis">États-Unis</button>
                    <button class="country-button" data-country="Canada">Canada</button>
                    <button class="country-button" data-country="Argentine">Argentine</button>
                    <button class="country-button" data-country="Chili">Chili</button>
                    <button class="country-button" data-country="Belgique">Belgique</button>
                    <button class="country-button" data-country="Maroc">Maroc</button>
                    <button class="country-button" data-country="Mexique">Mexique</button>
                    <button class="country-button" data-country="Japon">Japon</button>
                    <button class="country-button" data-country="Italie">Italie</button>
                    <button class="country-button" data-country="Islande">Islande</button>
                    <button class="country-button" data-country="Chine">Chine</button>
                    <button class="country-button" data-country="Grèce">Grèce</button>
                    <button class="country-button" data-country="Suisse">Suisse</button>
                    <!-- Add more buttons for additional countries as needed -->
                </div>
                <div class="contenu__restapi">
                </div>';
    return $contenu;
}
 
add_shortcode('em_pays', 'creation_pays');
?>