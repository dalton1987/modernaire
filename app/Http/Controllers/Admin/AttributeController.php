<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Attribute;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Validation\Rule;


class AttributeController extends Controller
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $attribute = Attribute::where('attribute', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $attribute = Attribute::paginate($perPage);
            }

            return view('admin.attribute.index', compact('attribute'));
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.attribute.create');
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'attribute' => 'required',
			'slug' => ['required', Rule::unique('attributes')->where('is_active', '1')->where('deleted_at', null)],
		]);

            $attribute = new attribute($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $attribute_path = 'uploads/attributes/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($attribute_path) . DIRECTORY_SEPARATOR. $profileImage);

                $attribute->image = $attribute_path.$profileImage;
            }
            
            $attribute->save();

            // return redirect('admin/attribute')->with('message', 'Attribute added!');
            return redirect('admin/attribute-value/create?id='.$attribute->id)->with('message', 'Attribute added. Please add its values!');
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $attribute = Attribute::findOrFail($id);
            return view('admin.attribute.show', compact('attribute'));
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $attribute = Attribute::findOrFail($id);
            return view('admin.attribute.edit', compact('attribute'));
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'attribute' => 'required',
			'slug' => ['required', Rule::unique('attributes')->where('is_active', '1')->where('deleted_at', null)->ignore($id)],
		]);
            $requestData = $request->all();

            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;

            

        if ($request->hasFile('image')) {
            
            $attribute = attribute::where('id', $id)->first();
            $image_path = public_path($attribute->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/attributes/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/attributes/'.$fileNameToStore;               
        }


            $attribute = Attribute::findOrFail($id);
             $attribute->update($requestData);

             return redirect('admin/attribute')->with('message', 'Attribute updated!');
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
        $model = str_slug('attribute','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Attribute::destroy($id);

            return redirect('admin/attribute')->with('message', 'Attribute deleted!');
        }
        return response(view('403'), 403);

    }
}
