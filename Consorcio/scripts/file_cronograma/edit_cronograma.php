<?php 

include("/../conexiondb.php");

if (isset($_POST['descripcion_crono']) && !empty($_POST['descripcion_crono']) && 
    isset($_POST['fecha_inicio']) && !empty($_POST['fecha_inicio']) && 
	isset($_POST['fecha_final']) && !empty($_POST['fecha_final'])) 
{

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_cronograma = mysql_query("UPDATE cronograma SET 
    Descripcion = '$_POST[descripcion_crono]', 
    Fecha_Inicio = '$_POST[fecha_inicio]', 
    Fecha_Final = '$_POST[fecha_final]',
    IdObra = '$_POST[id_obra_actual]'WHERE IdCronograma = '$_POST[IdCronogramaViejo]'", $con);
    

    if ($datos_cronograma) {    
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