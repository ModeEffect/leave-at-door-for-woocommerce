<?php
/**
 * Saves customer response at checkout and displays the customer's input in various locations.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Process the checkout.
 */
function wc_leave_at_door_update_order_meta( $order_id ) {
	/**
	 * Nonce check.
	 */
	if ( isset( $_REQUEST ) && isset( $_REQUEST['woocommerce-process-checkout-nonce'] ) ) {
		$nonce_value = sanitize_text_field( $_REQUEST['woocommerce-process-checkout-nonce'] );
		if ( empty( $nonce_value ) || ! wp_verify_nonce( $nonce_value, 'woocommerce-process_checkout' ) ) {
			return;
		}
	}

	/**
	 * Process checkbox field.
	 * Checkbox will return 1 if checked. We want to save "Yes" instead.
	 */
	if ( isset( $_POST[ 'leave_at_door_checkbox' ] ) ) {
		$customer_input = sanitize_text_field( $_POST[ 'leave_at_door_checkbox' ] );
		if ( 1 == $customer_input ) {
			add_post_meta( $order_id, 'leave_at_door_checkbox', esc_html__( 'Yes', 'leave-at-door-for-woocommerce' ) );
		}
	}

	/**
	 * Process delivery instructions.
	 */
	if ( isset( $_POST[ 'leave_at_door_instructions' ] ) ) {
		$customer_input = sanitize_text_field( $_POST[ 'leave_at_door_instructions' ] );
		add_post_meta( $order_id, 'leave_at_door_instructions', $customer_input );
	}
}
add_action( 'woocommerce_checkout_update_order_meta', 'wc_leave_at_door_update_order_meta' );


function wc_leave_at_door_display_admin_order( $order ) {
	$leave_at_door = get_post_meta( $order->get_id(), 'leave_at_door_checkbox', true );
	$instructions  = get_post_meta( $order->get_id(), 'leave_at_door_instructions', true );

	if ( $leave_at_door ) {
		echo '<h3>' . esc_html__( 'Leave At Door', 'leave-at-door-for-woocommerce' ) . '</h3>';
		echo '<ul>
		<li><strong>' . esc_html__( 'Customer wishes for their order to be left at the door', 'leave-at-door-for-woocommerce' ) . '</strong></li>';
		if ( $instructions ) {
			echo '<li><strong>' . esc_html__( 'Delivery instructions: ', 'leave-at-door-for-woocommerce' ) . '</strong>' . esc_html( $instructions ) . '</li>';
		}
		echo '</ul>';
	}
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wc_leave_at_door_display_admin_order' );
add_action( 'woocommerce_email_after_order_table', 'wc_leave_at_door_display_admin_order' );
add_action( 'woocommerce_order_details_after_order_table', 'wc_leave_at_door_display_admin_order' );
