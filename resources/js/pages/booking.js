$('.container-seats .seat').on('click', function() {
    var rooms = $('select[name="rooms"]').val();
    var wings = $('select[name="wings"]').val();

    if (rooms && wings) {
        selectLot();
    } else {
        $(this).removeClass('selected');
        notify('error', "@lang('Please select room and section before select any lot')")
    }
});

//select and booked lot
function selectSeat() {
    let selectedSeats = $('.seat.selected');
    let seatDetails = ``;
    // let price = $('input[name=price]').val();
    // let subtotal = 0;
    // let currency = '{{ __($general->cur_text) }}';
    let seats = '';
    if (selectedSeats.length > 0) {
        $('.booked-seat-details').removeClass('d-none');
        $.each(selectedSeats, function(i, value) {
            seats += $(value).data('seat') + ',';
            // seatDetails += `<span class="list-group-item d-flex justify-content-between">${$(value).data('seat')} <span>${price} ${currency}</span></span>`;
            // subtotal = subtotal + parseFloat(price);
        });

        $('input[name=seat]').val(seats);
        // $('.selected-seat-details').html(seatDetails);
        // $('.selected-seat-details').append(`<span class="list-group-item d-flex justify-content-between">@lang('Sub total')<span>${subtotal} ${currency}</span></span>`);
    } else {
        $('.selected-seat-details').html('');
        $('.booked-seat-details').addClass('d-none');
    }
}

function updateTextArea()
{
    var allSeatsVals = [];

    $('#seatsBlock :checked').each(function() {
       allSeatsVals.push($(this).val());
    });
}
