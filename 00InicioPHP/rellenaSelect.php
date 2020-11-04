<html>
<body>
<select>
<?php

    $ids = array (123, 321, 521, 555, 246, 999);
    $nombres = array ("Juan", "Luis", "Alberto", "Maria", "Javier", "Raul");
    foreach($ids as $posicionIds) {
        echo "<option value=$posicionIds>";
        echo $posicionIds;
        echo "</option>\n";
    }
    foreach($nombres as $posicionNom) {
        echo "<option value='" . $posicionNom . "'>";
        echo $posicionNom;
        echo "</option>\n";
    }
?>
</select>
</body>
</html>