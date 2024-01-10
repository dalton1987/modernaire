<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\faq;
use Illuminate\Http\Request;
use Image;
use File;

class faqController extends Controller
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $faq = faq::where('question', 'LIKE', "%$keyword%")
                ->orWhere('Answer', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $faq = faq::paginate($perPage);
            }

            return view('admin.faq.index', compact('faq'));
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.faq.create');
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'question' => 'required',
			'Answer' => 'required'
		]);

            $faq = new faq($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $faq_path = 'uploads/faqs/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($faq_path) . DIRECTORY_SEPARATOR. $profileImage);

                $faq->image = $faq_path.$profileImage;
            }
            
            $faq->save();

            return redirect('admin/faq')->with('message', 'faq added!');
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $faq = faq::findOrFail($id);
            return view('admin.faq.show', compact('faq'));
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $faq = faq::findOrFail($id);
            return view('admin.faq.edit', compact('faq'));
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'question' => 'required',
			'Answer' => 'required'
		]);
            $requestData = $request->all();
            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
        

        if ($request->hasFile('image')) {
            
            $faq = faq::where('id', $id)->first();
            $image_path = public_path($faq->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/faqs/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/faqs/'.$fileNameToStore;               
        }


            $faq = faq::findOrFail($id);
             $faq->update($requestData);

             return redirect('admin/faq')->with('message', 'faq updated!');
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
        $model = str_slug('faq','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            faq::destroy($id);

            return redirect('admin/faq')->with('message', 'faq deleted!');
        }
        return response(view('403'), 403);

    }
}
