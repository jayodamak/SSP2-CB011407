<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'product_code',
        'product_name',
        'product_size',
        'product_price',
        'product_qty',
    ];
    protected $with = ['Product'];
    public function Product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function OrderProductsByOrderId($orderId)
    {
        $relatedProducts = OrdersProduct::where('order_id', $orderId)->inRandomOrder()->get();
        return $relatedProducts;
    }
    public function Order()
    {
        return $this->belongsTo('App\Models\Orders', 'order_id');
    }
}
