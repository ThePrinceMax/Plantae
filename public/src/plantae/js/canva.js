// canva.js
// Created by Maxime Princelle
//----------------------------

let numberFlowers;
let biome;
let colorFlower;
let typeFlower;
let imageBack;
let imageFlower;

const c = document.getElementById('canvas');
const ctx = c.getContext('2d');

function resetCanvas(option){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    if (option == "nbflowers") {
        setBiome(biome);
    }
    else if (option == "changeflower") {
        setBiome(biome);
    }
    else if (option == "putElements") {
        setFlower(typeFlower, colorFlower, "keepBack");
    }
}

function setBiome(biomeSet) {
    biome = biomeSet;
    imageBack = new Image();
    imageBack.src = "./img/game/background/" + biomeSet + ".png"
    imageBack.onload = function(){
        ctx.drawImage(imageBack, 0, 0, canvas.width, canvas.height);
    }
    resetCanvas("putElements");
}

function setFlower(type, color, option) {
    if (option != "keepBack") {
        resetCanvas("changeflower");
    }
    typeFlower = type;
    colorFlower = color;
    imageFlower = new Image();
    imageFlower.src = "./img/game/flower/" + type + "_" + color + ".png";
    setFlowerNumber(numberFlowers, "keepBack");
}

function setFlowerNumber(numberFlowersSet, option) {
    if (option != "keepBack") {
        resetCanvas("nbflowers");
    }

    imageFlower.onload = function() {
        numberFlowers = numberFlowersSet;
        if (numberFlowersSet > 15) {
          numberFlowersSet = 15;
        }

        for (let i = 0; i <= numberFlowersSet; i++) {
          if (i < 8) {
              ctx.drawImage(imageFlower, canvas.width - (i * 100), canvas.height - 200, 50, 100);
          } else {
              ctx.drawImage(imageFlower, canvas.width - ((i - 8 + 1.5) * 100), canvas.height - 150, 50, 100);
          }
        }
    }
}
