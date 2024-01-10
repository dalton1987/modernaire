<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Category;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $category = Category::where('category', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $category = Category::paginate($perPage);
            }

            return view('admin.category.index', compact('category'));
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('admin.category.create');
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'category' => 'required',
			'slug' => ['required', Rule::unique('categories')->where('is_active', '1')->where('deleted_at', null)],
		]);

            $category = new category($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $category_path = 'uploads/categorys/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($category_path) . DIRECTORY_SEPARATOR. $profileImage);

                $category->image = $category_path.$profileImage;
            }
            
            $category->save();

            return redirect('admin/category')->with('message', 'Category added!');
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $category = Category::findOrFail($id);
            return view('admin.category.show', compact('category'));
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $category = Category::findOrFail($id);
            return view('admin.category.edit', compact('category'));
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'category' => 'required',
			'slug' => ['required', Rule::unique('categories')->where('is_active', '1')->where('deleted_at', null)->ignore($id)],
		]);
            $requestData = $request->all();

            $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;
            

        if ($request->hasFile('image')) {
            
            $category = category::where('id', $id)->first();
            $image_path = public_path($category->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/categorys/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/categorys/'.$fileNameToStore;               
        }


            $category = Category::findOrFail($id);
             $category->update($requestData);

             return redirect('admin/category')->with('message', 'Category updated!');
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Category::destroy($id);

            return redirect('admin/category')->with('message', 'Category deleted!');
        }
        return response(view('403'), 403);

    }
}
