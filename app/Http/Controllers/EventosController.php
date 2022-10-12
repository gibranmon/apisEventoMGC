<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Http\Requests\EventoStoreRequest;
use App\Http\Requests\EventoUpdateRequest;

class EventosController extends Controller
{
    public function index() {
        $eventos = Evento::get();
        return response()->json($eventos);
    }

    public function store(EventoStoreRequest $request) {
        try {
            $atributos = [
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'clave' => $request['clave']
            ];
            $item = Evento::create($atributos);
            return response()->json(["codigo" => 200,
            "mensaje" => "Se ha guardado con éxito el evento: {$item->nombre}"]);
        } catch (\Throwable $e) {
            return response()->json(["codigo" => 400,
            "mensaje" => "Ha ocurrido un error al crear el evento: {$e}"]);
        }
    }

    public function show($id) {
        $evento = Evento::find($id);
        if($evento) {
            return response()->json(["codigo" => 200, 'mensaje' => 'Evento consultado con éxito.',
            "evento" => $evento]);
        } else {
            return response()->json(["codigo" => 400, 'mensaje' => 'No existe evento con el ID indicado.']);
        }
    }

    public function update(EventoUpdateRequest $request, $id) {
        $evento = Evento::find($id);
        if($evento) {
            $atributos = [
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'clave' => $request['clave']
            ];
            try {
                if($evento->update($atributos)){
                    return response()->json(["codigo" => 200,
                    "mensaje" => "Se ha actualizado con éxito el evento con nombre: {$evento->nombre}"]);
                } else {
                    return response()->json(["codigo" => 400,
                    "mensaje" => "Ha ocurrido un error al actualizar el evento."]);
                }
            } catch (\Throwable $e) {
                return response()->json(["codigo" => 400,
                "mensaje" => "Ha ocurrido un error al actualizar el evento: {$e}"]);
            }
        } else {
            return response()->json(["codigo" => 400, 'mensaje' => 'No existe evento con el ID indicado.']);
        }
    }

    public function destroy($id) {
        try {
            $evento = Evento::find($id);
            if($evento) {
                if($evento->delete()) {
                    return response()->json(["codigo" => 200, 'mensaje' => 'Evento eliminado con éxito.']);
                } else {
                    return response()->json(["codigo" => 400, 'mensaje' => 'Ha ocurrido un error al eliminar el evento.',
                    $evento]);
                }
            } else {
                return response()->json(["codigo" => 400, 'mensaje' => 'No existe evento con el ID indicado.']);
            }
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 400, 'mensaje' => 'Ha ocurrido un error al eliminar el evento.']);
        }
    }
}
