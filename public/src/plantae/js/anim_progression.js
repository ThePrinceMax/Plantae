//Refresh progression
setInterval(function(){
	var score = $(".score").text();
	$(".fill").css("height",score);
},1);
