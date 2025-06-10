<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{

    protected $fillable = [
        'name', 'company_name', 'email', 'password', 'vat', 'adress', 'telephone',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'mechanic_user', 'mechanic_id', 'user_id')
                ->withTimestamps();
    }

    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }
}
