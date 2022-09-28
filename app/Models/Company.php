<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $table = 'companies';
    public $timestamps = true;

    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name',
                                'logo',
                                'website',
                                'user_id',
                                'creadopor',
                                'actualizadopor');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function employee()
    {
        return $this->hasMany('App\Models\Employee');
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
