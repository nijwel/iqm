<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     /**
     * Get the user that owns the phone.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     /**
     * Get the user that owns the phone.
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

     /**
     * Get the user that owns the phone.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

     /**
     * Get the user that owns the phone.
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

     /**
     * Get the user that owns the phone.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
