<?php 
    include("/../conexiondb.php");

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    if (isset($_POST['IdObras']) && !empty($_POST['IdObras'])){
        $reg = mysql_query("DELETE FROM localidades WHERE IdLocalidades = (SELECT Idlocalidad FROM obras WHERE IdObras = '$_POST[IdObras]')", $con);
        $num_reg = mysql_affected_rows();
        // $regobras = mysql_query("DELETE FROM obras WHERE IdObras = '$_POST[IdObras]'", $con);
        // $num_obra = mysql_affected_rows();
        
        // var_dump($num);
        if ($num_reg > 0)        
        {           
            $data['mensaje'] = "Ha eliminado correctamente la obra ";
            $data['codigo'] = "01";

        }else{
            // echo "Datos no han sido eliminados";
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