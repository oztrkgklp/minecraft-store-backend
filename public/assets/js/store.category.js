$(document).ready(function() {
  $("#selectServerID").change(function() {
    var selectServerID = $("#selectServerID").val();
    $("#product-categories").css("display", "none");
    $("#c-loading").css("display", "block");
    if (selectServerID != null) {
      $.ajax({
        type: "POST",
        url: "/apps/dashboard/public/ajax/categories.php",
        data: {serverID: selectServerID},
        success: function(result) {
          $("#selectParentID").html(result);
          $("#product-categories").css("display", "block");
          $("#c-loading").css("display", "none");
        }
      });
    }
  });
});
