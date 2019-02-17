<?php 

include("/../conexiondb.php");

if (isset($_POST['descripcion_crono']) && !empty($_POST['descripcion_crono']) && 
    isset($_POST['fecha_inicio']) && !empty($_POST['fecha_inicio']) && 
	isset($_POST['fecha_final']) && !empty($_POST['fecha_final']))
    {

    $data = array();
    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $sel = mysql_query("INSERT INTO cronograma 
    (Descripcion, Fecha_Inicio, 
    Fecha_Final, IdObra)
     VALUES ('$_POST[descripcion_crono]', '$_POST[fecha_inicio]', 
     '$_POST[fecha_final]', '$_POST[id_obra_actual]')", $con);  

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