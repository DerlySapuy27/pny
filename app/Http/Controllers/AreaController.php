<?php

namespace App\Http\Controllers;
use App\Models\Area; 
use App\Models\Department; 
use Illuminate\Http\Request;

class AreaController extends Controller
{

    public function index() {
        $areas = Area::with('department')->get();
        $departments = Department::all();
        return view('area.index', compact('areas', 'departments'));}

        
    public function creararea(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id', // Asegura que el departamento exista
        // Puedes agregar más validaciones según tus requisitos
    ]);

    Area::create([
        'name' => $request->name,
        'department_id' => $request->department_id,
        // Asegúrate de incluir cualquier otro campo necesario
    ]);

    return redirect()->route('area.index')->with('success', 'Área creada exitosamente.');
}



    public function update(Area $area, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            // Puedes agregar más validaciones según tus requisitos
        ]);
    
        $area->update([
            'name' => $request->name,
            // Asegúrate de incluir cualquier otro campo necesario
        ]);
    
        return redirect()->route('area.index')->with('success', 'Área actualizada exitosamente.');
    }

    public function delete(Area $area) {
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Área eliminada exitosamente.');
    }


}
