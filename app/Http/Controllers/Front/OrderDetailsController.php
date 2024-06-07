<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;  
use App\Models\DeliveryAddress; 
use App\Models\OrdersProduct;  
use App\Models\Product;  

class OrderDetailsController extends Controller
{
    public function saveOrderDetails(Request $request, $delivery_charge, $final_price)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $details = new Orders;
            $details->user_id = Auth::user()->id;
            $details->name = $data['order_name'];
            $details->address = $data['order_address'];
            $details->city = $data['order_city'];
            $details->email = $data['order_email'];
            $details->mobile_1 = $data['order_mobile_1'];
            $details->mobile_2 = $data['order_mobile_2'];
            $details->order_status = 'Pending';
            $details->delivery_charges = $delivery_charge;
            $details->grand_total = $final_price;
            $details->payment_method = 'Stripe';
            $details->payment_gateway = 'Stripe';
            $details->save();
    
            // Retrieve cart items
            $getCartItems = Cart::userCartItems();
            if (empty($getCartItems)) {
                return redirect()->back()->with('flash_message_error', 'Your cart is empty. Please add items to your cart to place an order.');
            }
    
            foreach ($getCartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $details->id; // Use $details->id to get the newly created order ID
                $cartItem->user_id = Auth::user()->id;
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $item['product']['product_code'];
                $cartItem->product_name = $item['product']['product_name'];
                $cartItem->product_size = $item['product_size'];
                $cartItem->product_price = $item['product']['product_price'];
                $cartItem->product_qty = $item['product_qty'];
                $cartItem->save();
            }
    
            Cart::where('user_id', Auth::id())->delete();
    
            return redirect()->route('stripe.payment', ['id' => $details->id, 'total' => $details->grand_total]);
        }
    }
    

}
