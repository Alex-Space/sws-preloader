<?php
/*
Plugin Name: Spaceliquis preloader
Description: Add preloader to your pages
Version: 1.0
Author: Alex Space
Author URI: http://spaceliquis.tk
*/
define('SPL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SPL_PLUGIN_URL', __FILE__);
define('SPL_PLUGIN_NAME', 'Spaceliquis preloader');

add_action( 'admin_menu', 'spl_admin_menu' );

function spl_admin_menu() {
 add_options_page(
  'Свойства' . SPL_PLUGIN_NAME, // заголовок страницы, title
  SPL_PLUGIN_NAME, // название пункта меню
  8, // права доступа к странице setting
  SPL_PLUGIN_URL, // слаг для url, можно здесь указать FILE, тогда в адресе просто будет название папки с плагином и название файла плагина
  'spl_option_page' // функция генерации элементов, полей для страницы
 );
}

function spl_option_page() {
 include __DIR__ . '/options.php';
}


if ( ! is_admin() ) {
  wp_enqueue_script( 'preloader',  plugins_url('assets/js/spl_preloader.js', __FILE__), array('jquery'));
  wp_enqueue_style( 'preloader',  plugins_url('assets/css/spl_preloader.css', __FILE__));

  $preloader = '<div style="background: #676d89 url(\''.plugins_url('assets/img/sp_loader.gif', __FILE__).'\') no-repeat center;" class="preloader"></div>';
  echo $preloader;
}
