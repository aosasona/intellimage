$(document).ready(function() {
  $("#generate_form").on('keyup keydown change paste', "input", function() {
    $("#submit_btn").attr("disabled", (!$("#prompt").val() && !$("#user_image").val()))
  });
})

