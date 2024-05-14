<?php
/**
 * Emails: Payment Refunded Confirmation
 *
 * @package SimplePay
 * @copyright Copyright (c) 2024, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 4.10.0
 */

namespace SimplePay\Core\Emails\Email;

use SimplePay\Pro\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * PaymentRefundedConfirmationEmail class.
 *
 * @since 4.10.0
 */
class PaymentRefundedConfirmationEmail extends AbstractEmail {

	/**
	 * {@inheritdoc}
	 */
	public function get_id() {
		return 'payment-refunded-confirmation';
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_type() {
		return AbstractEmail::INTERNAL_TYPE;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_label() {
		return __( 'Payment Refunded Confirmation', 'stripe' );
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_description() {
		return __(
			'Send a confirmation email for a payment refund',
			'stripe'
		);
	}

	/**
	 * Returns the email address(es) to send the email to.
	 *
	 * @since 4.10.0
	 *
	 * @return string
	 */
	public function get_to() {
		/** @var string $to_address */
		$to_address = simpay_get_setting(
			sprintf( 'email_%s_to', $this->get_id() ),
			get_bloginfo( 'admin_email' )
		);

		return $to_address;
	}

	/**
	 * Returns the subject of the email.
	 *
	 * @since 4.10.0
	 *
	 * @return string
	 */
	public function get_subject() {
		/** @var string $subject */
		$subject = simpay_get_setting(
			sprintf( 'email_%s_subject', $this->get_id() ),
			sprintf(
				/* translators: %s Site name */
				__( 'Payment refunded on %s', 'stripe' ),
				get_bloginfo( 'name' )
			)
		);

		return $subject;
	}

	/**
	 * Returns the body (content) of the email.
	 *
	 * @since 4.10.0
	 *
	 * @return string
	 */
	public function get_body() {
		return Settings\Emails\PaymentRefundedConfirmation\get_body_setting_or_default();
	}
}
