const installmentForm = document.querySelector('#installment-form');
installmentForm.addEventListener('submit', (e) => {
    e.preventDefault();

    //Computing the results
    const amount = document.getElementById('amount').value;
    // const interest = document.getElementById('interest').value;
    const installment_year = document.getElementById('installment_year').value;
    const downpayment = document.getElementById('downpayment').value;

    //Calculate
    const principal = parseFloat(amount);
    // const calculatedInterest = parseFloat(interest) / 100 / 12;
    const calculatedInterest = 0;
    const calculatedPayments = installment_year;
    const calculatedOutstanding = principal - parseFloat(downpayment);

    console.log(principal);
    console.log(calculatedPayments);
    console.log(calculatedOutstanding);

    //Calculating the monthly payment
    // const x = Math.pow(1 + calculatedInterest, calculatedPayments);
    // const monthly = (principal * x * calculatedInterest) / (x - 1);
    // const monthlyPayment = monthly.toFixed(2);

    const monthly = (calculatedOutstanding) / (calculatedPayments);
    const monthlyPayment = monthly.toFixed();

    console.log(monthly);
    console.log(monthlyPayment);

    //calculating the total interest
    // const totalInterest = (monthly * calculatedPayments - principal).toFixed(2);

    //calculating the total payment
    // const totalPayment = (monthly * calculatedPayments).toFixed(2);

    //Display elements using DOM manipulation
    document.getElementById("monthly_installment").innerHTML = "RM " + monthlyPayment;
    document.getElementById("outstanding_balance").innerHTML = "RM " + calculatedOutstanding;
});
