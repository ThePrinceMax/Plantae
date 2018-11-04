$(document).ready(function() {
  $('#js-content').load('/start.html');
  $('#li-item').load('/sidebar/list/start.html');
  $('#li-item-param').load('/sidebar/param/start.html');

  $('#navbar a').click(function(e) {
    e.preventDefault();
    $("#js-content").load(e.target.href);
    $('#li-item').load('./sidebar/list/'+e.target.href.split("/")[3]);
    $('#li-item-param').load('./sidebar/param/'+e.target.href.split("/")[3]);
  })
});
