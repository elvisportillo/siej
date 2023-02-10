// Inicio checkbox que controlan todos
function moverSwitch(div, clase){
    div.change(function () {
        clase.prop('checked', $(this).prop("checked"));
    });
}

moverSwitch($("#checkAll"), $(".deptos"));
moverSwitch($("#checkAllJ"), $(".judicat"));
moverSwitch($("#checkAllC"), $(".cargos"));



$(document).on('click', '.ver', function(){
    alert($(this).attr("id"))
})

//Funcion encargada del icono de flecha arriba para llegar al inicio de la pagina
function irArriba(){
    $('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },1000); });
    $(window).scroll(function(){
      if($(this).scrollTop() > 0){ $('.ir-arriba').slideDown(600); }else{ $('.ir-arriba').slideUp(600); }
    });
    $('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'1000px' },1000); });
  }


function pasarDatosaInputJudicatura(id, nombre){
    $(document).on('click', '.jud', function(){
        id.val("")
        console.log($(this).attr("id"))
        nombre.val($(this).html())
        id.val($(this).attr("id"))
        $("#buscar-judicatura-modal").modal("hide")
    })
}

pasarDatosaInputJudicatura($("#id_judicatura"), $("#nombre_judicatura"))


    $(document).ready(function () {
        var url = window.location.pathname.split("/");
        if(url[url.length-1] == "filtro-usuarios"){
            $("#quitar-filtros").show();
            $("#exportar-excel").show();
            $("#exportar-pdf").show();
        }
        if(window.location.search.startsWith("?")){
            $("#quitar-filtros").show();
        }



        irArriba();
        
        //Con el cuadro de texto buscamos
        $("#txt-buscar").keyup(function(){
            if(event.keyCode === 13){
                $("#form").submit();
            }
        })

        $("#txt-buscar").keyup(function(){
            if(event.keyCode == 13){
                $("#form-ale").submit();
            }
        })

        $("#tipo_busqueda").change(function(){
            $("#form").submit();
        })

        $("#enviarFiltros").click(function(){
            console.log($(".filters").val())
            
            $("#enviarFiltros").html("Cargando <img src='https://tradinglatam.com/wp-content/uploads/2019/04/loading-gif-png-4.gif' height='20px' width='20px'>");
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: "POST",
                url: $("#enviarFiltros").val(),
                data: $("#form-filtros").serialize() + '&view=' + $('.filters').val(),
                dataType: "json",
                success: function (response) {
                    if (response.status == 400) {
                        $("#enviarFiltros").html("Aceptar");
                        $('#filtros_msgList').html("");
                        $('#filtros_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#filtros_msgList').append('<li>' + err_value + '</li>');
                        });
                    }
                    else{
                        console.log(response)
                    }
                    
                },
                error: function(error){
                    $("#form-filtros").submit();
                    console.log(error.status);
                    
                }
            });
        })

    function valideKey(evt){
        var code = (evt.which) ? evt.which : evt.keyCode;
        
        if(code==8) {
          return true;
        } else if(code>=48 && code<=57) { 
          return true;
        } else{ 
          return false;
        }
    }
    

    
    
    });
    