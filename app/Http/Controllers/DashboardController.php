<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;
use App\Models\Product;


class DashboardController extends Controller
{
    // public function index() {

        
    //     if (Auth::user()->role->value == 1) {
    //         return redirect('/admin/dashboard');
    //     } else {
    //         return view('front.home');
    //     }

    // }


    public function redersssect(){
    // { dd(@Auth::check());
        //Get Home Page Slider Banners
        $homeSliderBanners = Banner::where('type', 'Slider')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();
        // dd($homeSliderBanners);


        //Get Home Page Fix Banners
        $homeFixBanner1 = Banner::where('type', 'Fix 1')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();
        $homeFixBanner2 = Banner::where('type', 'Fix 2')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();


        //Get New Arrival Products
        $newProducts = Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get()->toArray();

        // dd($newProducts);


        //Get Featured Products
        $featuredProducts = Product::where(['is_featured'=> 'Yes', 'status'=>1])->inRandomOrder()->limit(7)->get()->toArray();
        // dd($featuredProducts);

        return view('front.home')->with(compact('homeSliderBanners', 'homeFixBanner1', 'homeFixBanner2', 'newProducts', 'featuredProducts'));
    }

}
