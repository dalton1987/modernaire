<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Category;
use App\Motoroption;
use Illuminate\Http\Request;
use Image;
use File;
use DB;

class MotoroptionController extends Controller
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $motoroption = Motoroption::where('title', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $motoroption = Motoroption::paginate($perPage);
            }

            return view('admin.motoroption.index', compact('motoroption'));
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {

            // $category = Category::pluck('category', 'slug');
            $category = DB::table('categories')->where('deleted_at', NULL)->where('type' , 'motor-option')->where('is_active', 1)->get();
            return view('admin.motoroption.create', compact('category'));
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'image' => 'required',
			'description' => 'required',
            'category' => 'required',
		]);

            $motoroption = new motoroption($request->all());
			
			$motoroption->is_active = (!empty($request->is_active))?$request->is_active:0;

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $motoroption_path = 'uploads/motoroptions/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($motoroption_path) . DIRECTORY_SEPARATOR. $profileImage);

                $motoroption->image = $motoroption_path.$profileImage;
            }
            
            $motoroption->save();

            return redirect('admin/motoroption')->with('message', 'Motoroption added!');
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $motoroption = Motoroption::findOrFail($id);
             $category = DB::table('categories')->where('deleted_at', NULL)->where('type' , 'motor-option')->where('is_active', 1)->get();
            return view('admin.motoroption.show', compact('motoroption', 'category'));
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $motoroption = Motoroption::findOrFail($id);
            $category = DB::table('categories')->where('deleted_at', NULL)->where('type' , 'motor-option')->where('is_active', 1)->get();
            return view('admin.motoroption.edit', compact('motoroption','category'));
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			/*'image' => 'required',*/
			'description' => 'required'
		]);
            $requestData = $request->all();
			
			$requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
            

        if ($request->hasFile('image')) {
            
            $motoroption = motoroption::where('id', $id)->first();
            $image_path = public_path($motoroption->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/motoroptions/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/motoroptions/'.$fileNameToStore;               
        }


            $motoroption = Motoroption::findOrFail($id);
             $motoroption->update($requestData);

             return redirect('admin/motoroption')->with('message', 'Motoroption updated!');
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
        $model = str_slug('motoroption','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Motoroption::destroy($id);

            return redirect('admin/motoroption')->with('message', 'Motoroption deleted!');
        }
        return response(view('403'), 403);

    }
}
