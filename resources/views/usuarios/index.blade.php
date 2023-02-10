@extends('layouts.app')

@section('content')
<section class="section">
<div style="padding: 10px; margin: 5px; font-size:12px;">
  
  
  <div class="row">
    <div class="col-md-3">
        <h3 class="">Usuarios</h3>
    </div>

    <div class="col-md-9">
        <a class='btn btn-success' href=" {{ route('usuarios.create') }} ">Crear</a>
    </div>

</div>

<div class="" style="padding:5px;">

<form method="POST" action="{{route('subir')}}" accept-charset="UTF-8" enctype="multipart/form-data">
  {{ csrf_field() }}
  <label for="archivo"><b>Archivo: </b></label><br>
  <input type="file" name="archivo" required>
  <input class="btn btn-success" type="submit" value="Enviar" >
</form>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
                <table class='table table-striped' style="font-size:16px;">
                    <thead>
                        <th>NOMBRE</th>
                        <th>CORREO</th>
                        <th>ROL</th>
                        <th>ACCIONES</th>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td> {{ $usuario->name }} </td>
                            <td> {{ $usuario->email }}</td>
                            <td>
                                @if(!empty($usuario->getRoleNames()))
                                    @foreach($usuario->getRoleNames() as $rolName)
                                        <h5><span class='badge bg-primary'> {{ $rolName }} </span></h5>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                            <a href=" {{ route('usuarios.edit', $usuario->id) }} "class="btn btn-outline-primary editbtn btn-sm"><i class="fa fa-edit"></i></a>\
                                <form action=" {{ route('usuarios.destroy', $usuario->id)}} " method="post" style='display:inline;'>
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' style='display:inline;' class='btn btn-outline-danger btn-sm'>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class='pagination justify-content-end'>
                    {!! $usuarios->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="container"></div>
</section>

<script>

Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Browser market shares in May, 2020',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Chrome',
            y: 70.67,
            sliced: true,
            selected: true
        }, {
            name: 'Edge',
            y: 14.77
        },  {
            name: 'Firefox',
            y: 4.86
        }, {
            name: 'Safari',
            y: 2.63
        }, {
            name: 'Internet Explorer',
            y: 1.53
        },  {
            name: 'Opera',
            y: 1.40
        }, {
            name: 'Sogou Explorer',
            y: 0.84
        }, {
            name: 'QQ',
            y: 0.51
        }, {
            name: 'Other',
            y: 2.6
        }]
    }]
});

</script>
@endsection

