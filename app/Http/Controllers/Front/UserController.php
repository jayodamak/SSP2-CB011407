<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginUser()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
    
        
        

        $getCartItems = Cart::all();
        return view('front.users.login', compact('getCartItems'));
    }

    public function registerUser(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:150',
                'mobile' => 'required|numeric|digits:10',
                'email' => 'required|email|max:250|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ], [
                'name.required' => 'Name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Mobile must be numeric',
                'mobile.digits' => 'Mobile must be 10 digits',
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'email.unique' => 'Email is already registered',
                'password.required' => 'Password is required',
                'confirm_password.required' => 'Confirm Password is required',
                'confirm_password.same' => 'Password and Confirm Password must be same',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'type' => 'validation', 'errors' => $validator->messages()]);
            }

            $data = $request->all();

            // Register the user
            $user = new User;
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $redirectUrl = url('/');
                return response()->json(['url' => $redirectUrl]);
            }
        }

        return view('front.users.register');
    }


   
    
}

