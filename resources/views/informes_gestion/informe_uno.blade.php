@include("layouts.app")
@php
    $meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    $nombramientos = ['PROPIETARIO', 'PROPIETARIO EN REGIMEN DE DISPONIBILIDAD', 'INTERINO', 'SUPLENTE'];
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
<div class="col-sm-10 d-flex justify-content-center " style=" margin: auto; padding: 20px;
        
        background-color: #0055FF;
        color: white;
        border-radius: 10px;
        ">
        
    <form method="post" action="{{ url('guardarIG') }}">
    @csrf
    <div class="mb-3 row ">
        <h4 style="text-align: center;"> INGRESO DE INFORMES DE GESTION</h4>
    </div>

    <div class="mb-3 row">
        <label for="" class="col-sm-3">SEDE JUDICIAL </label>
        <div col-sm-7>
            <input type="text" name="tribunal" value="{{ old('nombre_tribunal', $datos->nombre_judicatura) }}">
        </div>
        <span class="col-sm-9">{{$datos->nombre_judicatura}}</span>
        <label for="" class="col-sm-3">FUNCIONARIO </label>
        <span class="col-sm-9">{{ $datos->nombres }} {{ $datos->apellidos }}</span>
        <label for="" class="col-sm-3">MES EVALUADO </label>
        <span class="col-sm-9">{{ $datos->mes_evaluado }}</span>
        <input type="hidden" name="tribunal" value="{{ $datos->id_tribunal }}">
        <input type="hidden" name="funcionario" value="{{ $datos->id_funcionario }}">
        <input type="hidden" name="mes_evaluado" value="{{ $datos->mes_evaluado }}">
        <input type="hidden" name="nombramiento" value="{{ $datos->nombramiento }}">
    </div>

    <fieldset class="border rounded-3 p-1">
        <legend class="float-none w-auto px-3" style="font-size: 14px;">RESUMEN DE EXPEDIENTES</legend>
        <div class="mb-3 row">
            <label for="" class="form-label col-sm-2">En tramite a inicio de mes:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="inicio_mes" value="{{ old('inicio_mes') }}">
            </div>
            
            <label for="" class="form-label col-sm-2">Ingresados en el Periodo:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="ingresados" value="{{ old('ingresados') }}">
            </div>

            <label for="" class="form-label col-sm-2">Reactivados en el Periodo:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="reactivados" value="{{ old('reactivados') }}">
            </div>

            <label for="" class="form-label col-sm-2">Conversion en el Periodo:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="convertidos" name="convertidos" value="{{ old('convertidos') }}">
            </div>
        </div>

        <div class="mb-3 row">
            
            <label for="" class="form-label col-sm-2">Resueltos en el Periodo:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="resueltos" value="{{ old('resueltos') }}">
            </div>

            <label for="" class="form-label col-sm-2">En tramite a final de mes:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="final_mes" value="{{ old('final_mes') }}">
            </div>

            <label for="" class="form-label col-sm-2">Inactivos al Inicio:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="inactivos_inicio" value="{{ old('inactivos_inicio') }}">
            </div>

            <label for="" class="form-label col-sm-2">Inactivos al Final:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="inactivos_final" value="{{ old('inactivos_final') }}">
            </div>

        </div>
    </fieldset>

    <br>

    <fieldset class="border rounded-3 p-1">
        <legend class="float-none w-auto px-3" style="font-size: 14px;">ACTUACIONES PROCESALES</legend>
        <div class="mb-3 row">
        
        <label for="" class="form-label col-sm-2">Pendientes al Inicio:</label>
        <div class="col-sm-1">
            <input type="number" class="form-control" id="" name="pendientes_inicio" value="{{ old('pendientes_inicio') }}">
        </div>

        <label for="" class="form-label col-sm-2">Recibidas en el Periodo:</label>
        <div class="col-sm-1">
            <input type="number" class="form-control" id="" name="recibidas_periodo" value="{{ old('recibidas_periodo') }}">
        </div>

        <label for="" class="form-label col-sm-2">Realizadas en el Periodo:</label>
        <div class="col-sm-1">
            <input type="number" class="form-control" id="" name="realizadas_periodo" value="{{ old('realizadas_periodo') }}">
        </div>

        <label for="" class="form-label col-sm-2">Pendientes al Final:</label>
        <div class="col-sm-1">
            <input type="number" class="form-control" id="" name="pendientes_final" value="{{ old('pendientes_final') }}">
        </div>

    </div>
    </fieldset>
    
    <br>

    <div class="mb-3 row">
        <label for="fecha_recepcion" class="form-label col-sm-2">Fecha de Recepción:</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="fecha_recepcion" name="fecha_recepcion" value="{{ old('fecha_recepcion') }}">
        </div>
        <div class="col-sm-3 mt-1">
            <div class="form-check form-switch" style="margin-left: 30px;">
                <input type="checkbox" class="form-check-input" name="en_tiempo" id="en_tiempo" checked value="EN TIEMPO">
                <label class="form-check-label" for="en_tiempo">En tiempo</label>
            </div>
        </div>
        <div class="col-sm-3">
        <input type="submit" class="btn btn-success col-sm-12" value="Enviar"> 
        </div>
    </div>
    
    </form>
</div>