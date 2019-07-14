<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rutina;
use App\Maquina;

class RutinaMaquinaControlador extends Controller
{
    public function store(Request $request) {
        $rutina_id = $request->input('rutina_id');
        $maquina_id = $request->input('maquina_id');
        Rutina::find($rutina_id)
            ->maquinas()
            ->attach($maquina_id);
        $redirect = $request->input('redirect');
        return redirect()->route(
            $redirect.'.show',
            $redirect === 'rutina' ? $rutina_id : $maquina_id
        );
    }

    public function delete(Request $request) {
        $rutina_id = $request->input('rutina_id');
        $maquina_id = $request->input('maquina_id');
        Rutina::find($rutina_id)
            ->maquinas()
            ->detach($maquina_id);
        $redirect = $request->input('redirect');
        return redirect()->route(
            $redirect.'.show',
            $redirect === 'rutina' ? $rutina_id : $maquina_id
        );
    }
}
