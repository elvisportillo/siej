@extends('layouts.app')

@section('content')

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Error</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ESTA PAGINA NO EXISTE.
                    <a href="{{route('home')}}" class="btn btn-success">REGRESAR</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection