<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);


    $datos_obras = mysql_query("SELECT * FROM obras" ) or die ("problema en consulta:" .mysql_error());
       

?>