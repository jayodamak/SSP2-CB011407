<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    protected $getCartItems;
    public function updateCartItemQty(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //Update the cart Item qty
            Cart::where('id', $data['cart_id'])->update(['product_qty' => $data['quantity']]);
            //$getAttributePrice = ProductsAttribute::getProductDetailsBySize($data['product_id'], $data['size']);

            return response()->json($data);
        }
    }
    public function addToCart(Request $request)
    {
        //dd(Auth::user()->id);
        $cart = new Cart();
        $cart->user_id = Auth::check() ? Auth::user()->id : 0;
        $cart->product_id = $request->product_id;
        $cart->product_size = $request->size;
        $cart->product_qty = $request->qty;
        $cart->save();

        return redirect('/cart');
    }
    public function cart()
    {
        $getCartItems = Cart::userCartItems();

        return view('front.products.cart')->with(compact('getCartItems'));
    }
    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Update the cart Item qty
            Cart::where('id', $data['cart_id'])->delete();
            // Get Updated cart Items
            $getCartItems = Cart::userCartItems();
            // Return the Updated cart Items via Ajax
            //return view('front.products.cart')->with(compact('getCartItems'));
            return response()->json([
                'status' => true,
                'view' =>   view('front.products.cart')->with(compact('getCartItems'))
            ]);
        }
    }
}
