<?php

use App\Enums\Role;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Models\Category;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::namespace('App\Http\Controllers\Front')->group(function() {
    Route::get('/', [HomeController::class, 'home']);

    // Listing Categories Routes
   $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url');
    // dd($catUrls);

   foreach ($catUrls as $url) {
       Route::get($url, [ProductController::class, 'listing']);
   }

    // Product Detail page
    Route::get('product/{id}', 'ProductController@detail');

    // Get Product Attribute Price
    Route::post('get-attribute-price', 'ProductController@getAttributePrices');

    //Add To Cart
    Route::post('/add-to-cart', 'CartController@addToCart');
    // Route::match(['get','post'],'/add-to-cart','ProductController@addToCart');
    // Route::get('/add-to-cart',[ProductController::class, 'addToCart'])->name('addToCart.get');

    //shoping cart
    // Route::get('cart', 'CartController@cart');

    //update cart quantity
    Route::post('update-cart-item-qty', 'CartController@updateCartItemQty')->name('updateCartItemQty');

    //Delete Cart Items
    Route::post('delete-cart-item', 'CartController@deleteCartItem');

    //Empty Cart

    // Use Login
    Route::match(['get','post'],'user/login','UserController@loginUser')->name('loginnew');

    // User Register
    Route::match(['get','post'],'user/register','UserController@registerUser');


    Route::group(['middleware' => ['auth']], function () {
        //User Account

        //shoping cart
        Route::get('cart', 'CartController@cart');

        //checkout
        Route::get('checkout', 'ProductController@checkout');

        //Save Delivery Address
        Route::post('confirm-order', 'OrderDetailsController@saveOrderDetails')->name('saveOrderDetails');
        Route::post('/saveOrderDetails/{charge}/{total}', 'OrderDetailsController@saveOrderDetails');

        // Route::get('/order-review', [OrderController::class, 'orderReview']);

    });


});



Route::get('/admin/dashboard', [\App\Http\Controllers\admin\AdminController::class, 'dashboard']);






// Route::get('/loginnew', 'UserController@loginUser');
    // Route::get('/dashboard', 'DashboardController@redersssect');


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], '/login', 'AdminController@login');

    Route::get('/dashboard', 'AdminController@dashboard');



    Route::get('update-password', 'AdminController@updatePassword');
    // Route::post('/logout', 'AdminController@logout');

    // Display CMS Pages (CRUD - READ)
    Route::get('cms-pages', 'CmsController@index');
    Route::match(['get', 'post'], 'update-cms-page-status', 'CmsController@update');
    Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', 'CmsController@edit');
    Route::get('delete-cms-page/{id?}', 'CmsController@destroy');


    //categories
    Route::get('categories', 'AdminController@categories');
    Route::match(['get', 'post'], 'update-category-status', 'CategoryController@updateCategoryStatus');
    // Route::get('delete-category/{id?}', 'CategoryController@deleteCategory');
    Route::get('categories', [CategoryController::class, 'categories']);
    Route::get('delete-category-image/{id?}', 'CategoryController@deleteCategoryImage');
    // Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
    Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);

    //users
    Route::get('users', 'AdminController@users')->name('admin.users');
    Route::match(['get', 'post'], 'add-edit-user/{id?}', 'AdminController@addEditUser');
    // Route::post('save-user', 'AdminController@saveUser')->name('admin.saveUser');
    Route::post('update-user-status', 'AdminController@updateUserStatus');
    Route::get('delete-user/{id}', 'AdminController@deleteUser');



    //products
    Route::get('products', 'AdminController@products');
    Route::get('products', 'ProductsController@products');
    // Route::get('products', [ProductsController::class, 'products']);
    Route::match(['get', 'post'], 'update-product-status', 'ProductsController@updateProductStatus');
    Route::get('delete-product/{id?}', 'ProductsController@deleteProduct') ;
    Route::get('delete-product-image/{id?}', 'ProductsController@deleteProductImage');
    Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct');



    //Attributes
    Route::match(['get', 'post'], 'update-attribute-status', 'ProductsController@updateAttributeStatus');
    Route::get('delete-attribute/{id?}', 'ProductsController@deleteAttribute');


    //Banners
    Route::get('banners', 'AdminController@banners');
    Route::get('banners', 'BannersController@banners');
    Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannersController@addEditBanner');
    Route::get('delete-banner/{id?}', 'BannersController@deleteBanner');
    Route::match(['get', 'post'], 'update-banner-status', 'BannersController@updateBannerStatus');
    Route::get('delete-banner-image/{id?}', 'BannersController@deleteBannerImage');


    //Orders
    Route::get('orders', 'OrderController@orders');
    Route::get('orders/{id}', 'OrderController@orderDetails');
    // Route::get('order_detail', 'OrderController@orderDetails');



    //middleware
    // Route::group(['middleware' => 'admin'], function () {

    // });
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'redersssect'])->name('dashboard');

    // Route::get('/dashboard', 'DashboardController@redersssect');


});



Route::get('payment/{id}/{total}', [StripeController::class, 'session'])->name('stripe.payment');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::get('checkout', [StripeController::class, 'checkout'])->name('checkout');
