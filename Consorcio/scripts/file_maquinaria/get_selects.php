<?php 

    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);


    $maquinas = mysql_query("SELECT * FROM maquinas WHERE Estado = '0' ORDER BY maquina ASC" ) or die ("problema en consulta:" .mysql_error());
    $operadores = mysql_query("SELECT * FROM trabajadores  WHERE Desempeno = '5' ORDER BY apellido ASC" ) or die ("problema en consulta:" .mysql_error());
    $obras = mysql_query("SELECT * FROM obras ORDER BY nombre_obra ASC" ) or die ("problema en consulta:" .mysql_error());
	
?>