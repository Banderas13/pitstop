<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'brand_id',
        'type_id',
        'year',
        'chasis_number',
        'numberplate',
        'fuel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }
}
