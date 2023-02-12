@extends('layouts.app')

@section('content')
@if($errors->any())
<div class='alert alert-dark alert-dismissible fade show' role='alert'>
    <strong>Revise los campos</strong>
    @foreach ($errors->all() as $error)
    <span class="badge badge-danger">{{ $error }}</span>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<section class="section">
<div style="padding: 10px; margin: 5px; font-size:12px;">
  
  
  <div class="row">
    <div class="col-lg-6 offset-md-3">
        <h3 class="">Actualizar Rol</h3>
    </div>
</div>
<div class="" style="padding:5px;">

<div class="col-lg-6 offset-md-3">
    <div class="card">
        <div class="card-body">

            <form action="{{ route('roles.update', $role->id) }}" method="post" style="font-size:16px;">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="row g-2">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                        </div>
                    </div>

                    <div class="g-2">
                        <div class="form-group">
                            <label for="name">Descripcion</label>
                            <input type="text" class="form-control" name="description" value="{{ $role->description }}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md12">
                        <div class="form-group">
                            <label for="name">Permisos para este Rol:</label>
                            @foreach($permission as $value)
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="{{$value->id}}" name="permission[]" value="{{ $value->id }}" <?php echo in_array($value->id, $rolePermissions) ? "checked" : "" ?>>
                                <label class="form-check-label" for="{{$value->id}}">{{ $value->name }}</label>
                            </div>
                            @endforeach
                                
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md12">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                </div>
            </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection