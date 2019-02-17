<?php 
session_start();
if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
    // var_dump($_SESSION);
	// header('Location: home.php');
    // var_dump("cono");
} else {
	// aqui se debe ejecutar redirecciom en el resto de las paginas
    // var_dump("no paso");
}

?> 

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login consorcio</title>
  
  <link rel="stylesheet" href="assets/css/style.css" />

</head>

<body>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Consorcio <span>D.C.</span></div>
		</div>
		<br>

		<form id="login_form" role="form" action="scripts/login_user.php" method="POST">	
			<div class="login">

				<label for="inputUsernameEmail"></label>
					<input type="text" id="inputUsernameEmail" placeholder="Cedula" name="cedula"><br>
				
				<label for="inputPassword"></label>
					<input type="password" id="inputPassword" placeholder="Contraseña" name="clave"><br>
					
					<input type="submit" value="Ingresar">
			</div>
		</form>



</body>
	<script src="assets/js/prefixfree.min.js"></script>
	<script src='assets/js/jquery.min.js'></script>
	<script src="assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="assets/js/generic.js"></script>

</html>
