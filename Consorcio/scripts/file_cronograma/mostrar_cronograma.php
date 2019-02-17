<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    if (isset($_GET['IdObra']) && !empty($_GET['IdObra']) ) {
        $id = $_GET['IdObra'];        
        $datos_cronograma = mysql_query("SELECT * FROM cronograma WHERE IdObra = $id ORDER BY Fecha_Inicio desc" ) or die ("problema en consulta:" .mysql_error());
    
        $nombre_obra = mysql_query("SELECT Nombre_Obra FROM obras WHERE IdObras = $id" ) or die ("problema en consulta:" .mysql_error());
        $nombre_obra = mysql_result($nombre_obra,0);
    } else {
        header('Location: home.php');
    }

?>