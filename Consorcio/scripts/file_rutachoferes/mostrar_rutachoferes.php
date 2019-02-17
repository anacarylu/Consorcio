<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);

    // // $datos_rutachofer = mysql_query("SELECT Actividad, Fecha_Ejecucion, IdRutachoferes,    
    // -- trabajadores.Apellido as ApellidoChofer, trabajadores.Nombre AS NombreChofer
    // -- FROM rutachoferes, trabajadores 
    // -- WHERE trabajadores.IdTrabajador = rutachoferes.Chofer" ) or die ("problema en consulta:" .mysql_error());     

    $datos_rutachofer = mysql_query("SELECT Actividad, Fecha_Ejecucion, IdRutachoferes,    
    trabajadores.Apellido as ApellidoChofer, trabajadores.Nombre AS NombreChofer,
    (SELECT estatus.Descripcion AS Descripcion FROM estatus WHERE rutachoferes.Estatus = estatus.IdEstatus)
    AS Estatus FROM rutachoferes, trabajadores 
    WHERE trabajadores.IdTrabajador = rutachoferes.Chofer" ) or die ("problema en consulta:" .mysql_error());  

    // $datos_rutachofer = mysql_query("SELECT * FROM rutachoferes" ) or die ("problema en consulta:" .mysql_error());

?>