var conn = new WebSocket('ws://localhost:8080');

conn.onopen = function(e) {
    document.getElementById("connection").innerHTML = "Connecté";
};

conn.onmessage = function(e) {
    console.log(e);
    var data = JSON.parse(e.data);
    console.log(data);
    if(data.event == 'connect') {
        eventConnect(data);
    } else if (data.event == 'playerInfo') {
        eventRefreshInfo(data);
    } else if (data.event == 'reset') {
        eventRefreshInfo();
    } else if (data.event == 'connected') {
        $('#my_avatar').attr('src',data.avatar);
    } else if (data.event == 'CreateGameSolo'){
        eventCreateGameSolo();
    }
};

var eventRefreshInfo = function(data) {
    document.getElementById("pupgradePoints").innerText = data.data.pupgradePoints;
    document.getElementById("fnameFlower").innerHTML = data.data.fnameFlower;
    document.getElementById("fpopulation").innerHTML = data.data.fpopulation;
    document.getElementById("fseeds").innerHTML = data.data.fseeds;
    document.getElementById("fidealTemperature").innerHTML = data.data.fidealTemperature;
    document.getElementById("ftemperatureAmplitude").innerHTML = data.data.ftemperatureAmplitude;
    document.getElementById("nfructoseProp").innerHTML = data.data.nfructoseProp;
    document.getElementById("nsucroseProp").innerHTML = data.data.nsucroseProp;
    document.getElementById("nglucoseProp").innerHTML = data.data.nglucoseProp;
    document.getElementById("bnameBiome").innerHTML = data.data.bnameBiome;
    document.getElementById("snameSeason").innerHTML = data.data.snameSeason;
    document.getElementById("mnameMonth").innerHTML = data.data.mnameMonth;
};
var eventCreateGameSolo = function(){

}
var eventPick = function(data) {
    $('#winner').modal('show');
    $('#winning_avatar').attr('src',data.winning_avatar);
    if(!is_admin) {
        if (data.winner) {
            body.css('background-color', 'green');
            $('#win_message').html('YOU WIN!');
        } else {
            body.css('background-color', 'red');
            $('#win_message').html("Sorry you weren't picked.");
        }
    }
};
var eventConnect = function(data) {
    waiting.html('');
    var html = '';
    var num_users = 0;
    for(key in data.clients) {
        if(!data.clients.hasOwnProperty(key)) continue;
        if(data.clients[key].is_admin == false) {
            num_users++;
            html += "<img src='" + data.clients[key].avatar + "' />";
        }
    }
    waiting.html(html);
    $('#number').html(num_users);
};

/*
var sendMsg = function(obj) {
    conn.send(JSON.stringify(obj));
};
$('#pick').click(function(){
    sendMsg({event:'pick'});
});
$('#reset').click(function(){
    sendMsg({event:'reset'});
});*/