$(document).ready(function() {
  $('#js-content').load('/start.html');

  $('#navbar a').click(function(e) {
    e.preventDefault();
    $("#js-content").load(e.target.href);
  })
});
