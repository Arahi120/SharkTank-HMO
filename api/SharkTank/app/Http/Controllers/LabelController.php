<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    // Mostrar todos los labels
    public function index()
    {
        $labels = Label::paginate(10);  // Cambia a la cantidad de elementos que prefieras por página
        return view('admin.label.index', compact('labels'));
    }

    // Mostrar el formulario para crear un nuevo label
    public function create()
    {
        return view('admin.label.create');
    }

    // Almacenar un nuevo label
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:3|max:255',
        ]);

        $label = Label::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return redirect()->route('label.index')->with('success', 'Label creado correctamente');
    }

    // Mostrar el formulario para editar un label
    public function edit($id)
    {
        $label = Label::findOrFail($id);
        return view('admin.label.edit', compact('label'));
    }

    // Actualizar un label
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:3|max:255',
        ]);

        $label = Label::findOrFail($id);
        $label->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return redirect()->route('label.index')->with('success', 'Label actualizado correctamente');
    }

    // Eliminar un label
    public function destroy($id)
    {
        $label = Label::findOrFail($id);
        $label->delete();

        return redirect()->route('label.index')->with('success', 'Label eliminado correctamente');
    }
}
