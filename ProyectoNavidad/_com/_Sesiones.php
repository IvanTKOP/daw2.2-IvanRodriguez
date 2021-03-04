<?php 

require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Clases.php";

/* SESIONES */

 function sesionStartSiNoLoEsta()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

function establecerSesion($usuario)
{
    $_SESSION["sesionIniciada"] = "";
    $_SESSION["id"] = $usuario->getId();
    $_SESSION["email"] = $usuario->getEmail();
    $_SESSION["nombre"] = $usuario->getNombre();

}

 function haySesionIniciada(): bool
    {
        sesionStartSiNoLoEsta();
        return isset($_SESSION["id"]);
    }

 function generarCadenaAleatoria(int $longitud): string
    {
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
        return $s;
    }

    function garantizarSesion()
    {
        sessionStartSiNoLoEsta();

        if (haySesionIniciada()) {
            if (vieneCookieRecuerdame()) {
                establecerCookieRecuerdame($_COOKIE["email"], $_COOKIE["codigoCookie"]);
            
        } else {
            if (vieneFormularioDeInicioDeSesion()) { 

                $usuario = DAO::clienteObtenerPorEmailYContrasenna($_REQUEST['email'], $_REQUEST['contrasenna']);

                if ($usuario) { 
                    anotarDatosSesionRam($usuario);

                    if (isset($_REQUEST["recuerdame"])) { 
                        generarCookieRecuerdame($usuario);
                    }
                } else { 
                    redireccionar("sesion-inicio.php?incorrecto=true");
                }
            } else if (vieneCookieRecuerdame()) {
                $usuario = DAO::clienteObtenerPorEmailYCodigoCookie($_COOKIE["email"], $_COOKIE["codigoCookie"]);

                if ($usuario) { 
                    anotarDatosSesionRam($usuario);

                    generarCookieRecuerdame($usuario);
                } else { 
                    borrarCookieRecuerdame($usuario->getEmail());

                    redireccionar("sesion-inicio.php");
                }
            } else {
                redireccionar("sesion-inicio.php");
            }
        }
    }

  function generarCookieRecuerdame($usuario)
 {
    
    $codigoCookie = generarCadenaAleatoria(32);
    DAO::clienteGuardarCodigoCookie($usuario->getEmail(), $codigoCookie);

    establecerCookieRecuerdame($usuario->getEmail(), $codigoCookie);
}

function borrarCookieRecuerdame($email)
{
    DAO::clienteGuardarCodigoCookie($email, null);

    setcookie("email", "", time() - 3600); 
    setcookie("codigoCookie", "", time() - 3600); 
}


     function vieneFormularioDeInicioDeSesion()
    {
        return isset($_REQUEST['email']);
    }
    
   function vieneCookieRecuerdame()
    {
        return isset($_COOKIE["email"]);
    }

    function establecerSesionCookie($email, $codigoCookie)
    {
        setcookie("email", $email, time() + 24*60*60); 
        setcookie("codigoCookie", $codigoCookie, time() + 24*60*60);
    }

 function cerrarSesion($email)
{
    session_destroy();

    borrarCookieRecuerdame($email);
}

    function borrarCookies()
    {
        setcookie("usuario", "", time() - 3600);
        setcookie("codigoCookie", "", time() - 3600);
    }

}