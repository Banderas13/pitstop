<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{


    protected $table = 'cases';

    protected $fillable = [
        'user_id', 'mechanic_id', 'car_id', 'description', 'offer_id', 'approval',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'case_id');
    }
}
