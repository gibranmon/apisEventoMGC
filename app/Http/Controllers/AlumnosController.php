<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Http\Requests\AlumnoStoreRequest;
use App\Http\Requests\AlumnoUpdateRequest;
use App\Utils\GenerateCode;

class AlumnosController extends Controller
{
    public function index() {
        $alumnos = Alumno::get();
        return response()->json($alumnos);
    }

    public function store(AlumnoStoreRequest $request) {
        try {
            $atributos = [
                'nombreCompleto' => $request['nombre'],
                'matricula' => $request['matricula'],
                'telefono' => $request['telefono'],
                'codigo' => GenerateCode::getCode()
            ];
            $item = Alumno::create($atributos);
            return response()->json(["codigo" => 200,
            "mensaje" => "Se ha guardado con éxito el alumno: {$item->nombreCompleto}"]);
        } catch (\Throwable $e) {
            return response()->json(["codigo" => 400,
            "mensaje" => "Ha ocurrido un error al crear el alumno: {$e}"]);
        }
    }

    public function show($id) {
        $alumno = Alumno::find($id);
        if($alumno) {
            return response()->json(["codigo" => 200, 'mensaje' => 'Alumno consultado con éxito.',
            "alumno" => $alumno]);
        } else {
            return response()->json(["codigo" => 400, 'mensaje' => 'No existe alumno con el ID indicado.']);
        }
    }

    public function alumnoByCode($code) {
        $alumno = Alumno::where('codigo',$code)->first();
        if($alumno) {
            return response()->json(["codigo" => 200, 'mensaje' => 'Alumno consultado con éxito.',
            "alumno" => $alumno]);
        } else {
            return response()->json(["codigo" => 400, 'mensaje' => 'No existe alumno con el código indicado.']);
        }
    }

    public function update(AlumnoUpdateRequest $request, $id) {
        $alumno = Alumno::find($id);
        if($alumno) {
            $atributos = [
                'nombreCompleto' => $request['nombre'],
                'matricula' => $request['matricula'],
                'telefono' => $request['telefono'],
            ];
            try {
                if($alumno->update($atributos)){
                    return response()->json(["codigo" => 200,
                    "mensaje" => "Se ha actualizado con éxito el alumno {$alumno->nombreCompleto} con matricula: {$alumno->matricula}"]);
                } else {
                    return response()->json(["codigo" => 400,
                    "mensaje" => "Ha ocurrido un error al actualizar el alumno."]);
                }
            } catch (\Throwable $e) {
                return response()->json(["codigo" => 400,
                "mensaje" => "Ha ocurrido un error al actualizar el alumno: {$e}"]);
            }
        } else {
            return response()->json(["codigo" => 400, 'mensaje' => 'No existe alumno con el ID indicado.']);
        }
    }

    public function destroy($id) {
        try {
            $alumno = Alumno::find($id);
            if($alumno) {
                if($alumno->delete()) {
                    return response()->json(["codigo" => 200, 'mensaje' => 'Alumno eliminado con éxito.']);
                } else {
                    return response()->json(["codigo" => 400, 'mensaje' => 'Ha ocurrido un error al eliminar el alumno.',
                    $alumno]);
                }
            } else {
                return response()->json(["codigo" => 400, 'mensaje' => 'No existe alumno con el ID indicado.']);
            }
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 400, 'mensaje' => 'Ha ocurrido un error al eliminar el alumno.']);
        }
    }
}
