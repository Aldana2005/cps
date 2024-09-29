<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Dependence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractorController extends Controller
{
    public function contractor()
    {
        $title = 'Contratistas';
        $title2 = 'Agregar Contratista';
        $title3 = 'Editar Informacion del Contratista';
        $contractTypes = ['Prestacion de servicios profesionales', 'Prestacion de servicios de apoyo en la gestion'];
        $documentTypes = ['Cedula de ciudadania', 'Tarjeta de identidad', 'Cedula de extranjeria'];
        $namedependence = Dependence::all();
        $contractors = Contractor::all();
        return view('contractors.contractors', compact('title', 'title2', 'title3', 'contractTypes', 'documentTypes', 'namedependence', 'contractors'));
    }

    public function store(Request $request)
    {
            // Validación
            $request->validate([
                'name' => 'required|string|max:255',
                'document_type' => 'required|string',
                'document_number' => 'required|string|max:255',
                'issue_date' => 'required|date',
                'contract_type' => 'required|string',
                'department' => 'required|exists:dependences,id',
                'pdf' => 'required|file|mimes:pdf|max:2048', // Ajusta el tamaño máximo según sea necesario
            ]);

            // Guardar el archivo PDF
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');

            // Crear un nuevo contratista
            $contractor = new Contractor;
            $contractor->nombres = $request->name;
            $contractor->tipo_documento = $request->document_type;
            $contractor->numero_cedula = $request->document_number;
            $contractor->fecha_expedicion_cedula = $request->issue_date;
            $contractor->tipo_contrato = $request->contract_type;
            $contractor->dependence_id = $request->department;
            $contractor->archivo_pdf = $pdfPath;

            $contractor->save();

        return redirect()->back()->with('success', 'Contratista agregado exitosamente');
    }
    public function edit($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractTypes = ['Prestacion de servicios profesionales', 'Prestacion de servicios de apoyo en la gestion'];
        $documentTypes = ['Cedula de ciudadania', 'Tarjeta de identidad', 'Cedula de extranjeria'];
        $namedependence = Dependence::all();

        return view('contractors.contractors', compact('contractor', 'contractTypes', 'documentTypes', 'namedependence'));
    }
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'edit_name' => 'required|string|max:255',
            'edit_document_type' => 'required|string',
            'edit_document_number' => 'required|string|max:255',
            'edit_issue_date' => 'required|date',
            'edit_contract_type' => 'required|string',
            'edit_department' => 'required|exists:dependences,id',
            'edit_pdf' => 'nullable|file|mimes:pdf|max:2048', // El archivo PDF es opcional en la edición
        ]);

        // Buscar el contratista
        $contractor = Contractor::findOrFail($id);

        // Actualizar los datos del contratista
        $contractor->nombres = $request->input('edit_name');
        $contractor->tipo_documento = $request->input('edit_document_type');
        $contractor->numero_cedula = $request->input('edit_document_number');
        $contractor->fecha_expedicion_cedula = $request->input('edit_issue_date');
        $contractor->tipo_contrato = $request->input('edit_contract_type');
        $contractor->dependence_id = $request->input('edit_department');

        // Actualizar el archivo PDF si se sube uno nuevo
        if ($request->hasFile('edit_pdf')) {
            // Eliminar el archivo PDF antiguo
            Storage::disk('public')->delete($contractor->archivo_pdf);

            // Guardar el nuevo archivo PDF
            $pdfPath = $request->file('edit_pdf')->store('pdfs', 'public');
            $contractor->archivo_pdf = $pdfPath;
        }

        // Guardar los cambios
        $contractor->save();

        return redirect()->back()->with('success', 'Contratista actualizado exitosamente');
    }

}

