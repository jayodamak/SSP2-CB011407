<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;

class BannersController extends Controller
{
    public function banners()
    {
        Session::put('page', 'banners');
        $banners = Banner::all();
        return view('admin.banners.banners', compact('banners'));
    }

    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = $data['status'] == "Active" ? 0 : 1;
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
        Banner::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Banner has been deleted successfully!');
    }

    public function addEditBanner(Request $request, $id = null)
    {
        if (is_null($id)) {
            $title = "Add Banner";
            $banner = new Banner;
            $message = "Banner added successfully!";
        } else {
            $title = "Edit Banner";
            $banner = Banner::find($id);
            $message = "Banner updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Validation rules
            $rules = [
                'type' => 'required',
                // 'button' => 'required',
                'sort' => 'required|integer',
            ];

            if (is_null($id)) {
                $rules['banner_image'] = 'required|image';
                $rules['banner_image_dark'] = 'required|image';
            }

            $customMessages = [
                'type.required' => 'Banner Type is required',
                // 'button.required' => 'Button is required',
                'sort.required' => 'Sort order is required',
                'banner_image.required' => 'Banner Image for Light Mode is required',
                'banner_image.image' => 'Banner Image for Light Mode must be an image file',
                'banner_image_dark.required' => 'Banner Image for Dark Mode is required',
                'banner_image_dark.image' => 'Banner Image for Dark Mode must be an image file',
            ];

            $this->validate($request, $rules, $customMessages);

            // Handle light mode image upload
            if ($request->hasFile('banner_image')) {
                $image_tmp = $request->file('banner_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imageFolder = 'front/images/banners/';
                    $imagePath = $imageFolder . $imageName;

                    if (!file_exists($imageFolder)) {
                        mkdir($imageFolder, 0755, true);
                    }

                    $image_tmp->move($imageFolder, $imageName);
                    $banner->banner_image = $imageName;
                }
            }

            // Handle dark mode image upload
            if ($request->hasFile('banner_image_dark')) {
                $image_tmp = $request->file('banner_image_dark');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imageFolder = 'front/images/banners/';
                    $imagePath = $imageFolder . $imageName;

                    if (!file_exists($imageFolder)) {
                        mkdir($imageFolder, 0755, true);
                    }

                    $image_tmp->move($imageFolder, $imageName);
                    $banner->banner_image_dark = $imageName;
                }
            }

            // Assign form data to the banner model
            $banner->type = $data['type'];
            $banner->heading = $data['heading'] ?? '';
            $banner->title = $data['title'] ?? '';
            $banner->description = $data['description'] ?? '';
            $banner->button = $data['button'];
            $banner->link = $data['link'] ?? '';
            $banner->alt = $data['alt'] ?? '';
            $banner->sort = $data['sort'];
            $banner->status = 1;

            $banner->save();

            return redirect('admin/banners')->with('success_message', $message);
        }

        return view('admin.banners.add_edit_banner', compact('title', 'banner'));
    }





    
    public function deleteBannerImage($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->back()->with('error_message', 'Banner not found.');
        }

        $bannerImagePath = public_path('front/images/banners/' . $banner->banner_image);
        $bannerImageDarkPath = public_path('front/images/banners/' . $banner->banner_image_dark);

        $imageDeleted = false;
        $darkImageDeleted = false;

        // Delete light mode image
        if (file_exists($bannerImagePath) && is_file($bannerImagePath)) {
            if (unlink($bannerImagePath)) {
                $banner->banner_image = 'default-image.jpg';
                $imageDeleted = true;
            }
        } else {
            return redirect()->back()->with('warning_message', 'Banner light mode image not found.');
        }

        // Delete dark mode image
        if (file_exists($bannerImageDarkPath) && is_file($bannerImageDarkPath)) {
            if (unlink($bannerImageDarkPath)) {
                $banner->banner_image_dark = 'default-image-dark.jpg';
                $darkImageDeleted = true;
            }
        } else {
            return redirect()->back()->with('warning_message', 'Banner dark mode image not found.');
        }

        $banner->save();

        if ($imageDeleted && $darkImageDeleted) {
            return redirect()->back()->with('success_message', 'Both Banner Images have been deleted successfully!');
        } elseif ($imageDeleted) {
            return redirect()->back()->with('success_message', 'Banner light mode image has been deleted successfully!');
        } elseif ($darkImageDeleted) {
            return redirect()->back()->with('success_message', 'Banner dark mode image has been deleted successfully!');
        } else {
            return redirect()->back()->with('error_message', 'Failed to delete both Banner images.');
        }
    }
}
