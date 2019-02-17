<?php 

include("/../conexiondb.php");

if (isset($_POST['cedula']) && !empty($_POST['cedula'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");
    mysql_set_charset('utf8', $con);

    $data = array();

    // $datos_usuario = mysql_query("SELECT * FROM usuarios WHERE Cedula = '$_POST[cedula]'", $con);
    $datos_usuario = mysql_query("SELECT usuarios.Correo, usuarios.Clave, trabajadores.Nombre as Nombre, trabajadores.Apellido as Apellido, trabajadores.Cedula as Cedula, trabajadores.Telefono as Telefono, (Select desempenos.Desempeno FROM desempenos WHERE desempenos.IdDesempeno = trabajadores.Desempeno) as Cargo FROM usuarios, trabajadores WHERE usuarios.Cedula = '$_POST[cedula]' AND trabajadores.Cedula = usuarios.Cedula ORDER BY Apellido ASC" ) or die ("problema en consulta:" .mysql_error());
    
    while($reg=mysql_fetch_array($datos_usuario)){

        $data['Apellido'] = $reg['Apellido'];
        $data['Nombre'] = $reg['Nombre'];
        $data['Cedula'] = $reg['Cedula'];
        $data['Telefono'] = $reg['Telefono'];
        $data['Correo'] = $reg['Correo'];
        $data['Cargo'] = $reg['Cargo'];
        $data['Clave'] = $reg['Clave'];
        $data['mensaje'] = "Informacion obtenida para editar";
        $data['codigo'] = "01";
        // var_dump($reg);
    }   
    // var_dump("pase");                        

}else {
    $data = array();
    $data['mensaje'] = "Error al enviar a información";
    $data['codigo'] = "03";  
    // var_dump("pase 222");      
}
   
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
?>