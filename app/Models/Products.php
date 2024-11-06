<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;


    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'id');
    }

    public function ProductStock()
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }



}





















