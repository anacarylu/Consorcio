<?php 

include("/../conexiondb.php");

if (isset($_POST['cedula']) && !empty($_POST['cedula'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_trabajador = mysql_query("SELECT * FROM trabajadores WHERE Cedula = '$_POST[cedula]'", $con);

    while($reg=mysql_fetch_array($datos_trabajador)){

        $data['Apellido'] = $reg['Apellido'];
        $data['Nombre'] = $reg['Nombre'];
        $data['Cedula'] = $reg['Cedula'];
        $data['Telefono'] = $reg['Telefono'];
        $data['Desempeno'] = $reg['Desempeno'];
        $data['Fecha_Ingreso'] = $reg['Fecha_Ingreso'];
        $data['Fecha_Salida'] = $reg['Fecha_Salida'];
        $data['mensaje'] = "Informacion obtenida para editar";
        $data['codigo'] = "01";

    }                           

}else {
    $data = array();
    $data['mensaje'] = "Error al enviar a información";
    $data['codigo'] = "03";       
}
   
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
?>