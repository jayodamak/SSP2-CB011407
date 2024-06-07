<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'email',
        'mobile_1',
        'mobile_2',
        'order_status',
        'payment_method',
        'payment_gateway',
        'delivery_charges',
        'grand_total',
    ];
    public static function userOrders()
    {
        $user_id = Auth::id();
        return Orders::where('user_id', $user_id)->get();
    }
    public function orderDetails($id)
    {
        $orderDetails = Orders::with('orderProducts')->where('id', $id)->first()->toArray();
        return $orderDetails;
    }

    public function orderProducts()
    {
        return $this->hasMany('App\Models\OrdersProduct', 'order_id');
    }
}
