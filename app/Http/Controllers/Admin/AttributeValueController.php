<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\AttributeValue;
use Illuminate\Http\Request;
use Image;
use File;

class AttributeValueController extends Controller
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $attributevalue = AttributeValue::where('value', 'LIKE', "%$keyword%")
                ->where('attribute_id', $_GET['id'])
                ->paginate($perPage);
            } else {
                $attributevalue = AttributeValue::where('attribute_id', $_GET['id'])->paginate($perPage);
            }

            return view('admin.attribute-value.index', compact('attributevalue'));
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.attribute-value.create');
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'value' => 'required'
		]);

            $attributevalue = new attributevalue($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $attributevalue_path = 'uploads/attributevalues/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($attributevalue_path) . DIRECTORY_SEPARATOR. $profileImage);

                $attributevalue->image = $attributevalue_path.$profileImage;
            }
            
            $attributevalue->save();

            return redirect('admin/attribute-value?id='.$attributevalue->attribute_id)->with('message', 'Value added!');
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $attributevalue = AttributeValue::findOrFail($id);
            return view('admin.attribute-value.show', compact('attributevalue'));
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $attributevalue = AttributeValue::findOrFail($id);
            return view('admin.attribute-value.edit', compact('attributevalue'));
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'value' => 'required'
		]);
            $requestData = $request->all();
            

        if ($request->hasFile('image')) {
            
            $attributevalue = attributevalue::where('id', $id)->first();
            $image_path = public_path($attributevalue->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/attributevalues/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/attributevalues/'.$fileNameToStore;               
        }


            $attributevalue = AttributeValue::findOrFail($id);
             $attributevalue->update($requestData);

             return redirect('admin/attribute-value?id='.$request->attribute_id)->with('message', 'AttributeValue updated!');
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
        $model = str_slug('attributevalue','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            AttributeValue::destroy($id);

            return redirect('admin/attribute-value?id='.$_GET['id'])->with('message', 'AttributeValue deleted!');
        }
        return response(view('403'), 403);

    }
}
