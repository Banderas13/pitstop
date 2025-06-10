<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'type_id', 'year', 'chasis_number', 'numberplate', 'user_id', 'fuel'
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
