$('#myModal').modal({
    backdrop: 'static',
    keyboard: false
}, 'show')

document.getElementById("gameCreation").style.display="none";
document.getElementById("gameJoining").style.display="none";

var conn = new WebSocket('ws://localhost:13750');
var flowerList = [];
var biomeList = [];
var oldPop = 0;
var oldPercent = 0;


function showGameCreation(){

    document.getElementById("gameJoining").style.display="none";
    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreation").style.display="block";

    getAllFlowers();

    let selectFlower = document.getElementById("createFlowerSelection");

    selectFlower.options.length =0;
    let keyFlower;
    for (keyFlower in flowerList) {
        if (flowerList.hasOwnProperty(keyFlower)  &&        // These are explained
            /^0$|^[1-9]\d*$/.test(keyFlower) &&    // and then hidden
            keyFlower <= 4294967294                // away below
        ) {
            selectFlower.options[selectFlower.options.length] = new Option(flowerList[keyFlower], keyFlower);
        }
    }


    getAllBiomes();

    let select = document.getElementById("createBiomeSelection");

    select.options.length =0;
    let keyBiome;
    for (keyBiome in biomeList) {
        if (biomeList.hasOwnProperty(keyBiome)  &&        // These are explained
            /^0$|^[1-9]\d*$/.test(keyBiome) &&    // and then hidden
            keyBiome <= 4294967294                // away below
        ) {
            select.options[select.options.length] = new Option(biomeList[keyBiome], keyBiome);
        }
    }


}

function showGameJoining(){
    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreation").style.display="none";
    document.getElementById("gameJoining").style.display="block";
}
function backToLoginActionChoice(){
    document.getElementById("gameCreation").style.display="none";
    document.getElementById("gameJoining").style.display="none";
    document.getElementById("loginActionChoice").style.display="block";
}

conn.onopen = function(e) {
    document.getElementById("modalTitle").innerHTML = "Connecté au server";
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
    } else if (data.event == 'Connexion'){

    } else if (data.event == 'FlowerList'){
        eventGetAllFlowers(data);
    } else if (data.event == 'BiomeList'){
        eventGetAllBiomes(data);
    } else if (data.event == 'Attributed'){
        eventAttributed(data);
    } else if (data.event == 'NoMorePoints'){
        eventNoMorePoints();
    }

};

var eventRefreshInfo = function(data) {

    if((parseInt(data.data.turn, 10)) === 0){
        setBiome(data.data.bnameBiome);
        setFlower("rose", "red");

    }

    let flowerToDisplay = Math.floor((~~(((parseInt(data.data.fpopulation, 10)+ 999) / 1000) * 1000))/650);

    console.log(flowerToDisplay);

    setFlowerNumber(flowerToDisplay);

    resetCanvas("nbflowers");

    let maxTurnPercent = 100;
    let turnPercent = Math.floor((parseInt(data.data.turn, 10)*maxTurnPercent/parseInt(data.data.nbTurns, 10)));

    console.log(turnPercent);
    if(turnPercent !== oldPercent){
        animateValue("progpercent", oldPercent, turnPercent, 2000); //Commande pour mettre à jour la progression
    }

    oldPercent = turnPercent;


    document.getElementById("pupgradePoints").innerText = "Points d'amélioration : "+data.data.pupgradePoints;
    document.getElementById("fnameFlowerTitle").innerHTML = data.data.fnameFlower;
    document.getElementById("nquality").innerHTML = "Qualité du nectar : " + data.data.nquality;
    document.getElementById("fpopulation").innerHTML = "Population : "+data.data.fpopulation;
    let pop = parseInt(data.data.fpopulation, 10)
    if(oldPop !== pop){
        animateValue("points", oldPop, pop, 2000); //Commande pour mettre à jour les points

    }
    oldPop = pop;

    document.getElementById("fseeds").innerHTML = "Graines : "+data.data.fseeds;
    document.getElementById("fidealTemperature").innerHTML = "Température idéale : "+data.data.fidealTemperature;
    document.getElementById("ftemperatureAmplitude").innerHTML = "Amplitude de température : "+data.data.ftemperatureAmplitude;
    document.getElementById("nfructoseProp").innerHTML = "Fructose : "+data.data.nfructoseProp;
    document.getElementById("nsucroseProp").innerHTML = "Sucrose : "+data.data.nsucroseProp;
    document.getElementById("nglucoseProp").innerHTML = "Glucose : "+data.data.nglucoseProp;
    document.getElementById("bnameBiome").innerHTML = data.data.bnameBiome;
    document.getElementById("snameSeason").innerHTML = "Saison : "+data.data.snameSeason;
    document.getElementById("mnameMonth").innerHTML = "Mois : "+data.data.mnameMonth;
};
var eventCreateGameSolo = function(){

    var flowerSelection = document.getElementById("createFlowerSelection");
    var flowerId = flowerSelection.options[flowerSelection.selectedIndex].value;

    var biomeSelection = document.getElementById("createBiomeSelection");
    var biomeId = biomeSelection.options[biomeSelection.selectedIndex].value;

    /*var maxTurnsSelection = document.getElementById("");
    var maxTurns = e.options[e.selectedIndex].value;*/
    conn.send('{"event":"CreateGameSolo", "data":{"flowerId":'+flowerId+', "biomeId":'+biomeId+', "maxTurns":10}}');

    $('#myModal').modal('hide');
}

var eventGetAllFlowers = function(data){
    flowerList = data.data;
}

var eventGetAllBiomes = function(data){
    biomeList = data.data;
}

var eventAttributed = function(data){
    document.getElementById("message").innerHTML = "Point attribué à : " + data.data.variable;
}

var eventNoMorePoints = function(data){
    document.getElementById("message").innerHTML = "Plus de points!";

}

var getAllFlowers = function(){
    conn.send('{"event":"GetAllFlowers", "data":{}}');
}

var getAllBiomes = function(data){
    conn.send('{"event":"GetAllBiomes", "data":{}}');
}

var endTurn = function(){
    conn.send('{"event":"Ready", "data":{"isReady":true}}');
}

var temperatureAmplitudeIncrease = function(){
    conn.send('{"event":"Attribute", "data":{"variable":"TemperatureAmplitude"}}');
}

var overallQualityIncrease = function(){
    conn.send('{"event":"Attribute", "data":{"variable":"OverallQuality"}}');
}

var fructoseIncrease = function(){
    conn.send('{"event":"Attribute", "data":{"variable":"Fructose"}}');

}

var glucoseIncrease = function(){
    conn.send('{"event":"Attribute", "data":{"variable":"Glucose"}}');
}

var sucroseIncrease = function(){
    conn.send('{"event":"Attribute", "data":{"variable":"Sucrose"}}');
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

function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
        end = new Date().getTime();
    }
}