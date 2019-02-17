<?php 

include("/../conexiondb.php");

if (isset($_POST['IdActividad']) && !empty($_POST['IdActividad'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_actividad = mysql_query("SELECT * FROM actividades WHERE IdActividad = '$_POST[IdActividad]'", $con);

    while($reg=mysql_fetch_array($datos_actividad)){

        $data['Actividad'] = $reg['Actividad'];
        $data['Fecha_Ejecucion'] = $reg['Fecha_Ejecucion'];
        $data['Estatus'] = $reg['Estatus'];
        $data['Nota'] = $reg['Nota'];
        $data['id_viejo'] = $reg['IdActividad'];
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