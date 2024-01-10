<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Review;
use Illuminate\Http\Request;
use Image;
use File;

class ReviewController extends Controller
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $review = Review::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('comments', 'LIKE', "%$keyword%")
                ->orWhere('star', 'LIKE', "%$keyword%")
                ->where('product_id', $_GET['id'])
                ->where('is_deleted', '0')
                ->paginate($perPage);
            } else {
                $review = Review::where('is_deleted', '0')->where('product_id', $_GET['id'])->paginate($perPage);
            }

            return view('admin.review.index', compact('review'));
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.review.create');
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'designation' => 'required',
			'comment' => 'required|max:290'
		]);

            $review = new Review($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $review_path = 'uploads/reviews/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($review_path) . DIRECTORY_SEPARATOR. $profileImage);

                $review->image = $review_path.$profileImage;
            }
            
            $review->save();

            return redirect('admin/review')->with('message', 'Testimonial added!');
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $review = Review::findOrFail($id);
            return view('admin.review.show', compact('review'));
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $review = Review::findOrFail($id);
            return view('admin.review.edit', compact('review'));
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'designation' => 'required',
			'comment' => 'required|max:290'
		]);
            $requestData = $request->all();

            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;

            

        if ($request->hasFile('image')) {
            
            $review = Review::where('id', $id)->first();
            $image_path = public_path($review->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/reviews/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/reviews/'.$fileNameToStore;               
        }


            $review = Review::findOrFail($id);
             $review->update($requestData);

             return redirect('admin/review')->with('message', 'Review updated!');
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
        $model = str_slug('review','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            
            $update['is_deleted'] = '1';
            Review::where('id', $id)->update($update);

            return redirect()->back()->with('message', 'Review deleted!');
        }
        return response(view('403'), 403);

    }




    public function updatestatusactive($id) {
        
        \DB::table('reviews')
              ->where('id', $id)
              ->update(['is_active' => '1']);
        
    
        \Session::flash('message', 'Status Updated!'); 
                        \Session::flash('alert-class', 'alert-success'); 
                        return back();
    
    }
    public function updatestatusinactive($id) {
        
        \DB::table('reviews')
              ->where('id', $id)
              ->update(['is_active' => '0']);
        
    
        \Session::flash('message', 'Status Updated!'); 
                        \Session::flash('alert-class', 'alert-success'); 
                        return back();
    
    }


}
