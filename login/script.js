$( ".input" ).focus(function() {
  $(this).parent(".input-container").addClass("infocus");
})
$( ".input" ).focusout(function() {
  $(this).parent(".input-container").removeClass("infocus");
});
$( ".select" ).focus(function() {
  $(this).parent(".select-container").addClass("infocus");
})
$( ".select" ).focusout(function() {
  $(this).parent(".select-container").removeClass("infocus");
});
$( ".select[disabled]" ).parent(".select-container").addClass("disabled");