<?php
/**
 * Simple Pay: Edit form custom fields
 *
 * @package SimplePay\Core\Post_Types\Simple_Pay\Edit_Form
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.8.0
 */

namespace SimplePay\Core\Post_Types\Simple_Pay\Edit_Form;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get custom field option group labels.
 *
 * @since 3.8.0
 *
 * @return array Group label names.
 */
function get_custom_field_type_groups() {
	$groups = array(
		'payment'  => _x( 'Payment', 'custom field group', 'stripe' ),
		'customer' => _x( 'Customer', 'custom field group', 'stripe' ),
		'standard' => _x( 'Standard', 'custom field group', 'stripe' ),
		'custom'   => _x( 'Custom', 'custom field group', 'stripe' ),
	);

	/**
	 * Filter the labels associated with field groups.
	 *
	 * @since 3.4.0
	 *
	 * @param array $groups optgroup/category keys and associated labels.
	 */
	return apply_filters( 'simpay_custom_field_group_labels', $groups );
}

/**
 * Get the available custom field types.
 *
 * @since 3.8.0
 *
 * @return array $fields Custom fields.
 */
function get_custom_field_types() {
	$fields = array(
		'customer_name'           => array(
			'label'      => esc_html__( 'Name', 'stripe' ),
			'type'       => 'customer_name',
			'category'   => 'customer',
			'active'     => true,
			'repeatable' => false,
		),
		'email'                   => array(
			'label'      => esc_html__( 'Email Address', 'stripe' ),
			'type'       => 'email',
			'category'   => 'customer',
			'active'     => true,
			'repeatable' => false,
		),
		'telephone'               => array(
			'label'      => esc_html__( 'Phone', 'stripe' ),
			'type'       => 'telephone',
			'category'   => 'customer',
			'active'     => true,
			'repeatable' => false,
		),
		'address'                 => array(
			'label'      => esc_html__( 'Address', 'stripe' ),
			'type'       => 'address',
			'category'   => 'customer',
			'active'     => true,
			'repeatable' => false,
		),
		'tax_id'                 => array(
			'label'      => esc_html__( 'Tax ID', 'stripe' ),
			'type'       => 'tax_id',
			'category'   => 'customer',
			'active'     => true,
			'repeatable' => false,
		),

		'plan_select'             => array(
			'label'      => esc_html__( 'Price Selector', 'stripe' ),
			'type'       => 'plan_select',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => false,
		),
		'coupon'                  => array(
			'label'      => esc_html__( 'Coupon', 'stripe' ),
			'type'       => 'coupon',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => false,
		),
		'custom_amount'           => array(
			'label'      => esc_html__( 'Custom Amount Input', 'stripe' ),
			'type'       => 'custom_amount',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => false,
		),
		'recurring_amount_toggle' => array(
			'label'      => esc_html__( 'Recurring Amount Toggle', 'stripe' ),
			'type'       => 'recurring_amount_toggle',
			'category'   => 'payment',
			'active'     => simpay_subscriptions_enabled(),
			'repeatable' => false,
		),
		'total_amount'            => array(
			'label'      => esc_html__( 'Amount Breakdown', 'stripe' ),
			'type'       => 'total_amount',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => true,
		),
		'payment_request_button'  => array(
			'label'      => esc_html__( 'Apple Pay/Google Pay Button', 'stripe' ),
			'type'       => 'payment_request_button',
			'category'   => 'payment',
			'active'     => simpay_can_use_payment_request_button(),
			'repeatable' => false,
		),
		'card'                    => array(
			'label'      => esc_html__( 'Payment Methods (Card, ACH, etc)', 'stripe' ),
			'type'       => 'card',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => false,
		),
		'checkout_button'         => array(
			'label'      => esc_html__( 'Checkout Button', 'stripe' ),
			'type'       => 'checkout_button',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => false,
		),
		'payment_button'          => array(
			'label'      => esc_html__( 'Payment Button', 'stripe' ),
			'type'       => 'payment_button',
			'category'   => 'payment',
			'active'     => true,
			'repeatable' => false,
		),

		'heading'                 => array(
			'label'      => esc_html__( 'Heading', 'stripe' ),
			'type'       => 'heading',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'text'                    => array(
			'label'      => esc_html__( 'Text', 'stripe' ),
			'type'       => 'text',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'dropdown'                => array(
			'label'      => esc_html__( 'Dropdown', 'stripe' ),
			'type'       => 'dropdown',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'radio'                   => array(
			'label'      => esc_html__( 'Radio Select', 'stripe' ),
			'type'       => 'radio',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'date'                    => array(
			'label'      => esc_html__( 'Date', 'stripe' ),
			'type'       => 'date',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'number'                  => array(
			'label'      => esc_html__( 'Number', 'stripe' ),
			'type'       => 'number',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'checkbox'                => array(
			'label'      => esc_html__( 'Checkbox', 'stripe' ),
			'type'       => 'checkbox',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
		'hidden'                  => array(
			'label'      => esc_html__( 'Hidden', 'stripe' ),
			'type'       => 'hidden',
			'category'   => 'standard',
			'active'     => true,
			'repeatable' => true,
		),
	);

	/**
	 * Filters available custom fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields Custom fields.
	 */
	return apply_filters( 'simpay_custom_field_options', $fields );
}

/**
 * Get a grouped list of custom field options.
 *
 * @since 3.8.0
 *
 * @param array $options Flat list of options.
 * @return array $options Grouped list of options.
 */
function get_custom_fields_grouped( $options = array() ) {
	if ( empty( $options ) ) {
		$options = get_custom_field_types();
	}

	$result = array();
	$groups = get_custom_field_type_groups();

	foreach ( $options as $key => $option ) {
		if ( isset( $option['category'] ) ) {
			$result[ $groups[ $option['category'] ] ][ $key ] = $option;
		} else {
			$result[ $groups['custom'] ][ $key ] = $option;
		}
	}

	return $result;
}

/**
 * Adds "Custom Fields" Payment Form settings tab content.
 *
 * Lite does not have true custom fields -- these are standard
 * form settings which are removed and replaced with true
 * custom fields in Pro.
 *
 * @since 3.8.0
 *
 * @param int $post_id Current Payment Form ID.
 */
function add_custom_fields( $post_id ) {
	$counter = 1;
	$fields  = get_post_meta( $post_id, '_custom_fields', true );
	$field   = isset( $fields['payment_button'] )
		? current( $fields['payment_button'] )
		: array();
	?>

<table>
	<tbody class="simpay-panel-section">
		<tr class="simpay-panel-field">
			<th>
				<label for="<?php echo esc_attr( 'simpay-payment-button-text-' . $counter ); ?>">
					<?php esc_html_e( 'Button Text', 'stripe' ); ?>
				</label>
			</th>
			<td>
				<?php
				simpay_print_field(
					array(
						'type'        => 'standard',
						'subtype'     => 'text',
						'name'        => '_simpay_custom_field[payment_button][' . $counter . '][text]',
						'id'          => 'simpay-payment-button-text-' . $counter,
						'value'       => isset( $field['text'] ) ? $field['text'] : '',
						'class'       => array(
							'simpay-field-text',
							'simpay-label-input',
						),
						'attributes'  => array(
							'data-field-key' => $counter,
						),
						'placeholder' => esc_attr__( 'Pay with Card', 'stripe' ),
					)
				);
				?>
			</td>
		</tr>

		<tr class="simpay-panel-field">
			<th>
				<label for="<?php echo esc_attr( 'simpay-processing-button-text' . $counter ); ?>">
					<?php esc_html_e( 'Button Processing Text', 'stripe' ); ?>
				</label>
			</th>
			<td>
				<?php
				simpay_print_field(
					array(
						'type'        => 'standard',
						'subtype'     => 'text',
						'name'        => '_simpay_custom_field[payment_button][' . $counter . '][processing_text]',
						'id'          => 'simpay-processing-button-text-' . $counter,
						'value'       => isset( $field['processing_text'] ) ? $field['processing_text'] : '',
						'class'       => array(
							'simpay-field-text',
							'simpay-label-input',
						),
						'attributes'  => array(
							'data-field-key' => $counter,
						),
						'placeholder' => esc_attr__( 'Please Wait...', 'stripe' ),
					)
				);
				?>
			</td>
		</tr>

		<tr class="simpay-panel-field">
			<th>
				<label for="<?php echo esc_attr( 'simpay-payment-button-style-' . $counter ); ?>">
					<?php esc_html_e( 'Button Style', 'stripe' ); ?>
				</label>
			</th>
			<td>
				<?php
				simpay_print_field(
					array(
						'type'    => 'radio',
						'name'    => '_simpay_custom_field[payment_button][' . $counter . '][style]',
						'id'      => esc_attr( 'simpay-payment-button-style-' . $counter ),
						'value'   => isset( $field['style'] )
							? $field['style']
							: 'stripe',
						'class'   => array( 'simpay-multi-toggle' ),
						'options' => array(
							'stripe' => esc_html__( 'Stripe blue', 'stripe' ),
							'none'   => esc_html__( 'Default', 'stripe' ),
						),
						'inline'  => 'inline',
					)
				);
				?>
			</td>
		</tr>
	</tbody>
</table>

	<?php
	/**
	 * Allows further content after "Custom" Fields" Payment Form
	 * settings tab content.
	 *
	 * @since 3.0.0
	 */
	do_action( 'simpay_admin_after_custom_fields' );
}
add_action( 'simpay_form_settings_meta_payment_options_panel', __NAMESPACE__ . '\\add_custom_fields' );
