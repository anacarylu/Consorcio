<?php 

include("/../conexiondb.php");

if (isset($_POST['selec_maquina']) && !empty($_POST['selec_maquina']) && 
	isset($_POST['selec_operador']) && !empty($_POST['selec_operador']) &&
    isset($_POST['selec_obra']) && !empty($_POST['selec_obra']) && 
    isset($_POST['fecha_desde']) && !empty($_POST['fecha_desde'])) 
{
    $data = array();
    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $sel = mysql_query("INSERT INTO maquinaria (IdMaqui, IdOperador, IdObra, Fecha_Desde, Fecha_Hasta) VALUES ('$_POST[selec_maquina]', '$_POST[selec_operador]', '$_POST[selec_obra]', '$_POST[fecha_desde]', '$_POST[fecha_hasta]')", $con);



    if ($sel) {
        $data['mensaje'] = "Agregado exitosamente";
        $data['codigo'] = "01";   

        mysql_query("UPDATE maquinas SET 
        Estado = '1' WHERE IdMaquina = '$_POST[selec_maquina]'", $con);

    } else {
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

