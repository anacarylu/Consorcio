<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    if (isset($_POST['IdRutachoferes']) && !empty($_POST['IdRutachoferes'])){
        $reg = mysql_query("DELETE FROM rutachoferes WHERE IdRutachoferes = '$_POST[IdRutachoferes]'", $con);
        $num = mysql_affected_rows();
        if($num > 0)
        {
            $data['mensaje'] = "Ha eliminado correctamente la actividad del chofer";
            $data['codigo'] = "01";
        }else{
            echo "Datos no han sido eliminados";
            $data['mensaje'] = "Datos no han sido eliminados";
            $data['codigo'] = "02";
        }
    }else {
        $data['mensaje'] = "Error al enviar a información";
        $data['codigo'] = "03";       
    }
   

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    return true;

?>