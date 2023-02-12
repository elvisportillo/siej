@extends('layouts.app')

@section('content')
@if($errors->any())
<div class='alert alert-danger' role='alert'>
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
        <h3>Actualizacion de Usuario</h3>
    </div>

</div>

<div class="" style="padding:5px;">

    <div class="col-lg-6 offset-md-3">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('usuarios.update', $user->id) }}" method="post" style='font-size: 16px;'>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Confirmar Password</label>
                                <input type="password" class="form-control" name="confirm-password">
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Roles</label>
                                <select name="roles[]" id="" class="form-select">
                                    @foreach($roles as $rol)
                                    <option value="{{$rol}}">{{$rol}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="g-3">
                            <button type="submit" class="col-md-4 offset-4 btn btn-primary">Guardar</button>
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