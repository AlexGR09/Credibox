<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = true;

    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name',
                                'lastname',
                                'phone',
                                'genero',
                                'user_id',
                                'company_id',
                                'creadopor',
                                'actualizadopor');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
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
