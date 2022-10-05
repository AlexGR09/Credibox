<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Employees.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * Fillable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'genero',
        'user_id',
        'company_id',
    ];

    /**
     * User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Company.
     *
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
