<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = ['path', 'price'];
    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }
}
