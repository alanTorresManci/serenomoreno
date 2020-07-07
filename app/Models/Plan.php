<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlanAttribute;

class Plan extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public function attributes(){
        return $this->hasMany(PlanAttribute::class);
    }
}
