<?php 

include("/../conexiondb.php");

if (isset($_POST['IdObras']) && !empty($_POST['IdObras'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_obras = mysql_query("SELECT obras.IdObras as IdObras,
    obras.Nombre_Obra as Nombre_Obra, 
    obras.Cedula_Encargado as Cedula_Encargado,
    obras.Correo_Obra as Correo_Obra, 
    obras.Fecha_Inicio as Fecha_Inicio, 
    obras.Fecha_Culminacion as Fecha_Culminacion, 
    obras.Direccion_Obra as Direccion_Obra,
    obras.Idlocalidad as Idlocalidad, 
    localidades.Latitud as Latitud, 
    localidades.Longitud as Longitud, 
    trabajadores.Telefono as Telefono_Encargado,
    trabajadores.Nombre as Nombre,
    trabajadores.Apellido as Apellido
    FROM obras, trabajadores, localidades WHERE IdObras = '$_POST[IdObras]' AND obras.Cedula_Encargado = trabajadores.Cedula 
    AND obras.Idlocalidad = localidades.IdLocalidades" ) or die ("problema en consulta:" .mysql_error());

    // // $datos_obras = mysql_query("SELECT obras.Nombre_Obra,
    // -- obras.Correo_Encargado,
    // -- obras.Fecha_Inicio,
    // -- obras.Fecha_Culminacion,
    // -- obras.Direccion_Obra,
    // -- obras.Latitud,
    // -- obras.Longitud,
    // -- obras.IdObras,
    // -- obras.Cedula_Encargado,
    // -- trabajadores.Telefono as Telefono_Encargado,
    // -- trabajadores.Nombre as Nombre,
    // -- trabajadores.Apellido as Apellido
    // -- FROM obras, trabajadores 
    // -- WHERE IdObras = '$_POST[IdObras]' AND obras.Cedula_Encargado = trabajadores.Cedula", $con);

    $a = " ".mysql_errno($con) . ": " . mysql_error($con) . "";

    while($reg=mysql_fetch_array($datos_obras)){
        $data['Nombre_Obra'] = $reg['Nombre_Obra'];
        $data['Encargado_Obra'] = $reg['Nombre']." ".$reg['Apellido'];
        $data['Cedula_Encargado'] = $reg['Cedula_Encargado'];
        $data['Telefono_Encargado'] = $reg['Telefono_Encargado'];
        $data['Correo_Obra'] = $reg['Correo_Obra'];
        $data['Fecha_Inicio'] = $reg['Fecha_Inicio'];
        $data['Fecha_Culminacion'] = $reg['Fecha_Culminacion'];
        $data['Direccion_Obra'] = $reg['Direccion_Obra'];
        $data['Latitud'] = $reg['Latitud'];
        $data['Longitud'] = $reg['Longitud'];
        // $data['Imagen_Obra'] = $reg['Imagen_Obra'];
        $data['id_viejo'] = $reg['IdObras'];
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