<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Video;
use Illuminate\Http\Request;
use Image;
use File;

class VideoController extends Controller
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $video = Video::where('designed_by', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $video = Video::paginate($perPage);
            }

            return view('admin.video.index', compact('video'));
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.video.create');
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'designed_by' => 'required',
			'location' => 'required',
            'video' => 'required',
			'thumbnail' => 'required',
		]);

            $video = new video($request->all());


            // thumbnail
            if ($request->hasFile('thumbnail')) {

                $file = $request->file('thumbnail');
                
                //make sure yo have image folder inside your public
                $podcast_path = 'uploads/videos/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($podcast_path) . DIRECTORY_SEPARATOR. $profileImage);

                $video->thumbnail = $podcast_path.$profileImage;
            }

            // video
            if($request->hasFile('video')){
                $file = $request->file('video');
                $folderName = '/uploads/videos';
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('video')->getClientOriginalName();
                $fileExt = $request->file('video')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $file->move($destinationPath, $safeName);
                $video->video = 'uploads/videos/'.$safeName;
            }
            
            $video->save();

            return redirect('admin/video')->with('message', 'Video added!');
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $video = Video::findOrFail($id);
            return view('admin.video.show', compact('video'));
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $video = Video::findOrFail($id);
            return view('admin.video.edit', compact('video'));
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'designed_by' => 'required',
			'location' => 'required',
			'video' => 'required'
		]);
            $requestData = $request->all();
            

        // video
            if($request->hasFile('video')){
                $file = $request->file('video');
                $folderName = '/uploads/videos';
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('video')->getClientOriginalName();
                $fileExt = $request->file('video')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $file->move($destinationPath, $safeName);
                $requestData['video'] = 'uploads/videos/'.$safeName;
            }


            // thumbnail
        if ($request->hasFile('thumbnail')) {
            
            $vudei = Video::where('id', $id)->first();
            $image_path = public_path($video->thumbnail); 
            
            if(File::exists($image_path)) {
                // File::delete($image_path);
            }

            $file = $request->file('thumbnail');
            $fileNameExt = $request->file('thumbnail')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('thumbnail')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/videos/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['thumbnail'] = 'uploads/videos/'.$fileNameToStore;               
        }


            $video = Video::findOrFail($id);
             $video->update($requestData);

             return redirect('admin/video')->with('message', 'Video updated!');
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
        $model = str_slug('video','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Video::destroy($id);

            return redirect('admin/video')->with('message', 'Video deleted!');
        }
        return response(view('403'), 403);

    }
}
