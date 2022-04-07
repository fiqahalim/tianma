const commissionForm = document.querySelector('#commissionInstallment-form');
commissionForm.addEventListener('submit', (e) => {
    e.preventDefault();

    //Computing the results
    const pv = document.getElementById('pv').value;
    const percentage = document.getElementById('percentage').value;

    //Calculate
    const principal = parseFloat(pv);
    const calculatedPercentage = parseFloat(percentage);

    console.log(principal);
    console.log(calculatedPercentage);
    console.log(calculateMonth);


    if (calculatedPercentage < 20) {
        console.log("less than 20");
        const calcPV = principal * (calculatedPercentage / 100);
        const balancePV = calcPV.toFixed();

        console.log(calcPV);
        console.log(balancePV);

        //Display elements using DOM manipulation
        document.getElementById("point_value").innerHTML = "" + balancePV;
        // document.getElementById("outstanding_balance").innerHTML = "RM " + calculatePV;

        document.getElementById("point_value").value = balancePV;
        // document.getElementById("outstanding_balance").value = calculatePV;

    } else if (calculatedPercentage == 20) {
        console.log("equal to 20");
        const calcPV = principal * (calculatedPercentage / 100);
        const balancePV = calcPV.toFixed();

        console.log(calcPV);
        console.log(balancePV);

        //Display elements using DOM manipulation
        document.getElementById("point_value").innerHTML = "" + balancePV;
        // document.getElementById("outstanding_balance").innerHTML = "RM " + calculatePV;

        document.getElementById("point_value").value = balancePV;
        // document.getElementById("outstanding_balance").value = calculatePV;

    } else {
        console.log("more than 20");
        const balPercentage = calculatedPercentage - 20;
        const firstPV = principal * (20 / 100);
        const secondPV = (principal - firstPV) * (balPercentage / 100);
        const calcPV = firstPV + secondPV;
        const balancePV = calcPV.toFixed();

        console.log(balPercentage);
        console.log(firstPV);
        console.log(secondPV);
        console.log(balancePV);

        //Display elements using DOM manipulation
        document.getElementById("point_value").innerHTML = "" + balancePV;
        // document.getElementById("outstanding_balance").innerHTML = "RM " + calculatePV;

        document.getElementById("point_value").value = balancePV;
        // document.getElementById("outstanding_balance").value = calculatePV;
    }
});
