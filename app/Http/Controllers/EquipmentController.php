<?php
namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;


class EquipmentController extends Controller
{



    /* CRUD Functions */
    public function EquipmentCreate_PNY(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'series' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Equipment::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'series' => $request->series,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->route('Equipment.View.PNY')->with('success', 'Equipo creado exitosamente.');
    }



    public function EquipmentView_PNY()
    {
        $equipment = new Equipment; // Crear una nueva instancia de Equipment
        $equipmentTypes = $equipment::$enums['type'];
        $Equipments = Equipment::all(); // Obtener todos los registros de Equipment
        return view('Equipment.EquipmentRegister', compact('equipment', 'equipmentTypes', 'Equipments'));
    }

    public function EquipmentDevolution_PNY(){

        return view('Equipment.Devolution');

    }
    
     public function EquipmentAssing_PNY(){

      return view('Equipment.EquipmentAssing');


    }

    public function EquipmentUpdate_PNY(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'series' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $Equipment = Equipment::findOrFail($id);
        $Equipment->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'series' => $request->series,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->route('Equipment.View.PNY')->with('success', 'Sede actualizada exitosamente.');
    }

    public function EquipmentDelete_PNY(Equipment $Equipment)
    {
        $Equipment->delete();
        return redirect()->route('Equipment.View.PNY')->with('success', 'Sede eliminada exitosamente.');
    }
        /* End CRUD Functions */
    
    public function EquipmentDetail_PNY($id)
    {
        $Equipment = Equipment::findOrFail($id);
        return response()->json($Equipment);
    }
    
    public function ViewEquipment_PNY($id)
    {

        dd($id);
    }

    public function PrinterLoanView_PNY()
    {
        return view('Equipment.PrinterLoan');
    }
    
}
