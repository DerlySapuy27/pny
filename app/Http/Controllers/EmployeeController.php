<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Area;
use App\Models\Sede;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $positions = Position::all();
        $areas = Area::all();
        $sedes = Sede::all();
        $id = 1; // Asigna aquí el valor de $id según tus necesidades
        return view('empleado.index', compact('employees', 'positions', 'areas', 'sedes', 'id'));}

    public function cargarDatos(){
        $positions = Position::all();
        $areas = Area::all();
        $sedes = Sede::all();
        $data = [
            'positions' => $positions,
            'areas' => $areas,
            'sedes' => $sedes,];
        return response()->json($data);}

    public function crearEmpleado(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_number' => 'required|string|max:255',
            'sex_type' => 'required|in:M,F', 
            'position_id' => 'required|exists:positions,id',
            'blood_type' => 'required|in:A✛,A-,B✛,B-,AB✛,AB-,O✛,O-',
            'area_id' => 'required|exists:areas,id',
            'delivered' => 'boolean',
            'observation' => 'nullable|string',
            'license_number' => 'nullable|string',
            'sede_id' => 'required|exists:sedes,id',
            'signature' => 'file|nullable|image|mimes:jpeg,png,jpg,gif']);

            $delivered = $request->input('delivered', 0); 
            
            
        $employee = new Employee([
            'name' => $request->name ? strtoupper($request->name) : null,
            'last_name' => $request->last_name ? strtoupper($request->last_name) : null,
            'document_number' => $request->document_number,
            'sex_type' => $request->sex_type,
            'position_id' => $request->position_id,
            'blood_type' => $request->blood_type,
            'area_id' => $request->area_id,
            'delivered' => (bool)$delivered, // Puede usar filled para verificar si se ha proporcionado
            'observation' => $request->observation,
            'license_number' => $request->license_number,
            'sede_id' => $request->sede_id,]);
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $employee->signature = $signaturePath;}
        $employee->save();
        return redirect()->route('empleado.index')->with('success', 'Empleado creado exitosamente.');}


    public function delete(Employee $employee){
        $employee->delete();
        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');}

    public function getEmployeeDetails(Request $request){
        $employeeId = $request->input('employee_id');
        $employee = Employee::with(['position', 'area', 'sede'])->findOrFail($employeeId);
        return response()->json(['employee' => $employee]);}    

    public function update(Request $request, $id) {
        $request->validate([
            // Añade las reglas de validación necesarias
        ]);
        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->route('empleado.index')->with('error', 'Empleado no encontrado.');}
        // Actualiza los campos según las reglas de validación
        $employee->name = strtoupper($request->name);
        $employee->last_name = strtoupper($request->last_name);
        $employee->document_number = $request->document_number;
        $employee->sex_type = $request->sex_type;
        $employee->position_id = $request->position_id;
        $employee->blood_type = $request->blood_type;
        $employee->area_id = $request->area_id;
        $employee->delivered = $request->delivered === '1';
        $employee->observation = $request->observation;
        $employee->license_number = $request->license_number;
        $employee->sede_id = $request->sede_id;
        // Manejar la carga de la firma si está presente
        if ($request->hasFile('signature')) {
            // Eliminar la firma anterior si existe
            if ($employee->signature) {
                Storage::disk('public')->delete($employee->signature);
            }
            // Guardar la nueva firma
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $employee->signature = $signaturePath;
        }
        $employee->save();
        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');}


    public function details($id){
        $employee = Employee::findOrFail($id);
        return response()->json($employee);}




}
