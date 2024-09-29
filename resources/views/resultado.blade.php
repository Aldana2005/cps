@extends('layouts.master')

@section('content')
<div class="d-flex flex-wrap justify-content-center align-items-start min-vh-100 pt-0">
    @if($contractors->isEmpty())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Información',
                    text: 'No se encontraron contratistas con los datos proporcionados.',
                });
            });
        </script>
    @else
        @foreach($contractors as $contractor)
        <div class="card" style="background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 24rem; margin: 10px 15px 15px;">
            <div class="card-header" style="background-color: {{ $contractor->dependence->color ?? '#ffffff' }}; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px; text-align: center; position: relative;">
                <h5 class="mb-0">Contratista</h5>
                <!-- Botón de cerrar -->
                <button type="button" class="btn-close" aria-label="Close" style="position: absolute; top: 10px; right: 10px;"></button>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="fas fa-user-tie fa-3x" style="color: {{ $contractor->dependence->color ?? '#000000' }}"></i>
                </div>
                <div class="text-center mb-3">
                    <h6 class="card-title" style="font-weight: bold; margin: 0;">{{ $contractor->nombres }}</h6>
                </div>
                <p class="card-text"><strong>Cédula:</strong> {{ $contractor->numero_cedula }}</p>
                <p class="card-text"><strong>Fecha de Expedición:</strong> {{ $contractor->fecha_expedicion_cedula }}</p>
                <p class="card-text"><strong>Tipo de Contrato:</strong> {{ $contractor->tipo_contrato }}</p>
                <p class="card-text"><strong>Tipo de Documento:</strong> {{ $contractor->tipo_documento }}</p>
                <p class="card-text"><strong>Dependencia:</strong> {{ $contractor->dependence->nombre ?? 'No asignada' }}</p>
                <p class="card-text">
                    <strong>Archivo PDF:</strong>
                    @if($contractor->archivo_pdf)
                        <a href="{{ asset('storage/' . $contractor->archivo_pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-file-pdf"></i> Ver Archivo
                        </a>
                    @else
                        <span class="text-muted">No disponible</span>
                    @endif
                </p>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
