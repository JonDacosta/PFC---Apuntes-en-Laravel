@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if($perfil->imagen)
                <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="imagen perfil 01">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary">{{$perfil->usuario->name}}</h2>
                <a href="">Biografía</a>
                <div class="biografia mt-5">
                    {!! $perfil->biografia !!}
                </div>


            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Apuntes Creados por: {{ $perfil->usuario->name }}</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if(count($apuntes) > 0)
            @foreach($apuntes as $apunte)
            <div class="col-me-4 mb-4">
                <div class="card">
                    
                    <img src="/storage/{{$apunte->imagen}}" class="card-img-top" alt="imagen apunte">

                    <div class="card-body">
                        <h3>{{$apunte->titulo}}</h3>
                        <a href="{{ route('apuntes.show', ['apunte' => $apunte->id]) }}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">Ver Apunte</a>
                    </div>
                
                </div>
            </div>
            @endforeach
            @else
            <p class="text-center w-100">No hay apuntes todavía...</p>
            @endif

        </div>
        <div class="d-flex justify-content-center">
            {{$apuntes->links()}}
        </div>
    </div>
   @endsection