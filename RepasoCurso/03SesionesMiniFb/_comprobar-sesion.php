<?php //TODAVIA NO
/*
session_start();

if(isset($_SESSION["sesionIniciada"])) {
//No hacemos nada
} else {
if(isset($_COOKIE["codigoCookie"])) {
if($_COOKIE["codigoCookie"] == ){
$sesionIniciada = $_SESSION["sesionIniciada"];
setcookie("codigoCookie", $codigoCookie, time() + 60 * 60);
} else {
header("Location: iniciar-sesion.php");
exit;
}
} else {
if(isset($_REQUEST["identificador"])) {
if($_REQUEST["identificador"] == ) {

} else {
header("Location: iniciar-sesion.php");
exit;
}
}
}
}
