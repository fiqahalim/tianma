/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/pages/commission.js ***!
  \******************************************/
var commissionForm = document.querySelector('#commission-form');
commissionForm.addEventListener('submit', function (e) {
  // e.preventDefault();
  //Computing the results
  var pv = document.getElementById('pv').value;
  var percentage = document.getElementById('percentage').value;
  var first_month = document.getElementById('first_month').value; //Calculate

  var principal = parseFloat(pv);
  var calculatedPercentage = parseFloat(percentage);
  var calculateMonth = parseFloat(first_month);
  console.log(principal);
  console.log(calculatedPercentage);
  console.log(calculateMonth);

  if (calculatedPercentage < 20) {
    console.log("less than 20");
    var calcPV = principal * (calculatedPercentage / 100);
    var balancePV = calcPV.toFixed();
    console.log(calcPV);
    console.log(balancePV); //Display elements using DOM manipulation

    document.getElementById("point_value").innerHTML = "" + balancePV;
    document.getElementById("point_value").value = balancePV;
  } else if (calculatedPercentage == 20) {
    console.log("equal to 20");

    var _calcPV = principal * (calculatedPercentage / 100) * calculateMonth;

    var _balancePV = _calcPV.toFixed(); //Display elements using DOM manipulation


    document.getElementById("point_value").innerHTML = "" + _balancePV;
    document.getElementById("point_value").value = _balancePV;
  } else if (calculatedPercentage > 20 && calculatedPercentage < 100) {
    console.log("more than 20");
    var balPercentage = calculatedPercentage - 20;
    var firstPV = principal * (20 / 100) * calculateMonth;
    var secondPV = (principal - firstPV) * (balPercentage / 100);

    var _calcPV2 = firstPV + secondPV;

    var _balancePV2 = _calcPV2.toFixed();

    console.log(balPercentage);
    console.log(firstPV);
    console.log(secondPV);
    console.log(_balancePV2); //Display elements using DOM manipulation

    document.getElementById("point_value").innerHTML = "" + _balancePV2;
    document.getElementById("point_value").value = _balancePV2;
  } else {
    console.log("equal to 100");

    var _calcPV3 = principal * (100 / 100) * calculateMonth;

    var _balancePV3 = _calcPV3.toFixed();

    console.log(_balancePV3); //Display elements using DOM manipulation

    document.getElementById("point_value").innerHTML = "" + _balancePV3;
    document.getElementById("point_value").value = _balancePV3;
  }
});
/******/ })()
;