$(document).ready(function() {
  $('#js-content').load('/start.html');

  $('#navbar a').click(function(e) {
    e.preventDefault();
    $("#js-content").load(e.target.href);
  })

  $('#js-content #switch #card-body a').click(function(e) {
    e.preventDefault();
    $("#js-content").load(e.target.href);
  })
});

responsiveCanvas(); //first init
$(window).resize(function(){
  responsiveCanvas(); //every resizing
  stage.update(); //update the canvas, stage is object of easeljs

});
function responsiveCanvas(target){
  $(canvas).each(function(e){

    var parentWidth = $(this).parent().outerWidth();
    var parentHeight =  $(this).parent().outerHeight();
    $(this).attr('width', parentWidth);
    $(this).attr('height', parentHeight);
    console.log(parentWidth);
  })

}
