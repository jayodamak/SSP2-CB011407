<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function checkout()
    {

        $getCartItems  = Cart::where('user_id', Auth::id())->get();
        return view('front.products.checkout', compact('getCartItems'));
    }

    public function session(Request $request, $id, $total)
    {
        Stripe::setApiKey(config('stripe.sk'));

        $totalInCents = $total * 100;

        $session = Session::create([
            'payment_method_types' => ['card'], // Specify payment method types
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'LKR',
                        'product_data' => [
                            'name' => "Product ID: $id",
                        ],
                        'unit_amount' => $totalInCents,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        // return "Thanks for your order! You have just completed your payment. The seller will reach out to you as soon as possible.";

        return redirect()->to('/checkout')->with('success', 'Order Placed Successfully');

    }
}
