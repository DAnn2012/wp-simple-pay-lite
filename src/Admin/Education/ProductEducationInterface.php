<?php
/**
 * Admin: Product education interface
 *
 * @package SimplePay
 * @subpackage Core
 * @copyright Copyright (c) 2021, WP Simple Pay, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 4.4.0
 */

namespace SimplePay\Core\Admin\Education;

/**
 * ProductEducationInterface interface.
 *
 * @since 4.4.0
 */
interface ProductEducationInterface {

	/**
	 * Returns the upgrade button URL.
	 *
	 * @since 4.4.0
	 *
	 * @param string $utm_medium utm_medium parameter.
	 * @return string
	 */
	public function get_upgrade_button_url( $utm_medium );

	/**
	 * Returns the upgrade button text for product education.
	 *
	 * @since 4.4.0
	 *
	 * @return string
	 */
	public function get_upgrade_button_text();

	/**
	 * Returns copy displayed under the upgrade button.
	 *
	 * @since 4.4.0
	 *
	 * @return string
	 */
	public function get_upgrade_button_subtext();

}