const installmentForm = document.querySelector('#installment-form');
installmentForm.addEventListener('submit', (e) => {
    // e.preventDefault();

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
    const installmentBalance = (installment_year - 1);
    const calculatedOutstanding = principal - parseFloat(downpayment);

    console.log(principal);
    console.log(calculatedPayments);
    console.log(calculatedOutstanding);

    const monthly = (calculatedOutstanding) / (calculatedPayments);
    const monthlyPayment = monthly.toFixed();
    const balanceMonthlyInstallment = monthlyPayment * installmentBalance;
    const lastMonthBalance = parseFloat(calculatedOutstanding - balanceMonthlyInstallment);
    const lastMonthPayment = lastMonthBalance.toFixed();

    console.log(monthlyPayment);
    console.log(lastMonthPayment);

    //Display elements using DOM manipulation
    document.getElementById("monthly_installment").innerHTML = "RM " + monthlyPayment;
    document.getElementById("outstanding_balance").innerHTML = "RM " + calculatedOutstanding;
    document.getElementById("last_month_payment").innerHTML = "RM " + lastMonthPayment;

    document.getElementById("monthly_installment").value = monthlyPayment;
    document.getElementById("outstanding_balance").value = calculatedOutstanding;
    document.getElementById("last_month_payment").value = lastMonthPayment;
});
