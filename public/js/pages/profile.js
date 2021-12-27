/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/pages/profile.js ***!
  \***************************************/
// import Swal from 'sweetalert2';
// import Swal from 'sweetalert2/dist/sweetalert2.js';
window.changePassword = function (change_password) {
  Swal.fire({
    icon: 'warning',
    text: 'Do you want to change your password?',
    showCancelButton: true,
    confirmButtonText: 'Confirm',
    confirmButtonColor: '#e3342f'
  }).then(function (result) {
    if (result.isConfirmed) {
      document.getElementById(change_password).submit();
    }
  });
};
/******/ })()
;