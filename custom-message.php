<?php
/*
Plugin Name: Custom Message Plugin
Description: A simple plugin to display a custom message for logged-in users.
Version: 1.0
Author: Omar ElHawary
Author URI: https://github.com/omaraelhawary
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once plugin_dir_path( __FILE__ ) . 'inc/admin-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/frontend-functions.php';

// Initialize classes
CustomMessageAdmin::init();
CustomMessageFrontend::init();