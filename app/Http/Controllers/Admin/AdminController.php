<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Orders;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page', 'dashboard');
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $ordersCount = Orders::count();
        $usersCount = User::count();
        return view('admin.layout.dashboard', compact('categoriesCount', 'productsCount', 'ordersCount', 'usersCount'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password!');
            }
        }
        return view('auth.login');
    }

    public function updatePassword()
    {
        return view('admin.layout.update_password');
    }

    public function categories()
    {
        return view('admin.categories.categories', [
            'categories' => Category::all()
        ]);
    }

    public function products()
    {
        return view('admin.products.products', [
            'products' => Product::all()
        ]);
    }

    public function banners()
    {
        return view('admin.banners.banners', [
            'banners' => Banner::all() // Assuming there is a Banner model
        ]);
    }

    public function orders()
    {
        return view('admin.orders.orders', [
            'orders' => Orders::all()
        ]);
    }

    public function users()
    {
        Session::put('page', 'users');
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }

    public function addEditUser(Request $request, $id = null)
    {
        if ($id == "") {
            // Add User
            $title = "Add User";
            $user = new User;
            $message = "User added successfully!";
        } else {
            // Edit User
            $title = "Edit User";
            $user = User::find($id);
            $message = "User updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            array_walk_recursive($data, function(&$item) {
                if (is_string($item)) {
                    $item = trim($item);
                }
            }); 

            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required'
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'role.required' => 'Role is required'
            ];

            $this->validate($request, $rules, $customMessages);

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->role = $data['role'];

            if (isset($data['password']) && !empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            Session::flash('success_message', $message);
            return redirect('admin/users');
        }

        return view('admin.users.add_edit_user')->with(compact('title', 'user'));
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        Session::flash('success_message', 'User deleted successfully!');
        return redirect()->back();
    }
}
