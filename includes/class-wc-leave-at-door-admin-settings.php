<?php
/**
 * Leave At Door Admin Menu.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Leave_At_Door_Admin_Settings' ) ) {
	class WC_Leave_At_Door_Admin_Settings {
		public function __construct() {
			add_filter( 'woocommerce_get_sections_shipping', array( $this, 'add_advanced_settings_section_tab' ) );
			add_action( 'woocommerce_get_settings_shipping', array( $this, 'get_settings' ), 10, 2 );
		}

		public function add_advanced_settings_section_tab( $section ) {
			$section['leave_at_door'] = __( 'Leave At Door', 'leave-at-door-for-woocommerce' );

			return $section;
		}
		/**
		 * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
		 *
		 * @return array Array of settings for @see woocommerce_admin_fields() function.
		 */
		public static function get_settings( $settings, $current_section ) {
			if ( 'leave_at_door' === $current_section  ) {
				$settings = array(
					'section_title'	=> array(
						'name'	=> __( 'Leave At Door', 'leave-at-door-for-woocommerce' ),
						'type'	=> 'title',
						'desc'	=> __( 'Select which shipping options should enable customers to request that their order is left at the door.', 'leave-at-door-for-woocommerce' ),
						'id'	=> 'leave_at_door_section_title'
					),
					'section_end'	=> array(
						'type'		=> 'sectionend',
						'id'		=> 'leave_at_door_section_end'
					)
				);

				/**
				 * Add in shipping methods at the top of the settings but below the main title.
				 */
				$zone = new WC_Shipping_Zones();

				foreach ( $zone->get_zones() as $key => $shipping_zone ) {
					foreach ( $shipping_zone['shipping_methods'] as $id => $method ) {
						$shipping_methods[ $method->id . ':' . $id] = array(
							'name' => $shipping_zone['zone_name'] . ' - ' . $method->title,
							'type' => 'checkbox',
							'desc' => '',
							'id'   => 'wc_leave_at_door_' . $method->id . ':' . $id,
						);
					}
				}
				// Adds shipping methods to the settings above.
				array_splice( $settings, 1, 0, $shipping_methods );
			}
			return apply_filters( 'leave_at_door_settings_fields', $settings );
		}
	}
	$GLOBAL['wc_leave_at_door'] = new WC_Leave_At_Door_Admin_Settings();
}
