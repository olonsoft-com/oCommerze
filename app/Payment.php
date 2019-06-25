<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function billing()
    {
    	return $this->belongsTo(\App\Billing::class, 'billing_id', 'id');
    }
}