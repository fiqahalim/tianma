/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/pages/booking.js ***!
  \***************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var selectedSeats = [];
var selectedSeatsIndexs = [];
var allSeats = document.querySelectorAll('#container-seats .seat'); ////////INITIALIZE DATA///////////

readState();
updateState();
var containerSeats = document.querySelector('#container-seats');
containerSeats.addEventListener("click", function (e) {
  var element = e.target;

  if (element.classList.contains('seat') && !element.classList.contains('occupied')) {
    if (element.classList.contains('selected')) {
      selectedSeatsNumber--;
      element.classList.remove('selected');
    } else {
      selectedSeatsNumber++;
      element.classList.add('selected');
    }
  }

  updateState();
});

function updateState() {
  console.log("allSeats", allSeats);
  selectedSeats = document.querySelectorAll('.row-seat .seat.selected');
  selectedSeatsIndexs = _toConsumableArray(selectedSeats).map(function (x) {
    return _toConsumableArray(allSeats).indexOf(x);
  });
  document.querySelector('#count').innerText = selectedSeatsNumber;
  localStorage.setItem('selectedSeatsNumber', selectedSeatsNumber);
  localStorage.setItem('selectedSeatsIndexs', JSON.stringify(selectedSeatsIndexs));
}

function readState() {
  selectedSeatsNumber = +localStorage.getItem('selectedSeatsNumber') || 0;
  selectedSeatsIndexs = JSON.parse(localStorage.getItem('selectedSeatsIndexs')) || [];

  _toConsumableArray(allSeats).map(function (seat, index) {
    if (selectedSeatsIndexs.includes(index)) {
      seat.classList.add('selected');
    }
  });
}
/******/ })()
;