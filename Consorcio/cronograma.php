<?php 
    session_start();
    if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
        include "scripts/file_cronograma/mostrar_cronograma.php";
        include "scripts/file_obras/mostrar_obras.php";
        // include "scripts/file_cronograma/mostrar_actividad.php";
    } else {
        header('Location: index.php');
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Obras</title>
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
        <div id="dialog-crono-confirm" title="Desea Eliminar Cronograma?" style="display:none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                ¿Está seguro de borrar este cronorama?
            </p>
        </div>

            <div id="dialog-activ-confirm" title="Desea Eliminar Actividad?" style="display:none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                ¿Está seguro de borrar la actividad?
            </p>
        </div>

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header" class="header-title">
                    <?php
                    echo "<span>Cronogramas de $nombre_obra</span>"
                    ?>
                </header>

                <!-- Tabla de cronograma -->
                <br>
                <!--<br>-->
                <div id="t_cronograma" class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                                
                                    // echo "<h2>".$nombre_obra."</h2>";  

                                    while($reg=mysql_fetch_array($datos_cronograma)){                                    
                                        echo "<tr>";
                                        echo "<td class='pointer' onClick='ver_actividades(".$reg['IdCronograma'].")'>".$reg['Descripcion']."</td>";
                                        echo "<td class='pointer' onClick='ver_actividades(".$reg['IdCronograma'].")'>".$reg['Fecha_Inicio']."</td>";
                                        echo "<td class='pointer' onClick='ver_actividades(".$reg['IdCronograma'].")'>".$reg['Fecha_Final']."</td>";
                                        echo "<td><i class='fa fa-eye icon-edit' aria-hidden='true' onClick='ver_actividades(".$reg['IdCronograma'].")'></i>";
                                        echo "<i class='fa fa-pencil-square-o icon-edit' aria-hidden='true' onClick='getcronograma(".$reg['IdCronograma'].")'></i>";
                                        echo "<i class='fa fa-trash-o icon-edit' aria-hidden='true' onClick='deleteCronoDialog(".$reg['IdCronograma'].")'></i></td>";
                                        echo "</tr>";
                                    }                                       
                                    
                        
                            
                            ?>            
                        </tbody>
                        <tfoot>
                            <tr>                                               
                                <td colspan="2"><button type="button" id="add_cronograma">Agregar</button>
                                <input type="button" value="Volver" id="boton_volvera_obra" /></td>
                                <!--<td colspan="5"></td>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>


                <!-- Form cronograma -->
                <div id="f_cronograma">
                    <header>
                        <h3 class="ingresar_datos colorgris">Ingresar fechas</h3>
                        <h3 class="subtitulosEditar colorgris">Editar fechas</h3>
                    </header>
                        
                    <form id="form_cronograma" method="post" action="#">
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Descripción</h5>
                                <input type="text" name="descripcion_crono" id="descripcionCrono" value="" placeholder="Descripción" />
                            </div> 
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Desde</h5>
                                <input type="text" name="fecha_inicio" id="fechaInicio" value="" placeholder="Fecha de inicio" />
                            </div>                                
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Hasta</h5>
                                <input type="text" name="fecha_final" id="fechaFinal" value="" placeholder="Fecha final" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h4 class="subtitulosEditar"></h4>
                                <input type="text" name="IdCronogramaViejo" id="IdCronogramaViejo" value="" placeholder="IdCronogramaViejo" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h4 class="subtitulosEditar"></h4>
                                <input type="text" name="id_obra_actual" id="id_obra_actual" value="<?php echo $_GET['IdObra'] ?>" placeholder="" />
                            </div>

                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li id="b_guardar"><input type="submit" value="Guardar" id="boton_guardar_cronograma" class="special" /></li>
                                    <li id="b_editar"><input type="button" value="Editar" id="boton_editar_cro" class="special" /></li>
                                    <li><input type="reset" value="Limpiar" /></li>
                                    <li><input type="button" value="Volver" id="volver_cronograma" /></li>
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
                        <h2>Contacto</h2>
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
