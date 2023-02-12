@include("layouts.app")

<p class="col-sm-8" style=" margin: auto; margin-top: 30px;">Para ingresar la información de la sede judicial, de click en el icono <i class="fa-solid fa-pen-to-square"></i> </p>
<div class="col-sm-8 d-flex justify-content-center" style=" margin: auto; margin-top: 30px;">
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>FUNCIONARIO</th>
                <th>SEDE JUDICIAL</th>
                <th>MES</th>
            </tr> 
            </thead>
            <tr>
                <td>{{ $datos->nombres }} {{ $datos->apellidos }}</td>
                <td>{{ $datos->nombre_sede }}</td>
                <td>{{ $datos->mes_evaluado }}</td>
                <td> <a href="{{url('cargar', [$datos->id_tribunal, $datos->id_funcionario, $datos->mes_evaluado])}}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></a> </td>
            </tr>
        
        </table>
    </div>
    
</div>