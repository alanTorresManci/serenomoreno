<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
class Client extends Model
{
    //
    protected $fillable = [
        'user_id',
        'plan_id',
        'last_name',
        'birthday',
        'phone',
        'grain_type',
        'address',
        'pc',
        'paypal',
        'paypal_agreement_id'
    ];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
