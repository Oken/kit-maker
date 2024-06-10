/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save() {
	return (
		<div  { ...useBlockProps.save() } className="container">
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
        </form>
      </div>
    </div>
	);
}
