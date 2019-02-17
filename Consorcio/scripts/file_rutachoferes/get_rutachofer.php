<?php 

include("/../conexiondb.php");

if (isset($_POST['IdRutachoferes']) && !empty($_POST['IdRutachoferes'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_rutachofer = mysql_query("SELECT * FROM rutachoferes WHERE IdRutachoferes = '$_POST[IdRutachoferes]'", $con);

    while($reg=mysql_fetch_array($datos_rutachofer)){

        $data['Chofer'] = $reg['Chofer'];
        $data['Actividad'] = $reg['Actividad'];
        $data['Fecha_Ejecucion'] = $reg['Fecha_Ejecucion'];
        $data['Estatus'] = $reg['Estatus'];
        $data['Idloc1'] = $reg['Idloc1'];
        $data['Idloc2'] = $reg['Idloc2'];
        $data['Idloc3'] = $reg['Idloc3'];
        // $data['Latitud1'] = $reg['Latitud1'];
        // $data['Longitud1'] = $reg['Longitud1'];
        // $data['Latitud2'] = $reg['Latitud2'];
        // $data['Longitud2'] = $reg['Longitud2'];
        // $data['Latitud3'] = $reg['Latitud3'];
        // $data['Longitud3'] = $reg['Longitud3'];
        $data['IdRutachoferes'] = $reg['IdRutachoferes'];
        $data['mensaje'] = "Informacion obtenida para editar";
        $data['codigo'] = "01";

    }
    
    $loc1 = mysql_query("SELECT * FROM localidades WHERE IdLocalidades = ".$data['Idloc1']."", $con);
    $loc2 = mysql_query("SELECT * FROM localidades WHERE IdLocalidades = ".$data['Idloc2']."", $con);
    $loc3 = mysql_query("SELECT * FROM localidades WHERE IdLocalidades = ".$data['Idloc3']."", $con);
    while($reg=mysql_fetch_array($loc1)){
      $data['Latitud1'] = $reg['Latitud'];
      $data['Longitud1'] = $reg['Longitud'];
    }
    while($reg=mysql_fetch_array($loc2)){
      $data['Latitud2'] = $reg['Latitud'];
      $data['Longitud2'] = $reg['Longitud'];
    }
    while($reg=mysql_fetch_array($loc3)){
      $data['Latitud3'] = $reg['Latitud'];
      $data['Longitud3'] = $reg['Longitud'];
    }

}else {
    $data = array();
    $data['mensaje'] = "Error al enviar a información";
    $data['codigo'] = "03";       
}
   
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
?>