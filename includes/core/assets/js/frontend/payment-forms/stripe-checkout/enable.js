/** @typedef {import('@wpsimplepay/payment-forms').PaymentForm} PaymentForm */

const { convertToDollars, formatCurrency } = window.spShared;

/**
 * Enable the Payment Form.
 *
 * @since 4.2.0
 *
 * @param {PaymentForm} paymentForm
 */
function enable( paymentForm ) {
	const { cart, __unstableLegacyFormData } = paymentForm;
	const { startTrial, paymentButtonText } = __unstableLegacyFormData;

	// Remove a loading class indicator.
	paymentForm.removeClass( 'simpay-checkout-form--loading' );

	// Enable the form submit button.
	const submitButtonEl = paymentForm.find( '.simpay-payment-btn' );

	submitButtonEl.prop( 'disabled', false ).removeClass( 'simpay-disabled' );

	if ( 0 === cart.getTotal() ) {
		submitButtonEl.find( 'span' ).text( startTrial );
	} else {
		const formatted = formatCurrency(
			cart.isZeroDecimal()
				? cart.getTotal()
				: convertToDollars( cart.getTotal() ),
			true,
			cart.getCurrencySymbol(),
			cart.isZeroDecimal()
		);

		const amount = `<em class="simpay-total-amount-value">${ formatted }</span>`;

		submitButtonEl
			.find( 'span' )
			.html( paymentButtonText.replace( '{{amount}}', amount ) );
	}
}

export default enable;