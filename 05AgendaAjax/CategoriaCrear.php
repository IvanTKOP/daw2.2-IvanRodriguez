<?php
    require_once "_com/_DAO.php";

    $categoria = DAO::categoriaCrear($_REQUEST["nombre"]);

    echo json_encode($categoria);
?>