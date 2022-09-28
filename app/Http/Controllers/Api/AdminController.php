<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\FormatterController as Formatear;
use Illuminate\Support\Facades\Validator;
use App\Models\Permiso;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
  {
    /* try { */
        $user_id = auth()->user()->id;
        return $user_id;

        $limit = env('PAGINATION_LIMIT', 15);
        $maxPaginationLimit = env('MAX_PAGINATION_LIMIT', 500);
        $order = 'id';
        $direction = 'desc';
        
        if(isset($request->l)) $limit = $request->l > $maxPaginationLimit || $request->l == 0 ? $limit : $request->l;
        if(isset($request->o)) $order = $request->o;
        if(isset($request->d)) $direction = $request->d;

        if($user->puede($user,'Administracion','r')) //Primero verificar si cuenta con permisos
        { 
          $todolodemas = [];
          $recurso = User::orderBy($order,$direction)->paginate($limit);

          if(count($recurso)==0){
            $todolodemas['info']['mensaje'] = 'No se encontraron registros en la base de datos';
            $todolodemas['info']['infos'] = ['registros'=>['No se encontraron registros en la base de datos']];
            return (new Formatear)->igor($recurso,202,$todolodemas);
          }
          return (new Formatear)->igor($recurso,200,$todolodemas);
        }
        else{
          $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
          $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
          return (new Formatear)->igor(null,403,$todolodemas);
        }
        /* } catch (\Throwable $th) {
          $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
          $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
          return (new Formatear)->igor(null,500,$todolodemas);
        } */
    }
}
