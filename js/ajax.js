$(document).ready(function(e) {    
    $('#sel_oblast').change(function() {
         $("#sel_city").empty();
         $("#sel_city").trigger("chosen:updated");
         $("#sel_ter").empty();
         $("#sel_ter").trigger("chosen:updated");
         var oblast_id = $('#sel_oblast').val();
         $.ajax({
             url: 'get_region.php', 
             type: 'POST', 
             data: {
                 oblast_id: oblast_id
             }, 
             success: function(data) { 
                 if (data) {
                     $('#sel_city').append('<option></option>');
                     $('#sel_city').append(data);
                     $("#sel_city").trigger("chosen:updated");
                 }
             }
         });
     });
     $('#sel_city').change(function() {
         $("#sel_ter").empty();
         $("#sel_ter").trigger("chosen:updated");
         var city_id = $('#sel_city').val();
         $.ajax({
             url: 'get_territory.php',
             type: 'POST', 
             data: {
                 city_id: city_id
             }, 
             success: function(data) { 
                 if (data) {
                     $("#sel_ter").empty();
                     $('#sel_ter').append(data);
                     $("#sel_ter").trigger("chosen:updated");
                 }
             }
         });
     });
 });