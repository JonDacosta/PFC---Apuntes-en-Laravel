@extends('layouts.app')


@section('botones')
    <a href="{{ route('apuntes.index')}}" class="btn btn-outline-primary text-uppercase font-weight-bold mr-2">
        <svg class="icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Volver
        </a>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
@endsection


@section ('content')

    <h1 class="text-center">Editar mi perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form 
                action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                {{-- Editar Nombre --}}

                <div class="form-group">
                    <label for="nombre">Nombre</label>

                    <input type="text"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        placeholder="Tu Nombre"
                        value="{{ $perfil->usuario->name }}"
                        >
                    
                    @error('nombre')
                        <span class="invalid-feedback d-block alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>    
                        </span>               
                    @enderror
                </div>

                {{-- Editar Biografía --}}
                
                <div class="form-group mt-3">
                    <label for="biografia">Biografía</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}">
                    <trix-editor
                        class="form-control @error('biografia') is-invalid @enderror"
                        input="biografia">
                    </trix-editor>
                
                    @error('biografia')
                        <span class="invalid-feedback d-block alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>    
                        </span>               
                    @enderror
                </div>

                {{-- Editar Imagen --}}

                <div class="form-group mt-3">
                    <label for="etiquetas">Tu Imagen</label>
                    <input 
                        id="imagen"
                        type="file"
                        name="imagen"
                        class="form-control @error ('imagen') is-invalid @enderror"
                    >
                    @if($perfil->imagen)
                    <div class="mt-4">
                        <p>Imagen Actual:</p>

                        <img src="/storage/{{$perfil->imagen}}" alt="" style="width: 30rem">
                    </div>

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                             <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    @endif
                </div>   
                
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection