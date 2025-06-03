<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
