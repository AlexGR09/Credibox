<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\FormatterController as Formatear;
use Illuminate\Support\Facades\Hash;

trait hasRegistro {

    public function registrar($registro) {
        try {
            $todolodemas = [];
            $registro->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'            
            ]);
        
            $user = new User();
            $user->name = $registro->name;
            $user->email = $registro->email;
            $user->password = Hash::make($registro->password);
            $user->save();

            return $user->id;

            /* $todolodemas['info']['mensaje'] = '¡Registro de usuario exitoso!';
            return (new Formatear)->igor($user,200,$todolodemas); */
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }
}
