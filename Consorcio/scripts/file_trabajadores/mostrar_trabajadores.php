<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);


    $datos_trabajador = mysql_query("SELECT Apellido, Nombre, Cedula, Telefono, Fecha_Ingreso, Fecha_Salida,
    (SELECT desempenos.Desempeno AS Desempeno FROM desempenos WHERE trabajadores.Desempeno = desempenos.IdDesempeno)
    AS Desempeno  FROM trabajadores ORDER BY Apellido ASC" ) or die ("problema en consulta:" .mysql_error());

?>