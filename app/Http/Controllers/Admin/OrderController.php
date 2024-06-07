<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Orders;

class OrderController extends Controller
{
    public function orders()
    {
        Session::put('page', 'orders');
        $orders = Orders::orderBy('id', 'desc')->get()->toArray();
        return view('admin.orders.orders')->with(compact('orders'));
    }


    public function orderDetails($id)
    {
        $modelInstance = new orders();
        $orderDetails = $modelInstance->orderDetails($id);
         //dd($orderDetails);
        // $orderDetails = Orders::with('orderProducts',$id)->where('id',$id)->first()->toArray;
        return view('admin.orders.order_detail')->with(compact('orderDetails'));
    }

    // public function orderDetails($id)
    // {  $modelInstance = new OrdersProduct();
    //     $orderDetails = $modelInstance->OrderProductsByOrderId($id);
    //      // dd($orderDetails);
    //     return view('admin.orders.order_detail')->with(compact('orderDetails'));
    // }
}
