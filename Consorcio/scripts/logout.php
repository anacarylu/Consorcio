<?php
session_start();
unset($_SESSION['cedula']);
// unset($_SESSION['nombre']);
// unset($_SESSION['apellido']);
unset($_SESSION['estado']);

$data = array();
$data['mensaje'] = "logout exitoso";
$data['codigo'] = "01";

echo json_encode($data, JSON_UNESCAPED_UNICODE);
return true;
?>