<?php 

include("/../conexiondb.php");

if (isset($_POST['selec_chofer']) && !empty($_POST['selec_chofer']) && 
	isset($_POST['actividad']) && !empty($_POST['actividad']) &&
    isset($_POST['fecha_ejecucion']) && !empty($_POST['fecha_ejecucion']) && 
	isset($_POST['selec_estatus']) && !empty($_POST['selec_estatus'])) 
    // isset($_POST['localidades']) && !empty($_POST['localidades'])) 
{

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    // var_dump("Error description: " . mysql_error($con));  
    // var_dump($_POST);  
    $data = array();

    $array_localidades = json_decode($_POST['localidades'],true);

    $lat0 = (isset($array_localidades[0])) ? $array_localidades[0]['lat'] : 0;
    $lng0 = (isset($array_localidades[0])) ? $array_localidades[0]['lng'] : 0;
    $lat1 = (isset($array_localidades[1])) ? $array_localidades[1]['lat'] : 0;
    $lng1 = (isset($array_localidades[1])) ? $array_localidades[1]['lng'] : 0;
    $lat2 = (isset($array_localidades[2])) ? $array_localidades[2]['lat'] : 0;
    $lng2 = (isset($array_localidades[2])) ? $array_localidades[2]['lng'] : 0;
    
    // Asumiendo no recibir todas las localidades y se modifican en lo siguiente
    $loc0_ID = 0;
    $loc1_ID = 0;
    $loc2_ID = 0;

    // Identificar ID de localidades anteriores para editar
    $sel_loc = mysql_query("SELECT Idloc1, Idloc2, Idloc3 FROM rutachoferes WHERE IdRutachoferes = '$_POST[id_viejo]'",$con);
    while($reg=mysql_fetch_array($sel_loc)){
      if ($reg['Idloc1'] == 0) {
        if ($lat0 != 0) {
          // Insert en localidades y obtener ultimo id para actualizar en rutachofer
          $loc0 = mysql_query("INSERT INTO localidades (Latitud, Longitud) VALUES ('$lat0','$lng0')", $con); 
          $loc0_ID = mysql_insert_id($con);       
        } else {
          // No se aplica nada
        }
      } else {
        if ($lat0 != 0) {
            // Update lat y long where Idloc1 == Idlocalidades in localidades
            $loc0 = mysql_query("UPDATE localidades SET Latitud = $lat0, Longitud = $lng0 WHERE IdLocalidades= ".$reg['Idloc1']." ", $con); 
            $loc0_ID = $reg['Idloc1'];        
        } else {
            // lat0 = 0 Necesito actualizar el valor de Idloc1 en rutachoferes a 0 Where $_POST[id_viejo]
            $loc0_ID = 0;
        }
        }

      if ($reg['Idloc2'] == 0) {
        if ($lat1 != 0) {
          // Insert en localidades y obtener ultimo id para actualizar en rutachofer
          $loc1 = mysql_query("INSERT INTO localidades (Latitud, Longitud) VALUES ('$lat1','$lng1')", $con); 
          $loc1_ID = mysql_insert_id($con); 
        } else {
          // No se aplica nada
        }
      } else {
        if ($lat1 != 0) {
          // Update a valor where Idloc1 == Idlocalidades in localidades
          $loc1 = mysql_query("UPDATE localidades SET Latitud = $lat1, Longitud = $lng1 WHERE IdLocalidades= ".$reg['Idloc2']." ", $con); 
          $loc1_ID = $reg['Idloc2'];           
        } else {
          // lat0 = 0 Necesito actualizar el valor de Idloc1 en rutachoferes a 0 Where $_POST[id_viejo]
          $loc1_ID = 0;
        }
      } 
      
      if ($reg['Idloc3'] == 0) {
        if ($lat2 != 0) {
          // Insert en localidades y obtener ultimo id para actualizar en rutachofer
          $loc2 = mysql_query("INSERT INTO localidades (Latitud, Longitud) VALUES ('$lat2','$lng2')", $con); 
          $loc2_ID = mysql_insert_id($con);           
        } else {
          // No se aplica nada
        }
      } else {
        if ($lat2 != 0) {
          // Update a valor where Idloc1 == Idlocalidades in localidades
          $loc2 = mysql_query("UPDATE localidades SET Latitud = $lat2, Longitud = $lng2 WHERE IdLocalidades= ".$reg['Idloc3']." ", $con); 
          $loc2_ID = $reg['Idloc3'];            
        } else {
          // lat0 = 0 Necesito actualizar el valor de Idloc1 en rutachoferes a 0 Where $_POST[id_viejo]
          $loc2_ID = 0;
        }
      }       
    }


    $datos_rutachofer = mysql_query("UPDATE rutachoferes SET 
    Chofer = '$_POST[selec_chofer]', 
    Actividad = '$_POST[actividad]', 
    Fecha_Ejecucion = '$_POST[fecha_ejecucion]',
    Estatus = '$_POST[selec_estatus]',
    Idloc1 = $loc0_ID,
    Idloc2 = $loc1_ID, 
    Idloc3 = $loc2_ID
    WHERE IdRutachoferes = '$_POST[id_viejo]'", $con);
    
    // -- Latitud1 = $lat0,
    // -- Longitud1 = $lng0,
    // -- Latitud2 = $lat1,
    // -- Longitud2 = $lng1,
    // -- Latitud3 = $lat2,
    // -- Longitud3 = $lng2
    


    if ($datos_rutachofer) {    
        $data['mensaje'] = "Informacion actualizada";
        $data['codigo'] = "01";
    } else {
        $data['mensaje'] = "Error actualizando";
        $data['codigo'] = "02";
    }                    

}else {
    $data = array();
    $data['mensaje'] = "Error al enviar la información, por favor verifique los campos";
    $data['codigo'] = "03";       
}
   
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
?>