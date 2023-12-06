<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::all();

        return response()->json($entradas);
    }

    public function show($id)
    {
        $entrada = Entrada::find($id);

        return response()->json([
            'entrada' => $entrada
        ]);
    }

    public function store(Request $request)
    {
        $entrada = new Entrada;
        $entrada->titulo = $request->input('titulo');
        $entrada->autor = $request->input('autor');
        $entrada->fecha_publicacion = $request->input('fecha_publicacion');
        $entrada->contenido = $request->input('contenido');
        $entrada->save();

        return response()->json([
            'codigo' => 1,
            'resultado' => 'exito',
        ]);
    }

    public function update(Request $request, $id)
    {
        $entrada = Entrada::find($id);

        $entrada->name = $request->input('name');
        $entrada->description = $request->input('description');
        $entrada->completed = $request->input('completed');

        $entrada->save();

        return response()->json([
            'message' => 'Entrada updated successfully',
            'entrada' => $entrada
        ]);
    }

    public function destroy($id)
    {
        $entrada = Entrada::find($id);

        $entrada->delete();

        return response()->json([
            'message' => 'Entrada deleted successfully'
        ]);
    }
}
