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
    } else {
      $("#lot").html("<option value=''>Select</option>");
    }
  });
});
