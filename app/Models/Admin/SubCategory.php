<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

        /**
        * Get the user that owns the phone.
        */
       public function category()
       {
           return $this->belongsTo(Category::class);
       }
}
