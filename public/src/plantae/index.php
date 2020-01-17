<!DOCTYPE html>
<html lang="fr" ng-app="plantae">
<head>
    <meta charset="UTF-8">
    <title>Plantae</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Maxime Princelle">

    <!-- Scripts -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/angular.min.js"></script>
    <script src="./js/angular-route.js"></script>
    <script src="./js/loading.js"></script>
    <script src="./js/bootstrap-notify.min.js"></script>

    <!-- Statistiques -->
    <script src="https://www.w3counter.com/tracker.js?id=122588"></script>
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(["setCookieDomain", "*.plantae.princelle.org"]);
  _paq.push(["setDomains", ["*.plantae.princelle.org"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.princelle.org/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '6']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//analytics.princelle.org/matomo.php?idsite=6&amp;rec=1" style="border:0;" alt="" /></p></noscript>

    <!-- CSS Styles -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/loading.css">

    <!-- Logo -->
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="icon" href="./img/logo.png" type="image/x-icon">
</head>
<body>
    <!-- Preloader -->
    <section id="preloader">
        <div id="loader" class="loader">
            <div>
                <img src="./img/loading.gif" alt="Loading">
                <span class="caption"><p></p></span>
                <span class="caption"><h1>Recherche des plantes...</h1></span>
            </div>
        </div>
    </section>

    <!-- Navbar -->
    <section id="navbar">
        <nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg shadow-lg">

            <a class="navbar-left" href="#">
                <img alt="Brand" style="max-width: 2.5rem; max-height: 2.5rem; object-fit: contain;" src="./img/logo.png">
            </a>

            <a class="navbar-brand" href="#">Plantae</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil<span class="sr-only">(current)</span></a>
                    </li>


                    <li class="nav-item">
                      <a class="nav-link" href="#!herbier">Herbier</a>
                    </li>

                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle btn btn-outline-secondary" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jeux</button>
                        <div class="dropdown-menu shadow-lg" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#!jeu-solo">Solo</a>
                            <!--
                            <a class="dropdown-item disabled" href="#!quizz">Quizz (en cours de développement)</a>
                            -->
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Multi-joueur</h6>
                            <a class="dropdown-item" href="#!jeu-onsite">OnSite - 1v1</a>
                            <a class="dropdown-item" href="#!jeu-online">OnLine - 1v1</a>
                        </div>
                    </li>
                </ul>
            </div>

        </nav>
    </section>

    <div ng-view></div>

    <script>
        var app = angular.module("plantae", ["ngRoute"]);
        app.config(function($routeProvider) {
            $routeProvider
            .when("/", {
                templateUrl : "start.html"
            })
            .when("/quizz", {
                templateUrl : "quizz.php"
            })
            .when("/jeu-solo", {
                templateUrl : "local.html"
            })
            .when("/jeu-onsite", {
                templateUrl : "local1v1.html"
            })
            .when("/jeu-online", {
                templateUrl : "lan.html"
            })
            .when("/herbier", {
                templateUrl : "herbier.php"
            })
            .otherwise('/');
        });
</script>

</body>
</html>
