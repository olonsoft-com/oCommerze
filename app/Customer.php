<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['id','user_first_name', 'user_last_name', 'user_email','user_mobile', 'terms_and_condition', 'user_verify_code','user_status'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function requests()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function package()
    {
        return $this->belongsTo(\App\Package::class);
    }

    public function zone()
    {
        return $this->belongsTo(\App\Area::class, 'zone_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(\App\Area::class, 'area_id', 'id');
    }

    public function bills()
    {
    	return $this->belongsTo(\App\Billing::class);
    }

    public function payments()
    {
    	return $this->belongsTo(\App\Payment::class);
    }

    // automatically deleted relations
    public static function boot() {
        parent::boot();
        static::deleting(function($customer) {
            
            //delete customer user account
            $customer->user()->delete();

            // delete all payment of customer
            foreach( $customer->payments as $payment ) {
                $payment->delete();
            }

            //delete all billing history of customer
            foreach( $customer->bills as $bill ) {
                $bill->delete();
            }

            //delete all request history of customer
            foreach( $customer->requests as $req ) {
                $req->delete();
            }
        });
    }
}
