<?php
/*
 * Plugin Name: Leave At Door for WooCommerce
 * Plugin URI: http://amplifyplugins.com
 * Description: Let customers request that a delivery is left at the door.
 * Version: 1.0.2
 * Author: Scott DeLuzio
 * Author URI: http://scottdeluzio.com
 * Requires at least: 4.4.0
 * WC requires at least: 3.0.0
 * Tested up to: 5.4.0
 * WC tested up to: 4.0.1
 *
 * Text Domain: leave-at-door-for-woocommerce
 * Domain Path: /languages/
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

 /**
 * The Main WC_Leave_At_Door class.
 **/
if ( ! class_exists( 'WC_Leave_At_Door' ) ) :

	class WC_Leave_At_Door {

		/**
		 * WC_Leave_At_Door Instance.
		 *
		 * @var WC_Leave_At_Door - the single instance of the class
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Main WC_Leave_At_Door Instance.
		 *
		 * Ensures only one instance of WC_Leave_At_Door is loaded or can be loaded.
		 *
		 * @static
		 * @see WC_Leave_At_Door()
		 * @return WC_Leave_At_Door - Main instance
		 * @since 1.0.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * WC_Leave_At_Door Constructor.
		 *
		 * @return WC_Leave_At_Door
		 * @since 1.0.0
		 */

		public function __construct() {

			// Always load translation files.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			// Include required files.
			$this->includes();

			// Settings Link for Plugin page.
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'add_action_link' ), 10, 2 );

			define( 'WLAD_PLUGIN_URL', plugins_url( '', __FILE__ ) );
			define( 'WLAD_PLUGIN_VERSION', '1.0.2' );

		}

		/**
		 * Load Localization files.
		 *
		 * @return void
		 * @since  1.0.0
		 */
		public function load_plugin_textdomain() {
			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'leave-at-door-for-woocommerce' );

			load_plugin_textdomain( 'leave-at-door-for-woocommerce', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @return void
		 * @since  1.0.0
		 */
		public function includes() {

			// Include checkout field settings.
			include_once  'includes/checkout-leave-at-door.php' ;
			include_once  'includes/save-display-customer-response.php' ;
			include_once  'includes/script-style.php' ;

			// include admin class to handle all backend functions
			if ( is_admin() ) {
				$this->admin_includes();
			}

		}

		/**
		 * Load the admin files.
	 *
		 * @return void
		 * @since  1.0.0
		 */
		public function admin_includes() {
			include_once  'includes/class-wc-leave-at-door-admin-settings.php' ;
		}

		/**
		 * 'Settings' link on plugin page
		 *
		 * @param array $links
		 * @return array
		 * @since 1.0.0
		 */
		public function add_action_link( $links ) {
			$settings_link = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=shipping&section=leave_at_door' ) . '" title="' . __( 'Go to the settings page', 'leave-at-door-for-woocommerce' ) . '">' . __( 'Settings', 'leave-at-door-for-woocommerce' ) . '</a>';
			return array_merge( (array) $settings_link, $links );
		}

	} //end class

endif; // end class_exists check

/**
 * Returns the main instance of WC_Leave_At_Door to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return WC_Leave_At_Door
 */
function WC_Leave_At_Door() {
	return WC_Leave_At_Door::instance();
}

// Launch the whole plugin.
add_action( 'plugins_loaded', 'WC_Leave_At_Door' );
