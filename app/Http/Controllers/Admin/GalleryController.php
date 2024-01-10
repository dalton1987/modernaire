<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Gallery;
use Illuminate\Http\Request;
use Image;
use File;
use DB;

class GalleryController extends Controller
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $gallery = Gallery::where('image', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $gallery = Gallery::paginate($perPage);
            }

            return view('admin.gallery.index', compact('gallery'));
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {

            $gallery_options = DB::table('options')->where('deleted_at',null)->get();
           // dd($gallery);
            return view('admin.gallery.create',compact('gallery_options'));
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'image' => 'required'
		]);

            $gallery = new gallery($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $gallery_path = 'uploads/gallery/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($gallery_path) . DIRECTORY_SEPARATOR. $profileImage);

                $gallery->image = $gallery_path.$profileImage;
            }
            
            $gallery->save();

            return redirect('admin/gallery')->with('message', 'Gallery added!');
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $gallery = Gallery::findOrFail($id);
            return view('admin.gallery.show', compact('gallery'));
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $gallery = Gallery::findOrFail($id);
            $gallery_options = DB::table('options')->where('deleted_at',null)->get();
            return view('admin.gallery.edit', compact('gallery','gallery_options'));
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			
		]);
            $requestData = $request->all();

            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
            

        if ($request->hasFile('image')) {
            
            $gallery = gallery::where('id', $id)->first();
            $image_path = public_path($gallery->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/gallery/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/gallery/'.$fileNameToStore;               
        }


            $gallery = Gallery::findOrFail($id);
             $gallery->update($requestData);

             return redirect('admin/gallery')->with('message', 'Gallery updated!');
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
        $model = str_slug('gallery','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Gallery::destroy($id);

            return redirect('admin/gallery')->with('message', 'Gallery deleted!');
        }
        return response(view('403'), 403);

    }
}
