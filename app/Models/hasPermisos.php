<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Permiso;
use App\Models\Permisionable;

trait hasPermisos {

    public function puede($user,$tabla,$accion) {
        
        $user = $user ?: auth()->user();

        $permiso = Permiso::where('nombre','=',$tabla)->first();

        if($permiso) 
        {
            $rouls = [];

            foreach($user->roles as $rolito)
                $rouls[] = $rolito->id;            

            $permisoRol = Permisionable::where('permiso_id','=',$permiso->id);
            $permisoRol = $permisoRol->where('permisionable_type','=','App\Models\Role');
            $permisoRol = $permisoRol->whereIn('permisionable_id',$rouls);
            $permisoRol = $permisoRol->select('permisionables.'.$accion.' as permiso')->first();            
                                   
            if($permisoRol && $permisoRol->permiso)
                return $permisoRol->permiso;

            return false;
        }
        else
            return false;

    }
}
