@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="section col-md-8 offset-2">
<div style="padding: 10px; margin: 5px; font-size:12px;">
    
  <div class="row">
    <div class="col-lg-6 offset-md-3">
        <h3>Cambiar Contrasena</h3>
    </div>

</div>

<div class="" style="padding:5px;">

    <div class="col-lg-6 offset-md-3">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('change_password') }}" method="post" style='font-size: 16px;'>
                    @csrf
                    <div class="row">

                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Nuevo Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="form-group">
                                <label for="name">Confirmar Nuevo Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
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