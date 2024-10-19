<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;



    /**
    * Get the user that owns the phone.
    */
    public function sale()
    {
        return $this->belongsTo(Sale::class ,'id');
    }


     /**
     * Get the user that owns the phone.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
