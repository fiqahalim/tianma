let ticketPrice = 10;
let selectedSeatsNumber = 0;
let selectedSeats = [];
let selectedSeatsIndexs = [];
let allSeats = document.querySelectorAll('#container-seats .seat');

////////INITIALIZE DATA///////////
readState();
updateState();
///////////////////////////////
// let selectMovie = document.querySelector("#movie-select");
// selectMovie.addEventListener("change", (e) => {
//     ticketPrice = +e.target.value;
//     localStorage.setItem("option", e.target.selectedIndex)
//     updateState();
// })

let containerSeats = document.querySelector('#container-seats');
containerSeats.addEventListener("click", (e) => {
    let element = e.target;
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
})

function updateState() {
    console.log("~ file: script.js ~ line 6 ~ allSeats", allSeats);
    selectedSeats = document.querySelectorAll('.row-seat .seat.selected');
    selectedSeatsIndexs = [...selectedSeats].map((x) => [...allSeats].indexOf(x));
    document.querySelector('#count').innerText = selectedSeatsNumber;
    // document.querySelector('#total').innerText = selectedSeatsNumber * ticketPrice;
    localStorage.setItem('selectedSeatsNumber', selectedSeatsNumber)
    localStorage.setItem('selectedSeatsIndexs', JSON.stringify(selectedSeatsIndexs));
}

function readState() {
    selectedSeatsNumber = +localStorage.getItem('selectedSeatsNumber') || 0;
    selectedSeatsIndexs = JSON.parse(localStorage.getItem('selectedSeatsIndexs')) || [];
    [...allSeats].map((seat, index) => {
        if (selectedSeatsIndexs.includes(index)) {
            seat.classList.add('selected');
        }
    })

    // let selectedIndex = +(localStorage.getItem('option') || 0);
    // let selectMovie = document.querySelector("#movie-select");
    // selectMovie.selectedIndex = selectedIndex
}