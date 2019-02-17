<?php 
    session_start();
    if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
        include "scripts/file_obras/mostrar_obras.php";
        include "scripts/file_obras/get_jefe_obra.php";
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
        <div id="dialog-obra-confirm" title="Desea Eliminar?" style="display:none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                ¿Está seguro de borrar todos los datos de la obra?
            </p>
        </div>
        
        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header" class="header-title">
                    <span>Obras</span>
                </header>

                <!-- Section -->
                <section class="obra_empresa">
                    <!--<header class="major">
                        <h3 class="obra_empresa">Obras de la empresa</h3>
                    </header>-->
                    <div id="t_obras" class="posts">
                        <?php 
                            while($reg=mysql_fetch_array($datos_obras)){                                                  
                                echo "<article>"; 
                                // echo "<a href='#' class='image imagen_obra'><img src='".$reg['Imagen_Obra']."' alt='' /></a>";
                                echo "<h3 class = 'colorgris'>".$reg['Nombre_Obra']."</h3>";                              
                                echo "<a  class='button small' onClick='getObras(".$reg['IdObras'].")'>Datos de la obra</a>";
                                echo "  ";
                                echo "<a href='/../Consorcio/cronograma.php?IdObra=".$reg['IdObras']."' class='button small'>Cronograma</a>";
                                echo "</article>";                               
                            }                       
                        ?>
              
                    </div>

                        <tfoot>
                            <tr>                                                
                                <td colspan="2"><button type="button" class="button special" id="add_obras">Nueva Obra</button></td>
                            </tr>
                        </tfoot>
                </section>
                <!--<ul class="actions">
                    <li><a href="#" class="button special" id="add_obras">Nueva Obra</a></li>            
                </ul>-->

                <!-- Form -->
                <div id="f_obras">
                    <header>
                        <h3 class="ingresar_datos colorgris">Ingresar Datos de la nueva obra</h3>
                        <h3 class="subtitulosEditar colorgris">Editar datos de la obra</h3>                        
                    </header>
                        
                    <form id="form_obras" method="post" action="#">
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Nombre de la obra</h5>
                                <input type="text" name="nombre_obra" id="nombreObra" value="" placeholder="Nombre de la obra" />
                            </div>                                
                            <!-- <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Encargado de la obra</h5>
                                <input type="text" name="encargado_obra" id="encargadoObra" value="" placeholder="Encargado de la obra" />
                            </div> -->
                            <div class="6u 12u$(xsmall)" id="selectTrabajador">
                              <h5 class="subtitulosEditar colorgris">Jefe de la obra</h5>
                              <div class="select-wrapper">
                                  <select class="colorgris" name="encargado_obra" id="encargadoObra">
                                      <option value="">Seleccione Jefe de la obra</option>                 
                                      <?php 
                                          while($reg=mysql_fetch_array($jefe_obra)){
                                              echo "<option value=".$reg['Cedula'].">".$reg['Nombre']." ".$reg['Apellido']." - ".$reg['Cedula']."</option>";
                                          }                           
                                      ?>  
                              </select>    
                              </div>
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Telefono del encargado</h5>
                                <input class="sineditar" type="text" name="telefono_obra" id="telefonoObra" value="" placeholder="Telefono del encargado" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Correo obra</h5>
                                <input type="text" name="correo_obra" id="correoObra" value="" placeholder="Correo de la obra" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha inicio de contrucción</h5>
                                <input type="text" name="fechai_obra" id="fechainicioObra" value="" placeholder="Fecha inicio de contrucción" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha de culminación</h5>
                                <input type="text" name="fechaf_obra" id="fechafinObra" value="" placeholder="Fecha de culminación" />
                            </div>
                            <div class="12u$">
                                <h5 class="subtitulosEditar colorgris">Dirección</h5>
                                <input type="text" name="direccion_obra" id="direccionObra" value="" placeholder="Direccion" />
                            </div>
                            <div class="6u 12u$(xsmall)">                                
                                <input type="text" name="latitud" id="latitud" value="" placeholder="" />
                            </div>
                            <div class="6u 12u$(xsmall)">                                
                                <input type="text" name="longitud" id="longitud" value="" placeholder="" />
                            </div>
                        </div>
                        <div class="row uniform">    
                            <div class="6u 12u$(xsmall)">
                                <h4 class="colorgris">Ubicación en el mapa</h4>
                                <div id="map"></div>
                            </div>
                            
                            <script>
                            var markers = [];
                            function initMap() {
                                var uluru = {lat: 10.224375, lng: -68.003394}; 
                                
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 11,
                                    center: uluru
                                });
                            
                                map.addListener('click', function(e) {
                                    if (markers.length == 0){
                                        placeMarkerAndPanTo(e.latLng, map);
                                    }else {
                                        alert("Debe borrar la marca establecida anteriormente");
                                    }                                                                        
                                });
                            }

                            function placeMarkerAndPanTo(latLng, map) {
                                console.log(latLng.lat());
                                console.log(latLng.lng());
                                var marker = new google.maps.Marker({
                                    position: latLng,
                                    map: map
                                });
                                markers.push(marker);   
                                map.panTo(latLng);
                                $('#latitud').val(latLng.lat());
                                $('#longitud').val(latLng.lng());
                            } 

                            function setMapOnAll(map) {
                                for (var i = 0; i < markers.length; i++) {
                                    markers[i].setMap(map);
                                }
                            }

                            // Removes the markers from the map, but keeps them in the array.
                            function clearMarkers() {
                                setMapOnAll(null);
                            }
                            
                            // Deletes all markers in the array by removing references to them.
                            function deleteMarkers() {
                                clearMarkers();
                                markers = [];
                            }
                           
                            </script>
                            <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6HWkJGK_8hF83fR7IZZ8nApQuB4TWpco&callback=initMap">
                            </script>
                            
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="id_viejo" id="id_viejo" value="" placeholder="" />
                            </div>

                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li id="b_guardar"><input type="submit" value="Guardar" id="boton_guardar_obra" class="special" /></li>
                                    <li id="b_editar"><input type="button" value="Editar" id="boton_editar_obra" class="special" /></li>
                                    <li><input type="reset" value="Limpiar" /></li>
                                    <li><input onclick="deleteMarkers();" type=button value="Borrar Ubicación"></li>
                                    <li><input type="button" value="Volver" id="volver_obra" /></li>
                                    <!--<li><a id="borrar_obra" class="button icon fa-trash">Borrar Obra</a></li>-->
                                    <li id="borrar_obra"><input onclick="$( '#dialog-obra-confirm' ).dialog( 'open' );" type=button value="Borrar Obra"></li>
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
