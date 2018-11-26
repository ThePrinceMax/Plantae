responsiveCanvas(); //first init
$(window).resize(function(){
  responsiveCanvas(); //every resizing
  //stage.update(); //update the canvas, stage is object of easeljs

});

function responsiveCanvas(){
  $(canvas).each(function(e){
    var parentWidth = $(this).parent().outerWidth();
    var parentHeight =  $(this).parent().outerHeight();

    $(this).attr('width', parentWidth);
    $(this).attr('height', parentHeight);
    //console.log(parentWidth);
  })

}
