<?php

namespace App\Http\Controllers;

use App\Models\Dependence;
use Illuminate\Http\Request;

class DependencyController extends Controller
{
    public function dependency()
    {
        $title = 'Dependencias';
        $title2 = 'Agregar Dependencia';
        $title3 = 'Editar Dependencia';
        $dependence = Dependence::all();
        return view('dependencies.dependency', compact('title', 'title2', 'title3', 'dependence'));
    }

    //Agregar dependencias
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Dependence::create([
            'nombre' => $request->name,
            'descripcion' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Dependencia registrada correctamente.');

    }

    // Editar dependencias
    public function update(Request $request, $id){
        $request->validate([
            'edit_name' => 'required',
            'edit_description' => 'required',

        ]);
        $dependence = Dependence::findOrFail($id);
        $dependence->nombre = $request->edit_name;
        $dependence->descripcion = $request->edit_description;
        $dependence->save();
        return redirect()->back()->with('success', 'Dependencia actualizada correctamente.');
    }

    public function destroy($id)
    {
        // Encuentra la dependencia por su ID
        $dependencia = Dependence::findOrFail($id);

        // Elimina la dependencia
        $dependencia->delete();

        // Redirige o devuelve una respuesta apropiada
        return redirect()->route('cps.admin.dependency')->with('success', 'Dependencia eliminada correctamente.');
    }






}
