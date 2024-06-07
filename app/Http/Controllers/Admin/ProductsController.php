<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function products()
    {
        Session::put('page','products');
        $products = Product::with('category')->get()->toArray();
       // dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = $data['status'] == "Active" ? 0 : 1;
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Product has been deleted successfully!');
    }

    public function addEditProduct(Request $request, $id = null)
{
    if ($id == "") {
        $title = "Add Product";
        $product = new Product;
        $message = "Product added successfully!";
    } else {
        $title = "Edit Product";
        $product = Product::with(['attributes'])->find($id);
        $message = "Product updated successfully!";
    }

    if ($request->isMethod('post')) {
        $data = $request->all();
        
        // Validation rules and custom messages
        $rules = [
            'category_id' => 'required',
            'product_name' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
            'url' => 'required|unique:products,url,' . ($id ?? 'NULL') . ',id',
            'product_code' => 'required|regex:/^[\w-]*$/|max:30',
            'product_price' => 'required|numeric',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $customMessages = [
            'category_id.required' => 'Category is required',
            'product_name.required' => 'Product Name is required',
            'product_name.regex' => 'Valid Product Name is required',
            'product_name.max' => 'Product Name must be less than 200 characters',
            'url.required' => 'Product URL is required',
            'url.unique' => 'Product URL already exists. Please try another.',
            'product_code.required' => 'Product Code is required',
            'product_code.regex' => 'Valid Product Code is required',
            'product_code.max' => 'Product Code must be less than 30 characters',
            'product_price.required' => 'Product Price is required',
            'product_price.numeric' => 'Valid Product Price is required',
            'product_image.image' => 'Product Image must be an image file',
        ];

        $this->validate($request, $rules, $customMessages);

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $image_tmp = $request->file('product_image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $imageName = rand(111, 99999) . '.' . $extension;
                $imageFolder = 'front/images/products/';
                $imagePath = $imageFolder . $imageName;

                if (!file_exists($imageFolder)) {
                    mkdir($imageFolder, 0755, true);
                }

                $image_tmp->move($imageFolder, $imageName);
                $product->product_image = $imageName;
            }
        } else {
            if (!empty($data['current_product_image'])) {
                $product->product_image = $data['current_product_image'];
            } else {
                $product->product_image = "";
            }
        }

        // Set product data
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->url = $data['url'];
        $product->product_code = $data['product_code'];
        $product->product_color = $data['product_color'];
        $product->family_color = $data['family_color'];
        $product->product_price = $data['product_price'];
        $product->search_keywords = $data['search_keywords'];
        $product->product_discount = $data['product_discount'];

        if (!empty($data['product_discount']) && is_numeric($data['product_discount']) && $data['product_discount'] > 0) {
            $product->discount_type = 'product';
            $product->final_price = $data['product_price'] - ($data['product_price'] * $data['product_discount'] / 100);
        } else {
            $getCategoryDiscount = Category::select('category_discount')->where('id', $data['category_id'])->first();
            if ($getCategoryDiscount && is_numeric($getCategoryDiscount['category_discount']) && $getCategoryDiscount['category_discount'] > 0) {
                $product->discount_type = '';
                $product->final_price = $data['product_price'] - ($data['product_price'] * $getCategoryDiscount['category_discount'] / 100);
            } else {
                $product->final_price = $data['product_price'];
            }
        }
        

       $product->description = $data['description'];
        $product->meta_title = $data['meta_title'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];
        $product->search_keywords = $data['search_keywords'];
        $product->is_featured = isset($data['is_featured']) ? 'Yes' : 'No';
        $product->status = 1;
        $product->save();

        // Add Product Attributes
        if (!empty($data['sku'])) {
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    // SKU already exists check
                    $countSKU = ProductsAttribute::where('sku', $value)->count();
                    if ($countSKU > 0) {
                        return redirect()->back()->with('error_message', 'SKU already exists. Please try another SKU.');
                    }

                    // Size already exists check
                    $countSize = ProductsAttribute::where(['product_id' => $product->id, 'size' => $data['size'][$key]])->count();
                    if ($countSize > 0) {
                        return redirect()->back()->with('error_message', 'Size already exists. Please add another Size.');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $product->id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->uk_size = $data['uk_size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
        }

        // Edit Product Attributes
        if (!empty($data['attributeId'])) {
            foreach ($data['attributeId'] as $akey => $attributeId) {
                if (!empty($attributeId)) {
                    ProductsAttribute::where('id', $attributeId)->update([
                        'price' => $data['price'][$akey],
                        'stock' => $data['stock'][$akey],
                    ]);
                }
            }
        }

        return redirect('admin/products')->with('success_message', $message);
    }

    $getCategories = Category::getCategories();

    return view('admin.products.add_edit_product')->with(compact('title', 'getCategories', 'product'));
}


    public function deleteProductImage($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error_message', 'Product not found.');
        }

        $productImagePath = public_path('front/images/products/' . $product->product_image);
        if (file_exists($productImagePath) && is_file($productImagePath)) {
            if (unlink($productImagePath)) {
                $product->product_image = null;
                $product->save();
                return redirect()->back()->with('success_message', 'Product Image has been deleted successfully!');
            } else {
                return redirect()->back()->with('error_message', 'Failed to delete product image.');
            }
        } else {
            return redirect()->back()->with('warning_message', 'Product image not found.');
        }
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = $data['status'] == "Active" ? 0 : 1;
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function deleteAttribute($id)
    {
        // delete attribute
        ProductsAttribute::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Attribute has been deleted successfully!');
    }


    

}
