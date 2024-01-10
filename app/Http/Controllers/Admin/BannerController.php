<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\imagetable;
use App\Banner;
use Illuminate\Http\Request;
use Image;
use File;

class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $logo = imagetable::
                     select('img_path')
                     ->where('table_name','=','logo')
                     ->first();
             
        $favicon = imagetable::
                     select('img_path')
                     ->where('table_name','=','favicon')
                     ->first();  

        View()->share('logo',$logo);
        View()->share('favicon',$favicon);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $banner = Banner::where('title', 'LIKE', "%$keyword%")
                ->where('is_deleted', '0')
                ->paginate($perPage);
            } else {
                $banner = Banner::where('is_deleted', '0')->paginate($perPage);
            }

            return view('admin.banner.index', compact('banner'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.banner.create');
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:10000'
		]);


            $banner = new Banner($request->all());

            // main image
            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $banner_path = 'uploads/banner/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").time().$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($banner_path) . DIRECTORY_SEPARATOR. $profileImage);

                $banner->image = $banner_path.$profileImage;
            }


            $banner->save();
           
            return redirect('admin/banner')->with('message', 'Banner added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $banner = Banner::findOrFail($id);
            return view('admin.banner.show', compact('banner'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $banner = Banner::findOrFail($id);


            return view('admin.banner.edit', compact('banner'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
            'title' => 'required',
        ]);


        $requestData = $request->all();

        $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
        
            
        // image
        if ($request->hasFile('image')) {
            
            $banner = Banner::where('id', $id)->first();
            $image_path = public_path($banner->image); 
            
            if(File::exists($image_path)) {
                // File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/banner/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/banner/'.$fileNameToStore;               
        }


        $banner = Banner::findOrFail($id);
             $banner->update($requestData);

       
        session()->flash('message', 'Banner updated!');
        return redirect('admin/banner');
            }
            return response(view('403'), 403);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
       $model = str_slug('banner','-');
       if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            
            $update['is_deleted'] = '1';
            Banner::where('id', $id)->update($update);

            return redirect('admin/banner')->with('message', 'Banner deleted!');
       }
       return response(view('403'), 403);

    }
}
