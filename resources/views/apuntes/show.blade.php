@extends('layouts.app')

@section('content')

{{-- <h1>{{$apunte}}</h1> --}}

<article class="contenido-apunte bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{$apunte->titulo}}</h1>

    <div class="imagen-apunte">
        <img src="/storage/{{$apunte->imagen}}" class="w-100">
    </div>
    <div class="apunte-meta mt-3">
        <p>
            <span class="font-weight-bold text-primary">Escrito en:</span>
        <a class="text-dark" href="{{ route('modulos.show', ['moduloApunte' => $apunte->modulo->id ]) }}">
                {{$apunte->modulo->nombre}}
            </a>
            
        </p>

        <p>
            <span class="font-weight-bold text-primary">Autor:</span>
            <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $apunte->autor->id ]) }}">
                {{$apunte->autor->name}}
            
            </a>
        </p>

        <p>
            <span class="font-weight-bold text-primary">Creada el: </span>
            
            @php
                $fecha = $apunte->created_at
            @endphp
            <fecha-apunte fecha="{{$fecha}}"></fecha-apunte>
            {{-- {{$apunte->created_at}} --}}
        </p>
        

        <div class="texto">
            <h2 class="my-3 text-primary">Texto</h2>
            {!! $apunte->texto !!}
        </div>

        <div class="justify-content-center row text-center">
            <like-button
                apunte-id="{{$apunte->id}}"
                like="{{$like}}"
                likes="{{$likes}}"
            ></like-button>
        </div>

    </div>
</article>

@endsection