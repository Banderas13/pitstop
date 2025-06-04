<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['path', 'case_id'];

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
}
