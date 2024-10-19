<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountPaid extends Model
{
    use HasFactory;

    /**
    * Get the user that owns the phone.
    */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
