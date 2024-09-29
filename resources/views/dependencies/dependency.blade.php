@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-pink disabled color-palette">{{ $title }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="#" class="btn btn-success" id="btn-open-modal">
                            <i class="fas fa-plus"></i> Agregar Dependencia
                        </a>
                    </div>

                    <table id="example1" class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none">Id</th> <!-- Ocultar el Id -->
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dependence as $index => $dependencia)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Mostrar número secuencial -->
                                <td class="d-none">{{ $dependencia->id }}</td> <!-- Ocultar el Id -->
                                <td>{{ $dependencia->nombre }}</td>
                                <td>{{ $dependencia->descripcion }}</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm btn-open-edit-modal" data-id="{{ $dependencia->id }}" data-name="{{ $dependencia->nombre }}" data-description="{{ $dependencia->descripcion }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form id="deleteForm-{{ $dependencia->id }}" action="{{ route('cps.admin.dependence.destroy', ['id' => $dependencia->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete" onclick="deleteConfirmation(event, '{{ $dependencia->nombre }}', '{{ $dependencia->id }}')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-pink disabled color-palette">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title2 }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('cps.admin.dependencias.store') }}" method="POST">
                    @csrf {{-- Token necesario para seguridad --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-building"></i> Nombre
                        </label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left"></i> Descripción
                        </label>
                        <input type="text" class="form-control" name="description" id="description" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" value="add" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-pink disabled color-palette">
                <h5 class="modal-title" id="editModalLabel">{{ $title3 }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="">
                    @csrf {{-- Token necesario para seguridad --}}
                    @method('PUT') {{-- Método PUT para actualizar --}}

                    <div class="mb-3">
                        <label for="edit_name" class="form-label">
                            <i class="fas fa-building"></i> Nombre
                        </label>
                        <input type="text" class="form-control" name="edit_name" id="edit_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">
                            <i class="fas fa-align-left"></i> Descripción
                        </label>
                        <input type="text" class="form-control" name="edit_description" id="edit_description" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" value="edit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para abrir los modales -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Abrir modal de agregar
        document.getElementById('btn-open-modal').addEventListener('click', function (event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace
            $('#exampleModal').modal('show');
        });

        // Abrir modal de editar
        const editButtons = document.querySelectorAll('.btn-open-edit-modal');
        editButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');

                // Poblar el formulario de editar con los datos del elemento específico
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_description').value = description;

                // Establecer la acción del formulario dinámicamente
                document.getElementById('editForm').action = "{{ route('cps.admin.dependence.update', '') }}/" + id;

                // Mostrar el modal de editar
                $('#editModal').modal('show');
            });
        });
    });

    // Definir la función deleteConfirmation
    function deleteConfirmation(event, name, id) {
        event.preventDefault(); // Prevenir comportamiento predeterminado del botón

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "¿Estás seguro?",
            text: "Estás a punto de eliminar " + name + ". ¿Deseas continuar?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "No, cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formId = `deleteForm-${id}`;
                const form = document.getElementById(formId);
                form.submit();

                swalWithBootstrapButtons.fire({
                    title: "¡Eliminado!",
                    text: "La dependencia " + name + " ha sido eliminada.",
                    icon: "success",
                    showConfirmButton: false
                });

                setTimeout(() => {
                    // Aquí podrías realizar alguna acción adicional si es necesario
                }, 3000);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "La dependencia " + name + " está segura :)",
                    icon: "error"
                });
            }
        });
    }

    $(document).ready(function() {
        $('#example1').DataTable({
            "columnDefs": [
                { "targets": [1], "visible": false, "searchable": false } // Ocultar la columna del Id en DataTable
            ]
        });
    });
</script>

@endsection
