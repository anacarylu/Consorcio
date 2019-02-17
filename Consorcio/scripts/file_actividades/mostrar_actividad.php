<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);mysql_set_charset('utf8', $con);

    if (isset($_GET['IdCronograma']) && !empty($_GET['IdCronograma']) ) {
        $id_cronograma = $_GET['IdCronograma'];
        $id_obra_actual = mysql_query("SELECT IdObra FROM cronograma WHERE IdCronograma = $id_cronograma" ) or die ("problema en consulta:" .mysql_error());
        $id_obra_actual = mysql_result($id_obra_actual,0);
        // $datos_actividad = mysql_query("SELECT * FROM actividades WHERE IdCronograma = $id_cronograma" ) or die ("problema en consulta:" .mysql_error());



        $datos_actividad = mysql_query("SELECT IdActividad, Actividad, Fecha_Ejecucion, Nota,
        (SELECT estatus.Descripcion AS Descripcion FROM estatus WHERE actividades.Estatus = estatus.IdEstatus)
        AS Estatus  FROM actividades WHERE IdCronograma = $id_cronograma " ) or die ("problema en consulta:" .mysql_error());  




        $id_obra = mysql_query("SELECT IdObra FROM cronograma WHERE IdCronograma = $id_cronograma" ) or die ("problema en consulta:" .mysql_error());
        $id_obra = mysql_result($id_obra,0);
        $nombre_obra = mysql_query("SELECT Nombre_Obra FROM obras WHERE IdObras = $id_obra" ) or die ("problema en consulta:" .mysql_error());
        $nombre_obra = mysql_result($nombre_obra,0);
    
        $fecha_crono_inicio = mysql_query("SELECT Fecha_Inicio FROM cronograma WHERE IdCronograma = $id_cronograma" ) or die ("problema en consulta:" .mysql_error());
        $fecha_crono_inicio = mysql_result($fecha_crono_inicio,0);
        $fecha_crono_final = mysql_query("SELECT Fecha_Final FROM cronograma WHERE IdCronograma = $id_cronograma" ) or die ("problema en consulta:" .mysql_error());
        $fecha_crono_final = mysql_result($fecha_crono_final,0);

     } else {
         if (isset($_GET['estatus']) && !empty($_GET['estatus']) ) {
             $estatus = $_GET['estatus'];
             $id_obra_actual = 0;
             $id_cronograma = 0;


             $datos_actividad = mysql_query("SELECT IdActividad, actividades.IdCronograma as IdCronograma, Actividad, 
             Fecha_Ejecucion, (SELECT estatus.Descripcion AS Descripcion FROM estatus WHERE actividades.Estatus = estatus.IdEstatus)
             AS Estatus, Nota, Nombre_Obra 
            FROM actividades left join cronograma on actividades.IdCronograma = cronograma.IdCronograma         
             left join obras on cronograma.IdObra = obras.IdObras
             WHERE Estatus = $estatus
             AND IdObras = IdObra" ) or die ("problema en consulta:" .mysql_error());
         } else {            
             header('Location: home.php');
         }
    }

    

?>