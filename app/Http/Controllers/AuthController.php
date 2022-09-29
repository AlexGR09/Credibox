<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\hasRegistro;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\FormatterController as Formatear;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use hasRegistro;

    public function register(Request $request) {
        $newUser = $this->registrar($request);
        if ($newUser != null) {
            $todolodemas['info']['mensaje'] = '¡Registro de usuario exitoso!';
            return (new Formatear)->igor(null,200,$todolodemas);
        }else{
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }


    public function login(Request $request) {

        try {
            $todolodemas = [];
            $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

            $user = User::where("email", "=", $request->email)->first();

            if( isset($user->id) ){
                if(Hash::check($request->password, $user->password)){
                    $token = $user->createToken("auth_token")->plainTextToken;

                    $todolodemas['info']['mensaje'] = '¡Usuario logueado exitosamente!';
                    $todolodemas['info']['access_token'] = [$token];
                    return (new Formatear)->igor($user,200,$todolodemas);     
                }else{
                    $todolodemas['error']['mensaje'] = 'La password es incorrecta';
                    return (new Formatear)->igor(null,404,$todolodemas);  
                }

            }else{
                $todolodemas['error']['mensaje'] = 'Usuario no registrado';
                return (new Formatear)->igor(null,404,$todolodemas); 
            }
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }

    public function logout() {
        try {
            auth()->user()->tokens()->delete();
            
            $todolodemas['info']['mensaje'] = 'Cierre de Sesión';
            return (new Formatear)->igor(null,200,$todolodemas);
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }
}
