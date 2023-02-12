@include("layouts.app")

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

    <fieldset class="border rounded-3 p-1">
        <legend class="float-none w-auto px-3" style="font-size: 14px;">RESUMEN DE EXPEDIENTES</legend>

        <div class="mb-3 row">
            <label for="" class="form-label col-sm-2">En tramite a inicio de mes:</label>
            <div class="col-sm-1 offset-sm-1">
                <input type="number" class="form-control" id="" name="inicio_mes" value="{{ old('inicio_mes') }}">
            </div>
            
            <label for="" class="form-label col-sm-2">Ingresados en el Periodo:</label>
            <div class="col-sm-1 offset-sm-1">
                <input type="number" class="form-control" id="" name="ingresados" value="{{ old('ingresados') }}">
            </div>

            <label for="" class="form-label col-sm-2">Reactivados en el Periodo:</label>
            <div class="col-sm-1 offset-sm-1">
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

        <hr>

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