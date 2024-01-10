<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\orders;
use App\orders_products;
use App\Product;
use App\imagetable;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
use Session;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
		
		$logo = imagetable::
					 select('img_path')
					 ->where('table_name','=','logo')
					 ->first();
			 
		$favicon = imagetable::
					 select('img_path')
					 ->where('table_name','=','favicon')
					 ->first();	 

		View()->share('logo',$logo);
		View()->share('favicon',$favicon);
		
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
		
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;
			
            if (!empty($keyword)) {
                $product = Product::where('products.product_title', 'LIKE', "%$keyword%")
				->leftjoin('categories', 'products.category', '=', 'categories.id')
                ->orWhere('products.description', 'LIKE', "%$keyword%")
                ->orWhere('products.model', 'LIKE', "%$keyword%")
                ->where('is_deleted', '0')
                ->paginate($perPage);
            } else {
                $product = Product::where('is_deleted', '0')->paginate($perPage);
            }

            return view('admin.product.index', compact('product'));
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
		
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
			
			// $items = Category::all(['id', 'name']);
			$category = Category::where('is_active', '1')->where('deleted_at', null)->where('type', 'parts')->orWhere('type', 'hoods')->pluck('category', 'slug');

			$services = DB::table('sizes')->where('deleted_at', null)->get()->toArray();
            return view('admin.product.create', compact('category', 'services'));
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
	    
	    //echo "<pre>";
	    //print_r($_FILES);
	    //return;
	    
		//dd($_FILES);
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'product_title' => 'required',
            'slug' => ['required', Rule::unique('products')->where('is_active', '1')->where('is_deleted', '0')],
			'short_description' => 'required',
			/*'price' => 'required',*/
			'image' => 'required',
			'category' => 'required',
			'type' => 'required',
			/*'pdf' => 'required',*/

		]);
		
		    $product = new product($request->all());
           $product->sizes = implode(',', $request->sizes);
            $product->is_featured = (!empty($request->is_featured))?$request->is_featured:0;
            $product->is_custom = (!empty($request->is_custom))?$request->is_custom:0;

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $product_path = 'uploads/products/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($product_path) . DIRECTORY_SEPARATOR. $profileImage);

                $product->image = $product_path.$profileImage;
            }


            // file
            if($request->hasFile('file')){
             /* dd('file');*/
                $file = $request->file('file');
                $folderName = '/uploads/products';
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('file')->getClientOriginalName();
                $fileExt = $request->file('file')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $file->move($destinationPath, $safeName);
                $product->file = 'uploads/products/'.$safeName;
            }  

             // pdf
            if($request->hasFile('pdf')){
            
                $pdf = $request->file('pdf');
          
                $folderName = '/uploads/products';
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('pdf')->getClientOriginalName();
                $fileExt = $request->file('pdf')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $pdf->move($destinationPath, $safeName);
                $product->pdf = 'uploads/products/'.$safeName;
               // dd($product->pdf);
            }
            
            if($request->hasFile('instruction_file')){
            
                $instruction_file = $request->file('instruction_file');
          
                $folderName = '/uploads/products';
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('instruction_file')->getClientOriginalName();
                $fileExt = $request->file('instruction_file')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $instruction_file->move($destinationPath, $safeName);
                $product->instruction_file = 'uploads/products/'.$safeName;
               // dd($product->pdf);
            }

             // dd($product);
			 
			 
			 
			 
			 //spec images
			 if ($request->hasFile('chrome_knob_image')) {

                $file = $request->file('chrome_knob_image');
                
                //make sure yo have image folder inside your public
                $product_path = 'uploads/products/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($product_path) . DIRECTORY_SEPARATOR. $profileImage);

                $product->chrome_knob_image = $product_path.$profileImage;
            }
			
			
			if ($request->hasFile('led_lighting_image')) {

                $file = $request->file('led_lighting_image');
                
                //make sure yo have image folder inside your public
                $product_path = 'uploads/products/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($product_path) . DIRECTORY_SEPARATOR. $profileImage);

                $product->led_lighting_image = $product_path.$profileImage;
            }
			
			
			if ($request->hasFile('baffle_filters_image')) {

                $file = $request->file('baffle_filters_image');
                
                //make sure yo have image folder inside your public
                $product_path = 'uploads/products/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($product_path) . DIRECTORY_SEPARATOR. $profileImage);

                $product->baffle_filters_image = $product_path.$profileImage;
            }
			
			
			if ($request->hasFile('implemented_underside_image')) {

                $file = $request->file('implemented_underside_image');
                
                //make sure yo have image folder inside your public
                $product_path = 'uploads/products/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").'-'.time().'-'.$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($product_path) . DIRECTORY_SEPARATOR. $profileImage);

                $product->implemented_underside_image = $product_path.$profileImage;
            }
			 //spec images

            $product->save();
            
            
            
            if(! is_null(request('images'))) {

                $photos=request()->file('images');

                foreach ($photos as $key=> $photo) {

                    $destinationPath = 'uploads/products/';

                    $filename = date("Ymdhis").uniqid().".".$photo->getClientOriginalExtension();
                    Image::make($photo)->save(public_path($destinationPath) . DIRECTORY_SEPARATOR. $filename);

                    DB::table('product_imagess')->insert([ 

                        ['image' => $destinationPath.$filename, 'product_id' => $product->id ] 

                    ]);
                    
                    
                    DB::table('galleries')->insert([ 

                        ['image' => $destinationPath.$filename, 'type' => 'model', 'is_active' => '1', 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now() ] 

                    ]);

                }

            }
            
            
            
            


            if($product->is_custom == '1'){
                return redirect('admin/custom-price/create?id='.$product->id)->with('message', 'Please add customization features.');
            }
            else{
                return redirect('admin/product')->with('message', 'Product added!');
            }
            

            
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $product = Product::findOrFail($id);
            
            $images = DB::table('product_imagess')->where('product_id', $id)->where('is_deleted', '0')->get();
            
            return view('admin.product.show', compact('product', 'images'));
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
		
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $product = Product::findOrFail($id);
			
			$category = Category::where('is_active', '1')->where('deleted_at', null)->where('type', 'parts')->orWhere('type', 'hoods')->pluck('category', 'slug');

			$services = DB::table('sizes')->where('deleted_at', null)->get()->toArray();
			
			
			$product_images = DB::table('product_imagess')

                          ->where('product_id', $id)
                          ->where('is_deleted', '0')

                          ->get();
                          
                          
            return view('admin.product.edit', compact('product','category', 'services', 'product_images'));
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'product_title' => 'required',
            'slug' => ['required', Rule::unique('products')->where('is_active', '1')->where('is_deleted', '0')->ignore($id)],
            'short_description' => 'required',
            /*'price' => 'required',*/
            'category' => 'required',
		]);
		
        
		
        $requestData = $request->all();

        $requestData['is_featured'] = (!empty($request->is_featured))?$request->is_featured:0;
        $requestData['is_custom'] = (!empty($request->is_custom))?$request->is_custom:0;
        $requestData['is_active'] = (!empty($request->is_active))?$request->is_active:0;

        $requestData['sizes'] = implode(',', $request->sizes);
        if ($request->hasFile('image')) {
            
            $product = product::where('id', $id)->first();
            $image_path = public_path($product->image); 
            
            if(File::exists($image_path)) {
                
                // File::delete($image_path);
            } 

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt); 
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/products/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);
            
            $requestData['image'] = 'uploads/products/'.$fileNameToStore;               
        }



        // file
        if($request->hasFile('file')){
                $file = $request->file('file');
                $folderName = '/uploads/products';
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('file')->getClientOriginalName();
                $fileExt = $request->file('file')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $file->move($destinationPath, $safeName);
                $requestData['file'] = 'uploads/products/'.$safeName;
            }  

               if($request->hasFile('pdf')){
                 // dd('pdf');
                $pdf = $request->file('pdf');

                $folderName = '/uploads/products';
               
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('pdf')->getClientOriginalName();
                $fileExt = $request->file('pdf')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $pdf->move($destinationPath, $safeName);
            

                $requestData['pdf'] = 'uploads/products/'.$safeName;

            }
            
            if($request->hasFile('instruction_file')){
                 // dd('instruction_file');
                $instruction_file = $request->file('instruction_file');

                $folderName = '/uploads/products';
               
                $destinationPath = public_path() . $folderName;
                $fileName = $request->file('instruction_file')->getClientOriginalName();
                $fileExt = $request->file('instruction_file')->getClientOriginalExtension();
                $safeName = $fileName.'_'.time().'.'.$fileExt;
                $instruction_file->move($destinationPath, $safeName);
            

                $requestData['instruction_file'] = 'uploads/products/'.$safeName;

            }
            
            
            
            
            
            if(! is_null(request('images'))) {
            $photos=request()->file('images');
            foreach ($photos as $photo) {
                $destinationPath = 'uploads/products/';
                $filename = date("Ymdhis").uniqid().".".$photo->getClientOriginalExtension();

                        //dd($photo,$filename);
                Image::make($photo)->save(public_path($destinationPath) . DIRECTORY_SEPARATOR. $filename);
                DB::table('product_imagess')->insert([
                    ['image' => $destinationPath.$filename, 'product_id' => $id ]
                ]);
                
                DB::table('galleries')->insert([ 

                        ['image' => $destinationPath.$filename, 'type' => 'model', 'is_active' => '1', 'product_id' => $id ] 

                    ]);
                    
                    
            }
        }
		
		
		
		
		
		
		//spec images
		if ($request->hasFile('chrome_knob_image')) {
            
            $product = product::where('id', $id)->first();
            $image_path = public_path($product->chrome_knob_image); 
            
            if(File::exists($image_path)) {
                
                // File::delete($image_path);
            } 

            $file = $request->file('chrome_knob_image');
            $fileNameExt = $request->file('chrome_knob_image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt); 
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('chrome_knob_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/products/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);
            
            $requestData['chrome_knob_image'] = 'uploads/products/'.$fileNameToStore;               
        }
		
		
		if ($request->hasFile('led_lighting_image')) {
            
            $product = product::where('id', $id)->first();
            $image_path = public_path($product->led_lighting_image); 
            
            if(File::exists($image_path)) {
                
                // File::delete($image_path);
            } 

            $file = $request->file('led_lighting_image');
            $fileNameExt = $request->file('led_lighting_image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt); 
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('led_lighting_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/products/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);
            
            $requestData['led_lighting_image'] = 'uploads/products/'.$fileNameToStore;               
        }
		
		
		if ($request->hasFile('baffle_filters_image')) {
            
            $product = product::where('id', $id)->first();
            $image_path = public_path($product->baffle_filters_image); 
            
            if(File::exists($image_path)) {
                
                // File::delete($image_path);
            } 

            $file = $request->file('baffle_filters_image');
            $fileNameExt = $request->file('baffle_filters_image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt); 
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('baffle_filters_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/products/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);
            
            $requestData['baffle_filters_image'] = 'uploads/products/'.$fileNameToStore;               
        }
		
		
		if ($request->hasFile('implemented_underside_image')) {
            
            $product = product::where('id', $id)->first();
            $image_path = public_path($product->implemented_underside_image); 
            
            if(File::exists($image_path)) {
                
                // File::delete($image_path);
            } 

            $file = $request->file('implemented_underside_image');
            $fileNameExt = $request->file('implemented_underside_image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt); 
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('implemented_underside_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/products/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);
            
            $requestData['implemented_underside_image'] = 'uploads/products/'.$fileNameToStore;               
        }
		
		//spec images
        
        
        
        
        

            $products = product::findOrFail($id);
            $products->update($requestData); 


            if($products->is_custom == '1'){
                $check_record = DB::table('custom_prices')->where('product_id', $products->id)->first();

                if($check_record != ''){ //edit
                    return redirect('admin/product')->with('message', 'Product updated!');
                    // return redirect('admin/custom-price/'.$check_record->id.'/edit?id='.$products->id)->with('message', 'Product Updated!');
                }
                else{  //create
                    return redirect('admin/custom-price/create?id='.$products->id)->with('message', 'Please add customization features.');
                }
                
                
            }
            else{
                return redirect('admin/product')->with('message', 'Product updated!');
            }
                

             
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            
            $update['is_deleted'] = '1';
            Product::where('id', $id)->update($update);


            return redirect('admin/product')->with('message', 'Product deleted!');
        }
        return response(view('403'), 403);

    }
	public function orderList() {
	
		$orders = orders::
				    select('orders.*')
				   ->get();
		  		   
		return view('admin.ecommerce.order-list', compact('orders'));
	}
	
	public function orderListDetail($id) {
		
		$order_id = $id;
		$order = orders::where('id',$order_id)->first();
		$order_products = orders_products::where('orders_id',$order_id)->get();
		
	
		
		return view('admin.ecommerce.order-page')->with('title','Invoice #'.$order_id)->with(compact('order','order_products'))->with('order_id',$order_id);
		
		// return view('admin.ecommerce.order-page');	
	}	
	 
	public function updatestatuscompleted($id) {
		
		$order_id = $id;
		$order = DB::table('orders')
              ->where('id', $id)
              ->update(['order_status' => 'Completed']);
		
	
		Session::flash('message', 'Order Status Updated Successfully'); 
						Session::flash('alert-class', 'alert-success'); 
						return back();
	
	}
	public function updatestatusPending($id) {
		
		$order_id = $id;
		$order = DB::table('orders')
              ->where('id', $id)
              ->update(['order_status' => 'Pending']);
		
	
		Session::flash('message', 'Order Status Updated Successfully'); 
						Session::flash('alert-class', 'alert-success'); 
						return back();
	
	}	
	
	
	
	// multi image delete
    public function destroyImage($id)
    {
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            
            $record = DB::table('product_imagess')->where('id', $id)->first();
          
            
            $update['is_deleted'] = '1';
            DB::table('product_imagess')->where('id', $id)->update($update);
            
            
            
            // galleries
            $updateGallery['deleted_at'] = now();
            DB::table('galleries')->where('product_id', $record->product_id)->update($updateGallery);

            return back()->with('message', 'Image deleted!');
        }
        return response(view('403'), 403);

    }




    // get specific type's categories
    public function typeCategory()
    {

        if($_POST['type_id'] == 'part'){
            $categories = DB::table('categories')->where('type', 'parts')->where('is_active', '1')->where('deleted_at', null)->get()->toArray();
        }
        elseif($_POST['type_id'] == 'product'){
            $categories = DB::table('categories')->where('type', 'hoods')->where('is_active', '1')->where('deleted_at', null)->get()->toArray();
        }
        
        $list = array();
        if(isset($categories) AND count($categories) > 0) {
            foreach($categories as $key=>$value) {
                $list[$value->slug] = $value->category;
            }
        }

        $json_param = array();
        $json_param['list'] = $list;
        $json_param['status'] = true;
        echo json_encode($json_param);
    }
	
}
