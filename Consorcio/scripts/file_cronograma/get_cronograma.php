<?php 

include("/../conexiondb.php");

if (isset($_POST['IdCronograma']) && !empty($_POST['IdCronograma'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    $datos_cronograma = mysql_query("SELECT * FROM cronograma WHERE IdCronograma = '$_POST[IdCronograma]'", $con);

    while($reg=mysql_fetch_array($datos_cronograma)){

        $data['Descripcion'] = $reg['Descripcion'];
        $data['Fecha_Inicio'] = $reg['Fecha_Inicio'];
        $data['Fecha_Final'] = $reg['Fecha_Final'];
        $data['IdCronograma'] = $reg['IdCronograma'];
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