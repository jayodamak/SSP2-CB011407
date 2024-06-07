<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->with('parentcategory');
    }
    // public static function productFilters()
    // {
    //     $productFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool');
    //     $productFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
    //     $productFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
    //     $productFilters['fitArray'] = array('Regular', 'Slim');
    //     $productFilters['occasionArray'] = array('Casual', 'Formal');
    //     return $productFilters;
    // }
    public function OrderProducts()
    {
        return $this->hasMany('App\Models\OrdersProduct', 'product_id');
    }
    public function attributes(){
        return $this->hasMany('App\Models\ProductsAttribute');
    }

  
}
