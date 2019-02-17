<?php 

include("/../conexiondb.php");

if (isset($_POST['nombre']) && !empty($_POST['nombre']) && 
	isset($_POST['apellido']) && !empty($_POST['apellido']) &&
    isset($_POST['cedula']) && !empty($_POST['cedula']) && 
	isset($_POST['telefono']) && !empty($_POST['telefono']) &&
    isset($_POST['selec_desempeno']) && !empty($_POST['selec_desempeno']) &&
    isset($_POST['fecha_ingreso']) && !empty($_POST['fecha_ingreso'])) 
{
    $data = array();
    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $sel = mysql_query("INSERT INTO trabajadores (Nombre, Apellido, Cedula, Telefono, Desempeno, Fecha_Ingreso) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[cedula]', '$_POST[telefono]', '$_POST[selec_desempeno]', '$_POST[fecha_ingreso]')", $con);

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