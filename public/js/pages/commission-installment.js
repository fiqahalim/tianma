/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./resources/js/pages/commission-installment.js ***!
  \******************************************************/
var commissionInstallment = document.querySelector('#commissionInstallment-form');
commissionInstallment.addEventListener('submit', function (e) {
  e.preventDefault(); //Computing the results

  var point_value = document.getElementById('point_value').value;
  var installment_year = document.getElementById('installment_year').value; //Calculate

  var principal = parseFloat(point_value);
  var calculatedPercentage = parseFloat(percentage);
  console.log(principal);
  console.log(calculatedPercentage);
  console.log(calculateMonth);

  if (calculatedPercentage < 20) {
    console.log("less than 20");
    var calcPV = principal * (calculatedPercentage / 100);
    var balancePV = calcPV.toFixed();
    console.log(calcPV);
    console.log(balancePV); //Display elements using DOM manipulation

    document.getElementById("point_value").innerHTML = "" + balancePV; // document.getElementById("outstanding_balance").innerHTML = "RM " + calculatePV;

    document.getElementById("point_value").value = balancePV; // document.getElementById("outstanding_balance").value = calculatePV;
  } else if (calculatedPercentage == 20) {
    console.log("equal to 20");

    var _calcPV = principal * (calculatedPercentage / 100);

    var _balancePV = _calcPV.toFixed();

    console.log(_calcPV);
    console.log(_balancePV); //Display elements using DOM manipulation

    document.getElementById("point_value").innerHTML = "" + _balancePV; // document.getElementById("outstanding_balance").innerHTML = "RM " + calculatePV;

    document.getElementById("point_value").value = _balancePV; // document.getElementById("outstanding_balance").value = calculatePV;
  } else {
    console.log("more than 20");
    var balPercentage = calculatedPercentage - 20;
    var firstPV = principal * (20 / 100);
    var secondPV = (principal - firstPV) * (balPercentage / 100);

    var _calcPV2 = firstPV + secondPV;

    var _balancePV2 = _calcPV2.toFixed();

    console.log(balPercentage);
    console.log(firstPV);
    console.log(secondPV);
    console.log(_balancePV2); //Display elements using DOM manipulation

    document.getElementById("point_value").innerHTML = "" + _balancePV2; // document.getElementById("outstanding_balance").innerHTML = "RM " + calculatePV;

    document.getElementById("point_value").value = _balancePV2; // document.getElementById("outstanding_balance").value = calculatePV;
  }
});
/******/ })()
;