<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    use HasFactory;

    public static function GetProductDetailsBySize($productId, $size){
        $productAttributes = ProductsAttribute::where('product_id', $productId)->where('size', $size)->first();
    return $productAttributes;
    }
 
    
}
