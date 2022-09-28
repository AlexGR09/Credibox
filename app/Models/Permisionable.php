<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Permisionable extends Model
{
    protected $table = 'permisionables';
    public $timestamps = true;

    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('permisionable_type','creadopor','actualizadopor');

    public function creadopor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function actualizadopor()
    {
        return $this->belongsTo('App\Models\User');
    }
}
