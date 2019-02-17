<?php 

include("/../conexiondb.php");

if (isset($_POST['IdMaquinaria']) && !empty($_POST['IdMaquinaria'])){

    // Conexion a la BD
    $con = mysql_connect($host, $user, $pw) or die ("problemas con server");
    mysql_select_db($db, $con) or die ("problemas con la base de datos");

    $data = array();

    // $datos_maquinarias = mysql_query("SELECT * FROM maquinaria WHERE IdMaquinaria = '$_POST[IdMaquinaria]'", $con);

    $datos_maquinarias = mysql_query("SELECT IdMaquinaria, IdMaqui, IdOperador, IdObra, Fecha_Desde, Fecha_Hasta,
    (SELECT maquinas.Maquina AS Maquina FROM maquinas WHERE maquinaria.IdMaqui = maquinas.IdMaquina) as Maquina 
    FROM maquinaria WHERE IdMaquinaria = '$_POST[IdMaquinaria]'", $con);


    while($reg=mysql_fetch_array($datos_maquinarias)){

        $data['Maquina'] = $reg['Maquina'];
        $data['IdMaqui'] = $reg['IdMaqui'];
        $data['IdOperador'] = $reg['IdOperador'];
        $data['IdObra'] = $reg['IdObra'];
        $data['Fecha_Desde'] = $reg['Fecha_Desde'];
        $data['Fecha_Hasta'] = $reg['Fecha_Hasta'];
        $data['id_viejo'] = $reg['IdMaquinaria'];
        // $idmaquina = $reg['IdMaqui'];
        
        $data['mensaje'] = "Informacion obtenida para editar";
        $data['codigo'] = "01";
    }           
        
        // $nombremaquina = mysql_query("SELECT Maquina FROM maquinas WHERE IdMaquina = '$idmaquina'", $con);          

        // while($reg=mysql_fetch_array($nombremaquina)){

        // $data['Maquina'] = $reg['Maquina'];

        // $data['mensaje'] = "Informacion obtenida para editar";
        // $data['codigo'] = "01";
        // }

}else {
    $data = array();
    $data['mensaje'] = "Error al enviar a información";
    $data['codigo'] = "03";       
}
   
echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
	
?>