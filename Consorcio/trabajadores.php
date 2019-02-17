<?php 
    session_start();
    if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
        include "scripts/file_trabajadores/mostrar_trabajadores.php";
        include "scripts/file_trabajadores/get_desempenos.php";
    } else {
        header('Location: index.php');
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Consorcio D.C.</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
<body>

<!-- Wrapper -->
    <div id="wrapper">

        <!-- Cuadro de dialogo -->
        <div id="dialog-trab-confirm" title="Desea Eliminar Trabajador?" style="display:none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                ¿Está seguro de borrar todos los datos del trabajador?
            </p>
        </div>

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header" class="header-title">
                    <span>Trabajadores</span>
                </header>

                <!-- Table -->
                <br>
                <br>
                <div id="t_trabajadores" class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Teléfono</th>
                                <th>Desempeño</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($reg=mysql_fetch_array($datos_trabajador)){
                                    echo "<tr>";
                                    echo "<td class='pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".substr(utf8_decode($reg['Apellido']), 0, 15)."</td>";
                                    echo "<td class='pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".substr(utf8_decode($reg['Nombre']), 0, 15)."</td>";
                                    echo "<td class='pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".$reg['Cedula']."</td>";
                                    echo "<td class='pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".$reg['Telefono']."</td>";
                                    echo "<td class='pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".$reg['Desempeno']."</td>";
                                    echo "<td class='pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".$reg['Fecha_Ingreso']."</td>";                                    
                                    if ($reg['Fecha_Salida'] == '0000-00-00'){
                                       echo "<td class='text-center pointer' onClick='getTrabajador(".$reg['Cedula'].")'> - </td>"; 
                                    } else {
                                       echo "<td class='text pointer' onClick='getTrabajador(".$reg['Cedula'].")'>".$reg['Fecha_Salida']."</td>";
                                    }
                                    echo "<td><i class='fa fa-pencil-square-o icon-edit' aria-hidden='true' onClick='getTrabajador(".$reg['Cedula'].")'></i> ";                                       
                                    echo "<i class='fa fa-trash-o icon-edit' aria-hidden='true' onClick='deleteTrabDialog(".$reg['Cedula'].")'></i>";
                                    echo "</td>";                                  
                                    echo "</tr>";
                                }                           
                            
                            ?>            
                        </tbody>
                        <tfoot>
                            <tr>                                                
                                <td colspan="2"><button type="button" id="add_trabajadores">Agregar</button></td>
                                <!--<td colspan="5"></td>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Form -->
                <div id="f_trabajadores">
                    <h3 class="ingresar_datos colorgris">Ingresar Datos</h3>
                    <h3 class="subtitulosEditar colorgris">Editar trabajador</h3>

                    <form id="form_trabajador" method="post" action="#">
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Nombre</h5>
                                <input type="text" name="nombre" id="nombreo" value="" placeholder="Nombre" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Apellido</h5>
                                <input type="text" name="apellido" id="apellidoo" value="" placeholder="Apellido" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Cedula</h5>
                                <input type="text" name="cedula" id="cedulao" value="" placeholder="Cédula" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Teléfono</h5>
                                <input type="text" name="telefono" id="telefonoo" value="" placeholder="Teléfono" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Desempeño</h5>
                                <div class="select-wrapper">
                                    <select class="colorgris" name="selec_desempeno" id="selec_desempeno">
                                        <option  value="">Seleccione Desempeño</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($desempenos)){
                                                echo "<option value=".$reg['IdDesempeno'].">".$reg['Desempeno']."</option>";
                                            }                           
                                        ?>  
                                </select>    
                                </div>
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha de ingreso</h5>
                                <input type="text" name="fecha_ingreso" id="fecha_ingresoo" value="" placeholder="Fecha Ingreso" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha de salida</h5>
                                <input type="text" name="fecha_salida" id="fecha_salidao" value="" placeholder="Fecha Salida" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="cedula_vieja" id="cedula_vieja" value="" placeholder="" />
                            </div>
                        
                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li id="b_guardar"><input type="submit" value="Guardar" id="boton_guardar" class="special" /></li>
                                    <li id="b_editar"><input type="button" value="Editar" id="boton_editar_ob" class="special" /></li>
                                    <li><input type="reset" value="Limpiar" /></li>
                                    <li><input type="button" value="Volver" id="volver_trabajadores" /></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
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
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/generic.js"></script>

</body>
</html>
