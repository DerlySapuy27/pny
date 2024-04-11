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
    ]);

    return redirect()->route('area.index')->with('success', 'Área creada exitosamente.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id',
    ]);

    $area = Area::findOrFail($id);
    $area->update([
        'name' => $request->name,
        'department_id' => $request->department_id,
    ]);

    return redirect()->route('area.index')->with('success', 'Área actualizada exitosamente.');
}

public function detalle($id)
{
    $area = Area::with('department')->findOrFail($id);

    // Obtener todos los departamentos disponibles
    $departments = Department::all();

    // Crear un arreglo de departamentos para enviar al frontend
    $departmentsData = $departments->map(function ($department) {
        return [
            'id' => $department->id,
            'name' => $department->name,
        ];
    });

    // Enviar los datos al frontend
    $data = [
        'id' => $area->id,
        'name' => $area->name,
        'selected_department_id' => $area->department->id,
        'departments' => $departmentsData,
    ];

    return response()->json($data);
}



    public function delete(Area $area) {
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Área eliminada exitosamente.');
    }



    



}
