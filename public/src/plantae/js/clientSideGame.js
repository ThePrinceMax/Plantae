var conn = new WebSocket('ws://localhost:8080');

conn.onopen = function(e) {
    document.getElementById("connection").innerHTML = "Connecté";
};

conn.onmessage = function(e) {
    console.log(e);
    var data = JSON.parse(e.data);
    console.log(data);
    if (data.event == 'playerInfo') {
        eventRefreshInfo(data);
    } else if (data.event == 'reset') {
        eventRefreshInfo();
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