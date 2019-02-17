<?php 

include("/../conexiondb.php");


if (isset($_POST['selec_chofer']) && !empty($_POST['selec_chofer']) && 
	isset($_POST['actividad']) && !empty($_POST['actividad']) &&
    isset($_POST['fecha_ejecucion']) && !empty($_POST['fecha_ejecucion']) && 
	isset($_POST['selec_estatus']) && !empty($_POST['selec_estatus']) &&
    isset($_POST['localidades']) && !empty($_POST['localidades']))
{

    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

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

    // Debemos insertar cada una de las localidades
    if ($lat0 != 0) {
      $loc0 = mysql_query("INSERT INTO localidades (Latitud, Longitud) VALUES ('$lat0','$lng0')", $con);
      $loc0_ID = mysql_insert_id($con);
      // var_dump("Error id 0: " . mysql_error($con));
    }

    if ($lat1 != 0) {
      $loc1 = mysql_query("INSERT INTO localidades (Latitud, Longitud) VALUES ('$lat1','$lng1')", $con);
      $loc1_ID = mysql_insert_id($con);
      // var_dump("Error id 1: " . mysql_error($con));
    }

    if ($lat2 != 0) {
      $loc2 = mysql_query("INSERT INTO localidades (Latitud, Longitud) VALUES ('$lat2','$lng2')", $con);
      $loc2_ID = mysql_insert_id($con);
      // var_dump("Error id 2: " . mysql_error($con));
    }

    // var_dump($loc0_ID);
    // var_dump($loc1_ID);
    // var_dump($loc2_ID);

    // var_dump($lat0);
    // var_dump($lng0);
    // var_dump($lat1);
    // var_dump($lng1);
    // var_dump($lat2);
    // var_dump($lng2);

    // var_dump($_POST);
    
    // $sel = mysql_query("INSERT INTO rutachoferes (Chofer, Actividad, Fecha_Ejecucion, Estatus, Latitud1, Longitud1, Latitud2, Longitud2, Latitud3, Longitud3) VALUES ('$_POST[selec_chofer]', '$_POST[actividad]', '$_POST[fecha_ejecucion]', '$_POST[selec_estatus]', ".$lat0.",". $lng0.",". $lat1.",". $lng1.",". $lat2.",". $lng2.")", $con);
    // var_dump("Error description: " . mysql_error($con));

    $sel = mysql_query("INSERT INTO rutachoferes 
    (Chofer, Actividad, Fecha_Ejecucion, Estatus, Idloc1, Idloc2, Idloc3) 
    VALUES ('$_POST[selec_chofer]', 
    '$_POST[actividad]', 
    '$_POST[fecha_ejecucion]', 
    '$_POST[selec_estatus]', 
    $loc0_ID, 
    $loc1_ID, 
    $loc2_ID)", $con);
    // var_dump("Error id 2: " . mysql_error($con));
    if ($sel) {
        $data['mensaje'] = "Agregado exitosamente";
        $data['codigo'] = "01";   
    }else {
        $data['mensaje'] = "Error al agregar o Usuario ya se encuentra en la Base de Datos";
        $data['codigo'] = "02";   
    }
 
} else {
    $data = array();

    $data['mensaje'] = "Error al enviar la información, por favor verifique los campos";
    $data['codigo'] = "02";  

}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
 ?>