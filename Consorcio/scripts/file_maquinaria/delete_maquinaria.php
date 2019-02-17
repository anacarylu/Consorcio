<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    if (isset($_POST['IdMaquinaria']) && !empty($_POST['IdMaquinaria'])){
        $estado = mysql_query("SELECT IdMaqui FROM maquinaria WHERE IdMaquinaria = '$_POST[IdMaquinaria]'", $con);
        
        $estadomaquina = mysql_result($estado,0);

        $reg = mysql_query("DELETE FROM maquinaria WHERE IdMaquinaria = '$_POST[IdMaquinaria]'", $con);
        $num = mysql_affected_rows();
        if($num > 0)
        {

            $data['mensaje'] = "Ha eliminado correctamente los datos";
            $data['codigo'] = "01";

            mysql_query("UPDATE maquinas SET 
            Estado = '0' WHERE IdMaquina = $estadomaquina", $con);
           

            
            
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