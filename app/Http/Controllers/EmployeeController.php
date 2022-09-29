<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\hasRegistro;
use App\Models\Permiso;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\FormatterController as Formatear;

class EmployeeController extends Controller
{
    use hasRegistro;

    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            
            $todolodemas = [];
            $limit = env('PAGINATION_LIMIT', 15);
            $maxPaginationLimit = env('MAX_PAGINATION_LIMIT', 500);
            $order = 'id';
            $direction = 'desc';
            
            if(isset($request->l)) $limit = $request->l > $maxPaginationLimit || $request->l == 0 ? $limit : $request->l;
            if(isset($request->o)) $order = $request->o;
            if(isset($request->d)) $direction = $request->d;

            if($user->puede($user,'Administracion','r'))
            { 
                $recurso = Employee::orderBy($order,$direction)->paginate($limit);

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
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            
            $todolodemas = [];

            if($user->puede($user,'Administracion','c')) 
            {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',          
                ]);

                DB::beginTransaction(); 
                $ruta = storage_path("app/public/img/");
                
                $newuser = $this->registrar($request);

                $recurso = new Company;
                $recurso->name = $request->name;
                $recurso->website = $request->website;
                $recurso->creadopor_id = $user->id;
                
                if ($newuser != null) {
                    $recurso->user_id = $newuser;
                }

                if ($request->file('img')) {
                    $logo = $request->file('img');
                    $img = date('YmdHis').'.'.$logo->getClientOriginalExtension();
                    $logo->move($ruta,$img);
                    $recurso->logo = $img;
                }
                $recurso->save();
          
                DB::commit();
                return (new Formatear)->igor($recurso,201,$todolodemas);
            }
        
            else{
                $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
                $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
                return (new Formatear)->igor(null,403,$todolodemas);
            }
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }  
    }

    public function show($id, Request $request)
    {
        try {
            $user = auth()->user();
        
            $todolodemas = [];

            if($user->puede($user,'Administracion','r')) //Primero verificar si cuenta con permisos
            {

                $recurso = Employee::with('user','company')->find($id);
                
                if (is_null($recurso)) {
                    $todolodemas['info']['mensaje'] = 'No se encontró el registro buscado en la base de datos';
                    $todolodemas['info']['infos'] = ['registros'=>['No se encontró el registro buscado en la base de datos']];
                    return (new Formatear)->igor($recurso,202,$todolodemas);
                }

                return (new Formatear)->igor($recurso,200,$todolodemas);
            }
            else
            {
                $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
                $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
                return (new Formatear)->igor(null,403,$todolodemas);
            }
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $user = auth()->user();
            
            $todolodemas = [];
    
            if($user->puede($user,'Administracion','u'))
            {  
                DB::beginTransaction();
    
                $recurso = Company::with('user','employee')->find($id);
            
                if(is_null($recurso)){
                    $todolodemas['info']['mensaje'] = 'No se encontró el registro para actualizar en la base de datos';
                    $todolodemas['info']['infos'] = ['registros'=>['No se encontró el registro para actualizar en la base de datos']];
                    return (new Formatear)->igor($recurso,202,$todolodemas);
                }
    
                $recurso->name = $request->name;
                $recurso->website = $request->website;
                $recurso->actualizadopor_id = $user->id;

                if ($request->file('img')) {
                    $logo = $request->file('img');
                    $img = date('YmdHis').'.'.$logo->getClientOriginalExtension();
                    $logo->move($ruta,$img);
                    $recurso->logo = $img;
                }
                $recurso->save();

                $userUpd = User::find($recurso->user_id);
                $userUpd->name = $request->name;
                $userUpd->email = $request->email;
                $userUpd->password = Hash::make($request->password);
                $userUpd->update();

                DB::commit();
    
                return (new Formatear)->igor($recurso,201,$todolodemas);
                
            }
            
            else{
            $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
            $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
            return (new Formatear)->igor(null,403,$todolodemas);
            }
        } catch (\Throwable $th) {
            $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
            $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
            return (new Formatear)->igor(null,500,$todolodemas);
        }
    }

    public function destroy($id, Request $request)
    {
      try {
        $user = auth()->user();
          
        $todolodemas = [];
  
        if($user->puede($user,'Administracion','d'))
        { 
            if(isset($request->ids))
            {
              $recurso = Employee::whereIn('id',$request->ids)->delete();
              $todolodemas['info']['mensaje'] = 'Registros eliminado correctamente';
              $todolodemas['info']['infos'] = ['registros'=>['Registros eliminado correctamente']];
  
              return (new Formatear)->igor(null,200,$todolodemas);
            }
            else
            {          
              $recurso = Employee::find($id);
              if (is_null($recurso)) {
                $todolodemas['info']['mensaje'] = 'No se encontró el registro que se intenta borrar, es probable que haya sido borrado anteriormente';
                $todolodemas['info']['infos'] = ['registros'=>['No se encontró el registro buscado en la base de datos']];
                return (new Formatear)->igor($recurso,202,$todolodemas);
              }
              else{
                $recurso->delete();
              
                $todolodemas['info']['mensaje'] = 'Registro eliminado correctamente';
                $todolodemas['info']['infos'] = ['registros'=>['Registro eliminado correctamente']];
                return (new Formatear)->igor($recurso,200,$todolodemas);
              }
            }
        }
        else{
          $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
          $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
          return (new Formatear)->igor(null,403,$todolodemas);
        }
      } catch (Exception $ex) {
        $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
        $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
        return (new Formatear)->igor(null,500,$todolodemas);
      }
    }
}
