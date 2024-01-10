<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Testimonial;
use Illuminate\Http\Request;
use Image;
use File;
use DB;


class TestimonialController extends Controller
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $testimonial = Testimonial::where('title', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $testimonial = Testimonial::paginate($perPage);
            }

            return view('admin.testimonial.index', compact('testimonial'));
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.testimonial.create');
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'designation' => 'required',
			'comment' => 'required|max:290'
		]);

            $testimonial = new testimonial($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $testimonial_path = 'uploads/testimonials/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($testimonial_path) . DIRECTORY_SEPARATOR. $profileImage);

                $testimonial->image = $testimonial_path.$profileImage;
            }
            
            $testimonial->save();

            return redirect('admin/testimonial')->with('message', 'Testimonial added!');
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $testimonial = Testimonial::findOrFail($id);
            return view('admin.testimonial.show', compact('testimonial'));
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $testimonial = Testimonial::findOrFail($id);
            return view('admin.testimonial.edit', compact('testimonial'));
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'designation' => 'required',
			'comment' => 'required|max:290'
		]);
            $requestData = $request->all();

            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;

            

        if ($request->hasFile('image')) {
            
            $testimonial = testimonial::where('id', $id)->first();
            $image_path = public_path($testimonial->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/testimonials/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/testimonials/'.$fileNameToStore;               
        }


            $testimonial = Testimonial::findOrFail($id);
             $testimonial->update($requestData);

             return redirect('admin/testimonial')->with('message', 'Testimonial updated!');
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Testimonial::destroy($id);

            return redirect('admin/testimonial')->with('message', 'Testimonial deleted!');
        }
        return response(view('403'), 403);

    }
    
    
    
    // adminapprove/disapprove story
    public function showReview(){
        
        if($_GET['type'] == '1'){
            $update['flag_value'] = '1';
            
            DB::table('m_flag')->where('id', '1400')->update($update);

            return redirect()->back()->with('message', 'Testimonials section shown!');
        
        }
        elseif($_GET['type'] == '0'){
            $update['flag_value'] = '0';
            
            DB::table('m_flag')->where('id', '1400')->update($update);

            return redirect()->back()->with('message', 'Testimonials section hidden!');
        }
        
        
    }
    
    
    
    
}
