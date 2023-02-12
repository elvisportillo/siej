$(".txt-buscar").keyup(function(){
    if(event.keyCode == 13){
        $("#form-actividades-usuarios").submit();
    }
})

$("#tipo_busqueda").change(function(){
    $("#form-actividades-usuarios").submit();
})

$("#filtro-actividad").click(function(){
    $("#view").val("actividades-usuarios.index")
})



