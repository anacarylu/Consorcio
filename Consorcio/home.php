<?php 
session_start();
if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){

} else {
    // var_dump("no paso");
    header('Location: index.php');
}

?> 

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Editorial by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a class="logo"><strong>Sistema para la gestión organizacional de obras </strong> </a>
								</header>

							<!-- Banner -->
								<section id="banner">									
									<span class="image object">
										<img src="images/banner.jpg" alt="" />
									</span>
								</section>

							<!-- Section -->
								<section>
									<header class="major header-home">
										<h2>Seleccione una opción</h2>
									</header>
									<div class="features">
										<article id="f1" class="pointer">
											<span class="icon fa-building"></span>
											<div class="content">
												<h3>Obras</h3>
												<p>Datos de cada obra con sus respectivos cronogramas y actividades.</p>
											</div>
										</article>
										<article id="f2" class="pointer">
											<!--<span class="icon fa-calendar"></span>-->
											<span class="icon fa-list"></span>											
											<div class="content">
												<h3>Actividades</h3>
												<p>Visualizacion de todas las actividades de la empresa clasificadas según su estatus.</p>
											</div>
										</article>
										<article id="f3" class="pointer">
											<span class="icon fa-users"></span>
											<div class="content">
												<h3>Trabajadores</h3>
												<p>Datos personales sobre los trabajadores.</p>
											</div>
										</article>
										<article id="f4" class="pointer">
											<span class="icon fa-bus"></span>
											<div class="content">
												<h3>Choferes</h3>
												<p>Actividades deben realizar los choferes de la empresa indicando los puntos en el mapa.</p>
											</div>
										</article>
										<article id="f5" class="pointer">
											<span class="icon fa-truck"></span>
											<div class="content">
												<h3>Maquinaria</h3>
												<p>Fechas que se requiere la maquinaria en cada obra con su respectivo operador.</p>
											</div>
										</article>
										
										<?php
										if (isset($_SESSION['estado']) && !empty($_SESSION['estado']) && $_SESSION['estado']==1){
											echo '<article id="f6" class="pointer">
												<span class="icon fa-address-card-o"></span>
												<div class="content">
													<h3>Usuarios</h3>
													<p>Datos sobre los usuarios que pueden acceder al sistema.</p>
												</div>
											</article>';
										}
										?>
									</div>
								</section>



						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Menu -->
								<div class="mini-posts">
									<article>
										<a class="image"><img src="images/logo.jpg" alt="" /></a>
									</article>										
								</div>
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="home.php">Homepage</a></li>
										<li><a href="obras.php">Obras</a></li>
										<!--<li><a href="cronograma.php">Cronograma</a></li>-->
										<li><span class="opener">Actividades</span>
											<ul>
												<li><a href="/../Consorcio/actividades.php?estatus=1">Pendientes</a></li>
												<li><a href="/../Consorcio/actividades.php?estatus=2">Desarrollo</a></li>
												<li><a href="/../Consorcio/actividades.php?estatus=3">Realizadas</a></li>
												<li><a href="/../Consorcio/actividades.php?estatus=4">Canceladas</a></li>
											</ul>
										</li>
										<li><a href="trabajadores.php">Trabajadores</a></li>
										<li><a href="rutachoferes.php">Choferes</a></li>
										<li><a href="maquinaria.php">Maquinaria</a></li>
										<?php
										if (isset($_SESSION['estado']) && !empty($_SESSION['estado']) && $_SESSION['estado']==1){
											echo '<li><a href="usuarios.php">Usuarios</a></li>	';
										}
										?>	
										<li id="logout"><a href="#">Cerrar Sesión</a></li>
																								
									</ul>
								</nav>


							<!-- Section -->
								<section>
									<header class="major">
										<h2></h2>
									</header>
									<ul class="contact">										
										<li class="fa-envelope-o">ciminofc@yahoo.com <br> jesusmojedam@gmail.com </li>																
										<li class="fa-phone">(0241) 8269394 <br> (0414) 4122031</li>
										<li class="fa-home">Edo Carabobo, ciudad de Valencia, municipio Valencia, sector El Recreo, torre Stratos, Piso 02, oficina 05<br />
										J-31399716-1 </li>
									</ul>
								</section>
							
						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/jquery-ui.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/generic.js"></script>

	</body>
</html>