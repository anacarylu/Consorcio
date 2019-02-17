<?php 

include("/../conexiondb.php");

if (isset($_POST['selec_operador']) && !empty($_POST['selec_operador']) &&
    isset($_POST['selec_obra']) && !empty($_POST['selec_obra']) && 
    isset($_POST['fecha_desde']) && !empty($_POST['fecha_desde'])) 
{

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_maquinarias = mysql_query("UPDATE maquinaria SET
    IdOperador = '$_POST[selec_operador]', 
    IdObra = '$_POST[selec_obra]',
    Fecha_Desde = '$_POST[fecha_desde]', 
    Fecha_Hasta = '$_POST[fecha_hasta]'WHERE IdMaquinaria = '$_POST[id_viejo]'", $con);
    

    if ($datos_maquinarias) {    
        $data['mensaje'] = "Informacion actualizada";
        $data['codigo'] = "01";
    } else {
        $data['mensaje'] = "Error actualizando";
        $data['codigo'] = "02";
    }                    

}else {
    $data = array();
    $data['mensaje'] = "Error al enviar a información, por favor verifique los campos";
    $data['codigo'] = "03";       
}
   
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
?>