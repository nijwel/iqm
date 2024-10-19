<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;


    /**
    * Get the user that owns the phone.
    */
    public function sale_details()
    {
        return $this->hasMany(SaleDetails::class , 'sale_id');
    }

    /**
    * Get the user that owns the phone.
    */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}
