<?php 

include("/../conexiondb.php");

if (isset($_POST['nombre_obra']) && !empty($_POST['nombre_obra']) && 
	isset($_POST['encargado_obra']) && !empty($_POST['encargado_obra']) &&
	isset($_POST['correo_obra']) && !empty($_POST['correo_obra']) &&
  isset($_POST['fechai_obra']) && !empty($_POST['fechai_obra']) && 
	isset($_POST['direccion_obra']) && !empty($_POST['direccion_obra']) &&
  isset($_POST['latitud']) && !empty($_POST['latitud']) &&
  isset($_POST['longitud']) && !empty($_POST['longitud']))
  {

    $data = array();
    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $loc = mysql_query("INSERT INTO localidades 
    (Latitud,
    Longitud) 
    VALUES ('$_POST[latitud]',
    '$_POST[longitud]')", $con);

    $newId = mysql_insert_id();

    $sel = mysql_query("INSERT INTO obras 
    (Nombre_Obra, 
    Cedula_Encargado,  
    Correo_Obra, 
    Fecha_Inicio,
    Fecha_Culminacion, 
    Direccion_Obra,
    Idlocalidad) 
     VALUES ('$_POST[nombre_obra]', 
     '$_POST[encargado_obra]', 
     '$_POST[correo_obra]', 
     '$_POST[fechai_obra]',
     '$_POST[fechaf_obra]', 
     '$_POST[direccion_obra]',
     $newId)", $con);  



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