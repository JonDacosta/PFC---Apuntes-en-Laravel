@extends('layouts.app')



@section('botones')
    @include('ui.navegacion')
@endsection
{{-- section enlazado con /layouts.app --}}
@section ('content')

<h2 class="text-center mb-5">Administra tus apuntes</h2>

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="col">Título</th>
                <th scole="col">Módulo</th>
                <th scole="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach($apuntes as $apunte)
                
            <tr>
                <td>{{$apunte->titulo}}</td>
                <td>{{$apunte->modulo->nombre}}</td>
                <td>
                   <eliminar-apunte
                       apunte-id={{$apunte->id}}>
                   </eliminar-apunte>
                    <a href="{{ Route ('apuntes.edit', ['apunte' => $apunte->id]) }}" class="btn btn-dark d-block mb-2 ">Editar</a>
                    <a href="{{ Route ('apuntes.show', ['apunte' => $apunte->id]) }}" class="btn btn-success d-block ">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 mt-4 justify-content-center d-flex">
        {{ $apuntes->links()}}
    </div>


    <h2 class="text-center my-5">Apuntes que te gustan</h2>
    <div class="col-md-10 mx-auto bg-white p-3">

        @if (count( $usuario->meGusta ) > 0 )
            <ul class="list-groups">
                @foreach($usuario->meGusta as $apunte)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{$apunte->titulo}}</p>
                    <a class="btn btn-outline-success text-uppercase" href="{{ route('apuntes.show', ['apunte' => $apunte->id ]) }}">Ver</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center">Todavía no tienes apuntes guardados 
                <small>Dale me gista a los apuntes y aparecerán aquí</small>
            </p>
        @endif
    </div>
</div>

@endsection

