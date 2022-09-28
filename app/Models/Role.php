<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = true;

    use hasPermisos, SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('nombre','creadopor','actualizadopor');


    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function creadopor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function actualizadopor()
    {
        return $this->belongsTo('App\Models\User');
    }
}
