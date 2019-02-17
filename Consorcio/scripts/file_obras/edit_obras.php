<?php 

include("/../conexiondb.php");

if (isset($_POST['id_viejo']) && !empty($_POST['id_viejo'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $update_localidades = mysql_query("UPDATE localidades SET Longitud = '$_POST[longitud]', Latitud = '$_POST[latitud]' 
    WHERE IdLocalidades = (SELECT Idlocalidad FROM obras WHERE IdObras = '$_POST[id_viejo]')");

    $datos_obras = mysql_query("UPDATE obras SET 
    Nombre_Obra = '$_POST[nombre_obra]', 
    Cedula_Encargado = '$_POST[encargado_obra]', 
    Correo_Obra = '$_POST[correo_obra]', 
    Fecha_Inicio = '$_POST[fechai_obra]', 
    Fecha_Culminacion = '$_POST[fechaf_obra]', 
    Direccion_Obra = '$_POST[direccion_obra]' 
    WHERE IdObras = '$_POST[id_viejo]'", $con);
    

    if ($datos_obras && $update_localidades) {    
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