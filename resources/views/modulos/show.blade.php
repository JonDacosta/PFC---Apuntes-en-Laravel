@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="titulo-modulo text-uppercase mt-5 mb-4">
            Módulo: {{ $moduloApunte->nombre }}
        </h2>

        <div class="row">
            @foreach($apuntes as $apunte)
                @include('ui.apunte')
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">    
            {{ $apuntes->links() }}
        </div>
    </div>
@endsection