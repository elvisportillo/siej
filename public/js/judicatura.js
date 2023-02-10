$(document).on('click', '.editJudicaturabtn', function (e) {
    e.preventDefault();
    var id_judicatura = $(this).val();
    $('#actualizar-judicatura-modal').modal('show');
    $.ajax({
        type: "GET",
        url: $("#editarJudicatura").val() + "/" + id_judicatura,
        data: {id_judicatura: id_judicatura},
        success: function (response) {
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
                
            } else {
                $("#update_nombre_judicatura").val(response.judicatura.nombre_judicatura)
                $('#correo_judicatura').val(response.judicatura.correo_judicatura);
                $('#telefono1').val(response.judicatura.telefono1);
                $('#telefono2').val(response.judicatura.telefono2);
                $('#telefono3').val(response.judicatura.telefono3);
                $("#departamento").val(response.judicatura.departamento);
                $("#tipo").val(response.judicatura.tipo);
                $('#hidden_user_id').val(response.judicatura.id_judicatura);
                console.log(response.judicatura.nombre_judicatura)
            }
        }
    });

});


$("#actualizarJudicatura").click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: $("#actualizarJudicatura").val(),
        data: $("#form_judicatura").serialize() + '&id_judicatura=' + $("#hidden_user_id").val(),
        dataType: "json",
        success: function (response) {
            console.log(response.message);
            if (response.status == 400) {
                $('#updateJudicatura_msgList').html("");
                $('#updateJudicatura_msgList').addClass('alert alert-danger');
                $.each(response.errors, function (key, err_value) {
                    $('#updateJudicatura_msgList').append('<li>' + err_value + '</li>');
                });
                $('.agregar_usuario').text('Guardando');
            } else {
                alert(response.message)
                $('#actualizarJudicatura').text('Actualizando');
                $('#actualizar-judicatura-modal').modal('hide');
                window.location.reload()
            }
        }
    });

})


$("#boton_judicatura_usuario").click(function(){
    $("#buscar-judicatura-modal").modal("show");
})

$("#boton_judicatura").click(function(){
    $("#buscar-judicatura-modal").modal("show");
})


$("#buscandoJudicatura").keyup(function(){
    if(event.keyCode === 13){
        $("#mostrarJudicaturas").html("")
        $("#mostrarJudicaturas").append("<div class='loading'><img width='100' src='https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif' /><br /> Cargando Informacion")
        alert($("#boton_judicatura").val())
        $.ajax({
            type: "GET",
            url: $("#boton_judicatura").val(),
            data: {texto: $("#buscandoJudicatura").val()},
            dataType: "json",
            success: function (response) {
                alert(response)
                $("#mostrarJudicaturas").html("");
                $("#mostrarJudicaturas").append("<table>");
                //var datos = JSON.parse(data);
                if(response.status == 200){
                    $.each(response.judicatura, function(index, element){
                        $("#mostrarJudicaturas").append("<tr><td class='jud' id='" + element.id_judicatura +"'>" + element.nombre_judicatura + "</td></tr>")
                    })
                }
                console.log(response.message)        
            }, 
            error: function(error){
                alert("erro")
            }
        
        })
    }
  $("#mostrarJudicaturas").append("</table>")
})
