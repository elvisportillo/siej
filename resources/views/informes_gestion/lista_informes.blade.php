@include("layouts.app")

<div class="col-sm-11" style="margin: auto;">
      

    <div class="row">
    
        <form id="form" method="post" action="{{route('buscar-informes')}}" class="row g-3">
            @csrf
            <div class="col-lg-4">
                <label for="">Nombre</label>
                <input type="text" class="form-control" id="txt-buscar" placeholder="Digite nombre de persona y presione Enter" name="buscar_informes">
            </div>

            <div class="col-lg-2">
                <label for="">Busqueda de</label>
                <select class="form-select" id="tipo_busqueda" name="tipo_busqueda">
                    <option value='funcionarios'>Funcionarios</option>
                    <option value="sedes">Sede Judicial</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label for="">Mes Inicio</label>
                <select class="form-select" id="mes_inicio" name="mes_inicio">
                    @foreach (meses() as $mes)
                        <option value="{{ $mes }}">{{ $mes }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label for="">Mes Final</label>
                <select class="form-select" id="mes_final" name="mes_final">
                    @foreach (meses() as $mes)
                        <option value="{{ $mes }}">{{ $mes }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-lg-1">
                <label for="">&nbsp;</label>
                <input type="submit" class="form-control btn btn-success" value="Buscar">
            </div>
        </form> 
    </div>
    
    <div class='form-group col-md-6'>
    
    </div>
</div>

<div class="col-sm-11" style="margin:auto;">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>SEDE JUDICIAL</th>
                <th>FUNCIONARIO</th>
                <th>NOMBRAMIENTO</th>
                <th>MES EVALUADO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        @foreach($informes as $informe => $valor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $valor->nombre_sede }}</td>
                <td>{{ $valor->nombres }} {{ $valor->apellidos }}</td>
                <td>{{ $valor->nombramiento }}</td>
                <td>{{ $valor->mes_evaluado }}</td>
                <td> <a href="{{url('cargar', [$valor->id_tribunal, $valor->id_funcionario, $valor->mes_evaluado])}}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></a> </td>
                
            </tr>
        @endforeach
    </table>
</div>