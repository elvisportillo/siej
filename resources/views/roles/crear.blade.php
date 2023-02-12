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
        <h3 class="">Crear Rol</h3>
    </div>
</div>
<div class="" style="padding:5px;">

<div class="col-lg-6 offset-md-3">
    <div class="card">
        <div class="card-body">

                            <form action="{{ route('roles.store') }}" method="post" style="font-size:16px;">
                                @csrf
                                <div class="row">
                    <div class="row g-2">
                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>

                                    <div class="g-2">
                        <div class="form-group">
                                            <label for="name">Descripcion</label>
                                            <input type="text" class="form-control" name="description">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md12">
                                        <div class="form-group">
                                            <label for="">Nombre del Rol</label>
                                            @foreach($permisos as $value)
                                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="{{$value->id}}" name="permission[]" value="{{ $value->id }}">
                                <label class="form-check-label" for="{{$value->id}}">{{ $value->name }}</label>
                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
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