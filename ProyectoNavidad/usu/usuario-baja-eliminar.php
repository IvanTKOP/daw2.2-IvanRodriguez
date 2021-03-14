<?php
require_once "../_com/comunes-app.php";

if (isset($_REQUEST["cancelar"])){
    redireccionar("usuario-detalle.php");
}
else{
DAO::usuarioActualizar();
require_once "sesion-cerrar.php";
};