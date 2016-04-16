<?php
/**
* Plugin Name: Preloader SWS
* Description: Add preloader to your website. This plugin gives to select a lot of cool preloaders (100+). Most of them are extremely awesome!
* Version: 1.2.1
* Author: Alex Space
* Author URI: spwanderer@mail.ru
*/

define( 'SWS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SWS_PLUGIN_URL', __FILE__ );
define( 'SWS_PLUGIN_NAME', 'Preloader SWS' );

require_once( SWS_PLUGIN_DIR .  'includes/admin_assets.php' );
require_once( SWS_PLUGIN_DIR .  'includes/frontend-assets.php' );
require_once( SWS_PLUGIN_DIR .  'includes/sws-preloader-settings.php' );
require_once( SWS_PLUGIN_DIR .  'includes/view.php' );