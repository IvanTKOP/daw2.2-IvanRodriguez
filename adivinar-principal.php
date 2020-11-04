<?php
    $oculto = (int)$_REQUEST["oculto"];

    if(isset($_REQUEST['numero'])) {
        $numero = $_REQUEST['numero'];
        $intento= $_REQUEST['intento'] + 1;
    }else{
        $numero=null;
        $intento=0;
    }

?>

  <html>
  <head>
      <meta charset="UTF-8">

  </head>
  <body>
  <?php
  if($numero!=null) {
      if ($numero == $oculto) {
          echo "Has acertado! El número era $oculto y has tardado en adivinarlo $intento intentos";
      } else if ($numero > $oculto) {
              echo "Más bajo";
          } else if ($numero<$oculto){
              echo "Más alto";
          }
  }
  ?>

  <form method="post">
      <p>Jugador 2 adivina el número del jugador 1</p>
      <input type="hidden" name="oculto" value="<?=$oculto?>">
      <input type="hidden" name="intento" value="<?=$intento?>">
      <input type="number" name="numero">
      <input type="submit"  value="Enviar">
  </form>
  </body>
  </html>



