<?php
// error_reporting(E_ALL ^ E_DEPRECATED);
session_start();
unset($_SESSION['cedula']);
// unset($_SESSION['nombre']);
// unset($_SESSION['apellido']);
unset($_SESSION['estado']);
include("conexiondb.php");


if (isset($_POST['cedula']) && !empty($_POST['cedula']) && 
	isset($_POST['clave']) && !empty($_POST['clave'])) 
{
    $data = array();
    $set_user = true;
    $cedula = $_POST['cedula'];
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");

    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    // $sel = mysql_query("SELECT * FROM usuarios WHERE Cedula = '$cedula' AND Estado = $set_user ", $con);
    $sel = mysql_query("SELECT * FROM usuarios WHERE Cedula = '$cedula'", $con);
	$query = mysql_fetch_array($sel);
    // var_dump($query['Clave']);
    // return;
    if($_POST['clave'] == $query['Clave'])
	{
		$_SESSION['cedula'] = $query['Cedula'];
        // $_SESSION['nombre'] = $query['Nombre'];
        // $_SESSION['apellido'] = $query['Apellido'];
        $_SESSION['estado'] = $query['Estado'];

		$data['mensaje'] = "sesion exitosa";
        $data['codigo'] = "01";
        // header('Location: ../index.php');
        
	}else{
		$data['mensaje'] = "Combinacion erronea";
        $data['codigo'] = "02";
	}
    
}else {
	$data['mensaje'] = "Debes llenar ambos campos";
    $data['codigo'] = "03";
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
?>