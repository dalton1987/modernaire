<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Dealer;
use Illuminate\Http\Request;
use Image;
use File;
use DB;

class DealerController extends Controller
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $dealer = Dealer::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('model_nuber', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('service', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $dealer = Dealer::paginate($perPage);
            }

            return view('admin.dealer.index', compact('dealer'));
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $service = DB::table('services')->where('deleted_at',null)->where('is_active',1)->get();
    
            return view('admin.dealer.create',compact('service'));
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'latitude' => 'required',
            'longitude' => 'required',
		
			
			//'image' => 'required'
		]);

            $dealer = new dealer($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $dealer_path = 'uploads/dealers/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($dealer_path) . DIRECTORY_SEPARATOR. $profileImage);

                $dealer->image = $dealer_path.$profileImage;
            }
            $dealer->save();
              

            return redirect('admin/dealer')->with('message', 'Dealer added!');
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $dealer = Dealer::findOrFail($id);
            return view('admin.dealer.show', compact('dealer'));
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $dealer = Dealer::findOrFail($id);
        $service = DB::table('services')->where('deleted_at',null)->where('is_active',1)->get();
    
            return view('admin.dealer.edit', compact('dealer','service'));
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'latitude' => 'required',
            'longitude' => 'required',
	/*		'address' => 'required',
			'phone' => 'required',
			'model_number' => 'required',*/
			
		]);
            $requestData = $request->all();
             $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;

        if ($request->hasFile('image')) {
            
            $dealer = dealer::where('id', $id)->first();
            $image_path = public_path($dealer->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/dealers/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/dealers/'.$fileNameToStore;               
        }


            $dealer = Dealer::findOrFail($id);
             $dealer->update($requestData);

             return redirect('admin/dealer')->with('message', 'Dealer updated!');
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
        $model = str_slug('dealer','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Dealer::destroy($id);

            return redirect('admin/dealer')->with('message', 'Dealer deleted!');
        }
        return response(view('403'), 403);

    }
}
