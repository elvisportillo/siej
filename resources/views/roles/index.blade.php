@extends('layouts.app')

@section('content')
<section class="section">
<div style="padding: 10px; margin: 5px; font-size:12px;">
  
  
  <div class="row">
    <div class="col-md-3">
        <h3 class="">Roles de Usuario</h3>
    </div>
    @can('crear-rol')
    <div class="col-md-9">
        <a class='btn btn-success' href=" {{ route('roles.create') }} ">Crear Nuevo Rol</a>
    </div>
    @endcan

</div>

<div class="" style="padding:5px;">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                            <table class='table table-striped'  style="font-size:16px;">
                                <thead>
                                    <th>ID</th>
                                    <th>Rol</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($roles as $rol)
                                        <tr>
                                            <td>{{ $rol->id }} </td>
                                            <td> {{ $rol->name }} </td>
                                            <td> {{ $rol->description }} </td>
                                            <td>
                                                @can('editar-rol')
                                                <a href=" {{ route('roles.edit', $rol->id) }} "class="btn btn-outline-primary editbtn btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan

                                                @can('borrar-rol')
                                                <form action=" {{ route('roles.destroy', $rol->id)}} " method="post" style='display:inline;'>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type='submit' style='display:inline;' class='btn btn-outline-danger btn-sm'>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class='pagination justify-content-end'>
                                {!! $roles->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

