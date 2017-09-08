<?php
/**
 * Plugin Name: ARMS
 * Description: Animal Rescue Management System
 * Version:     0.0.1
 * Author:      Aaron Graham
 * Author URI:  https://coderaaron.com
 * License:     GPLv2 or later
 *
 * @package arms
 */

// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'ARMS_VERSION', '0.0.1' );
define( 'ARMS__MINIMUM_WP_VERSION', '3.7' );
define( 'ARMS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'ARMS', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'ARMS', 'plugin_deactivation' ) );

require_once( ARMS__PLUGIN_DIR . 'class-arms.php' );

add_action( 'init', array( 'ARMS', 'init' ) );
