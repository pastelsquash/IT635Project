$(document).ready(function() {
  $("#place").change(function() {
    var venue_id = $(this).val();
    if(venue_id != "") {
      $.ajax({
        url:"get-lots.php",
        data:{v_id:venue_id},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#lot").html(resp);
        }
      });
    }	
    else {
      $("#lot").html("<option value=''>Select</option>");
    }
  });
   $("#lot").change(function() {
    var lot_id = $(this).val();
    if(lot_id != "") {
      $.ajax({
        url:"get-lots.php",
        data:{l_id:lot_id},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#zone").html(resp);
        }
      });
    }
    else {
      $("#zone").html("<option value=''>Select</option>");
    }
  });

});
