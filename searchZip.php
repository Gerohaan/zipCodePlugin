<?php
/**
 * Plugin Name: Search zip code
 * Plugin URI: https://ingeniados.com/
 * Description: Search for already registered zip codes.
 * Version: 1.0.0
 * Author: by Gerohaan Torrealba for Ingeniados.com 
 * Author URI: https://gerohaan-torrealba.netlify.app/
 * License: 
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
///Start
require_once plugin_dir_path(__FILE__) . '/includes/searchFunction.php';
if (!defined('ABSPATH')) {
    exit;
}
function ob_start_buffer() {
    ob_start();
}
// admin
function activate(){
    global $wpdb;
    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}listZip(
        `id` INT NOT NULL AUTO_INCREMENT,
        `zip` VARCHAR(150) NOT NULL ,
        PRIMARY KEY (`id`)
    )
    ";
    $wpdb->query($sql);
}
function desactivate(){
}
register_activation_hook(__FILE__, 'activate');
register_deactivation_hook(__FILE__, 'desactivate');
add_action('admin_menu', 'createMenu');

function createMenu(){
    add_menu_page(
        'Zip GT', // Title page
        'Zip code list', // Title Menu
        'manage_options', // Capability
        plugin_dir_path(__FILE__).'/includes/listRegistered.php', //Slug
        null,  // Get Content Page Menu
        plugin_dir_url(__FILE__).'/assets/img/zipWhite.png', // Icon Url
        '1', // Position
    );

}
function enqueueBootstrapJs($hook){
    if($hook != 'searchZip/includes/listRegistered.php'){
        return;
    }
    wp_enqueue_script('bootstrapJs',plugins_url('/assets/bootstrap/js/bootstrap.min.js', __FILE__),array('jquery'));
}
function enqueueBootstrapCss($hook){
    if($hook != 'searchZip/includes/listRegistered.php'){
        return;
    }
    wp_enqueue_style('bootstrapCss',plugins_url('/assets/bootstrap/css/bootstrap.min.css', __FILE__));
}
function enqueueBootstrapCssPage(){
    /* if(is_page('pagina-ejemplo')){
        wp_enqueue_style('bootstrapCss',plugins_url('/assets/bootstrap/css/bootstrap.min.css', __FILE__));
    } */
    wp_enqueue_style('bootstrapCss',plugins_url('/assets/bootstrap/css/bootstrap.min.css', __FILE__));
}

// enqueue custom js

function enqueueJsC($hook){
    if($hook != 'searchZip/includes/listRegistered.php'){
        return;
    }
    wp_enqueue_script('jsForen',plugins_url('/assets/js/listRegistered.js', __FILE__),array('jquery'));
}
add_action('admin_enqueue_scripts','enqueueBootstrapCss');
add_action('wp_enqueue_scripts', 'enqueueBootstrapCssPage');
add_action('admin_enqueue_scripts','enqueueBootstrapJs');
add_action('admin_enqueue_scripts','enqueueJsC');
// admin end

// Función para registrar el shortcode del formulario de búsqueda
function register_search_zip_shortcode() {
    add_shortcode('searchZip', 'search_zip_shortcode');
}
add_action('init', 'register_search_zip_shortcode');
add_action('init', 'ob_start_buffer');
add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email ) {
return "itermi@itermi.webdrafts.cloud";
}
add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
function my_mail_from_name( $name ) {
return "Itermi";
}