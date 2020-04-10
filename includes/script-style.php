<?php
/**
 * Register JS and CSS.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register JS and CSS on checkout page only.
 */
function wcad_checkout_scripts_styles() {
	if ( is_checkout() ) {
		wp_enqueue_script( 'leave-at-door-scripts', WLAD_PLUGIN_URL . '/js/leave-at-door.js', array(), WLAD_PLUGIN_VERSION );
		wp_register_style( 'leave-at-door-styles', WLAD_PLUGIN_URL . '/css/leave-at-door.css', array(), WLAD_PLUGIN_VERSION );
		wp_enqueue_style( 'leave-at-door-styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'wcad_checkout_scripts_styles' );
