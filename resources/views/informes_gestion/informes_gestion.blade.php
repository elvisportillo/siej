@include("layouts.app")
@include("informes_gestion.modals.buscar-judicatura-modal")
@include("informes_gestion.modals.buscar-funcionario-modal")

@php
    
@endphp

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<br>
<div class="col-sm-8 d-flex justify-content-center " style=" margin: auto; padding: 30px;
        
        background-color: #0055FF;
        color: white;
        border-radius: 10px;
        ">
    <form action="{{ url('g') }}" method="post">
        @csrf
        <div class="mb-3 row">
            <label for="tribunal" class="col-sm-2 col-form-label">Sede Judicial</label>
            <div class="col-sm-8">
                <input type="hidden" name="tribunal" id="tribunal" value="{{ old('tribunal', '') }}">
                <input type="textbox" class="form-control-plaintext" id="nombre_tribunal" name="nombre_tribunal" value="{{ old('nombre_tribunal') }}" style="color:white;">
            </div>

            <div class="col-sm-2">
                <a class="btn btn-outline-light" id="btn-buscar-tribunal">Buscar</a>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="form-label col-sm-2">Funcionario</label>
            <div class="col-sm-8">
                <input type="text" class="form-control-plaintext" id="nombre_funcionario" name="nombre_funcionario" value="{{ old('nombre_funcionario','') }}" style="color:white;">
                <input type="hidden" name="funcionario" id="funcionario" value="{{ old('funcionario', '') }}">
            </div>

            <div class="col-sm-2">
                <a class="btn btn-outline-light" id="btn-buscar-funcionario">Buscar</a>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="form-label col-sm-3">Nombramiento</label>
            <div class="col-sm-9">
                <select name="nombramiento" id="" class="form-select" value="{{ old('nombramiento') }}">
                @foreach(nombramientos() as $nombramiento)
                        <option value="{{$nombramiento}}"  @if (old("nombramiento") == $nombramiento ) {{ 'selected' }} @endif>{{$nombramiento}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="mes_evaluado" class="form-label col-sm-3">Mes Evaluado</label>
            <div class="col-sm-9">
                <select name="mes_evaluado" id="" class="form-select"s>
                    @foreach(meses() as $mes)
                        <option value="{{$mes}}"  @if (old("mes_evaluado") == $mes ) {{ 'selected' }} @endif>{{$mes}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <input type="submit" value="Enviar">
    </form>
</div>

<script>
    var myModalTribunal = new bootstrap.Modal(document.getElementById('buscar-judicatura-modal'), {})
    var myModalFuncionario = new bootstrap.Modal(document.getElementById('buscar-funcionario-modal'), {})

    document.getElementById("btn-buscar-tribunal").addEventListener("click", function(){
        myModalTribunal.show()
        document.getElementById("mostrarJudicaturas").innerHTML = "";
        document.getElementById("buscandoJudicatura").value = "";
    })

    document.getElementById("btn-buscar-funcionario").addEventListener("click", function(){
        myModalFuncionario.show()
        document.getElementById("mostrarFuncionarios").innerHTML = "";
        document.getElementById("buscandoFuncionario").value = "";
    })

    document.getElementById("buscandoJudicatura").addEventListener("keyup", function(){
        if(event.keyCode === 13){
            document.getElementById("mostrarJudicaturas").innerHTML = "";
            fetch("http://127.0.0.1/ute/public/buscar-judicatura" + "/" + document.getElementById("buscandoJudicatura").value, {
                    method: 'GET',
                    headers: {
                        "Content-Type": "application/json",
                        'Access-Control-Allow-Origin': '*'
                    }
            })
            .then(response => response.json())
            .then(function(dato){
                dato.forEach(element => {
                    document.getElementById("mostrarJudicaturas").innerHTML += "<tr><td class='id_sede' id='" + element.id_sede + "'>" + element.nombre_sede + ", " + element.nombre_departamento + "</td></tr>"
                    
                })
                document.querySelectorAll(".id_sede").forEach(el => {
                    el.addEventListener("click", e => {
                        const id = e.target.getAttribute("id");
                        
                        document.getElementById("nombre_tribunal").value = e.target.innerHTML
                        document.getElementById("tribunal").value = id
                        myModalTribunal.hide()

                    });
                });
            })

        }
    })

    document.getElementById("buscandoFuncionario").addEventListener("keyup", function(){
        if(event.keyCode === 13){
            
            document.getElementById("mostrarFuncionarios").innerHTML = "";
            fetch("http://127.0.0.1/ute/public/buscar-funcionario" + "/" + document.getElementById("buscandoFuncionario").value, {
                    method: 'GET',
                    headers: {
                        "Content-Type": "application/json",
                        'Access-Control-Allow-Origin': '*'
                    }
            })
            .then(response => response.json())
            .then(function(dato){
                dato.forEach(element => {
                    document.getElementById("mostrarFuncionarios").innerHTML += "<tr><td class='id_funcionario' id='" + element.id_funcionario + "'>" + element.nombres + " " + element.apellidos + "</td></tr>"
                })
                console.log("ok")
                document.querySelectorAll(".id_funcionario").forEach(el => {
                    el.addEventListener("click", e => {
                        const id = e.target.getAttribute("id");
                        document.getElementById("nombre_funcionario").value = e.target.innerHTML
                        document.getElementById("funcionario").value = id
                        myModalFuncionario.hide()
                    });
                });
            })

        }
    })
    
</script>