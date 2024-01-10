<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CustomPrice;
use Illuminate\Http\Request;
use Image;
use File;

class CustomPriceController extends Controller
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
        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $customprice = CustomPrice::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('attribute_id', 'LIKE', "%$keyword%")
                ->orWhere('value_price', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customprice = CustomPrice::paginate($perPage);
            }

            return view('admin.custom-price.index', compact('customprice'));
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
        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.custom-price.create');
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
        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'product_id' => 'required',
			'attribute_id' => 'required',
			'attribute_value_price' => 'required'
		]);

            $customprice = new customprice($request->all());

            $customprice->value_price = $request->attribute_value_price;

            
            
            $customprice->save();

            return redirect('admin/product')->with('message', 'Record added!');
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
        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customprice = CustomPrice::findOrFail($id);
            return view('admin.custom-price.show', compact('customprice'));
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
        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customprice = CustomPrice::findOrFail($id);
            return view('admin.custom-price.edit', compact('customprice'));
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

        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'product_id' => 'required',
            'attribute_id' => 'required',
            'attribute_value_price' => 'required'
		]);
            $requestData = $request->all();
            
            $requestData['value_price'] = $request->attribute_value_price;
       


            $customprice = CustomPrice::findOrFail($id);
             $customprice->update($requestData);

             return redirect('admin/product')->with('message', 'Record updated!');
             // return redirect('admin/custom-price')->with('message', 'CustomPrice updated!');
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
        $model = str_slug('customprice','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CustomPrice::destroy($id);

            return redirect('admin/custom-price')->with('message', 'CustomPrice deleted!');
        }
        return response(view('403'), 403);

    }
}
