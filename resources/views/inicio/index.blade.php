@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />

@endsection

@section('hero')
    <div class="hero-modulos">
        <form class="container h-100" action={{ route('buscar.show') }}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra los apuntes que necesites</p>

                    <input 
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar Apunte"
                    />
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    

    
    <div class="container nuevos-apuntes">
        <h2 class="titulo-modulo text-uppercase mb-4">Últimos Apuntes</h2>
        
        <div class="owl-carousel owl-theme">
            @foreach($nuevos as $nuevo)
            
                <div class="card">
                    <img src="/storage/{{ $nuevo->imagen}} " class="card-img-top" alt="imagen apunte">

                    <div class="card-body">
                        <h3>{{ Str::title( $nuevo->titulo ) }}</h3>

                        <p> {{ Str::words( strip_tags( $nuevo->texto ), 20) }}</p>


                        <a href=" {{ route('apuntes.show', ['apunte' => $nuevo->id])}}"
                           class="btn btn-primary d-block font-weight-bold text-uppercase">
                        Ver Apunte</a>
                    </div>
                </div>
            
            @endforeach
        </div>

    </div>

    <div class="container">
        <h2 class="titulo-modulo text-uppercase mt-5 mb-4">Apuntes más votados</h2>

        <div class="row">
                @foreach($votados as $apunte)
                    @include('ui.apunte')
                @endforeach
        </div>
    </div>

    @foreach($apuntes as $key => $grupo )
        <div class="container">
            <h2 class="titulo-modulo text-uppercase mt-5 mb-4">{{ str_replace ('-', ' ', $key ) }}</h2>

            <div class="row">
                @foreach($grupo as $apuntes)

                    @foreach($apuntes as $apunte)
                        @include('ui.apunte')
                    @endforeach
                
                @endforeach
            </div>
        </div>
    @endforeach
@endsection