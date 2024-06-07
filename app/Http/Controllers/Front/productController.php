<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use stdClass;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        // $TotalRecordCount;
        if ($categoryCount > 0) {
            // echo "Category Page";

            // Get Category Details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);

            //Get Category and their Sub Category Products
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

            //Product Filtering
            if ($request->has('orderby') && !empty($request->orderby)) {
                $orderby = $request->orderby;
                switch ($orderby) {
                    case 'product_latest':
                        $categoryProducts = $categoryProducts->orderBy('id', 'DESC');
                        break;
                    case 'lowest_price':
                        $categoryProducts = $categoryProducts->orderBy('final_price', 'ASC');
                        break;
                    case 'highest_price':
                        $categoryProducts = $categoryProducts->orderBy('final_price', 'DESC');
                        break;
                        // case 'best_popular':
                        //     $categoryProducts = $categoryProducts->orderBy('popularity', 'DESC');
                        //     break;
                        // case 'best_rating':
                        //     $categoryProducts = $categoryProducts->orderBy('rating', 'DESC');
                        //     break;
                    case 'featured_products':
                        $categoryProducts = $categoryProducts->where('is_featured', 'Yes');
                        break;
                    case 'discounted_products':
                        $categoryProducts = $categoryProducts->whereNotNull('product_discount')->orderBy('product_discount', 'DESC');
                        break;
                    default:
                        break;
                }
            }

            //Filter Products by Color
            // $categoryProducts = Product::query();

            if ($request->has('color') && !empty($request->color)) {
                $categoryProducts->where('family_color', $request->color);
            }


            //Filter Products by Size

            if ($request->has('size') && !empty($request->size)) {
                $categoryProducts->join('product_attributes', function ($join) {
                    $join->on('product_attributes.product_id', '=', 'products.id');
                })
                    ->whereIn('products_attributes.size', $request->size);
            }

            $TotalRecordCount = $categoryProducts->count();
            $categoryProducts = $categoryProducts->paginate(12);

            return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'TotalRecordCount', 'url'));
        } else {
            abort(404);
        }
    }




    public function detail($id)
    {
        $productDetails = Product::with(['category', 'attributes'])->find($id);
        // dd($productDetails);
        // Get Category Details
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);

        // dd($productDetails['category']['id'], $categoryDetails);

        // dd(Product::where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->inRandomOrder()->limit(6)->get());

        //Get related products
        $relatedProducts = Product::where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->inRandomOrder()->limit(6)->get();
        // dd($relatedProducts);

        $getAttributePrice = ProductsAttribute::GetProductDetailsBySize($id, 'S');
        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails', 'relatedProducts'));
    }

    public function getAttributePrices(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getAttributePrice = ProductsAttribute::getProductDetailsBySize($data['product_id'], $data['size']);
            return response()->json($getAttributePrice);
        }
    }




    public function checkout(Request $request)
    {
        // Get user cart items
        $getCartItems = Cart::userCartItems();

        // Get user orders
        $userOrders = Orders::userOrders();

        return view('front.products.checkout', compact('getCartItems', 'userOrders'));
    }


}
