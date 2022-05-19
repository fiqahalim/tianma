(function($) {
    //reset all lots
    function reset() {
        $('.seat-wrapper .seat').removeClass('selected');
        $('.selected-seat-details').html('');
    }

    //click on lot
    $('.seat-wrapper .seat').on('click', function() {
        var rooms = $('select[name="rooms"]').val();
        var sections = $('select[name="sections"]').val();

        if (rooms && sections) {
            selectLot();
        } else {
            $(this).removeClass('selected');
            notify('error', "@lang('Please select room and section before select any lot')")
        }
    });

    //select and booked seat
    function selectLot() {
        let selectedSeats = $('.seat.selected');
        let seatDetails = ``;
        let price = $('input[name=price]').val();
        let subtotal = 0;

        let seats = '';
        if (selectedSeats.length > 0) {
            $('.booked-seat-details').removeClass('d-none');
            $.each(selectedSeats, function(i, value) {
                seats += $(value).data('seat') + ',';
                seatDetails += `<span class="list-group-item d-flex justify-content-between">${$(value).data('seat')} <span>${price} ${currency}</span></span>`;
                subtotal = subtotal + parseFloat(price);
            });

            $('input[name=seats]').val(seats);
            $('.selected-seat-details').html(seatDetails);
            $('.selected-seat-details').append(`<span class="list-group-item d-flex justify-content-between">@lang('Sub total')<span>${subtotal} ${currency}</span></span>`);
        } else {
            $('.selected-seat-details').html('');
            $('.booked-seat-details').addClass('d-none');
        }
    }

    //on change rooms and sections show available lots
    $(document).on('change', 'select[name="rooms"], select[name="sections"]', function(e) {
        showBookedSeat();
    });
})(jQuery);
