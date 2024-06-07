<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'cms-pages');
        $CmsPages = CmsPage::get()->toArray();
        // dd($cmsPages);
        return view('admin.pages.cms_pages')->with(compact('CmsPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        $CmsPages = CmsPage::get()->toArray();
        if($id==""){
            $title = "Add CMS Page";
            $cmspage = new CmsPage;
            $message = "CMS Page added successfully!";
        }else{
            $title = "Edit CMS Page";
            // Fetch the existing CMS page if editing
            $cmspage = CmsPage::find($id);
            $message = "CMS Page updated successfully!";
        }

        if($request->isMethod('post')){
           $data = $request->all();

           //CMS pages Validations
           $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required',
           ];
              $customMessages = [
                 'title.required' => 'Title is required',
                 'url.required' => 'URL is required',
                 'description.required' => 'Description is required',
              ];
                $this->validate($request, $rules, $customMessages);

                // Assign form data to the CMS page model
                $cmspage->title = $data['title'];
                $cmspage->url = $data['url'];
                $cmspage->description = $data['description'];
                $cmspage->meta_title = $data['meta_title'];
                $cmspage->meta_description = $data['meta_description'];
                $cmspage->meta_keywords = $data['meta_keywords'];
                $cmspage->status = 1;
                $cmspage->save();
                return redirect('admin/cms-pages')->with('success_message',$message);
        }

        return view('admin.pages.add_edit_cmspage')->with(compact('title', 'cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            } 
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //Delete CMS page
        CmsPage::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'CMS Page has been deleted successfully!');
    }
}
