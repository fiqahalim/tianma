/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/pages/reviewOrder.js ***!
  \*******************************************/
var form = document.querySelector('#review-order');
var loader = document.querySelector('#loader');
form.addEventListener('submit', function (event) {
  event.preventDefault(); // using non css framework method with Style

  loader.style.display = 'block'; // using a css framework such as TailwindCSS

  loader.classList.remove('hidden'); // pretend the form has been sumitted and returned

  setTimeout(function () {
    return loader.style.display = 'none';
  }, 1000);
});
/******/ })()
;