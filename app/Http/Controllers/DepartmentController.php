<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();
        return view('departamento.index', compact('departments'));}

    public function creardepartamento(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',]);
        Department::create([
            'name' => $request->name,]);
        return redirect()->route('departamento.index')->with('success', 'Departamento creado exitosamente.');}

    public function edit($id){
    $department = Department::findOrFail($id);
    return view('departamento.editar', compact('department'));}

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,]);
        return redirect()->route('departamento.index')->with('success', 'Departamento actualizado exitosamente.');} 

    public function detalle($id){
    $department = Department::findOrFail($id);
    return response()->json($department);}

    public function delete(Department $departamento) {
            $departamento->delete();
            return redirect()->route('departamento.index')->with('success', 'Departamento eliminado exitosamente.');}
    

}
