<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FileManagement;
use Illuminate\Http\Request;
use Image;
use File;

class FileManagementController extends Controller
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $filemanagement = FileManagement::where('title', 'LIKE', "%$keyword%")
                ->orWhere('file', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $filemanagement = FileManagement::paginate($perPage);
            }

            return view('admin.file-management.index', compact('filemanagement'));
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.file-management.create');
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'file' => 'required'
		]);

            $filemanagement = new filemanagement($request->all());

            // if ($request->hasFile('image')) {

            //     $file = $request->file('image');
                
            //     //make sure yo have image folder inside your public
            //     $filemanagement_path = 'uploads/filemanagements/';
            //     $fileName = $file->getClientOriginalName();
            //     $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

            //     Image::make($file)->save(public_path($filemanagement_path) . DIRECTORY_SEPARATOR. $profileImage);

            //     $filemanagement->image = $filemanagement_path.$profileImage;
            // }
            
            
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                //make sure yo have image folder inside your public
                $resume_path = 'uploads/filemanagements/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();
                $request->file->move(public_path('uploads/filemanagements/'), $profileImage);
                $filemanagement->file = $resume_path.$profileImage;
            }
            
            
            
            $filemanagement->save();

            return redirect('admin/file-management')->with('message', 'File added!');
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $filemanagement = FileManagement::findOrFail($id);
            return view('admin.file-management.show', compact('filemanagement'));
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $filemanagement = FileManagement::findOrFail($id);
            return view('admin.file-management.edit', compact('filemanagement'));
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'file' => 'required'
		]);
            $requestData = $request->all();
            

        if ($request->hasFile('image')) {
            
            $filemanagement = filemanagement::where('id', $id)->first();
            $image_path = public_path($filemanagement->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/filemanagements/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/filemanagements/'.$fileNameToStore;               
        }
        
        
        if ($request->hasFile('file')) {
                $file = $request->file('file');
                //make sure yo have image folder inside your public
                $resume_path = 'uploads/filemanagements/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();
                $request->file->move(public_path('uploads/filemanagements/'), $profileImage);
                $requestData['file'] = $resume_path.$profileImage;
            }


            $filemanagement = FileManagement::findOrFail($id);
             $filemanagement->update($requestData);

             return redirect('admin/file-management')->with('message', 'File updated!');
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
        $model = str_slug('filemanagement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FileManagement::destroy($id);

            return redirect('admin/file-management')->with('message', 'File deleted!');
        }
        return response(view('403'), 403);

    }
}
