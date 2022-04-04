var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   $(document).ready(function(){

     $( "#id_number" ).autocomplete({
        source: function( request, response ) {
           // Fetch data
           $.ajax({
             url:"{{route('getEmployees')}}",
             type: 'post',
             dataType: "json",
             data: {
                _token: CSRF_TOKEN,
                search: request.term
             },
             success: function( data ) {
                response( data );
             }
           });
        },
        select: function (event, ui) {
          // Set selection
          $('#id_number').val(ui.item.label); // display the selected text
          $('#employeeid').val(ui.item.value); // save selected id to input
          return false;
        }
     });

   });
