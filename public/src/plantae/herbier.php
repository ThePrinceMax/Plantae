<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body, h2, p {
  margin: 0;
  padding: 0;
}

body {
  background-color: #444;
  color: #333;
  font-family: Helvetica, sans-serif;
}

#book {
  background:white;
  position: absolute;
  width: 830px;
  height: 260px;
  left: 50%;
  top: 50%;
  margin-left: -400px;
  margin-top: -125px;
}

#pages section {
  background: white;
  display: block;
  width: 400px;
  height: 250px;
  position: absolute;
  left: 415px;
  top: 5px;
  overflow: hidden;
}
#pages section>div {
  display: block;
  width: 400px;
  height: 250px;
  font-size: 12px;
}
#pages section p,
#pages section h2 {
  padding: 3px 35px;
  line-height: 1.4em;
  text-align: justify;
}
#pages section h2{
  margin: 15px 0 10px;
}

#pageflip-canvas {
  position: absolute;
  z-index: 100;
}

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

  <div>
    <div id="book">
      <canvas id="pageflip-canvas"></canvas>
      <div id="pages">
        <section>
          <div>
            <?php
                require_once('./php/bdd.php');
                $reqTulipe = 'SELECT nameFr, family, nameLatin, nbPetals, diseaseResistance, idealTemperature, temperatureAmplitude, colorPetals FROM flower WHERE id = 0';
                $tabTulipe = $db->query($reqTulipe);
                $nomFr = $tabTulipe['nameFr'];
                $family = $tabTulipe['family'];
                $nomLatin = $tabTulipe['nameLatin'];
                $nbPetales = $tabTulipe['nbPetals'];
                $maladieDef = $tabTulipe['diseaseResistance'];
                $idealTemperature = $tabTulipe['idealTemperature'];
                $temperatureAmplitude = $tabTulipe['temperatureAmplitude'];
                $couleurPetales = $tabTulipe['colorPetals'];
            ?>
            <h2>Tulipe</h2>
            <p>
              La <?php echo $nomFr ?>, aussi appelé <?php echo $nomLatin ?> en latin, provient de la famille <?php echo $family ?>. Cette fleur possède en générale <?php echo $nbPetales ?> pétales qui sont de couleurs <?php echo $couleurPetales ?>. Sa température idéale est d'environ <?php echo $idealTemperature ?> °C avec une amplitude d'à peu près <?php echo $temperatureAmplitude ?> °C. Elle a une resistance aux maladies d'environ <?php $maladieDef ?>.
            </p>
          </div>
        </section>
        <section>
          <div>
            <h2>Fleur 2</h2>
            <p>Description fleur 2</p>
          </div>
        </section>
        <section>
          <div>
            <h2>Fleur 3</h2>
            <p>Description fleur 3</p>
          </div>
        </section>
        <section>
          <div>
            <h2>Fleur 4</h2>
            <p>Description fleur 4</p>
          </div>
        </section>
      </div>
    </div>
  </div>
    <script  src="js/index.js"></script>
</div>
