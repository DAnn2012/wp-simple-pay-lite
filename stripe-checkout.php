<?php
/**
 * Plugin Name: WP Simple Pay Lite for Stripe
 * Plugin URI:  https://wpsimplepay.com
 * Description: Add high conversion Stripe checkout forms to your WordPress site and start accepting payments in minutes.
 * Author:      Moonstone Media
 * Author URI:  https://wpsimplepay.com
 * Version:     1.5.0
 * Text Domain: sc
 * Domain Path: /i18n
 *
 * @copyright   2015 Moonstone Media/Phil Derksen. All rights reserved.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Setup plugin constants.

// Plugin version
if ( ! defined( 'SIMPAY_VERSION' ) ) {
	define( 'SIMPAY_VERSION', '1.5.0' );
}

// Plugin folder path
// TODO SIMPAY_PLUGIN_DIR
if ( ! defined( 'SC_DIR_PATH' ) ) {
	define( 'SC_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Plugin folder URL
// TODO SIMPAY_PLUGIN_URL
if ( ! defined( 'SC_DIR_URL' ) ) {
	define( 'SC_DIR_URL', plugin_dir_url( __FILE__ ) );
}

// Plugin root file
// TODO SIMPAY_PLUGIN_FILE
if ( ! defined( 'SC_PLUGIN_FILE' ) ) {
	define( 'SC_PLUGIN_FILE', __FILE__ );
}

// Base URL
// TODO SIMPAY_BASE_URL
if ( ! defined( 'SC_WEBSITE_BASE_URL' ) ) {
	define( 'SC_WEBSITE_BASE_URL', 'https://wpsimplepay.com/' );
}

// Plugin requirements

$stripe_checkout_requires = array(
	'wp'  => '4.0.0',
	'php' => '5.3.3',
	'ext' => array( 'curl', 'json', 'mbstring' ),
);

if ( ! defined( 'SC_REQUIRES' ) ) {
	define( 'SC_REQUIRES', serialize( $stripe_checkout_requires ) );
}

// Check plugin requirements.
include_once 'stripe-checkout-requirements.php';
$stripe_checkout_requirements = new Stripe_Checkout_Requirements( $stripe_checkout_requires );
if ( $stripe_checkout_requirements->pass() === false ) {

	$stripe_checkout_fails = $stripe_checkout_requirements->failures();
	if ( isset( $stripe_checkout_fails['wp'] ) || isset( $stripe_checkout_fails['php']) ) {

		// Display an admin notice if running old WordPress or PHP.
		function stripe_checkout_plugin_requirements() {
			$required = unserialize( SC_REQUIRES );
			global $wp_version;
			echo '<div class="error">' .
			        '<p>'  .
					     sprintf(
						     __( 'WP Simple Pay requires PHP %1$s and WordPress %2$s to function properly. PHP version found: %3$s. WordPress installed version: %4$s. Please upgrade to meet the minimum requirements. <a href="http://www.wpupdatephp.com/update/" target=_blank">Read more on why it is important to stay updated.</a>', 'stripe' ),
						     $required['php'],
						     $required['wp'],
						     PHP_VERSION,
						     $wp_version
					     ) .
			        '</p>' .
			     '</div>';
		}
		add_action( 'admin_notices', 'stripe_checkout_plugin_requirements' );

	}

	if ( isset( $stripe_checkout_fails['ext'] ) ) {

		// Display a notice if extensions are not found.
		function stripe_checkout_plugin_extensions() {
			$required = unserialize( SC_REQUIRES );
			$extensions = '<code>' . implode( ', ', $required['ext'] ) . '</code>';
			echo '<div class="error"><p>' . sprintf( __( 'WP Simple Pay requires the following PHP extensions to work: %s. Please make sure they are installed or contact your host.', 'stripe' ), $extensions ) . '</p></div>';
		}
		add_action( 'admin_notices', 'stripe_checkout_plugin_extensions' );

	}

	// Halt the rest of the plugin execution if PHP check fails or extensions not found.
	if ( isset( $stripe_checkout_fails['php'] ) || isset( $stripe_checkout_fails['ext'] ) ) {
		return;
	}

}

// Load the plugin.
require_once SC_DIR_PATH . 'classes/class-stripe-checkout-shared.php';

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( SC_PLUGIN_FILE, array( 'Stripe_Checkout', 'activate' ) );

// Set up global holding the base class instance so we can easily use it throughout
global $base_class;

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'stripe-checkout-pro/stripe-checkout-pro.php' ) ) {
	deactivate_plugins( 'stripe-checkout-pro/stripe-checkout-pro.php' );

	function sc_deactivate_lite_notice() {
		echo '<div class="error"><p>' . __( 'You cannot activate WP Simple Pay Lite and Pro at the same time. Please deactivate one to activate the other.', 'stripe' ) . '</p></div>';
	}
	add_action( 'admin_notices', 'sc_deactivate_lite_notice' );
	//wp_die( sprintf( __( 'You cannot activate Stripe Checkout Lite with the Pro version already active. <a href="%s">Return to plugins page.</a>', 'sc' ), get_admin_url( '', 'plugins.php' ) ) );
}


$base_class = Stripe_Checkout::get_instance();
