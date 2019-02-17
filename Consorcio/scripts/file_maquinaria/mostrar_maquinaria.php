<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);

    // $datos_maquinarias = mysql_query("SELECT Maquina, IdOperador, IdObra, Fecha_Desde, Fecha_Hasta 
    // -- FROM maquinaria " ) or die ("problema en consulta:" .mysql_error());

    // // $datos_maquinarias = mysql_query("SELECT Fecha_Desde, Fecha_Hasta,
    // -- (SELECT maquinas.Maquina AS Maquina FROM maquinas WHERE maquinaria.Maquina = maquinas.IdMaquina)
    // -- AS Maquina  FROM maquinaria " ) or die ("problema en consulta:" .mysql_error());

    $datos_maquinarias = mysql_query("SELECT IdMaquinaria, Fecha_Desde, Fecha_Hasta,
    (SELECT maquinas.Maquina AS Maquina FROM maquinas WHERE maquinaria.IdMaqui = maquinas.IdMaquina) as IdMaqui ,
    (SELECT trabajadores.Apellido as ApellidoOperador FROM trabajadores WHERE maquinaria.IdOperador = trabajadores.IdTrabajador) as IdOperador,
    (SELECT obras.Nombre_Obra AS Nombre_Obra FROM obras WHERE maquinaria.IdObra = obras.IdObras)
    AS IdObra  FROM maquinaria " ) or die ("problema en consulta:" .mysql_error());

  

?>



