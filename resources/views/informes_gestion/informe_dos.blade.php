@include("layouts.app")

@include("informes_gestion.modals.buscar-judicatura-modal")
@include("informes_gestion.modals.buscar-funcionario-modal")

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
     
    @include("informes_gestion.informacion_general")
    
    <br>

    <fieldset class="border rounded-3 p-1">
        <legend class="float-none w-auto px-3" style="font-size: 14px;">RESUMEN DE EXPEDIENTES</legend>
        <div class="mb-3 row">
            <label for="" class="form-label col-sm-3">En tramite a inicio de mes:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="inicio_mes" value="{{ old('inicio_mes') }}">
            </div>
            
            <label for="" class="form-label col-sm-3">Ingresados en el Periodo:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="ingresados" value="{{ old('ingresados') }}">
            </div>

            <label for="" class="form-label col-sm-3">Reactivados en el Periodo:</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="" name="reactivados" value="{{ old('reactivados') }}">
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
</script>