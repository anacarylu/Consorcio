<?php 

include("/../conexiondb.php");

if (isset($_POST['cedula']) && !empty($_POST['cedula']) && 
    isset($_POST['correo']) && !empty($_POST['correo']) && 
    isset($_POST['clave']) && !empty($_POST['clave'])) 
{
    $data = array();
    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    // $sel = mysql_query("INSERT INTO usuarios (Nombre, Apellido, Cedula, Telefono, Correo, Cargo, Clave) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[cedula]', '$_POST[telefono]', '$_POST[correo]', '$_POST[cargo]', '$_POST[clave]')", $con);
    $sel = mysql_query("INSERT INTO usuarios (Cedula, Correo, Clave) VALUES ('$_POST[cedula]', '$_POST[correo]', '$_POST[clave]')", $con);
    // var_dump(mysql_error($con));
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