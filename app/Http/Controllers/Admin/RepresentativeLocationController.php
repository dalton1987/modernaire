<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RepresentativeLocation;
use Illuminate\Http\Request;
use Image;
use File;

class RepresentativeLocationController extends Controller
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $representativelocation = RepresentativeLocation::where('Name', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $representativelocation = RepresentativeLocation::paginate($perPage);
            }

            return view('admin.representative-location.index', compact('representativelocation'));
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.representative-location.create');
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'Name' => 'required'
		]);

            $representativelocation = new representativelocation($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $representativelocation_path = 'uploads/representativelocations/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($representativelocation_path) . DIRECTORY_SEPARATOR. $profileImage);

                $representativelocation->image = $representativelocation_path.$profileImage;
            }
            
            $representativelocation->save();

            return redirect('admin/representative-location')->with('message', 'Location added!');
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $representativelocation = RepresentativeLocation::findOrFail($id);
            return view('admin.representative-location.show', compact('representativelocation'));
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $representativelocation = RepresentativeLocation::findOrFail($id);
            return view('admin.representative-location.edit', compact('representativelocation'));
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'Name' => 'required'
		]);
            $requestData = $request->all();
            
            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
            
            

        if ($request->hasFile('image')) {
            
            $representativelocation = representativelocation::where('id', $id)->first();
            $image_path = public_path($representativelocation->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/representativelocations/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/representativelocations/'.$fileNameToStore;               
        }


            $representativelocation = RepresentativeLocation::findOrFail($id);
             $representativelocation->update($requestData);

             return redirect('admin/representative-location')->with('message', 'Location updated!');
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
        $model = str_slug('representativelocation','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RepresentativeLocation::destroy($id);

            return redirect('admin/representative-location')->with('message', 'Location deleted!');
        }
        return response(view('403'), 403);

    }
}
