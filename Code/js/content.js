$(window).load(function() {
	$(".preloader").fadeOut("1000");
})

$(document).ready(function() {
  $('#signin').hide();
});

$('#login').on('click',function(){
    $('#signin').show();
});
