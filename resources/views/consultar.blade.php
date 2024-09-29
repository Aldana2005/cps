@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-center align-items-start min-vh-100 pt-5">
    <div class="card shadow-lg" style="width: 28rem;">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Consulta Contratistas</h2>
        </div>
        <div class="card-body">
            <form id="consultForm" method="POST" action="{{ route('cps.contratista.consulta') }}">
                @csrf
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required placeholder="Ingrese el número de cédula">
                </div>
                <div class="mb-3">
                    <label for="fecha_expedicion" class="form-label">Fecha de Expedición</label>
                    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required>
                </div>
                <!-- Verificación de dependencia -->
                @if(isset($dependencia) && is_object($dependencia))
                    <input type="hidden" id="dependencia_id" name="dependencia_id" value="{{ $dependencia->id }}">
                    <input type="hidden" id="dependencia_nombre" name="dependencia_nombre" value="{{ $dependencia->nombre }}">
                @else
                    <input type="hidden" id="dependencia_id" name="dependencia_id" value="">
                    <input type="hidden" id="dependencia_nombre" name="dependencia_nombre" value="">
                @endif
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-block">Consultar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Agrega SweetAlert2 -->
@if(isset($noContractors) && $noContractors)
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
@endif
@endsection
