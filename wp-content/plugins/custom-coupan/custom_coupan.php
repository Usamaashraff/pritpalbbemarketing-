<?php
/*
Plugin Name: Custom Coupan 
Plugin URI: #
Description: Custom Coupan plugin  
Version: 1.0
Author: Usama Ashraf
Author URI: #
License: GPLv2 or later
Text Domain: custom-coupon
*/

define('COUPON_PLUGIN_URL', dirname(__FILE__) );
define( 'COUPON_PLUGIN_URL_VERSION', '1.0.0' );
require_once (COUPON_PLUGIN_URL.'/inc/admin/admin_backend.php');
require_once (COUPON_PLUGIN_URL.'/inc/frontend/frontend.php');

$backend = new Backend();
$backend->plugin_init();

$frontend = new Frontend();
$frontend->plugin_init_frontend();