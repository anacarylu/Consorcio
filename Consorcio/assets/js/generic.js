
// ---------------------------------- LOGIN -------------------------------------//

$(function() {

    $('#login_form').submit(function(e) {
        e.preventDefault();
        var postdata = $('#login_form').serialize();
        console.log(postdata);

        $.ajax({
            type: 'POST',
            url: 'scripts/login_user.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/home.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                
                // if(response.code != "01") {
                //     $(' #id_message_error ').hide();
                //     $('.function_message_error span').html("");
                //     $('.function_message_error span').html(response.message);
                //     $(' #id_message_error').show();
                // } else {
                //     $(' #sting ').hide();
                //     $(' #success ').show();
                // }

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });  
    });

// ---------------------------------- HOME -------------------------------------//

    $('#f1').click(function(e) {
        // alert("di click en f1");
        window.location.href = "obras.php";
        console.log("1");
    });

    $('#f2').click(function(e) {
        // alert("di click en f2");
        window.location.href = "/../Consorcio/actividades.php?estatus=1";
        console.log("2");
    });

    $('#f3').click(function(e) {
        // alert("di click en f3");
        window.location.href = "trabajadores.php";
    });

    $('#f4').click(function(e) {
        // alert("di click en f4");
        window.location.href = "rutachoferes.php";
    });

    $('#f5').click(function(e) {
        // alert("di click en f4");
        window.location.href = "maquinaria.php";
    });

    $('#f6').click(function(e) {
        // alert("di click en f4");
        window.location.href = "usuarios.php";
    });

//-------------------------------- 

    $("#add_trabajadores").click(function(){
        limpiar_trabajador();
        $("#b_guardar").show();
        $("#b_editar").hide(); 
        $(".subtitulosEditar").hide(); 
        $(".ingresar_datos").show(); 
        $("#t_trabajadores").fadeOut();
        $("#f_trabajadores").fadeIn(1500);   
    });

    $("#volver_trabajadores").click(function(){
        $("#f_trabajadores").fadeOut();
        setTimeout(function(){
            $("#t_trabajadores").fadeIn(1500);
        }, 250);
    });

    $( "#fecha_ingresoo" ).datepicker();
    $( "#fecha_salidao" ).datepicker();

    $( "#fechainicioObra" ).datepicker();
    $( "#fechafinObra" ).datepicker();

    $( "#fecha_ejecucion" ).datepicker();

    $( "#fechaInicio" ).datepicker();
    $( "#fechaFinal" ).datepicker();

    $( "#fechaEjecucion" ).datepicker();
    
    $( "#fecha_desde" ).datepicker();
    $( "#fecha_hasta" ).datepicker();

//-------------------------------- 

    $("#add_usuarios").click(function(){
        limpiar_usuario();
        $("#b_guardar").show();
        $("#b_editar").hide();

        $(".hide_user").hide();
        $("#cedulau").removeClass("sineditar");

        $(".subtitulosEditar").hide(); 
        $(".ingresar_datos").show(); 
        $("#t_usuarios").fadeOut();
        $("#f_usuarios").fadeIn(1500);   
    });

    $("#volver_usuarios").click(function(){
        $("#f_usuarios").fadeOut();
        setTimeout(function(){
            $("#t_usuarios").fadeIn(1500);
        }, 250);

    
    })

//-------------------------------- 

    $("#add_obras").click(function(){
        limpiar_obra();
        $("#b_guardar").show();
        $("#add_obras").hide();
        $("#b_editar").hide(); 
        $("#t_obras").fadeOut();
        $("#f_obras").fadeIn(1500);
        $(".obra_empresa").hide();
        $(".subtitulosEditar").hide();
        $(".ingresar_datos").show();
        $("#borrar_obra").hide();
        deleteMarkers();
    });

    $("#volver_obra").click(function(){
        $("#f_obras").fadeOut();
        setTimeout(function(){
            $(".obra_empresa").show();
            $(".ingresar_datos").hide();
            $("#add_obras").show();
            $(".subtitulosEditar").show();
            $("#t_obras").fadeIn(1500);
            $("#borrar_obra").show();
        }, 250);

    
    })

//-------------------------------- 

    $("#add_cronograma").click(function(){
        limpiar_cronograma();       
        $("#t_cronograma").fadeOut();
        $("#f_cronograma").fadeIn(1500);
        $(".subtitulosEditar").hide(); 
        $(".ingresar_datos").show(); 
        $("#b_guardar").fadeIn();
        $("#b_editar").fadeOut();

    });

    $("#volver_cronograma").click(function(){
        $("#f_cronograma").fadeOut();
        setTimeout(function(){
            $("#t_cronograma").fadeIn(1500);
        }, 250);

    
    })

//-------------------------------- 

    $("#add_actividad").click(function(){
        limpiar_actividad();   
        $("#t_actividades").fadeOut();
        $("#f_actividad").fadeIn(1500);
        $(".subtitulosEditar").hide(); 
        $(".ingresar_datos").show(); 
        $("#b_guardar").fadeIn();
        $("#b_editar").fadeOut();

    });

    $("#volverACronograma").click(function(){
        // $("#t_actividades").fadeOut();
        // $("#t_cronograma").fadeIn(1500);
        var referrer =  document.referrer;
        var id_obra = $("#id_obra_hide").val();
        // Cuando tenga configurado cronograma debo implementar el id_obra al volver
        // window.location.href = referrer;
        window.location.href = location.origin+"/Consorcio/cronograma.php?IdObra="+id_obra+""; 
        console.log(id_obra);

    });

    $("#boton_volvera_obra").click(function(){
        window.location.href = location.origin+"/Consorcio/obras.php";
    });
    

    $("#volver_actividad").click(function(){
        $("#f_actividad").fadeOut();
        setTimeout(function(){
            $("#t_actividades").fadeIn(1500);
        }, 250);    
    })

    $("#logout").click(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'scripts/logout.php',
            data: 1,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/index.php";
                }
            },
            error: function(error) {
                console.log("Hubo un error");
                console.log(error);
            }
        });
      
    })    

           
});

//-------------------------------- 

    $("#add_rutachofer").click(function(){
        limpiar_rutachofer();
        $("#t_rutachoferes").fadeOut();
        $("#b_guardar").fadeIn();
        $(".subtitulosEditar").hide(); 
        $(".ingresar_datos").show();
        $("#f_rutachofer").fadeIn(1500);
        $("#b_editar").fadeOut();
        deleteMarkers();
    });

    $("#volver_rutachofer").click(function(){
        $("#f_rutachofer").fadeOut();
        setTimeout(function(){
            $("#b_editar").fadeIn();
            $("#t_rutachoferes").fadeIn(1500);
        }, 250);    
    })


//-------------------------------- 

    $("#add_maquinaria").click(function(){
        limpiar_maquinaria();
        $("#t_maquinaria").fadeOut();
        $("#b_guardar").fadeIn();
        $(".subtitulosEditar").hide(); 
        $(".ingresar_datos").show();
        $("#f_maquinaria").fadeIn(1500);
        $("#b_editar").fadeOut();
        $("#listamaquinas").show();
        $("#cuadromaquina").hide();
    });

    $("#volver_maquinaria").click(function(){
        $("#f_maquinaria").fadeOut();
        setTimeout(function(){
            $("#b_editar").fadeIn();
            $("#t_maquinaria").fadeIn(1500);
        }, 250);    
    })


//-------------------------------- 

//--------------------------------
    $( "#dialog-obra-confirm" ).dialog({
      closeOnEscape: true,
      autoOpen: false,
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,      
      buttons: {
        "Eliminar": function() {
            eliminarObra();
            $( this ).dialog( "close" );
        },
        Cancel: function() {
            $( this ).dialog( "close" );
        }
      }
    });

 //--------------------------------

    function deleteTrabDialog(ci) {
        $('#dialog-trab-confirm').data('ci',ci).dialog('open');
    }

    $( "#dialog-trab-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: false,
      closeOnEscape: true,
      buttons: {
        "Eliminar": function() {    
            deleteTrabajador($( "#dialog-trab-confirm" ).data("ci"));
            $( this ).dialog( "close" );
            },
            Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

 //--------------------------------

    function deleteUsuaDialog(ci) {
        $('#dialog-usua-confirm').data('ci',ci).dialog('open');
    }

    $( "#dialog-usua-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: false,
      closeOnEscape: true,
      buttons: {
        "Eliminar": function() {    
            deleteUsuario($( "#dialog-usua-confirm" ).data("ci"));
            $( this ).dialog( "close" );
            },
            Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

//--------------------------------

    function deleteRutaChofDialog(ci) {
        $('#dialog-rutaChof-confirm').data('ci',ci).dialog('open');
    }

    $( "#dialog-rutaChof-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: false,
      closeOnEscape: true,
      buttons: {
        "Eliminar": function() {    
            deleteChofer($( "#dialog-rutaChof-confirm" ).data("ci"));
            $( this ).dialog( "close" );
            },
            Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

//--------------------------------

//--------------------------------

    function deleteCronoDialog(ci) {
        $('#dialog-crono-confirm').data('ci',ci).dialog('open');
    }

    $( "#dialog-crono-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: false,
      closeOnEscape: true,
      buttons: {
        "Eliminar": function() {    
            deletecronograma($( "#dialog-crono-confirm" ).data("ci"));
            $( this ).dialog( "close" );
            },
            Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

//--------------------------------

    function deleteActivDialog(ci) {
        $('#dialog-activ-confirm').data('ci',ci).dialog('open');
    }

    $( "#dialog-activ-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: false,
      closeOnEscape: true,
      buttons: {
        "Eliminar": function() {    
            deleteactividad($( "#dialog-activ-confirm" ).data("ci"));
            $( this ).dialog( "close" );
            },
            Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

//--------------------------------

    function deleteMaquiDialog(ci) {
        $('#dialog-maqui-confirm').data('ci',ci).dialog('open');
    }

    $( "#dialog-maqui-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      autoOpen: false,
      closeOnEscape: true,
      buttons: {
        "Eliminar": function() {    
            deleteMaquinaria($( "#dialog-maqui-confirm" ).data("ci"));
            $( this ).dialog( "close" );
            },
            Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });


// ---------------------------------- TRABAJADORES -------------------------------------//
    //---------------Agregar trabajador----------------//

    $('#form_trabajador').submit(function(e) {     
        e.preventDefault();
        $( "#fecha_ingresoo" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fecha_salidao" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        // $( "#fecha_ingresoo" ).datepicker({
        //     dateFormat: "yy-mm-dd"
        // });
        // alert($("#fecha_ingresoo"));
        var postdata = $('#form_trabajador').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_trabajadores/add_trabajador.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/trabajadores.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

    //---------------limpiar datos de trabajador----------------//

    function limpiar_trabajador() {
        $('#nombreo').val("");
        $('#apellidoo').val("");
        $('#cedulao').val("");
        $('#selec_desempeno').val("");
        $('#telefonoo').val("");
        $('#fecha_ingresoo').val("");
        $('#fecha_salidao').val("");
        $('#cedula_vieja').val("");
    }  


    //---------------Eliminar trabajador----------------//

function deleteTrabajador(ci) {
    var postdata = {'cedula': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_trabajadores/delete_trabajador.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                alert(response.mensaje);
                window.location.href = location.origin+"/Consorcio/trabajadores.php";
            } else {
                alert(response.mensaje);
                console.log(response);
            }
        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    });         
}

    //---------------Get trabajador----------------//

function getTrabajador(ci) {

    $(".subtitulosEditar").show();  
    $(".ingresar_datos").hide();
    $("#b_guardar").hide();
    $("#b_editar").show();

    console.log(ci);
    $("#t_trabajadores").fadeOut();
    $("#f_trabajadores").fadeIn(1500);
    var postdata = {'cedula': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_trabajadores/get_trabajador.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                console.log(response);
                $('#nombreo').val(response.Nombre);
                $('#apellidoo').val(response.Apellido);
                $('#cedulao').val(response.Cedula);
                $('#telefonoo').val(response.Telefono);
                $('#selec_desempeno').val(response.Desempeno);
                $('#fecha_ingresoo').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Ingreso);
                $('#cedula_vieja').val(response.Cedula);
                // var fechasalida = response.Fecha_Salida.datepicker("option", "dateFormat", "yy-mm-dd" );
                if (response.Fecha_Salida=='0000-00-00'){
                    $('#fecha_salidao').val(response.Fecha_Salida);  
                } else {
                    $('#fecha_salidao').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Salida); //////////////////////////////////
                }

            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    }); 
}

    //---------------Editar trabajador----------------//

    $("#boton_editar_ob").click(function(){
        // e.preventDefault();
        $( "#fecha_ingresoo" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fecha_salidao" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_trabajador').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_trabajadores/edit_trabajador.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/trabajadores.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    })



// ---------------------------------- USUARIOS -------------------------------------//
    //---------------Agregar usuario----------------//
          
 $('#form_usuarios').submit(function(e) {     
        e.preventDefault();
        var postdata = $('#form_usuarios').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_usuarios/add_usuario.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/usuarios.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

        //---------------limpiar datos de usuario----------------//

        function limpiar_usuario() {
            $('#nombreu').val("");
            $('#apellidou').val("");
            $('#cedulau').val("");
            $('#telefonou').val("");
            $('#correou').val("");
            $('#cargou').val("");
            $('#claveu').val("");
            $('#cedula_vieja').val("");
        }   

        //---------------Eliminar usuario----------------//


function deleteUsuario(ci) {
    var postdata = {'cedula': ci};

            $.ajax({
            type: 'POST',
            url: 'scripts/file_usuarios/delete_usuario.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/usuarios.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
            });  
      }


    //---------------Get usuario----------------//

function getUsuario(ci) {

    $("#b_guardar").hide();
    $("#b_editar").show();

    $(".hide_user").show();
    $("#cedulau").addClass("sineditar");


    $(".subtitulosEditar").show();  
    $(".ingresar_datos").hide();

    console.log(ci);
    $("#t_usuarios").fadeOut();
    $("#f_usuarios").fadeIn(1500);
    var postdata = {'cedula': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_usuarios/get_usuario.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                console.log(response);
                $('#nombreu').val(response.Nombre);
                $('#apellidou').val(response.Apellido);
                $('#cedulau').val(response.Cedula);
                $('#telefonou').val(response.Telefono);
                $('#correou').val(response.Correo);
                $('#cargou').val(response.Cargo);
                $('#claveu').val(response.Clave);
                $('#cedula_vieja').val(response.Cedula);
            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    }); 
}

    //---------------Editar usuario----------------//

    $("#boton_editar_us").click(function(){
        var postdata = $('#form_usuarios').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_usuarios/edit_usuario.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/usuarios.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    });


// ---------------------------------- OBRAS -------------------------------------//
    //---------------Agregar obra----------------//
          
 $('#form_obras').submit(function(e) {    
        e.preventDefault();
        $( "#fechainicioObra" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fechafinObra" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_obras').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_obras/add_obras.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/obras.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

    //---------------limpiar datos de obras----------------//

    function limpiar_obra() {
        $('#nombreObra').val("");
        $('#encargadoObra').val("");
        $('#telefonoObra').val("");
        $('#correoObra').val("");
        $('#fechainicioObra').val("");
        $('#fechafinObra').val("");
        $('#direccionObra').val("");
        $('#ubicacionObra').val("");
        $('#imagenObra').val("");
        $('#id_viejo').val("");
        $('#latitud').val("");
        $('#longitud').val("");
    }   

    //---------------Get obra----------------//
    function showm(){
        console.log(markers);
        console.log(localidades);
        // alert(JSON.stringify(markers,null,4));
    }

    function getObras(nom) {
        // e.preventDefault();
        $("#b_guardar").hide();
        $("#b_editar").show();
        $("#add_obras").hide();
        $(".ingresar_datos").hide();
        $(".obra_empresa").hide();


        console.log(nom);
        $("#t_obras").fadeOut();
        $("#f_obras").fadeIn(1500);
        var postdata = {'IdObras': nom};
        $.ajax({
            type: 'POST',
            url: 'scripts/file_obras/get_obras.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    console.log(response);

                    var uluru = {lat: 10.224375, lng: -68.003394}; 
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 11,
                        center: uluru
                    });
                    var latlng = new google.maps.LatLng(
                        parseFloat(response.Latitud),
                        parseFloat(response.Longitud));

                    var marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    markers.push(marker);   
                    map.panTo(latlng);

                    map.addListener('click', function(e) {
                        if (markers.length == 0){
                            placeMarkerAndPanTo(e.latLng, map);
                        }else {
                            alert("Debe borrar la marca establecida anteriormente");
                        }                                    
                    });    

                    $('#nombreObra').val(response.Nombre_Obra);
                    $('#encargadoObra').val(response.Cedula_Encargado);
                    $('#telefonoObra').val(response.Telefono_Encargado);
                    $('#correoObra').val(response.Correo_Obra);
                    $('#fechainicioObra').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Inicio);
                    $('#fechafinObra').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Culminacion);
                    $('#direccionObra').val(response.Direccion_Obra);                    
                    // $('#imagenObra').val(response.Imagen_Obra);
                    $('#latitud').val(response.Latitud);
                    $('#longitud').val(response.Longitud);
                    $('#id_viejo').val(response.id_viejo);

                } else {
                    alert(response.mensaje);
                    console.log(response);
                }

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        }); 
    }

    //---------------Editar obra----------------//

    $("#boton_editar_obra").click(function(){
        $( "#fechainicioObra" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fechafinObra" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_obras').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_obras/edit_obras.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/obras.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    });


    //---------------Eliminar obras----------------//

    // $("#borrar_obra").click(function(){
      function eliminarObra() {  
        var idObra = $("#id_viejo").val(); 
        var postdata = {'IdObras': idObra};
        $.ajax({
            type: 'POST',
            url: 'scripts/file_obras/delete_obras.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/obras.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });  
    };

// ---------------------------------- CRONOGRAMA -------------------------------------//
    //---------------Agregar cronograma----------------//
          
 $('#form_cronograma').submit(function(e) {     
        $( "#fechaInicio" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fechaFinal" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        e.preventDefault();
        var postdata = $('#form_cronograma').serialize();
        var IdObra = $('#id_obra_actual').val();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_cronograma/add_cronograma.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/cronograma.php?IdObra="+IdObra+"";                    
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

    //---------------Ver cronograma----------------//

function vercronograma(idObra) {
    window.location.href = location.origin+"/Consorcio/actividades.php?idObra="+idObra+"";
}


    //---------------Ver actividades----------------//

function ver_actividades(IdCronograma) {
    window.location.href = location.origin+"/Consorcio/actividades.php?IdCronograma="+IdCronograma+"";
}



    //---------------limpiar cronograma----------------//

    function limpiar_cronograma() {
        $('#fechaInicio').val("");
        $('#fechaFinal').val("");
    } 

    //---------------Get cronograma----------------//

function getcronograma(ci) {

    $("#b_guardar").hide();
    $("#b_editar").show();
    $(".subtitulosEditar").show();  
    $(".ingresar_datos").hide();

    console.log(ci);
    $("#t_cronograma").fadeOut();
    $("#f_cronograma").fadeIn(1500);
    var postdata = {'IdCronograma': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_cronograma/get_cronograma.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                console.log(response);
                $('#descripcionCrono').val(response.Descripcion);
                $('#fechaInicio').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Inicio);
                $('#fechaFinal').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Final);

                $('#IdCronogramaViejo').val(response.IdCronograma);

            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    }); 
}

    //---------------Editar cronograma----------------//

    $("#boton_editar_cro").click(function(){
        $( "#fechaInicio" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fechaFinal" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_cronograma').serialize();
        var IdObra = $('#id_obra_actual').val();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_cronograma/edit_cronograma.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/cronograma.php?IdObra="+IdObra+"";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    });


    //---------------Eliminar cronograma----------------//

function deletecronograma(id) {
    var postdata = {'IdCronograma': id};
    var IdObra = $('#id_obra_actual').val();
    $.ajax({
        type: 'POST',
        url: 'scripts/file_cronograma/delete_cronograma.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                alert(response.mensaje);
                window.location.href = location.origin+"/Consorcio/cronograma.php?IdObra="+IdObra+"";
            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    });  
}


// ---------------------------------- ACTIVIDADES -------------------------------------//
    //---------------Agregar actividad----------------//
          
 $('#form_actividad').submit(function(e) {  
        $( "#fechaEjecucion" ).datepicker("option", "dateFormat", "yy-mm-dd" );   
        e.preventDefault();
        var postdata = $('#form_actividad').serialize();
        var IdCronograma = $('#id_cronograma_hide').val();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_actividades/add_actividad.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/actividades.php?IdCronograma="+IdCronograma+"";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

    //---------------limpiar actividad----------------//

    function limpiar_actividad() {
        $('#actividad').val("");
        $('#fechaEjecucion').val("");
        $('#selec_desempeno').val("");
        $('#notaActividad').val("");
        $('#id_viejo').val("");
    } 

    //---------------Get actividad----------------//

function getactividad(ci) {

    $("#b_guardar").hide();
    $("#b_editar").show();
    $(".subtitulosEditar").show();  
    $(".ingresar_datos").hide();

    console.log(ci);
    $("#t_actividades").fadeOut();
    $("#f_actividad").fadeIn(1500);
    var postdata = {'IdActividad': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_actividades/get_actividad.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                console.log(response);
                $('#actividad').val(response.Actividad);                
                $('#fechaEjecucion').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Ejecucion);
                $('#selec_desempeno').val(response.Estatus);
                $('#notaActividad').val(response.Nota);
                $('#id_viejo').val(response.id_viejo);

            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    }); 
}

    //---------------Editar actividad----------------//

    $("#boton_editar_actividad").click(function(){
        $( "#fechaEjecucion" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_actividad').serialize();
        var IdCronograma = $('#id_cronograma_hide').val();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_actividades/edit_actividad.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);

                    if (IdCronograma == 0) {
                        var Estatus = $('#estatus_hide').val();
                        window.location.href = location.origin+"/Consorcio/actividades.php?estatus="+Estatus+"";
                    } else {
                        window.location.href = location.origin+"/Consorcio/actividades.php?IdCronograma="+IdCronograma+"";  
                    }                                      
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    });


        //---------------Eliminar actividad----------------//

function deleteactividad(id) {
    var postdata = {'IdActividad': id};
    var IdCronograma = $('#id_cronograma_hide').val();
    $.ajax({
        type: 'POST',
        url: 'scripts/file_actividades/delete_actividad.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                alert(response.mensaje);
                if (IdCronograma == 0) {
                    var Estatus = $('#estatus_hide').val();
                    window.location.href = location.origin+"/Consorcio/actividades.php?estatus="+Estatus+"";
                } else {
                    window.location.href = location.origin+"/Consorcio/actividades.php?IdCronograma="+IdCronograma+"";                
                }
            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    });  
}

// ---------------------------------- RUTA CHOFERES -------------------------------------//
    //---------------Agregar ruta choferes----------------//
          
    $('#form_rutachofer').submit(function(e) {     
        e.preventDefault();
        $( "#fecha_ejecucion" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_rutachofer').serialize();
        postdata += '&localidades='+JSON.stringify(localidades);
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_rutachoferes/add_rutachofer.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/rutachoferes.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

    //---------------limpiar formulario ruta chofere\----------------//

    function limpiar_rutachofer() {
        $('#selec_chofer').val("");
        $('#actividad').val("");
        $('#fecha_ejecucion').val("");
        $('#selec_estatus').val("");
        $('#latitud1').val("");
        $('#longitud1').val("");
        $('#latitud2').val("");
        $('#longitud2').val("");
        $('#id_viejo').val("");
    }  

        //---------------Eliminar ruta chofer----------------//

function deleteChofer(ci) {
    var postdata = {'IdRutachoferes': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_rutachoferes/delete_rutachofer.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                alert(response.mensaje);
                window.location.href = location.origin+"/Consorcio/rutachoferes.php";
            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    });  
}

    //---------------Get ruta chofer----------------//

function getChofer(ci) {

    $("#b_guardar").hide();
    $("#b_editar").show();
    $(".subtitulosEditar").show();  
    $(".ingresar_datos").hide();

    console.log(ci);
    $("#t_rutachoferes").fadeOut();
    $("#f_rutachofer").fadeIn(1500);
    var postdata = {'IdRutachoferes': ci};
    localidades = [];
    deleteMarkers();
    $.ajax({
        type: 'POST',
        url: 'scripts/file_rutachoferes/get_rutachofer.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                console.log(response);

                var uluru = {lat: 10.224375, lng: -68.003394}; 
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 11,
                    center: uluru
                });

                if (response.latitud1 != 0){
                    var latlng = new google.maps.LatLng(
                        parseFloat(response.Latitud1),
                        parseFloat(response.Longitud1));

                    var marker = new google.maps.Marker({
                        position: latlng,
                        label: 'A',
                        map: map
                    });

                    var localidad = {
                        'lat' : response.Latitud1,
                        'lng' : response.Longitud1
                    };
                    localidades.push(localidad);                    
                    markers.push(marker);   
                    map.panTo(latlng);
                }

                if (response.Latitud2 != 0) {
                    var latlng = new google.maps.LatLng(
                        parseFloat(response.Latitud2),
                        parseFloat(response.Longitud2));

                    var marker = new google.maps.Marker({
                        position: latlng,
                        label: 'B',
                        map: map
                    });

                    var localidad = {
                        'lat' : response.Latitud2,
                        'lng' : response.Longitud2
                    };
                    localidades.push(localidad);                    
                    markers.push(marker);   
                    map.panTo(latlng);
                }

                if (response.Latitud3 != 0) {
                    var latlng = new google.maps.LatLng(
                        parseFloat(response.Latitud3),
                        parseFloat(response.Longitud3));

                    var marker = new google.maps.Marker({
                        position: latlng,
                        label: 'C',
                        map: map
                    });

                    var localidad = {
                        'lat' : response.Latitud3,
                        'lng' : response.Longitud3
                    };
                    localidades.push(localidad);                    
                    markers.push(marker);   
                    map.panTo(latlng);
                }

                map.addListener('click', function(e) {
                    if (markers.length < 3){
                        placeMarkerAndPanTo(e.latLng, map);
                    }else {
                        alert("Debe borrar la marca establecida anteriormente");
                    }                                    
                });    

                $('#selec_chofer').val(response.Chofer);
                $('#actividad').val(response.Actividad);
                $('#fecha_ejecucion').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Ejecucion);
                $('#selec_estatus').val(response.Estatus);

                // Se debe agregar condicional por si viene 0
                $('#latitud1').val(response.Latitud1);
                $('#longitud1').val(response.Longitud1);
                $('#latitud2').val(response.Latitud2);
                $('#longitud2').val(response.Longitud2);
                $('#latitud3').val(response.Latitud3);
                $('#longitud3').val(response.Longitud3);
                
                $('#id_viejo').val(response.IdRutachoferes);

                // var fechasalida = response.Fecha_Salida.datepicker("option", "dateFormat", "yy-mm-dd" );
                // if (response.Fecha_Salida=='0000-00-00'){
                //     $('#fecha_salidao').val(response.Fecha_Salida);  
                // } else {
                //     $('#fecha_salidao').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Ingreso);
                // }

            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    }); 
}

    //---------------Editar ruta choferes----------------//

    $("#boton_editar_rutach").click(function(){
        // e.preventDefault();
        $( "#fecha_ejecucion" ).datepicker("option", "dateFormat", "yy-mm-dd" );        
        var postdata = $('#form_rutachofer').serialize();
        postdata += '&localidades='+JSON.stringify(localidades);
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_rutachoferes/edit_rutachofer.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/rutachoferes.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    })

    //---------------Mostrar ruta choferes----------------//

    function verRutaChofer(idRuta) {        
        var postdata = {'IdRutachoferes': idRuta};
        localidades = [];
        deleteMarkers();
        $.ajax({
            type: 'POST',
            url: 'scripts/file_rutachoferes/get_rutachofer.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    console.log(response);
                        
                    var uluru = {lat: 10.224375, lng: -68.003394}; 
                    var mapModal = new google.maps.Map(document.getElementById('ruta-map'), {
                        zoom: 11,
                        center: uluru
                    });

                    if (response.latitud1 != 0.0){
                        var latlng = new google.maps.LatLng(
                            parseFloat(response.Latitud1),
                            parseFloat(response.Longitud1));

                        var marker = new google.maps.Marker({
                            position: latlng,
                            label: 'A',
                            map: mapModal
                        });

                        var localidad = {
                            'lat' : response.Latitud1,
                            'lng' : response.Longitud1
                        };
                        localidades.push(localidad);                    
                        markers.push(marker);   
                        mapModal.panTo(latlng);
                    }

                    if (response.Latitud2 != 0.0) {
                        var latlng = new google.maps.LatLng(
                            parseFloat(response.Latitud2),
                            parseFloat(response.Longitud2));

                        var marker = new google.maps.Marker({
                            position: latlng,
                            label: 'B',
                            map: mapModal
                        });

                        var localidad = {
                            'lat' : response.Latitud2,
                            'lng' : response.Longitud2
                        };
                        localidades.push(localidad);                    
                        markers.push(marker);   
                        mapModal.panTo(latlng);
                    }

                    if (response.Latitud3 != 0.0) {
                        var latlng = new google.maps.LatLng(
                            parseFloat(response.Latitud3),
                            parseFloat(response.Longitud3));

                        var marker = new google.maps.Marker({
                            position: latlng,
                            label: 'C',
                            map: mapModal
                        });

                        var localidad = {
                            'lat' : response.Latitud3,
                            'lng' : response.Longitud3
                        };
                        localidades.push(localidad);                    
                        markers.push(marker);   
                        mapModal.panTo(latlng);
                    }  

                    // $('#selec_chofer').val(response.Chofer);
                    $('#texto-Actividad-mapa').text(response.Actividad);
                    $('#dialog-rutaChof-mapa').dialog('open');

                } else {
                    alert(response.mensaje);
                    console.log(response);
                }

            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });         
    }

    $( "#dialog-rutaChof-mapa" ).dialog({
      resizable: false,
      height: "auto",
      width: 650,
      modal: true,
      autoOpen: false,
      closeOnEscape: true
    });

    // ---------------------------------- MAQUINARIA -------------------------------------//
    //---------------Agregar maquinaria----------------//

    $('#form_maquinaria').submit(function(e) {     
        e.preventDefault();
        $( "#fecha_desde" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fecha_hasta" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        // $( "#fecha_ingresoo" ).datepicker({
        //     dateFormat: "yy-mm-dd"
        // });
        // alert($("#fecha_ingresoo"));
        var postdata = $('#form_maquinaria').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_maquinaria/add_maquinaria.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                // console.log(response.mensaje);
                // alert(window.location.href);
                if (response.codigo == "01"){
                    window.location.href = location.origin+"/Consorcio/maquinaria.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
                
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });     
    });

    //---------------limpiar formulario maquinaria----------------//

    function limpiar_maquinaria() {
        $('#selec_maquina').val("");
        $('#maquina').val("");
        $('#selec_operador').val("");
        $('#selec_obra').val("");
        $('#fecha_desde').val("");
        $('#fecha_hasta').val("");
    }  

    //---------------Eliminar maquinaria----------------//

function deleteMaquinaria(ci) {
    var postdata = {'IdMaquinaria': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_maquinaria/delete_maquinaria.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                alert(response.mensaje);
                window.location.href = location.origin+"/Consorcio/maquinaria.php";
            } else {
                alert(response.mensaje);
                console.log(response);
            }
        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    });         
}


    //---------------Get maquinaria----------------//

function getMaquinaria(ci) {

    $(".subtitulosEditar").show();  
    $(".ingresar_datos").hide();
    $("#b_guardar").hide();
    $("#b_editar").show();
    $("#listamaquinas").hide();
    $("#cuadromaquina").show();

    console.log(ci);
    $("#t_maquinaria").fadeOut();
    $("#f_maquinaria").fadeIn(1500);
    var postdata = {'IdMaquinaria': ci};
    $.ajax({
        type: 'POST',
        url: 'scripts/file_maquinaria/get_maquinaria.php',
        data: postdata,
        dataType: 'json',
        success: function(response) {
            // console.log(response.mensaje);
            // alert(window.location.href);
            if (response.codigo == "01"){
                console.log(response);
                $('#selec_maquina').val(response.IdMaqui);
                $('#maquina').val(response.Maquina);
                $('#selec_operador').val(response.IdOperador);
                $('#selec_obra').val(response.IdObra);
                // $('#fecha_desde').val(response.Fecha_Desde);
                // $('#fecha_hasta').val(response.Fecha_Hasta);
                $('#id_viejo').val(response.id_viejo);
                $('#fecha_desde').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Desde);
                if (response.Fecha_Hasta == '0000-00-00'){
                    $('#fecha_hasta').val(response.Fecha_Hasta);  
                } else {
                    $('#fecha_hasta').datepicker("option", "dateFormat", "yy-mm-dd" ).val(response.Fecha_Hasta);
                }

            } else {
                alert(response.mensaje);
                console.log(response);
            }

        },
        error: function(error) {
            console.log("hubo un error");
            console.log(error);
        }
    }); 
}

    //---------------Editar maquinaria----------------//

    $("#boton_editar_maq").click(function(){
        // e.preventDefault();
        $( "#fecha_desde" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        $( "#fecha_hasta" ).datepicker("option", "dateFormat", "yy-mm-dd" );
        var postdata = $('#form_maquinaria').serialize();
        console.log(postdata);
        $.ajax({
            type: 'POST',
            url: 'scripts/file_maquinaria/edit_maquinaria.php',
            data: postdata,
            dataType: 'json',
            success: function(response) {
                if (response.codigo == "01"){
                    console.log(response.mensaje);
                    alert(response.mensaje);
                    window.location.href = location.origin+"/Consorcio/maquinaria.php";
                } else {
                    alert(response.mensaje);
                    console.log(response);
                }
            },
            error: function(error) {
                console.log("hubo un error");
                console.log(error);
            }
        });   
    })