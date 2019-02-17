<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);


    // $datos_usuario = mysql_query("SELECT * FROM usuarios ORDER BY Apellido ASC" ) or die ("problema en consulta:" .mysql_error());
    $datos_usuario = mysql_query("SELECT usuarios.Correo, usuarios.Clave, trabajadores.Nombre as Nombre, trabajadores.Apellido as Apellido, trabajadores.Cedula as Cedula, trabajadores.Telefono as Telefono, (Select desempenos.Desempeno FROM desempenos WHERE desempenos.IdDesempeno = trabajadores.Desempeno) as Cargo FROM usuarios, trabajadores WHERE trabajadores.Cedula = usuarios.Cedula ORDER BY Apellido ASC" ) or die ("problema en consulta:" .mysql_error());

?>