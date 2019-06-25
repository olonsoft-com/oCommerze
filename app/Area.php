<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	public function zoneCustomers ()
	{
		return $this->hasMany(\App\User::class, 'zone_id', 'id');
	}

    public function customers()
    {
    	return $this->hasMany(\App\Customer::class, 'area_id', 'id');
    }

    // automatically deleted relations
    public static function boot() {
        parent::boot();
        static::deleting(function($area) { 

        	// before delete() method call these
            foreach( $area->zoneCustomers as $customer ) {
                $customer->delete();
            }

            foreach( $area->customers as $customer ) {
                $customer->delete();
            }
        });
    }
}
