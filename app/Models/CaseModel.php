<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'user_id', 'mechanic_id', 'car_id', 'description', 'offer_id', 'approval', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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

    public function relationshipCar()
    {
        return $this->belongsTo(Car::class, 'car_id')->where('user_id', $this->user_id);
    }
}
