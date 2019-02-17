<?php 

include("/../conexiondb.php");

if (isset($_POST['actividad']) && !empty($_POST['actividad']) &&
    isset($_POST['fecha_ejecucion']) && !empty($_POST['fecha_ejecucion']) && 
    isset($_POST['selec_desempeno']) && !empty($_POST['selec_desempeno']) &&  
	isset($_POST['nota']) && !empty($_POST['nota'])) 
{

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_actividad = mysql_query("UPDATE actividades SET 
    Actividad = '$_POST[actividad]', 
    Fecha_Ejecucion = '$_POST[fecha_ejecucion]', 
    Estatus = '$_POST[selec_desempeno]', 
    Nota = '$_POST[nota]' WHERE IdActividad = '$_POST[id_viejo]'", $con);
    

    if ($datos_actividad) {    
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