/* eslint-disable no-console */
console.log( 'Hello World! (from create-block-pluginblock block)' );
/* eslint-enable no-console */

// Calculates mortgage on loading the page
const calculateMortgage = () => {
  const homePrice = parseInt(document.querySelector('#home_price').value) | 0;
  const downPayment = parseInt(document.querySelector('#down_payment').value) | 0;
  const loanTerm = parseInt(document.querySelector('#loan_term').value);
  const interest = parseFloat(document.querySelector('#interest_rate').value);

  const loanAmount = homePrice - downPayment;
  const monthlyRate = interest / 12 / 100;
  const monthlyLoanTerm = loanTerm * 12;

  const compoundInterest = Math.pow((1 + monthlyRate), monthlyLoanTerm);
  const monthlyPayment = (loanAmount * monthlyRate * compoundInterest) / (compoundInterest - 1);

  document.querySelector('.monthly_payment').textContent = '$' + monthlyPayment.toFixed();
}

calculateMortgage();

// When the percentage down payment changes, effect the actual down payment with the change and the monthly payment likewise
document.querySelector('#down_payment_percent').addEventListener('input', (event) => {
  const downPaymentPercent = parseInt(event.target.value) | 0;
  const homePrice = parseInt(document.querySelector('#home_price').value);
  document.querySelector('#down_payment').value = homePrice * downPaymentPercent / 100;

  calculateMortgage();
});

// Something similar when the actual down paymenf is the one changing
document.querySelector('#down_payment').addEventListener('input', (event) => {
  const downPayment = parseInt(event.target.value) | 0;
  const homePrice = parseInt(document.querySelector('#home_price').value);

  const downPaymentPercent = downPayment / homePrice * 100;

  document.querySelector('#down_payment_percent').value = downPaymentPercent.toFixed()

  calculateMortgage();
});

// When other variables change
document.querySelector('#home_price').oninput =
document.querySelector('#loan_term').oninput = () => {
  calculateMortgage()
}

document.querySelector('#interest_rate').oninput = (event) => {
  if (event.target.value === '') {
    event.target.value = 1;
  }
  calculateMortgage()
}

