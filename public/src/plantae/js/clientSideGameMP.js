/*
============================= GENERIC =============================
 */

//var conn = new WebSocket('ws://localhost:13750');
var conn = new WebSocket('wss://plantae.princelle.org/ws/');


var gameList = [];
var flowerList = [];
var biomeList = [];
var oldPop = 0;
var oldPercent = 0;

conn.onopen = function(e) {
    document.getElementById("modalTitle").innerHTML = "Connecté au serveur";
};

conn.onmessage = function(e) {
    console.log(e);
    var data = JSON.parse(e.data);
    console.log(data);
    if (data.event == 'playerInfo') {
        eventRefreshInfo(data);
    } else if (data.event == 'Reset') {
        eventResetInfo();
    } else if (data.event == 'CreateGameSolo') {
        eventCreateGameSolo();
    } else if (data.event == 'CreatedGameMP') {
        eventCreatedGameMP();
    } else if (data.event == 'GetAllGames') {
        eventGetAllGames(data);
    } else if (data.event == 'PlayerJoined') {
        eventPlayerJoined();
    }else if (data.event == 'EnnemyLeft') {
        eventEnnemyLeft();
    }else if (data.event == 'GameJoined'){
        eventGameJoined();
    } else if (data.event == 'NextTurn'){
        eventNextTurn();
    } else if (data.event == 'FlowerList'){
        eventGetAllFlowers(data);
    } else if (data.event == 'BiomeList'){
        eventGetAllBiomes(data);
    } else if (data.event == 'Attributed'){
        eventAttributed(data);
    } else if (data.event == 'NoMorePoints'){
        eventNoMorePoints();
    } else if (data.event == 'GameWon'){
        eventGameWon();
    } else if (data.event == 'GameLost'){
        eventGameLost();
    } else if (data.event == 'Draw'){
        eventGameDraw();
    }
};



var eventCreatedGameMP = function () {
    document.getElementById("modalTitle").innerHTML = "En attente d'un joueur";
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreationMP").style.display="none";
}

var eventPlayerJoined = function(){
    $('#modalMP').modal('hide');
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreationMP").style.display="none";
}

var eventGameJoined = function(){
    $('#modalMP').modal('hide');
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreationMP").style.display="none";
}

var eventEnnemyLeft = function() {
    $('#modalMP').modal('show');
    document.getElementById("modalTitle").innerHTML = "L'autre joueur s'est déconnecté";
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="block";
    document.getElementById("gameCreationMP").style.display="none";
}

var eventRefreshInfo = function(data) {

    if((parseInt(data.data.turn, 10)) === 0){
        setBiome(data.data.bnameBiome);
        setFlower("rose", "red");

    }

    let flowerToDisplay = Math.floor((~~(((parseInt(data.data.fpopulation, 10)+ 999) / 1000) * 1000))/650);

    console.log(flowerToDisplay);

    setFlowerNumber(flowerToDisplay);

    //resetCanvas("nbflowers");

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
    if(data.data.currentEvent !== undefined){
        document.getElementById("message").innerHTML = "Event : " + data.data.currentEvent;
    }
    else{
        document.getElementById("message").innerHTML = "???";
    }

    if(data.data.nbTurns === data.data.turn){
        initializeModal();
    }

};

var eventNextTurn = function(){
    $('#modalMP').modal('hide');
}

var eventGetAllFlowers = function(data){
    flowerList = data.data;

    let selectFlowerCreate = document.getElementById("createFlowerSelection");

    selectFlowerCreate.options.length =0;
    let keyFlowerCreate;
    for (keyFlowerCreate in flowerList) {
        if (flowerList.hasOwnProperty(keyFlowerCreate)  &&        // These are explained
            /^0$|^[1-9]\d*$/.test(keyFlowerCreate) &&    // and then hidden
            keyFlowerCreate <= 4294967294                // away below
        ) {
            selectFlowerCreate.options[selectFlowerCreate.options.length] = new Option(flowerList[keyFlowerCreate], keyFlowerCreate);
        }
    }

    let selectFlower = document.getElementById("joinFlowerSelection");

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
}

var eventGetAllBiomes = function(data){
    biomeList = data.data;

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

    conn.removeEventListener('open', initializeModal);
}

var eventGetAllGames = function (data){
    gameList = data.data;

    let select = document.getElementById("serverGamesSelection");

    select.options.length =0;
    let keyGame;
    for (keyGame in gameList) {
        if (gameList.hasOwnProperty(keyGame)  &&        // These are explained
            /^0$|^[1-9]\d*$/.test(keyGame) &&    // and then hidden
            keyGame <= 4294967294                // away below
        ) {
            select.options[select.options.length] = new Option(gameList[keyGame], keyGame);
        }
    }

    conn.removeEventListener('open', initializeModal);
}

var eventAttributed = function(data){
    document.getElementById("message").innerHTML = "Point attribué à : " + data.data.variable;
}

var eventNoMorePoints = function(data){
    document.getElementById("message").innerHTML = "Plus de points!";

}

var eventGameWon = function(){
    document.getElementById("modalTitle").innerHTML = "Vous avez gagné !";
    initializeModal();
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="block";
    document.getElementById("gameCreationMP").style.display="none";

}

var eventGameLost = function(){
    document.getElementById("modalTitle").innerHTML = "Vous avez perdu !";
    initializeModal();
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="block";
    document.getElementById("gameCreationMP").style.display="none";

}

var eventGameDraw = function(){
    document.getElementById("modalTitle").innerHTML = "Egalité !";
    initializeModal();
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="block";
    document.getElementById("gameCreationMP").style.display="none";

}

var getAllFlowers = function(){
    conn.send('{"event":"GetAllFlowers", "data":{}}');
}

var getAllBiomes = function(data){
    conn.send('{"event":"GetAllBiomes", "data":{}}');
}

var getAllGames = function(){
    conn.send('{"event":"GetAllGames", "data":{}}');
}

var endTurn = function(){
    document.getElementById("modalTitle").innerHTML = "En attente de l'autre joueur";
    $('#modalMP').modal('show');
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

var redirectToOnline = function() {
    $location.path("/jeu-online");
    $('#modalMP').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

var redirectToSolo = function(){
    $location.path("/jeu-solo");
    $('#modalMP').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

var redirectToIndex = function(){
    $location.path("/");
    $('#modalMP').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

function wait(ms) {
    var start = new Date().getTime();
    var end = start;
    while (end < start + ms) {
        end = new Date().getTime();
    }
}
/*
============================= GENERIC =============================
*/

var initializeModal = function(){
    $('#modalMP').modal({
        backdrop: 'static',
        keyboard: false
    }, 'show')

    document.getElementById("gameCreationMP").style.display="none";
    document.getElementById("gameJoiningMP").style.display="none";
}

function showGameCreationMP(){

    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreationMP").style.display="block";

    getAllFlowers();

    getAllBiomes();

}

function showGameJoiningMP(){

    document.getElementById("loginActionChoice").style.display="none";
    document.getElementById("gameCreationMP").style.display="none";
    document.getElementById("gameJoiningMP").style.display="block";

    getAllFlowers();

    getAllGames();

}
function backToLoginActionChoice(){

    document.getElementById("gameCreationMP").style.display="none";
    document.getElementById("gameJoiningMP").style.display="none";
    document.getElementById("loginActionChoice").style.display="block";
}

var createGameMP = function(){

    var flowerSelection = document.getElementById("createFlowerSelection");
    var flowerId = flowerSelection.options[flowerSelection.selectedIndex].value;

    var biomeSelection = document.getElementById("createBiomeSelection");
    var biomeId = biomeSelection.options[biomeSelection.selectedIndex].value;

    /*var maxTurnsSelection = document.getElementById("");
    var maxTurns = e.options[e.selectedIndex].value;*/
    conn.send('{"event":"CreateGamePVP", "data":{"flowerId":'+flowerId+', "biomeId":'+biomeId+', "maxTurns":10}}');

}

var joinGame = function(){
    var flowerSelection = document.getElementById("createFlowerSelection");
    var flowerId = flowerSelection.options[flowerSelection.selectedIndex].value;

    var serverIDSelection = document.getElementById("serverID");
    var serverID = serverIDSelection.value;

    conn.send('{"event":"Join", "data":{"serverId":'+serverID+', "flowerId":'+flowerId+'}}');
}

conn.addEventListener('open', initializeModal);