@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-pink disabled color-palette">{{ $title }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="#" class="btn btn-success btn-sm" id="btn-open-modal" data-toggle="modal" data-target="#addModal">
                            <i class="nav-icon fas fa-plus">Agregar Contratista</i>
                        </a>
                    </div>

                    <table id="example1" class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none">id</th>
                                <th>Nombre</th>
                                <th>Tipo de documento</th>
                                <th>Fecha de expedicion</th>
                                <th>Numero de documento</th>
                                <th>Tipo de Contrato</th>
                                <th>Dependencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($contractors as $index => $contratista)

                                <tr>
                                    <td>{{ $index + 1 }}</td> <!-- Mostrar número secuencial -->
                                    <td class="d-none">{{ $contratista->id }}</td> <!-- Ocultar el Id -->
                                    <td>{{ $contratista->nombres }}</td>
                                    <td>{{ $contratista->tipo_documento }}</td>
                                    <td>{{ $contratista->fecha_expedicion_cedula }}</td>
                                    <td>{{ $contratista->numero_cedula }}</td>
                                    <td>{{ $contratista->tipo_contrato }}</td>
                                    <td>{{ $contratista->dependence->nombre }}</td>
                                    <td>

                                    <a href="#" class="btn btn-info btn-sm btn-open-edit-modal" data-toggle="modal" data-target="#editModal"
                                        data-id="{{ $contratista->id }}"
                                        data-name="{{ $contratista->nombres }}"
                                        data-document-type="{{ $contratista->tipo_documento }}"
                                        data-issue-date="{{ $contratista->fecha_expedicion_cedula }}"
                                        data-document-number="{{ $contratista->numero_cedula }}"
                                        data-contract-type="{{ $contratista->tipo_contrato }}"
                                        data-department="{{ $contratista->dependence->nombre }}">
                                         <i class="nav-icon fas fa-edit"></i>
                                     </a>
                                        <a href="#" class="btn btn-danger btn-sm" id="delete">
                                            <i class="nav-icon fas fa-trash-alt"></i>
                                        </a>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-pink disabled color-palette">
                <h5 class="modal-title" id="addModalLabel">{{ $title2 }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST" action="{{ route('cps.admin.contractor.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_type"><i class="fas fa-id-card"></i> Tipo de documento</label>
                                <select class="form-control" id="document_type" name="document_type" required>
                                    <option value="">Seleccione tipo documento</option>
                                    @foreach ($documentTypes as $documentType)
                                        <option value="{{ $documentType }}">{{ $documentType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_number"><i class="fas fa-id-card-alt"></i> Numero de documento</label>
                                <input type="text" class="form-control" id="document_number" name="document_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="issue_date"><i class="fas fa-calendar-alt"></i> Fecha de expedicion</label>
                                <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contract_type"><i class="fas fa-file-contract"></i> Tipo de Contrato</label>
                                <select class="form-control" id="contract_type" name="contract_type" required>
                                    <option value="">Seleccione tipo Contrato</option>
                                    @foreach ($contractTypes as $contractType)
                                        <option value="{{ $contractType }}">{{ $contractType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department"><i class="fas fa-building"></i> Dependencia</label>
                                <select class="form-control" id="department" name="department" required>
                                    <option value="">Seleccione la secretaria</option>
                                    @foreach ($namedependence as $dependence)
                                        <option value="{{ $dependence->id }}">{{ $dependence->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pdf"><i class="fas fa-file-pdf"></i> Archivo PDF</label>
                                <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-pink disabled color-palette">
                <h5 class="modal-title" id="editModalLabel">{{ $title3 }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="edit_id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name"><i class="fas fa-user"></i> Nombre</label>
                                <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_document_type"><i class="fas fa-id-card"></i> Tipo de documento</label>
                                <select class="form-control" id="edit_document_type" name="edit_document_type" required>
                                    <option value="">Seleccione tipo documento</option>
                                    @foreach ($documentTypes as $documentType)
                                        <option value="{{ $documentType }}">{{ $documentType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_document_number"><i class="fas fa-id-card-alt"></i> Numero de documento</label>
                                <input type="text" class="form-control" id="edit_document_number" name="edit_document_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_issue_date"><i class="fas fa-calendar-alt"></i> Fecha de expedicion</label>
                                <input type="date" class="form-control" id="edit_issue_date" name="edit_issue_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_contract_type"><i class="fas fa-file-contract"></i> Tipo de Contrato</label>
                                <select class="form-control" id="edit_contract_type" name="edit_contract_type" required>
                                    <option value="">Seleccione tipo Contrato</option>
                                    @foreach ($contractTypes as $contractType)
                                        <option value="{{ $contractType }}">{{ $contractType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_department"><i class="fas fa-building"></i> Dependencia</label>
                                <select class="form-control" id="edit_department" name="edit_department" required>
                                    <option value="">Seleccione la secretaria</option>
                                    @foreach ($namedependence as $dependence)
                                        <option value="{{ $dependence->id }}">{{ $dependence->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_pdf"><i class="fas fa-file-pdf"></i> Archivo PDF</label>
                                <input type="file" class="form-control" id="edit_pdf" name="edit_pdf" accept="application/pdf">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.btn-open-edit-modal').on('click', function() {
            let button = $(this);
            let modal = $('#editModal');

            // Establecer el ID del contratista
            let contractorId = button.data('id');
            modal.find('#edit_id').val(contractorId);

            // Establecer la acción del formulario
            let updateUrl = '{{ route("cps.admin.contractor.update", ["id" => ":id"]) }}';
            updateUrl = updateUrl.replace(':id', contractorId);
            modal.find('#editForm').attr('action', updateUrl);

            // Establecer los valores de los campos
            modal.find('#edit_name').val(button.data('name'));
            modal.find('#edit_document_type').val(button.data('document-type'));
            modal.find('#edit_document_number').val(button.data('document-number'));
            modal.find('#edit_issue_date').val(button.data('issue-date'));
            modal.find('#edit_contract_type').val(button.data('contract-type'));

            // Asegúrate de que el valor de 'department' sea el id de la dependencia
            let departmentId = button.data('department-id'); // Ajusta este nombre si es necesario
            modal.find('#edit_department').val(departmentId);

            modal.modal('show');
        });
    });
</script>
@endsection
