@extends('layouts.app')


@section('botones')
    <a href="{{ route('apuntes.index')}}" class="btn btn-outline-primary text-uppercase font-weight-bold mr-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Volver
    </a>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection
{{-- section enlazado con /layouts.app --}}
@section ('content')

<h2 class="text-center mb-5">Editar apunte {{$apunte->titulo}}</h2>

    
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('apuntes.update', ['apunte' => $apunte->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Título Apunte</label>

                    <input type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titulo"
                        placeholder="Título Apunte"
                        value="{{$apunte->titulo}}">
                    
                    @error('titulo')
                        <span class="invalid-feedback d-block alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>    
                        </span>               
                    @enderror

                </div>

                <div class="form-group">
                    <label for="modulo">Módulos</label>
                    <select 
                        name="modulo" 
                        class="form-control @error('modulo') is-invalid @enderror"
                        id="modulo"
                        >
                        <option value="">--Seleccione--</option>
                            @foreach($modulos as $modulo)
                                <option value="{{ $modulo->id }}" 
                                {{ $apunte->modulo_id == $modulo->id ? 'selected' : '' }}
                                > {{$modulo->nombre}} </option>
                            @endforeach
                    </select>
                    @error('modulo')
                        <span class="invalid-feedback d-block alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>    
                        </span> 
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="notas">Notas</label>
                    <input id="notas" type="hidden" name="notas" value="{{ $apunte->notas }}">
                    <trix-editor
                        class="form-control @error('notas') is-invalid @enderror"
                        input="notas">
                    </trix-editor>
                
                    @error('notas')
                        <span class="invalid-feedback d-block alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>    
                        </span>               
                    @enderror
                </div>
                {{-- <div class="form-group mt-3">
                    <label for="etiquetas">Etiquetas</label>
                    <input id="etiquetas" type="hidden" name="etiquetas" value="{{ old('etiquetas') }}">
                    <trix-editor input="etiquetas"></trix-editor>
                </div> --}}

                <div class="form-group mt-3">
                    <label for="etiquetas">Elige la imagen</label>
                    <input 
                        id="imagen"
                        type="file"
                        name="imagen"
                        class="form-control @error ('imagen') is-invalid @enderror"
                    >

                    <div class="mt-4">
                        <p>Imagen Actual:</p>

                        <img src="/storage/{{$apunte->imagen}}" alt="" style="width: 30rem">
                    </div>

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                             <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>    

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Apunte">
                </div>

            </form>
        </div>
    </div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection