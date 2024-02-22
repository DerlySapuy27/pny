<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index()
    {
        $sede = Sede::all(); 
        return view('sede.index', compact('sede'));
    }

    public function crearsede(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Sede::create([
            'name' => $request->name,
        ]);

        return redirect()->route('sede.index')->with('success', 'Sede creada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sede = Sede::findOrFail($id);
        $sede->update([
            'name' => $request->name,
        ]);

        return redirect()->route('sede.index')->with('success', 'Sede actualizada exitosamente.');
    }
    
    public function detalle($id)
    {
        $sede = Sede::findOrFail($id);
        return response()->json($sede);
    }
        
    public function delete(Sede $sede)
    {
        $sede->delete();
        return redirect()->route('sede.index')->with('success', 'Sede eliminada exitosamente.');
    }
}
