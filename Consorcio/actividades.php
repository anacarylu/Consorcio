<?php 
    session_start();
    if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
        include "scripts/file_actividades/mostrar_actividad.php";
        include "scripts/file_actividades/get_estatus_act.php";
    } else {
        header('Location: index.php');
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Actividades</title>
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
                    // echo "<span>Actividades de $nombre_obra</span>";
                    
                    if (isset($_GET['IdCronograma']) && !empty($_GET['IdCronograma'])){
                        echo "<span>Actividades de $nombre_obra</span>";
                    } else {
                        echo "<span>Actividades</span>";
                    }

                    ?> 




                </header>

                <!-- Tabla de actividades -->
                <br>
                <!--<br>-->
                <div id="t_actividades" class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <?php
                                    if (isset($_GET['estatus']) && !empty($_GET['estatus'])){
                                        echo "<th>".substr(utf8_decode('Obra'), 0, 15)."</th>";
                                        // echo "<th>Obra</th>";
                                    } 
                                ?>
                                <th>Actividad</th>
                                <th>Fecha Ejecución</th>
                                <th>Estatus</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                if (isset($_GET['IdCronograma']) && !empty($_GET['IdCronograma'])){
                                    echo "<h3 class='colorgris'> Del ".$fecha_crono_inicio." hasta ".$fecha_crono_final."</h3>"; 
                                } else {
                                    
                                    echo"<div class='text-center colorgris 12u'>"; 
                                    
                                    echo"<button class='button ".(($_GET['estatus'] == '1') ? 'special' : '')." margenbotonesAct colorgris 2u 12u$(xsmall)' onclick= \"location.href='/../Consorcio/actividades.php?estatus=1'\">Pendiente</button>";
                                    echo"<button class='button ".(($_GET['estatus'] == '2') ? 'special' : '')." margenbotonesAct colorgris 2u 12u$(xsmall)' onclick= \"location.href='/../Consorcio/actividades.php?estatus=2'\">Desarrollo</button>";
                                    echo"<button class='button ".(($_GET['estatus'] == '3') ? 'special' : '')." margenbotonesAct colorgris 2u 12u$(xsmall)' onclick= \"location.href='/../Consorcio/actividades.php?estatus=3'\">Realizado</button>";
                                    echo"<button class='button ".(($_GET['estatus'] == '4') ? 'special' : '')." margenbotonesAct colorgris 2u 12u$(xsmall)' onclick= \"location.href='/../Consorcio/actividades.php?estatus=4'\">Cancelado</button></div>";

                                    echo "<br>";
                                }

                                 
                                echo "<br>";
                                while($reg=mysql_fetch_array($datos_actividad)){
                                    
                                    echo "<tr>";
                                    if (isset($_GET['estatus']) && !empty($_GET['estatus'])){
                                        echo "<td>".$reg['Nombre_Obra']."</td>";
                                    }
                                    echo "<td class='pointer' onClick='getactividad(".$reg['IdActividad'].")'>".substr(utf8_decode($reg['Actividad']), 0, 30)."</td>";
                                    echo "<td class='pointer' onClick='getactividad(".$reg['IdActividad'].")'>".$reg['Fecha_Ejecucion']."</td>";                                 
                                    echo "<td class='pointer' onClick='getactividad(".$reg['IdActividad'].")'>".$reg['Estatus']."</td>";
                                    echo "<td class='pointer' onClick='getactividad(".$reg['IdActividad'].")'>".substr(utf8_decode($reg['Nota']), 0, 30)."</td>";
                                    echo "<td><i class='fa fa-pencil-square-o icon-edit' aria-hidden='true' onClick='getactividad(".$reg['IdActividad'].")'></i>";
                                    echo "<i class='fa fa-trash-o icon-edit' aria-hidden='true' onClick='deleteActivDialog(".$reg['IdActividad'].")'></i></td>";
                                    echo "</tr>";
                                }                          
                            
                            ?>            
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php                                     
                                    if (isset($_GET['IdCronograma']) && !empty($_GET['IdCronograma'])){

                                        echo "<td><button type='button' id='add_actividad'>Agregar</button>";
                                        echo "  <button type='button' id='volverACronograma'>Volver</button></td>";
                                    } 

                                    ?>                                                
                                <!--<td colspan="2"><button type="button" id="add_actividad">Agregar</button>-->
                                <!--<button type="button" id="volverACronograma">Volver</button></td>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Form -->
                <div id="f_actividad">
                    <header>
                        <h3 class="ingresar_datos colorgris">Nueva Actividad</h3>
                        <h3 class="subtitulosEditar colorgris">Editar actividad</h3>
                    </header>
                    
                        
                    <form id="form_actividad" method="post" action="#">
                        <div class="row uniform">
                            <div class="12u$">
                                <h5 class="subtitulosEditar colorgris">Actividad</h5>
                                <input type="text" name="actividad" id="actividad" value="" placeholder="Actividad" />
                            </div>                                
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha de ejecución</h5>
                                <input type="text" name="fecha_ejecucion" id="fechaEjecucion" value="" placeholder="Fecha de ejecución" />
                            </div>
                            <div class="6u 12u$(xsmall)$">
                                <h5 class="subtitulosEditar colorgris">Estatus</h5>
                                <div class="select-wrapper">
                                    <select name="selec_desempeno" id="selec_desempeno">
                                        <option  value="">Seleccione estatus</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($estatus_act)){
                                                echo "<option value=".$reg['IdEstatus'].">".$reg['Descripcion']."</option>";
                                            }                           
                                        ?>  
                                    </select>
                                </div>
                            </div>
                            <div class="12u">
                                <h5 class="subtitulosEditar colorgris">Nota</h5>
                                <textarea rows="4" maxlength="750" type="text" name="nota" id="notaActividad" value="" placeholder="Nota"> </textarea>
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="id_viejo" id="id_viejo" value="" placeholder="" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="id_cronograma_hide" id="id_cronograma_hide" value="<?php echo $id_cronograma ?>" placeholder="" />
                            </div>                            
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="id_obra_hide" id="id_obra_hide" value="<?php echo $id_obra_actual ?>" placeholder="" />
                            </div> 
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="estatus_hide" id="estatus_hide" value="<?php echo $_GET['estatus'] ?>" placeholder="" />
                            </div>                               
                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li id="b_guardar"><input type="submit" value="Guardar" id="boton_guardar_actividad" class="special" /></li>
                                    <li id="b_editar"><input type="button" value="Editar" id="boton_editar_actividad" class="special" /></li>
                                    <li><input type="reset" value="Limpiar" /></li>
                                    <li><input type="button" value="Volver" id="volver_actividad" /></li>
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
