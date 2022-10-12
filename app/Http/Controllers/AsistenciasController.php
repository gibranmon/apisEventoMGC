<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Alumno;
use App\Models\Asistencia;
use App\Http\Requests\AsistenciaStoreRequest;

class AsistenciasController extends Controller
{
    public function index() {
        $asistencia = Asistencia::getQuery()->get();
        return response()->json($asistencia);
    }

    public function store(AsistenciaStoreRequest $request) {
        try {
            $atributos = [
                'id_alumno' => $request['id_alumno'],
                'id_evento' => $request['id_evento'],
            ];
            $asistenciaExiste = Asistencia::where('id_alumno', $atributos['id_alumno'])
                ->where('id_evento', $atributos['id_evento'])->count();
            if($asistenciaExiste > 0){
                $alumno = Alumno::find($atributos['id_alumno']);
                return response()->json(["codigo" => 500,
                "mensaje" => "Alumno(a) {$alumno->nombreCompleto} ya fue registrado(a) para este evento."]);
            }
            $item = Asistencia::create($atributos);
            $alumno = Alumno::find($atributos['id_alumno']);
            return response()->json(["codigo" => 200,
            "mensaje" => "Se ha guardado con éxito la asistencia del alumno(a): {$alumno->nombreCompleto}"]);
        } catch (\Throwable $e) {
            return response()->json(["codigo" => 500,
            "mensaje" => "Ha ocurrido un error al guardar la asistencia: {$e}"]);
        }
    }

    public function show($id) {
        $asistencia = Asistencia::getQuery()->where('asistencia_evento_alumno.id', $id)->first();
        if($asistencia) {
            return response()->json(["codigo" => 200, 'mensaje' => 'Asistencia consultada con éxito.',
            "asistencia" => $asistencia]);
        } else {
            return response()->json(["codigo" => 400, 'mensaje' => 'No existe asistencia con el ID indicado.']);
        }
    }

    public function destroy($id) {
        try {
            $asistencia = Asistencia::find($id);
            if($asistencia) {
                if($asistencia->delete()) {
                    return response()->json(["codigo" => 200, 'mensaje' => 'Asistencia eliminado con éxito.']);
                } else {
                    return response()->json(["codigo" => 500, 'mensaje' => 'Ha ocurrido un error al eliminar el asistencia.',
                    $asistencia]);
                }
            } else {
                return response()->json(["codigo" => 500, 'mensaje' => 'No existe asistencia con el ID indicado.']);
            }
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 500, 'mensaje' => 'Ha ocurrido un error al eliminar el asistencia.']);
        }
    }

}
