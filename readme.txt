=== Leave At Door For WooCommerce ===
Contributors: scott.deluzio, ampmode
Tags: plugin, woocommerce, checkout, delivery, restaurant
Requires at least: 3.0
Tested up to: 6.0.1
Stable tag: 1.1.2
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Adds an option at checkout for the customer to request that their order is left at the door.

== Description ==
If you run a restaurant or a store that offers local delivery your customers may not want to open the door to receive the delivery. With social distancing, customers may be weary about opening the door to a delivery driver.

This plugin gives a small checkbox just before the Place Order button at checkout that asks customers if they would like their order left at the door.

If the customer checks this box, a text input is revealed where they can optionally leave additional instructions (leave the order at the side door, or near the garage).

Whatever the customer enters will be displayed in three places:

1. The admin order edit screen just below the billing address section.
2. The order email just below the order table.
3. The order invoice that the customer sees after completing their order.

It is possible to add this information to other places as well by adding our function to your template.

In the plugin's settings you can choose which shipping methods enable the "leave at door" option to be displayed on the checkout page. For example, you may not need this to be displayed if you are shipping a package with UPS, but you might if you are delivering the order locally. In this case you would enable the "leave at door" option just for your local delivery option.

This plugin requires your site to have WooCommerce installed in order to work. It is not compatible with other e-commerce plugins.

== Installation ==
1. Download archive and unzip in wp-content/plugins or install via Plugins > Add New.
2. Activate the plugin through the Plugins menu in WordPress.
3. In your WordPress dashboard, click on WooCommerce > Settings > Shipping tab > Leave At Door.
4. Select the shipping method(s) that would prompt the leave at door option to be displayed.

== Screenshots ==
1. Leave at door option at checkout. When the checkbox is checked, it reveals an optional "Instructions for delivery driver" text box.
2. On the customer's order details, the leave at door option will be displayed, indicating that the customer wishes for the order to be left at the door and delivery instructions, if any.
3. The leave at door instructions are also displayed on the edit order screen in the admin.

== Changelog ==
= 1.1.2 =
* Updated tested up to versions of WP and WooCommerce.

= 1.1.1 =
* Updated tested up to versions.
* Added Contributors.

= 1.1.0 =
* Added option to enable the "leave at door" checkbox to be checked by default on the checkout page.

= 1.0.6 =
* Updated tested up to versions.

= 1.0.5 =
* Added error handling for when no shipping methods are set.

= 1.0.4 =
* Added new filter `wc_leave_at_door_custom_display` for custom conditions to control whether or not the leave at door option is displayed on the checkout page.

= 1.0.3 =
* Fixed plugin textdomain for translations.
* Updated POT file for translations.
* Minor formatting updates.

= 1.0.2 =
* Fix: Sanitized values from form inputs.
* Update: Removed unnecessary commented out code.

= 1.0.1 =
* Added settings link to plugin page.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==
= 1.1.2 =
* Updated tested up to versions of WP and WooCommerce.