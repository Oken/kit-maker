/**
 * Retrieves the translation of text.
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	return (
		// <p { ...useBlockProps() }>
		// 	{ __( 'Mortgage Calculus - hello from the editor!', 'mortgagecalculus' ) }
		// </p>
		/*<div className="mortgage-calculator-block">
			<h2>Mortgage Calculator</h2>
			<label htmlFor="interest-rate">Interest Rate (%):</label>
			<input
			type="number"
			id="interest-rate"
			value={ interestRate }
			onChange={ ( event ) => setAttributes( { interestRate: parseFloat( event.target.value ) } ) } // Update attribute on change
			/>
			<label htmlFor="loan-amount">Loan Amount ($):</label>
			<input
			type="number"
			id="loan-amount"
			value={ loanAmount }
			onChange={ ( event ) => setAttributes( { loanAmount: parseFloat( event.target.value ) } ) } // Update attribute on change
			/>
			<label htmlFor="loan-term">Loan Term (Years):</label>
			<input
			type="number"
			id="loan-term"
			value={ loanTerm }
			onChange={ ( event ) => setAttributes( { loanTerm: parseFloat( event.target.value ) } ) } // Update attribute on change
			/>
			<button onClick={ calculateMortgagePayment }>Calculate</button>
			<p className="result">{ calculateMortgagePayment() }</p>
		</div>*/

		<div  { ...useBlockProps() } className="container">
      <div className="wrapper">
        <h3>Mortgage Calculator</h3>
        <form>
          <div className="form-group">
            <label htmlFor="home_price">Home Price ($)</label>
            <input name="home_price" id="home_price" type="number" value="30000" />
          </div>
          <div className="form-group">
            <label htmlFor="down_payment_percent">Down Payment (%)</label>
            <input name="down_payment_percent" id="down_payment_percent" type="number" value="20" />
          </div>
          <div className="form-group">
            <label htmlFor="down_payment">Down Payment ($)</label>
            <input name="down_payment" id="down_payment" type="number" value="6000" />
          </div>
          <div className="form-group">
            <label htmlFor="loan_term">Loan Term (Year)</label>
            <select name="loan_term" id="loan_term">
              <option selected value="30">30</option>
              <option value="20">20</option>
              <option value="15">15</option>
              <option value="10">10</option>
            </select>
          </div>
          <div className="form-group">
            <label htmlFor="interest_rate">Interest (%)</label>
            <input name="interest_rate" id="interest_rate" type="number" value="6.42" />
          </div>
          <div>
            <p>Monthly Payment: <span className="monthly_payment"></span></p>
          </div>
          <label htmlFor="loan-amount">Loan Amount ($):</label>
					<input
					type="number"
					id="loan-amount"
					value="50"
					onChange={ ( event ) => console.log( event.target.value ) } // Update attribute on change
					/>
        </form>
      </div>
    </div>
	);
}
