<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\GalleryCategory;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Validation\Rule;

class GalleryCategoryController extends Controller
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $gallerycategory = GalleryCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $gallerycategory = GalleryCategory::paginate($perPage);
            }

            return view('admin.gallery-category.index', compact('gallerycategory'));
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.gallery-category.create');
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'slug' => ['required', Rule::unique('categories')->where('is_active', '1')->where('deleted_at', null)],
		]);

            $gallerycategory = new gallerycategory($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $gallerycategory_path = 'uploads/gallerycategorys/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($gallerycategory_path) . DIRECTORY_SEPARATOR. $profileImage);

                $gallerycategory->image = $gallerycategory_path.$profileImage;
            }
            
            $gallerycategory->save();

            return redirect('admin/gallery-category')->with('message', 'Category added!');
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $gallerycategory = GalleryCategory::findOrFail($id);
            return view('admin.gallery-category.show', compact('gallerycategory'));
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $gallerycategory = GalleryCategory::findOrFail($id);
            return view('admin.gallery-category.edit', compact('gallerycategory'));
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'slug' => ['required', Rule::unique('categories')->where('is_active', '1')->where('deleted_at', null)->ignore($id)],
		]);
            $requestData = $request->all();
            
            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;

            

        if ($request->hasFile('image')) {
            
            $gallerycategory = gallerycategory::where('id', $id)->first();
            $image_path = public_path($gallerycategory->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/gallerycategorys/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/gallerycategorys/'.$fileNameToStore;               
        }


            $gallerycategory = GalleryCategory::findOrFail($id);
             $gallerycategory->update($requestData);

             return redirect('admin/gallery-category')->with('message', 'Category updated!');
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
        $model = str_slug('gallerycategory','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            GalleryCategory::destroy($id);

            return redirect('admin/gallery-category')->with('message', 'Category deleted!');
        }
        return response(view('403'), 403);

    }
}
