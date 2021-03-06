<?php
    require_once "_com/DAO.php";
    require_once "_com/PintarSesion.php";

    if (!DAO::haySesionRamIniciada()) {
      redireccionar("sesion-inicio.php");
    }

?>



<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="css/Estilos.css" />
    <script src="js/Scripts.js"></script>
    <title>SUPERLIGA SIMULATOR</title>
  </head>

  <body>

    <h1 style="text-align: center; margin-top: 1%">SUPERLIGA SIMULATOR</h1>

    <details>
      <summary style="text-align: center">¿Como Funciona?</summary>
      <p style="text-align: center">
        Bienvenido a
        <mark style="background-color: #7ee9fd">Superliga Simulator</mark>, para
        entender de donde sale la idea de esta app necesitarás conocer algo de
        historia sobre la
        <a
          href="https://es.wikipedia.org/wiki/Superliga_europea_de_f%C3%BAtbol"
          target="_blank"
          title="Ir a información sobre Superliga"
          >Superliga Europea de Fútbol.</a
        >
      </p>
      <p style="text-align: center">
        Este simulador es algo especial, tenemos 30 cupos repartidos entre las 5
        grandes ligas de Europa (España, Reino Unido, Italia, Alemania y
        Francia), 6 cupos en cada liga para los equipos clasificados a competición europea.
      </p>
      <p style="text-align: center">
        Podrás modificar los nombres, puntos y diferencia de goles de cada
        equipo, filtrado por sus respectivas ligas o en la tabla general.
      </p>
      <p style="text-align: center">
        <mark style="background-color: #fbe90b"
          >¿Quién será el rey de Europa? !Compruébalo ya!</mark
        >
      </p>
    </details>

    <h2 style="text-align: center">Selecciona Liga</h2>

    <div style="text-align: center">
      <button id="esp" value="1">
        <img src="img/esp.png" width="53" height="45" alt="LaLiga" />
      </button>
      <button id="ru" value="2">
        <img src="img/ru.png" width="53" height="45" alt="Premier League" />
      </button>
      <button id="it" value="3">
        <img src="img/it.png" width="53" height="45" alt="Serie A" />
      </button>
      <button id="al" value="4">
        <img src="img/al.png" width="53" height="45" alt="Bundesliga" />
      </button>
      <button id="fr" value="5">
        <img src="img/fr.png" width="53" height="45" alt="Ligue 1" />
      </button>
      <button id="eu">
        <img src="img/eu.png" width="53" height="45" alt="Europa" />
      </button>
    </div>

    <br />

    <div id="divCabecera"></div>

    <div id="equiposTabla" style="margin-left: 14%; margin-right: 7%">
      <div id="equiposCabecera"></div>
      <div id="equiposDatos" style="margin-bottom: 10%"></div>
    </div>
    <br />
  </body>
</html>
