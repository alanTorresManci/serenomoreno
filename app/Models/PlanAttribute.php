<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class PlanAttribute extends Model
{
    //
    protected $fillable = [
        'plan_id',
        'attribute'
    ];
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
