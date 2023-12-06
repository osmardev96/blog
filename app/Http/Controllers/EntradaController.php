<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{
    public function entradas()
    {
        $entradas = Entrada::all();
        return response()->json($entradas);
    }

    public function busqueda($b)
    {
        $entradas = DB::table('entrada')->where('titulo','LIKE','%'.$b.'%')
        ->orWhere('autor','LIKE','%'.$b.'%')
        ->orWhere('contenido','LIKE','%'.$b.'%')
        ->get();
        return response()->json($entradas);
    }

    public function entradaId($id)
    {
        $entrada = Entrada::find($id);

        return response()->json([
            'entrada' => $entrada
        ]);
    }

    public function guardar(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'titulo' => 'required',
            'autor' => 'required',
            'fecha_publicacion' => 'required',
            'contenido' => 'required',
        ]);
        if ($validador->fails()) {
            return response()->json([
                'codigo' => 0,
                'resultado' => 'campos requeridos',
            ]);
        }

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

    public function actualizar(Request $request, $id)
    {
        $entrada = Entrada::find($id);

        $validador = Validator::make($request->all(), [
            'titulo' => 'required',
            'autor' => 'required',
            'fecha_publicacion' => 'required',
            'contenido' => 'required',
        ]);
        if ($validador->fails()) {
            return response()->json([
                'codigo' => 0,
                'resultado' => 'campos requeridos',
            ]);
        }

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

    public function eliminar($id)
    {
        $entrada = Entrada::find($id);

        $entrada->delete();

        return response()->json([
            'mensaje' => 'Entrada deleted successfully'
        ]);
    }
}
