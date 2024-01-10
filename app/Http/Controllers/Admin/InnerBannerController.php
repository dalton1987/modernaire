<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\InnerBanner;
use Illuminate\Http\Request;
use Image;
use File;

class InnerBannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $innerbanner = InnerBanner::where('title', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $innerbanner = InnerBanner::paginate($perPage);
            }

            return view('admin.inner-banner.index', compact('innerbanner'));
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
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.inner-banner.create');
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
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'image' => 'required'
		]);

            $innerbanner = new innerbanner($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $innerbanner_path = 'uploads/innerbanners/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($innerbanner_path) . DIRECTORY_SEPARATOR. $profileImage);

                $innerbanner->image = $innerbanner_path.$profileImage;
            }
            
            $innerbanner->save();

            return redirect('admin/inner-banner')->with('message', 'Inner banner added!');
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
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $innerbanner = InnerBanner::findOrFail($id);
            return view('admin.inner-banner.show', compact('innerbanner'));
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
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $innerbanner = InnerBanner::findOrFail($id);
            return view('admin.inner-banner.edit', compact('innerbanner'));
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
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			
		]);
            $requestData = $request->all();
            

        if ($request->hasFile('image')) {
            
            $innerbanner = innerbanner::where('id', $id)->first();
            $image_path = public_path($innerbanner->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/innerbanners/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/innerbanners/'.$fileNameToStore;               
        }


            $innerbanner = InnerBanner::findOrFail($id);
             $innerbanner->update($requestData);

             return redirect('admin/inner-banner')->with('message', 'Inner banner updated!');
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
        $model = str_slug('innerbanner','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            InnerBanner::destroy($id);

            return redirect('admin/inner-banner')->with('message', 'Inner banner deleted!');
        }
        return response(view('403'), 403);

    }
}
