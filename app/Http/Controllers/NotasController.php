<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotasController extends Controller
{
    public function index () 
    {
        $notas = Notas::all();

        if ($notas->isEmpty()) {
            $data = [
                'message' => 'No se encontraron notas',
                'status' => 200
            ];
            return response()->json($data,200);
        }

        return response()->json($notas,200);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'autor' => 'required',
            'cuerpo' => 'required',
            'clasificacion' => 'required|in:Personal,Escolar,Laboral'
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400); 
        }

        $notas = Notas::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'cuerpo' => $request->cuerpo,
            'clasificacion' => $request->clasificacion
        ]);

        if (!$notas) {
            $data = [
                'message' => 'Error al crear nota',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'student' => $notas,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function show($id)
    {
        $notas = Notas::find($id);

        if (!$notas) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'notas' => $notas,
            'status' => 404
        ];
        return response()->json($data, 200);

    }

    public function destroy($id)
    {
        $notas = Notas::find($id);

        if (!$notas) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $notas->delete();

        $data = [
            'message' => 'Nota eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $notas = Notas::find($id);

        if (!$notas) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'autor' => 'required',
            'cuerpo' => 'required',
            'clasificacion' => 'required|in:Personal,Escolar,Laboral'
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400); 
        }

        $notas->titulo = $request->titulo;
        $notas->autor = $request->autor;
        $notas->cuerpo = $request->cuerpo;
        $notas->clasificacion = $request->clasificacion;

        $notas->save();

        $data = [
            'message' => 'Nota actualizada',
            'notas' => $notas,
            'status' => 200
        ];
        return response()->json($data, 200);

    }

    public function patch(Request $request, $id)
    {
        $notas = Notas::find($id);
        
        if (!$notas) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo',
            'autor',
            'cuerpo',
            'clasificacion' => 'in:Personal,Escolar,Laboral'
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400); 
        }

        if ($request->has('titulo')) {
            $notas->titulo = $request->titulo;
        }

        if ($request->has('autor')) {
            $notas->autor = $request->autor;
        }

        if ($request->has('cuerpo')) {
            $notas->cuerpo = $request->cuerpo;
        }

        if ($request->has('clasificacion')) {
            $notas->clasificacion = $request->clasificacion;
        }

        $notas->save();

        $data = [
            'message' => 'La nota ha sido actualizada con exito',
            'notas' => $notas,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

}