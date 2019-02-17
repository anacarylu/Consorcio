<?php 

include("/../conexiondb.php");

if (isset($_POST['nombre']) && !empty($_POST['nombre']) && 
	isset($_POST['apellido']) && !empty($_POST['apellido']) &&
    isset($_POST['cedula']) && !empty($_POST['cedula']) && 
	isset($_POST['telefono']) && !empty($_POST['telefono']) &&
    isset($_POST['selec_desempeno']) && !empty($_POST['selec_desempeno']) &&
    isset($_POST['fecha_ingreso']) && !empty($_POST['fecha_ingreso'])) 
{

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_trabajador = mysql_query("UPDATE trabajadores SET 
    Apellido = '$_POST[apellido]', 
    Nombre = '$_POST[nombre]', 
    Cedula = '$_POST[cedula]',
    Telefono = '$_POST[telefono]', 
    Desempeno = '$_POST[selec_desempeno]',
    Fecha_Ingreso = '$_POST[fecha_ingreso]', 
    Fecha_Salida = '$_POST[fecha_salida]'WHERE Cedula = '$_POST[cedula_vieja]'", $con);
    

    if ($datos_trabajador) {    
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