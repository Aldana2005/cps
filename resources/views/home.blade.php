@extends('layouts.master')

@section('content')
<div class="container">
    <div class="position-relative overflow-hidden p-2 p-md-0 m-md-0 text-center bg-body-tertiary">
        <div class="col-md-6 p-lg-4 mx-auto mt-0 mb-0">
            <h1 class="display-3 fw-bold">Bienvenidos Contratistas</h1>
            <h3 class="fw-normal text-muted mb-2">Selecciona tu dependencia para hacer la consulta</h3>
            <div class="d-flex gap-3 justify-content-center lead fw-normal"></div>
        </div>
    </div>

    <div class="row mt-4">
        @foreach($dependences as $dependencia)
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card" style="background-color: {{ $dependencia->color }}; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon mr-3" style="font-size: 2rem;">
                        <i class="nav-icon {{ $dependencia->icono }}"></i>
                    </div>
                    <div class="text">
                        <h3 class="mb-1" style="font-size: 1.5rem; font-weight: bold;">{{ $dependencia->contratistas_count }}</h3>
                        <p class="mb-1" style="font-size: 1.2rem; font-weight: bold;">{{ $dependencia->nombre }}</p>
                        <p class="mb-0" style="font-size: 1rem;">Número de contratistas: {{ $dependencia->contractors_count }}</p>
                    </div>
                </div>
                <a href="{{ route('consultar.contratistas', ['id' => $dependencia->id]) }}" class="small-box-footer" style="background: none; border: none; color: #007bff; font-weight: bold; text-decoration: none; padding: 10px 0;">
                    Consulte <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
