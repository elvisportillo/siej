<div class="col-sm-10 d-flex justify-content-center " style=" margin: auto; padding: 20px;
        
        background-color: #0055FF;
        color: white;
        border-radius: 10px;
        ">

<form method="post" action="{{ url('guardarIG') }}">
        @csrf
        
        <div class="row ">
            <h5 style="text-align: center;"> INGRESO DE INFORMES DE GESTION - {{ $datos->nombre_sede }}</h5>
        </div>
        
    <fieldset class="border rounded-3 p-1">
        <input type="hidden" name="tribunal" id="tribunal" value="{{ old('tribunal', $datos->id_sede) }}">

        <div class="mb-3 row" style="margin-top: 10px;">
            <label for="" class="form-label col-sm-2">FUNCIONARIO</label>
            <div class="col-sm-1">
                <a class="btn btn-outline-light" id="btn-buscar-funcionario"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
            <div class="col-sm-8">
                <input type="text" class="form-control-plaintext" id="nombre_funcionario" name="nombre_funcionario" value="{{ old('nombre_funcionario', $datos->nombres . ' ' . $datos->apellidos) }}" style="color:white;">
                <input type="hidden" name="funcionario" id="funcionario" value="{{ old('funcionario', '$datos->id_funcionario') }}">
            </div>

        </div>

        <div class="row">
            <label for="" class="form-label col-sm-2">NOMBRAMIENTO</label>
            <div class="col-sm-4">
                @php
                $n = $datos->nombramiento;
                @endphp
                <select name="nombramiento" id="" class="form-select">
                @foreach(nombramientos() as $nombramiento)
                        <option value="{{ old('nombramiento', $datos->nombramiento) }}"  @if(old("nombramiento") == $nombramiento ) {{ 'selected' }} @endif>{{$nombramiento}}</option>
                    @endforeach
                </select>
            </div>
            <label for="mes_evaluado" class="form-label col-sm-2">MES EVALUADO</label>
            <div class="col-sm-4">
                <select name="mes_evaluado" id="" class="form-select"s>
                    @foreach(meses() as $mes)
                        <option value="{{$mes}}"  @if (old("mes_evaluado") == $mes ) {{ 'selected' }} @endif>{{$mes}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            
        </div>
    </fieldset>