<?php 
    session_start();
    if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
        include "scripts/file_maquinaria/mostrar_maquinaria.php";
        include "scripts/file_maquinaria/get_selects.php";
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
        <div id="dialog-maqui-confirm" title="Desea Eliminar Datos?" style="display:none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                ¿Está seguro de borrar todos los datos de la maquinaria?
            </p>
        </div>

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header" class="header-title">
                    <span>Control de maquinaria</span>
                </header>

                <!-- Table -->
                <br>
                <br>
                <div id="t_maquinaria" class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Máquina</th>
                                <th>Operador</th>
                                <th>Obra</th>
                                <th>Fecha desde</th>
                                <th>Fecha hasta</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                while($reg=mysql_fetch_array($datos_maquinarias)){
                                    echo "<tr>";
                                    echo "<td>".substr(utf8_decode($reg['IdMaqui']), 0, 30)."</td>";
                                    echo "<td>".substr(utf8_decode($reg['IdOperador']), 0, 20)."</td>";
                                    echo "<td>".substr(utf8_decode($reg['IdObra']), 0, 20)."</td>";
                                    echo "<td>".$reg['Fecha_Desde']."</td>";                                    
                                    if ($reg['Fecha_Hasta'] == '0000-00-00'){
                                       echo "<td class='text-center pointer'>-</td>"; 
                                    } else {
                                       echo "<td class='text pointer'>".$reg['Fecha_Hasta']."</td>";
                                    }
                                    echo "<td><i class='fa fa-pencil-square-o icon-edit' aria-hidden='true' onClick='getMaquinaria(".$reg['IdMaquinaria'].")'></i> ";                                       
                                    echo "<i class='fa fa-trash-o icon-edit' aria-hidden='true' onClick='deleteMaquiDialog(".$reg['IdMaquinaria'].")'></i>";
                                    echo "</td>";               
                                    echo "</tr>";
                                }                           
                            
                            ?> 
                                                                
                        </tbody>
                        <tfoot>
                            <tr>                                                
                                <td colspan="2"><button type="button" id="add_maquinaria">Agregar</button></td>
                                <!--<td colspan="5"></td>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Form -->
                <div id="f_maquinaria">
                    <h3 class="ingresar_datos colorgris">Ingresar Datos</h3>
                    <h3 class="subtitulosEditar colorgris">Editar maquinaria</h3>

                    <form id="form_maquinaria" method="post" action="#">
                        <div class="row uniform">
                            
                            <div class="6u 12u$(xsmall)" id="listamaquinas">
                                <h5 class="subtitulosEditar colorgris">Máquina</h5>
                                <div class="select-wrapper" >
                                    <select name="selec_maquina" id="selec_maquina">
                                        <option value="">Seleccione Máquina</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($maquinas)){
                                                echo "<option value=".$reg['IdMaquina'].">".$reg['Maquina']."</option>";
                                            }                           
                                        ?>  
                                </select>    
                                </div>
                            </div>

                            <div class="6u 12u$(xsmall)" id="cuadromaquina">
                                <h5 class="subtitulosEditar colorgris">Máquina</h5>
                                <input type="text" name="maquina" id="maquina" value="" placeholder="" class="sineditar" />
                            </div>

                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Operador de máquina</h5>
                                <div class="select-wrapper">
                                    <select name="selec_operador" id="selec_operador">
                                        <option value="">Seleccione operador</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($operadores)){
                                                echo "<option value=".$reg['IdTrabajador'].">".$reg['Apellido']." ".$reg['Nombre']."</option>";
                                            }                           
                                        ?>  
                                </select>    
                                </div>
                            </div>


                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Obra</h5>
                                <div class="select-wrapper">
                                    <select name="selec_obra" id="selec_obra">
                                        <option value="">Seleccione obra</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($obras)){
                                                echo "<option value=".$reg['IdObras'].">".$reg['Nombre_Obra']."</option>";
                                            }                           
                                        ?>  
                                </select>    
                                </div>
                            </div>                            

                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha desde</h5>
                                <input type="text" name="fecha_desde" id="fecha_desde" value="" placeholder="Fecha desde" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha hasta</h5>
                                <input type="text" name="fecha_hasta" id="fecha_hasta" value="" placeholder="Fecha hasta" />
                            </div>

 
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="id_viejo" id="id_viejo" value="" placeholder="" />
                            </div>
                                                
                        
                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li id="b_guardar"><input type="submit" value="Guardar" id="boton_guardar" class="special" /></li>
                                    <li id="b_editar"><input type="button" value="Editar" id="boton_editar_maq" class="special" /></li>
                                    <li><input type="reset" value="Limpiar" /></li>
                                    <li><input type="button" value="Volver" id="volver_maquinaria" /></li>
                                    
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
