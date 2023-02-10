$("#crear").click(function(){
    $("#agregar-usuario-modal").modal("show")
    $("#id_usuario").val("")    
    void_user();
    $("#agregar-usuario").html("Agregar")
    $("#calidad").hide();
})

function void_user(){
    $("#id_usuario").attr("class", "form-control")
    $("#header-title").html("Crear Usuario")
    $('#nombres').val("");
    $('#apellidos').val("");
    $('#sexo').val("");
    $('#cargo').val("");
    $("#calidad").show();
    $('#telefono').val("");
    $('#correo').val("");
    $('#cuenta_academica').val("");
    $("#calidad").hide();
    $('#nombre_judicatura').val("");
    $("#buscandoJudicatura").val("");
    $('#vetting').prop('checked', false); 
    $('#comentarios_usuario').val("");
    $('#id_judicatura').val("");
    $('#dui').val("");         
}

$(".select_cargos").change(function(){
    $(this).val().includes("MAGISTRADO/A") | $(this).val().includes("JUEZ/A")
    ? $("#calidad").show()
    : $("#calidad").hide();
})

//Funcion que se encarga de obtener toda la informacion de un usuario cuando se introduce el codigo de usuario en el modal agregar-usuario
$("#id_usuario").blur(function(){
    //var id = $("#create_id_usuario").val();
    $.ajax({
        type: "GET",
        url: $("#editar-usuario").val() + "/" + $("#id_usuario").val(),
        success: function (response) {
            console.log(response.usuario.id_usuario)
            if (response.status == 200) {
                llenar_inputs(response)
            }
        }, error(){
            void_user()
        }
    });
})


//Esta funcion se la asignamos a los botones de editar-usuario, con ella traemos la informacion del usuario seleccionado y la pasamos al modal
$(document).on('click', '.editbtn', function (e) {
    e.preventDefault();
    var id_usuario = $(this).val();
    
    $("#id_usuario").attr("class", "form-control-plaintext")
    $('#agregar-usuario-modal').modal('show');
    $("#header-title").html("Actualizar Usuario")
    $.ajax({
        type: "GET",
        url: $("#editar-usuario").val() + "/" + id_usuario,
        success: function (response) {
            if (response.status == 404) {
                console.log(response.message)
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
                
            } else {
                console.log(response.usuario.nombres);
                llenar_inputs(response)
                $("#agregar-usuario").html("Actualizar")
            }
            
        }
    });
});

function llenar_inputs(response){
    $("#id_usuario").val(response.usuario.id_usuario)
    $('#nombres').val(response.usuario.nombres);
    $('#apellidos').val(response.usuario.apellidos);
    $('#sexo').val(response.usuario.sexo);
    $('#cargo').val(response.usuario.cargo);
    if(response.usuario.calidad == "PROPIETARIO" | response.usuario.calidad == "INTERINO" | response.usuario.calidad == "SUPLENTE"){
        $("#calidad").show();
        $("#calidad").val(response.usuario.calidad);
    }
    $('#telefono').val(response.usuario.telefono_usuario);
    $('#correo').val(response.usuario.correo_usuario);
    $('#cuenta_academica').val(response.usuario.cuenta_academica);
    $('#nombre_judicatura').val(response.usuario.cargo + ", " + response.usuario.nombre_judicatura);
    $("#buscandoJudicatura").val(response.usuario.nombre_judicatura)
    $('#dui').val(response.usuario.dui);
    response.usuario.vetting == "SI" 
    ? $('#vetting').prop('checked', true) : $('#vetting').prop('checked', false); 
    $('#comentarios_usuario').val(response.usuario.comentarios);
    $("#id_judicatura").val(response.usuario.id_judicatura);
    console.log(response.usuario.id_judicatura)
}

$(document).on('click', '.agregar_usuario', function (e) {
    e.preventDefault();

    var vetting;
    vetting = $("#vetting").is(':checked') ? "SI" : "NO"  

    var cargo = $("#seleccionarTipo").val() == "LIBRE EJERCICIO" ? "LIBRE EJERCICIO" : $('#cargo').val();

    var data = {
        'id_usuario': $('#id_usuario').val(),
        'nombres': $('#nombres').val(),
        'apellidos': $('#apellidos').val(),
        'sexo': $('#sexo').val(),
        'correo_usuario': $('#correo').val(),
        'cuenta_academica': $('#cuenta_academica').val(),
        'telefono_usuario': $('#telefono').val(),
        'dui': $('#dui').val(),
        'vetting': vetting,
        'cargo': cargo,
        'calidad': $("#calidad").val(),
        'comentarios': $("#comentarios_usuario").val(),
        'id_judicatura': $("#id_judicatura").val()
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: $("#agregar-usuario").val(),
        data: data,
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.status == 400) {
                $('#save_msgList').html("");
                $('#save_msgList').addClass('alert alert-danger');
                $.each(response.errors, function (key, err_value) {
                    $('#save_msgList').append('<li>' + err_value + '</li>');
                });
                $('.agregar_usuario').text('Guardando');
            }else {
                alert(response.message)
                $('.agregar_usuario').text('Guardar');
                $('#agregar-usuario-modal').modal('hide');
                window.location.reload()
            }
        }
    });

});


$(document).on('click', '.deletebtn', function () {
    var usuario = $(this).val();
    console.log(usuario)
    var id = usuario.slice(0,usuario.indexOf("-"))
    $('#eliminar-usuario-modal').modal('show');
    $("#txt-borrar-usuario").html(usuario)
    $('#deleteing_id').val(usuario);
});

$(document).on('click', '.delete_student', function (e) {
    e.preventDefault();

    $(this).text('Eliminando..');
    var id = $('#deleteing_id').val().slice(0,$('#deleteing_id').val().indexOf("-"));
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "DELETE",
        url: $("#eliminar-usuario").val() + "/" + id + "|" + $("#razon").val() + "|" + $("#comentario").val(),
        dataType: "json",
        success: function (response) {
            // console.log(response);
            if (response.status == 404) {
                alert(response.message);
                $('.delete_student').text('Eliminar');
            } else {
                alert(response.message);
                $('.delete_student').text('Eliminar');
                $('#eliminar-usuario-modal').modal('hide');
                window.location.reload()
            }
        }
    });
});

$("#mostrar").hide()
$("#seleccionarTipo").change(function(){
    if($("#seleccionarTipo").val() == "LIBRE EJERCICIO"){
        $("#buscar-judicatura-modal").modal("hide")
        $("#nombre_judicatura").val("ABOGADO EN LIBRE EJERCICIO, OFICINA JURIDICA PARTICULAR")
        $("#id_judicatura").val(0);
    } else if($("#seleccionarTipo").val() == "JUDICATURA"){
        $("#mostrar").show()
    }
})