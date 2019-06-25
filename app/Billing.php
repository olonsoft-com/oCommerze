<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    public function payments()
    {
    	return $this->hasMany(\App\Payment::class, 'billing_id', 'id');
    }

    // automatically deleted relations
    public static function boot() {
        parent::boot();
        static::deleting(function($billing) {

            // delete all payment of customer
            foreach( $billing->payments as $payment ) {
                $payment->delete();
            }

        });
    }
}