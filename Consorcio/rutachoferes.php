<?php 
    session_start();
    if (isset($_SESSION['cedula']) && !empty($_SESSION['cedula'])){
        include "scripts/file_rutachoferes/mostrar_rutachoferes.php";
        include "scripts/file_rutachoferes/get_choferes.php";
        include "scripts/file_actividades/get_estatus_act.php";
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
        <div id="dialog-rutaChof-confirm" title="Desea Eliminar Ruta Chofer?" style="display:none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                ¿Está seguro de borrar la actividad del chofer?
            </p>
        </div>

        <!-- Cuadro de dialogo para mapa-->
        <div id="dialog-rutaChof-mapa" title="Detalles" style="display:none;">
            <div style="margin:12px 12px 20px 0;">
                <span class="fa fa-truck" ></span>
                <span id='texto-Actividad-mapa'></span>
            </div>
            <p>
                <div>
                    <div class="12u$">
                        <h3>Ubicación en el mapa</h3>
                        <div id="ruta-map"></div>
                    </div>
                    
                    <script>
                    var markers = [];
                    var localidades = [];
                    function initMap() {
                        var uluru = {lat: 10.224375, lng: -68.003394}; 
                        
                        var rutaMap = new google.maps.Map(document.getElementById('ruta-map'), {
                            zoom: 11,
                            center: uluru
                        });

                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 11,
                            center: uluru
                        });

                        map.addListener('click', function(e) {
                            if (markers.length < 3){
                                placeMarkerAndPanTo(e.latLng, map);
                            }else {
                                alert("Debe borrar la marca establecida anteriormente");
                            }                                                                        
                        });                                                              
                    }                                  
                    </script>                    
                    <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6HWkJGK_8hF83fR7IZZ8nApQuB4TWpco&callback=initMap">
                    </script>
                </div>
            </p>
        </div>
        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header" class="header-title">
                    <span>Control de actividad de Choferes</span>
                </header>

                <!-- Table -->
                <br>
                <br>
                <div id="t_rutachoferes" class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Chofer</th>
                                <th>Actividad</th>
                                <th>Fecha a realizar</th>
                                <th>Estatus</th>                                                             
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($reg=mysql_fetch_array($datos_rutachofer)){
                                    echo "<tr>";
                                    echo "<td class='pointer' onClick='verRutaChofer(".$reg['IdRutachoferes'].")'>".utf8_decode($reg['ApellidoChofer']." ".$reg['NombreChofer'])."</td>";
                                    echo "<td class='pointer' onClick='verRutaChofer(".$reg['IdRutachoferes'].")'>".substr(utf8_decode($reg['Actividad']), 0, 30)."</td>";
                                    echo "<td class='pointer' onClick='verRutaChofer(".$reg['IdRutachoferes'].")'>".$reg['Fecha_Ejecucion']."</td>";   
                                    echo "<td class='pointer' onClick='verRutaChofer(".$reg['IdRutachoferes'].")'>".$reg['Estatus']."</td>";            
                                    // echo "<td><i class='fa fa-map-marker icon-edit' aria-hidden='true' onClick='verRutaChofer(".$reg['IdRutachoferes'].")'></i> ";   
                                    echo "<td><i class='fa fa-eye icon-edit' aria-hidden='true' onClick='verRutaChofer(".$reg['IdRutachoferes'].")'></i> ";          
                                    echo "<i class='fa fa-pencil-square-o icon-edit' aria-hidden='true' onClick='getChofer(".$reg['IdRutachoferes'].")'></i> ";
                                    echo "<i class='fa fa-trash-o icon-edit' aria-hidden='true' onClick='deleteRutaChofDialog(".$reg['IdRutachoferes'].")'></i></td>";
                                    echo "</tr>"; 
                                }                           
                            
                            ?>            
                        </tbody>
                        <tfoot>
                            <tr>                                                
                                <td colspan="2"><button type="button" id="add_rutachofer">Nueva ruta</button></td>
                                <!--<td colspan="5"></td>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Form -->
                <div id="f_rutachofer">
                    <h3 class= "ingresar_datos colorgris">Ingresar Datos</h3>
                    <h3 class= "subtitulosEditar colorgris" >Editar actividad del chofer</h3>

                    <form id="form_rutachofer" method="post" action="#">                        
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Chofer</h5>
                                <div class="select-wrapper">
                                    <select name="selec_chofer" id="selec_chofer">
                                        <option value="">Seleccione Chofer</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($choferes)){
                                                echo "<option value=".$reg['IdTrabajador'].">".$reg['Apellido']." ".$reg['Nombre']."</option>";
                                            }                           
                                        ?>  
                                </select>    
                                </div>
                            </div>   
                            <div class="6u 12u$(xsmall)">
                                <h5 class="subtitulosEditar colorgris">Fecha a realizar</h5>
                                <input type="text" name="fecha_ejecucion" id="fecha_ejecucion" value="" placeholder="Fecha a realizar" />
                            </div>                                                     
                            <div class="12u$">
                                <h5 class="subtitulosEditar colorgris">Estatus</h5>
                                <div class="select-wrapper">
                                    <select name="selec_estatus" id="selec_estatus">
                                        <option  value="">Seleccione estatus</option>                 
                                        <?php 
                                            while($reg=mysql_fetch_array($estatus_act)){
                                                echo "<option value=".$reg['IdEstatus'].">".$reg['Descripcion']."</option>";
                                            }                           
                                        ?>  
                                    </select>
                                </div>
                            </div>
                            <div class="12u$">
                                <h5 class="subtitulosEditar colorgris">Actividad</h5>
                                <!--<input type="text" name="actividad" id="actividad" value="" placeholder="Actividad" />-->
                                <textarea rows="4" maxlength="750" type="text" name="actividad" id="actividad" value="" placeholder="Actividad"> </textarea>
                            </div>    
                        </div>
                        <div class="row uniform">
                            <div class="12u$">
                                <h4 class="colorgris">Ruta del chofer (Seleccione min 1 punto en el mapa max 3)</h4>
                                <div id="map"></div>
                            </div> 

                            <script>
                            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            var labelIndex = 0;
                            
                            function placeMarkerAndPanTo(latLng, map) {
                                console.log(latLng.lat());
                                console.log(latLng.lng());
                                var marker = new google.maps.Marker({
                                    position: latLng,
                                    label: labels[labelIndex++ % labels.length],
                                    map: map
                                });
                                var localidad = {
                                    'lat' : latLng.lat(),
                                    'lng' : latLng.lng()
                                };
                                localidades.push(localidad);
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
                                localidades = [];
                                labelIndex = [];
                            }                                        
                            </script>                                                                                
                                                        
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="id_viejo" id="id_viejo" value="" placeholder="" />
                            </div>
                        
                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li id="b_guardar"><input type="submit" value="Guardar" id="boton_guardar" class="special" /></li>
                                    <li id="b_editar"><input type="button" value="Editar" id="boton_editar_rutach" class="special" /></li>
                                    <li><input type="reset" value="Limpiar" /></li>
                                    <li><input onclick="deleteMarkers();" type=button value="Borrar Ubicación"></li>
                                    <li><input type="button" value="Volver" id="volver_rutachofer" /></li>
                                    
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
