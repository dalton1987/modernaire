<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Service;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Validation\Rule;
class ServiceController extends Controller
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
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $service = Service::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $service = Service::paginate($perPage);
            }

            return view('admin.service.index', compact('service'));
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
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.service.create');
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
        
        
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
            'slug' => ['required', Rule::unique('services')->where('is_active', '1')->where('deleted_at', null)],
            'representative_location' => 'required'
		]);

            $service = new service($request->all());
            
            $service->representative_location = implode(',', $_POST['representative_location']);

            
            $data = json_encode($request->representative);
            $service->representative = $data;
            

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $service_path = 'uploads/services/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($service_path) . DIRECTORY_SEPARATOR. $profileImage);

                $service->image = $service_path.$profileImage;
            }
            
            $service->save();

            return redirect('admin/service')->with('message', 'Service added!');
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
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $service = Service::findOrFail($id);
            return view('admin.service.show', compact('service'));
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
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $service = Service::findOrFail($id);
            return view('admin.service.edit', compact('service'));
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
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
            'slug' => ['required', Rule::unique('services')->where('is_active', '1')->where('deleted_at', null)->ignore($id)],
            'representative_location' => 'required'
		]);
            $requestData = $request->all();
            
            $requestData['representative_location'] = implode(',', $_POST['representative_location']);
            
            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
             
             $rep = $request->representative;
            
             foreach($rep as $key=>$value){

                 if(empty($value[name]) && empty($value[email]) && empty($value[phone])){
                     unset($rep[$key]);
                 }
             }
             
            
             
             $data = json_encode($rep);
             $requestData['representative'] = $data;
            


        if ($request->hasFile('image')) {
            
            $service = service::where('id', $id)->first();
            $image_path = public_path($service->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/services/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/services/'.$fileNameToStore;               
        }


            $service = Service::findOrFail($id);
             $service->update($requestData);

             return redirect('admin/service')->with('message', 'Service updated!');
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
        $model = str_slug('service','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Service::destroy($id);

            return redirect('admin/service')->with('message', 'Service deleted!');
        }
        return response(view('403'), 403);

    }
}
