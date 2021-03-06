// canva.js
// Created by Maxime Princelle
//----------------------------

var numberFlowers;
var biome;
var colorFlower;
var typeFlower;
var imageBack;
var imageFlower;

const getdisplay = document.getElementById('canvas');
const display = getdisplay.getContext('2d');

function resetCanvas(option){
    if (option == "nbflowers") {
        display.clearRect(0, 0, canvas.width, canvas.height);
        setBiome(biome);
    }
    else if (option == "changeflower") {
        display.clearRect(0, 0, canvas.width, canvas.height);
        setBiome(biome);
    }
    else if (option == "putElements") {
        if (colorFlower === undefined && typeFlower === undefined && numberFlowers === undefined) {
            //No flower has been displayed yet.
        }
        else {
            setFlower(typeFlower, colorFlower, "keepBack");
        }
    }
}

function setBiome(biomeSet) {
    biome = biomeSet;
    imageBack = new Image();
    imageBack.src = "./img/game/background/" + biomeSet + ".png"
    imageBack.onload = function(){
        display.drawImage(imageBack, 0, 0, canvas.width, canvas.height);
        resetCanvas("putElements");
    }
}

function setFlower(type, color, option) {
    typeFlower = type;
    colorFlower = color;
    if (option != "keepBack") {
        resetCanvas("changeflower");
    }
    imageFlower = new Image();
    imageFlower.src = "./img/game/flower/" + type + "_" + color + ".png";
    setFlowerNumber(numberFlowers, "keepBack");
}

function setFlowerNumber(numberFlowersSet, option) {
    numberFlowers = numberFlowersSet;

    if (option != "keepBack") {
        resetCanvas("nbflowers");
    }

    imageFlower.onload = function() {
        if (numberFlowersSet > 15) {
          numberFlowersSet = 15;
        }

        for (let i = 0; i <= numberFlowersSet; i++) {
          if (i < 8) {
              display.drawImage(imageFlower, canvas.width - (i * 100), canvas.height - 200, 50, 100);
          } else {
              display.drawImage(imageFlower, canvas.width - ((i - 8 + 1.5) * 100), canvas.height - 150, 50, 100);
          }
        }
    }
}

$(window).resize(function(){
    setBiome(biome);
    setFlower(typeFlower, colorFlower);
    setFlowerNumber(numberFlowers);
});
