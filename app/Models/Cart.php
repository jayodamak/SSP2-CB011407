<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id', 'user_id', 'product_id', 'product_size', 'product_qty'
    ];

    public static function userCartItems()
    {
        if(Auth::check()){
            //If the user is not logged in,check from user_id
            $user_id = Auth::user()->id;
        // dd($user_id);
            $getCartItems = Cart::with('product')->where('user_id', $user_id)->get()->toArray();
        }
        else{
            //If the user is not logged in,check from session_id
            $session_id = Session::get('session_id');
           // dd($session_id);
            $getCartItems = Cart::with('product')->where('session_id', $session_id)->where('user_id', 0)->get()->toArray();
        }
        return $getCartItems;

    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
