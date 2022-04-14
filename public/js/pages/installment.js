/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/pages/installment.js ***!
  \*******************************************/
var installmentForm = document.querySelector('#installment-form');
installmentForm.addEventListener('submit', function (e) {
  // e.preventDefault();
  //Computing the results
  var amount = document.getElementById('amount').value; // const interest = document.getElementById('interest').value;

  var installment_year = document.getElementById('installment_year').value;
  var downpayment = document.getElementById('downpayment').value; //Calculate

  var principal = parseFloat(amount); // const calculatedInterest = parseFloat(interest) / 100 / 12;

  var calculatedInterest = 0;
  var calculatedPayments = installment_year;
  var calculatedOutstanding = principal - parseFloat(downpayment);
  console.log(principal);
  console.log(calculatedPayments);
  console.log(calculatedOutstanding); //Calculating the monthly payment
  // const x = Math.pow(1 + calculatedInterest, calculatedPayments);
  // const monthly = (principal * x * calculatedInterest) / (x - 1);
  // const monthlyPayment = monthly.toFixed(2);

  var installmentBalance = calculatedPayments - 1;
  var monthly = calculatedOutstanding / calculatedPayments;
  var lastMonthBalance = calculatedOutstanding - monthly * installmentBalance;
  var monthlyPayment = monthly.toFixed();
  var lastMonthPayment = lastMonthBalance.toFixed();
  console.log(monthly);
  console.log(monthlyPayment); //calculating the total interest
  // const totalInterest = (monthly * calculatedPayments - principal).toFixed(2);
  //calculating the total payment
  // const totalPayment = (monthly * calculatedPayments).toFixed(2);
  //Display elements using DOM manipulation

  document.getElementById("monthly_installment").innerHTML = "RM " + monthlyPayment;
  document.getElementById("outstanding_balance").innerHTML = "RM " + calculatedOutstanding;
  document.getElementById("last_month_payment").innerHTML = "RM " + lastMonthPayment;
  document.getElementById("monthly_installment").value = monthlyPayment;
  document.getElementById("outstanding_balance").value = calculatedOutstanding;
  document.getElementById("last_month_payment").value = lastMonthPayment;
});
/******/ })()
;