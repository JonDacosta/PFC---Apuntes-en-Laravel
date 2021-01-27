<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/storage/{{ $apunte->imagen }}" alt="imagen apunte">
        <div class="card-body">
            <h3 class="card-title">{{ $apunte->titulo}}</h3>

            <div class="meta-apunte d-flex justify-content-between">
                @php
                    $fecha = $apunte->created_at
                @endphp
                <p class="text-primary fecha font-weight-bold">
                    <fecha-apunte fecha="{{$fecha}}"></fecha-apunte>
                </p>

                <p class="">A {{ count ( $apunte->likes ) }} les Gustó</p>
            </div>

            
            <p> {{ Str::words( strip_tags( $apunte->texto ), 20, ' ...') }}</p>

            <a href="{{ route('apuntes.show', ['apunte' => $apunte->id])}}" class="btn btn-primary d-block btn-apunte">Ver Apunte</a>
           
        </div>
    </div>
</div>