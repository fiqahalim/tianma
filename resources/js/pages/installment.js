const installmentForm = document.querySelector('#installment-form');
installmentForm.addEventListener('submit', (e) => {
    e.preventDefault();

    //Computing the results
    const amount = document.getElementById('amount').value;
    // const interest = document.getElementById('interest').value;
    const period = document.getElementById('period').value;
    const downpayment = document.getElementById('downpayment').value;

    //Calculate
    const principal = parseFloat(amount);
    // const calculatedInterest = parseFloat(interest) / 100 / 12;
    const calculatedInterest = 0;
    const calculatedPayments = parseFloat(period) * 12;
    const calculatedOutstanding = principal - parseFloat(downpayment);

    console.log(principal);
    console.log(calculatedPayments);
    console.log(calculatedOutstanding);

    //Calculating the monthly payment
    // const x = Math.pow(1 + calculatedInterest, calculatedPayments);
    // const monthly = (principal * x * calculatedInterest) / (x - 1);
    // const monthlyPayment = monthly.toFixed(2);

    const monthly = (calculatedOutstanding) / (calculatedPayments);
    const monthlyPayment = monthly.toFixed(2);

    console.log(monthly);
    console.log(monthlyPayment);

    //calculating the total interest
    const totalInterest = (monthly * calculatedPayments - principal).toFixed(2);

    //calculating the total payment
    const totalPayment = (monthly * calculatedPayments).toFixed(2);

    //Display elements using DOM manipulation
    document.getElementById("installment").innerHTML = "RM " + monthlyPayment;
    document.getElementById("balance").innerHTML = "RM " + calculatedOutstanding;
});