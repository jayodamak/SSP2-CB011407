<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Image;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page','categories');
        $categories = Category::with('parentcategory')->get();
        return view('admin.categories.categories')->
        with(compact('categories'));
    }


    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            } 
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }


    public function deleteCategory($id)
    {
        //Delete Category
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Category has been deleted successfully!');
    }


    public function addEditCategory(Request $request, $id=null){
        $getCategories = Category::getcategories();
        if($id==""){
            // Add Category
            $title = "Add Category";
            $category = new Category;
            $message = "Category added successfully!";
        }else{
            // Edit Category
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category updated successfully!";
        }
    
        if($request->isMethod('POST')){
            $data = $request->all();
            
            // Validation Rules
            if($id==""){
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required|unique:categories',
                ];
            }else{
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required',
                ];
            }
            
            $customMessages = [
                'category_name.required' => 'Category Name is required',
                'url.required' => 'Category URL is required',
                'url.unique' => 'Category URL already exists. Please try another.',
            ];
    
            $this->validate($request, $rules, $customMessages);
    
            // Upload Category Image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imageFolder = 'front/images/categories/'.$imageName;
                    
                    // Create directory if it doesn't exist
                    if (!file_exists($imageFolder)) {
                        mkdir($imageFolder, 0755, true);
                    }
    
                    // Save the category Image
                    $image_tmp->move($imageFolder, $imageName);
                    $category->category_image = $imageName;
                }
            } else {
                // When editing, retain the existing image if no new image is uploaded
                if(!empty($data['current_category_image'])){
                    $category->category_image = $data['current_category_image'];
                } else {
                    $category->category_image = "";
                }
            }
    
            if(empty($data['category_discount'])){
                $data['category_discount'] = 0;
            }
    
            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message', $message);
        }
        return view('admin.categories.add_edit_category')->with(compact('title', 'getCategories', 'category'));
    }



    public function deleteCategoryImage($id)
    {
        // Validate category ID
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->back()->with('error_message', 'Invalid category ID.');
        }
    
        // Get Category Image
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with('error_message', 'Category not found.');
        }
    
        // Get Category Image Path
        $categoryImagePath = public_path('front/images/categories/'.$category['category_image'].'/'.$category->category_image);
    
        // Check if the image file exists and it's a file, not a directory
        if (file_exists($categoryImagePath) && is_file($categoryImagePath)) {
            // Attempt to delete the image file
            if (unlink($categoryImagePath)) {
                // Update category record to remove image reference
                $category->category_image = null;
                $category->save();
    
                return redirect()->back()->with('success_message', 'Category Image has been deleted successfully!');
            } else {
                return redirect()->back()->with('error_message', 'Failed to delete category image.');
            }
        } else {
            // Image file doesn't exist or it's not a file
            return redirect()->back()->with('warning_message', 'Category image not found.');
        }
    }
    
    
    

}
