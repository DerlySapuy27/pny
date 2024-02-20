<?php

namespace App\Http\Controllers;
use App\Models\Position;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
        $positions = Position::all(); 
        return view('cargo.index', compact('positions'));}

    public function crearCargo(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',]);
        Position::create([
            'name' => $request->name,]);
        return redirect()->route('cargo.index')->with('success', 'Cargo creado exitosamente.');}

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',]);
        $position = Position::findOrFail($id);
        $position->update([
            'name' => $request->name,]);
        return redirect()->route('cargo.index')->with('success', 'Departamento actualizado exitosamente.');} 
    
    public function detalle($id){
        $position = Position::findOrFail($id);
        return response()->json($position);}
        
        public function delete(Position $position) {
            $position->delete();
            return redirect()->route('cargo.index')->with('success', 'Cargo  eliminado exitosamente.');}

}
