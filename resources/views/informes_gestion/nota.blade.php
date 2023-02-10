@include("layouts.app")
<div class="col-sm-8 d-flex justify-content-center" style=" margin: auto; margin-top: 60px;">
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
            <td>{{ $datos->nombre_judicatura }}</td>
            <td>{{ $datos->mes_evaluado }}</td>
            <td> <a href="{{url('cargar', [$datos->id_tribunal, $datos->id_funcionario, $datos->mes_evaluado])}}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></a> </td>
        </tr>
    
    </table>
</div>