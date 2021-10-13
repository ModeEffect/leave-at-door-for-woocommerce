<?php
/**
 * Leave At Door Checkout Fields.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display fields on checkout page.
 */
function wlad_checkout_options() {
	$chosen_methods     = WC()->session->get( 'chosen_shipping_methods' );
	$chosen_shipping    = $chosen_methods[0];

	$leave_at_door      = __( 'Leave At Door', 'leave-at-door-for-woocommerce' );
	$leave_at_door_text = (string) apply_filters( 'leave_at_door_text', $leave_at_door );

	$instructions       = __( 'Instructions for delivery driver', 'leave-at-door-for-woocommerce' );
	$instructions_text  = (string) apply_filters( 'leave_at_door_delivery_instructions', $instructions );

	$custom_display     = (bool) apply_filters( 'wc_leave_at_door_custom_display', true, WC()->session );
	// Loop through shipping packages from WC_Session (They can be multiple in some cases).
	foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
		// Check if a shipping for the current package exist.
		if ( WC()->session->__isset( 'shipping_for_package_' . $package_id ) ) {
			// Loop through shipping rates for the current package.
			foreach ( WC()->session->get( 'shipping_for_package_' . $package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
				$rate_id = $shipping_rate->get_id(); // same thing that $shipping_rate_id variable (combination of the shipping method and instance ID).

				if ( $chosen_shipping == $rate_id && $custom_display ) {
					if ( 'yes' == get_option( 'wc_leave_at_door_' . $rate_id ) ) {
						// Add a checkbox field.
						woocommerce_form_field( 'leave_at_door_checkbox', array(
							'type'				=> 'checkbox',
							'default'			=> ( 'yes' == get_option( 'wc_leave_at_door_default_checked' ) ) ? 1 : 0,
							'class'				=> array( 'form-row-wide' ),
							'label'				=> $leave_at_door_text,
							'custom_attributes'	=> array( 'onclick' => 'revealDeliveryInstructions()' ),
						) );
						// Add a text field.
						if ( 'yes' == get_option( 'wc_leave_at_door_default_checked' ) ) {
							// Displays the text field on page load without having to interact with the checkbox, which is already checked.
							$class = array( 'form-row-wide', 'leave_at_door_instructions_display' );
						} else {
							// Hides the text field on page load since the checkbox is not yet checked.
							$class = array( 'form-row-wide', 'leave_at_door_instructions' );
						}
						woocommerce_form_field( 'leave_at_door_instructions', array(
							'type'				=> 'text',
							'class'				=> $class,
							'label'				=> $instructions_text,
						), '' );
						return;
					}
				}
			}
		}
	}
}
add_action( 'woocommerce_review_order_before_submit', 'wlad_checkout_options' );
