@extends('layouts.app')

@section('content')

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">SISTEMA UNIDAD TECNICA DE EVALUACION DEL CONSEJO NACIONAL DE LA JUDICATURA</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido: <b>{{auth()->user()->name }}</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
