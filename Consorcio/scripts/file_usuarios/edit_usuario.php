<?php 

include("/../conexiondb.php");

if (isset($_POST['cedula']) && !empty($_POST['cedula'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    // $datos_usuario = mysql_query("UPDATE usuarios SET 
    // Apellido = '$_POST[apellido]', 
    // Nombre = '$_POST[nombre]', 
    // Cedula = '$_POST[cedula]',
    // Telefono = '$_POST[telefono]', 
    // Correo = '$_POST[correo]', 
    // Cargo = '$_POST[cargo]',
    // Clave = '$_POST[clave]' WHERE Cedula = '$_POST[cedula_vieja]'", $con);
    
    $datos_usuario = mysql_query("UPDATE usuarios SET 
    Correo = '$_POST[correo]', 
    Clave = '$_POST[clave]' WHERE Cedula = '$_POST[cedula_vieja]'", $con);    

    if ($datos_usuario) {    
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