<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function customers()
    {
    	return $this->hasMany(\App\Customer::class, 'package_id', 'id');
    }

    // automatically deleted relations
    public static function boot() {
        parent::boot();
        static::deleting(function($package) {

            // delete all customers
            foreach( $package->customers as $customer ) {
                $customer->delete();
            }
        });
    }
}
