<?php 

include("/../conexiondb.php");

if (isset($_POST['actividad']) && !empty($_POST['actividad']) && 
    isset($_POST['fecha_ejecucion']) && !empty($_POST['fecha_ejecucion']) && 
    isset($_POST['id_cronograma_hide']) && !empty($_POST['id_cronograma_hide']) && 
    isset($_POST['selec_desempeno']) && !empty($_POST['selec_desempeno']))
    {

    $data = array();
    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $sel = mysql_query("INSERT INTO actividades 
    (IdCronograma,
    Actividad, 
    Fecha_Ejecucion,
    Estatus,
    Nota) VALUES ('$_POST[id_cronograma_hide]',
     '$_POST[actividad]', 
     '$_POST[fecha_ejecucion]', 
     '$_POST[selec_desempeno]', 
     '$_POST[nota]')", $con);  

    if ($sel) {
        $data['mensaje'] = "Agregado exitosamente";
        $data['codigo'] = "01";   
    }else {
        $a = " ".mysql_errno($con) . ": " . mysql_error($con) . "";
        $data['mensaje'] = $a;
        // $data['mensaje'] = "Error al agregar o Usuario ya se encuentra en la Base de Datos";
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