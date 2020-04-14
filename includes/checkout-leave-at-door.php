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
	$chosen_methods  = WC()->session->get( 'chosen_shipping_methods' );
	$chosen_shipping = $chosen_methods[0];

	$leave_at_door      = __( 'Leave At Door', 'leave_at_door_for_woocommerce' );
	$leave_at_door_text = (string) apply_filters( 'leave_at_door_text', $leave_at_door );

	$instructions      = __( 'Instructions for delivery driver', 'leave_at_door_for_woocommerce' );
	$instructions_text = (string) apply_filters( 'leave_at_door_delivery_instructions', $instructions );

	// Loop through shipping packages from WC_Session (They can be multiple in some cases).
	foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
		// Check if a shipping for the current package exist.
		if ( WC()->session->__isset( 'shipping_for_package_' . $package_id ) ) {
			// Loop through shipping rates for the current package.
			foreach ( WC()->session->get( 'shipping_for_package_' . $package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
				$rate_id = $shipping_rate->get_id(); // same thing that $shipping_rate_id variable (combination of the shipping method and instance ID).

				if ( $chosen_shipping == $rate_id ) {
					if ( 'yes' == get_option( 'wc_leave_at_door_' . $rate_id ) ) {
							// Add a checkbox field
							woocommerce_form_field( 'leave_at_door_checkbox', array(
								'type'        => 'checkbox',
								'class'       => array( 'form-row-wide' ),
								'label'       => $leave_at_door_text,
								'custom_attributes' => array( 'onclick' => 'revealDeliveryInstructions()' ),
							), '' );
							woocommerce_form_field( 'leave_at_door_instructions', array(
								'type'        => 'text',
								'class'       => array( 'form-row-wide', 'leave_at_door_instructions' ),
								'label'       => $instructions_text,
							), '' );
						return;
					}
				}
			}
		}
	}
}
add_action( 'woocommerce_review_order_before_submit', 'wlad_checkout_options' );
