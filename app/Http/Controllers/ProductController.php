<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inquiry;

use App\newsletter;
use App\Program;
use App\imagetable;
use SoapClient;
use App\Product;
use App\Category;
use App\Banner;
use DB;
use View;
use Session;
use App\Http\Traits\HelperTrait;
use App\orders;
use App\orders_products;


class ProductController extends Controller
{	
	use HelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 // use Helper;
	 
    public function __construct()
    {
         //$this->middleware('auth');
        $logo = imagetable::
                     select('img_path')
                     ->where('table_name','=','logo')
                     ->first();

        $footer_logo = imagetable::
                     select('img_path')
                     ->where('table_name','=','footer_logo')
                     ->first();
             
        $favicon = imagetable::
                     select('img_path')
                     ->where('table_name','=','favicon')
                     ->first(); 
        
        View()->share('logo',$logo);
        View()->share('footer_logo',$footer_logo);
        View()->share('favicon',$favicon);
        //View()->share('config',$config);
    }
	
	// public function index()
 //    {
	// 	 $products = new Product; 	
	// 	 if(isset($_GET['q']) && $_GET['q'] != '') {
			
	// 		$keyword = $_GET['q'];
			
	// 		$products = $products->where(function($query)  use ($keyword) {
	// 						$query->where('product_title', 'like', $keyword);
	// 					 });
	// 	 }	 
	// 	$products = $products->orderBy('id','asc')->get();
	// 	return view('products',['products'=>$products]); 
		
	// }

	// public function productDetail($id) {
		 
	// 	 $product = new Product; 
	// 	 $product_detail = $product->where('id',$id)->first();
	// 	 $products = DB::table('products')->get()->take(10);
	// 	 return view('product_detail',['product_detail'=>$product_detail, 'products'=>$products]); 
		
	// }

	public function shop()
    {
    	// META TAGS
        $pageTitle = 'Hoods';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '5')->first();   


        $categories = DB::table('categories')->where('type', 'hoods')->where('deleted_at', null)->where('is_active', '1')->get();


       
 	
		 // if(isset($_GET['q']) && $_GET['q'] != '') {
			
			// $keyword = $_GET['q'];
			
			// $shop = DB::table('products')
   //              ->where('product_title', 'like', '%'.$keyword.'%')
   //              ->get()->toArray();
		 // }	 
		 // else{
   //      $shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->paginate(12);
   //      }

    	if(isset($_GET['q']) && $_GET['q'] != '') {
			
			$keyword = $_GET['q'];
			
			$shop = DB::table('products')
                ->where('product_title', 'like', '%'.$keyword.'%')
                ->where('is_active', '1')
                ->where('is_deleted', '0')
                ->orderBy('product_title', 'ASC')
                ->paginate(12);
		 }	

		 // RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 

		 	if($_GET['range'] == 'less_25'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->where('price', '<', '25')->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->whereBetween('price', ['25', '50'])->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->whereBetween('price', ['50', '75'])->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->whereBetween('price', ['75', '100'])->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->where('price', '>', '100')->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 }

		 else{


		 	$shop = DB::table('products')->where('is_deleted', '0')->where('type', 'product')->where('is_active', '1')
		 	// ->orderBy('id', 'DESC')
		 	->orderBy('product_title', 'ASC')
		 	->paginate(12);

        }
        


        return view('shop.product_listing', compact('shop', 'pageTitle', 'pagedescription', 'pagetags', 'banner', 'categories'));
    }

    	public function Part()
    {
    	// META TAGS
        $pageTitle = 'Parts';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '14')->first();   


        $categories = DB::table('categories')->where('type', 'parts')->where('deleted_at', null)->where('is_active', '1')->get();


       
 	
		 // if(isset($_GET['q']) && $_GET['q'] != '') {
			
			// $keyword = $_GET['q'];
			
			// $shop = DB::table('products')
   //              ->where('product_title', 'like', '%'.$keyword.'%')
   //              ->get()->toArray();
		 // }	 
		 // else{
   //      $shop = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->paginate(12);
   //      }

    	if(isset($_GET['q']) && $_GET['q'] != '') {
			
			$keyword = $_GET['q'];
			
			$shop = DB::table('products')
                ->where('product_title', 'like', '%'.$keyword.'%')
                ->where('is_active', '1')
                ->where('is_deleted', '0')
                ->where('type', 'part')
                ->orderBy('product_title', 'ASC')
                ->paginate(12);
		 }	

		 // RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 

		 	if($_GET['range'] == 'less_25'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('type', 'part')->where('is_deleted', '0')->where('price', '<', '25')->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('type', 'part')->where('is_deleted', '0')->whereBetween('price', ['25', '50'])->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('type', 'part')->where('is_deleted', '0')->whereBetween('price', ['50', '75'])->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('type', 'part')->where('is_deleted', '0')->whereBetween('price', ['75', '100'])->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		$shop = DB::table('products')->where('is_active', '1')->where('type', 'part')->where('is_deleted', '0')->where('price', '>', '100')->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 }

		 else{


		 	$shop = DB::table('products')->where('is_deleted', '0')->where('type', 'part')->where('is_active', '1')
		 	// ->orderBy('id', 'DESC')
		 	->orderBy('product_title', 'ASC')
		 	->paginate(12);
		 	//dd($shop);

        }
        


        return view('shop.product_listing', compact('shop', 'pageTitle', 'pagedescription', 'pagetags', 'banner', 'categories'));
    }


  //   public function shopDetail($id)
  //   {
		//  $product = new Product; 
		//  $product_detail = $product->where('id',$id)->first();
		//  // $english_content = DB::table('contents')->where('id', 1)->first();
		//  // $arabic_content = DB::table('contents')->where('id', 2)->first();

  //       $shop = DB::table('products')->where('id', $id)->first();
		// // $language = Session::get('language');
		// // $testimonial = DB::table('testimonials')->get();
		// // $faqs = DB::table('faqs')->get()->toArray();
		// // $faqs = array_chunk($faqs, 2);
		// $products = DB::table('products')->get()->take(10);
  //       return view('shop.product_details', ['shop'=> $shop, 'language'=> $language, 'english_content'=> $english_content, 'arabic_content'=> $arabic_content, 'faqs'=> $faqs, 'testimonial'=> $testimonial, 'product_detail'=>$product_detail,'products'=>$products ]);
  //   }

    public function shopDetail($slug)
    { 
        // META TAGS
        $pageTitle = 'Product Details';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '7')->first();  

    
        	$product = DB::table('products')->where('slug', $slug)->where('is_active', '1')->where('is_deleted', '0')->first();
        	
        
        	$reviews = DB::table('reviews')->where('product_id', $product->id)->orderBy('id', 'DESC')->where('is_deleted', '0')->where('is_active', '1')->get();
       

	        // star rating
			$sum = 0;
			for($counter= 0; $counter < count($reviews); $counter++){
			  $sum = $sum + $reviews[$counter]->star;
			}
			if($sum > 0){
			  $averageRatings = round($sum/$counter);
			}
			else{
			  $averageRatings = 0;
			}
			// star rating
        
        return view('shop.product_details', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'product', 'averageRatings', 'reviews'));
    }
	
	public function categoryDetail($slug) {
	    
	    // META TAGS
        $pageTitle = 'Hoods';
        $pagedescription = '';
        $pagetags = '';
        
        
			/*dd('test');	*/
		$banner = DB::table('inner_banners')->where('id', '5')->first();
    // 	$categories = DB::table('categories')->where('deleted_at', null)->get();
    	$categories = DB::table('categories')->where('type', 'hoods')->where('deleted_at', null)->where('is_active', '1')->get();

		if(isset($_GET['q']) && $_GET['q'] != '') {
			
			$keyword = $_GET['q'];
			
			$shop = DB::table('products')
                ->where('product_title', 'like', '%'.$keyword.'%')
                ->where('is_deleted', '0')
                ->where('is_active', '1')
                ->where('category', '=', $slug)
                ->orderBy('product_title', 'ASC')
                ->paginate(12);
		 }

		 // RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 	if($_GET['range'] == 'less_25'){
		 		$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->where('price', '<', '25')->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->where('price', '>', '100')->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}

		 }

		else{
			$shop = DB::table('products')->where('category', '=', $slug)->where('is_active', '1')->where('is_deleted', '0')->orderBy('product_title', 'ASC')->paginate(12);
		}
       
		return view('shop.product_listing',compact('shop', 'banner', 'categories', 'pageTitle', 'pagedescription', 'pagetags'));
		
	}

///parts category detail//
	public function partscategoryDetail($slug) {
	
		$banner = DB::table('inner_banners')->where('id', '14')->first();
    // 	$categories = DB::table('categories')->where('deleted_at', null)->get();
    	$categories = DB::table('categories')->where('type', 'parts')->where('deleted_at', null)->where('is_active', '1')->get();

		if(isset($_GET['q']) && $_GET['q'] != '') {
			
			$keyword = $_GET['q'];
			
			$shop = DB::table('products')
                ->where('product_title', 'like', '%'.$keyword.'%')
                ->where('is_deleted', '0')
                ->where('is_active', '1')
                ->where('type','part')
                ->where('category', '=', $slug)
                ->orderBy('product_title', 'ASC')
                ->paginate(12);
		 }

		 // RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 	if($_GET['range'] == 'less_25'){
		 		$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->where('price', '<', '25')->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('is_active', '1')->where('price', '>', '100')->where('category', '=', $slug)->orderBy('product_title', 'ASC')->paginate(12);
		 	}

		 }

		else{
			$shop = DB::table('products')->where('type','part')->where('category', '=', $slug)->where('is_active', '1')->where('is_deleted', '0')->orderBy('product_title', 'ASC')->paginate(12);
		}
       
		return view('shop.product_listing',compact('shop', 'banner', 'categories'));
		
	}


	// MUSIC
	public function music()
    { 
        $banner = DB::table('inner_banners')->where('id', '5')->first();
        $music = DB::table('music')->where('deleted_at', null)->get();

        return view('shop.music', compact('banner', 'music'));
    } 
	

	public function cart() {
		$cartCount=COUNT(Session::get('cart'));
		$language = Session::get('language');
		$product_detail = DB::table('products')->first();
		if(Session::get('cart') && count(Session::get('cart'))>0) {
		    // dd(Session::get('cart'));
			return view('shop.cart',['cart'=>Session::get('cart'),'language'=>$language,'product_detail'=>$product_detail]);
						
		} else {
			Session::flash('flash_message', 'No product found!'); 
			Session::flash('alert-class', 'alert-success'); 
			return redirect('/');
		}
		
    }
	
	public function saveCart() {

			$result = array();
			
			
			$id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
			$qty = isset($_POST['quantity']) ? intval($_POST['quantity']) : '1';
			$size = isset($_POST['sizes']) ? intval($_POST['sizes']) : '0';
			$cart = array();
			$cartId = $id;
			if(Session::has('cart')){

				$cart = Session::get('cart');
			}
			

				$product_detail = DB::table('products')->where('id', $_POST['product_id'])->first();
				$product_name = $product_detail->product_title;
			
				if($_POST['is_custom'] == '0'){
					$price = $product_detail->price;
				}
				else{
					$price = $_POST['price'];
					$custom_attribute = $_POST['custom_attribute'];
					$custom_value = $_POST['custom_value'];
					$custom_price = $_POST['custom_price'];
				}
				

			
			if($id!=""&&intval($qty)>0) {

				if(array_key_exists($cartId,$cart)){
					unset($cart[$cartId]);
				}
						$productFirstrow = Product::where('id',$id)->first(); 
				
						

						if($_POST['is_custom'] == '0'){
							$cart[$cartId]['id'] = $id;
							// $cart[$cartId]['name'] = $productFirstrow->product_title;
							$cart[$cartId]['name'] = $product_name;
							$cart[$cartId]['baseprice'] = $price;
							$cart[$cartId]['qty'] = $qty;
							$cart[$cartId]['sizes'] = $size;
						}
						else{
							$cart[$cartId]['id'] = $id;
							// $cart[$cartId]['name'] = $productFirstrow->product_title;
							$cart[$cartId]['name'] = $product_name;
							$cart[$cartId]['baseprice'] = $price;
							$cart[$cartId]['qty'] = $qty;
                            $cart[$cartId]['sizes'] = $size;
                            
							$cart[$cartId]['custom_attribute'] = $custom_attribute;
							$cart[$cartId]['custom_value'] = $custom_value;
							$cart[$cartId]['custom_price'] = $custom_price;
						}


				
						Session::put('cart',$cart);

						Session::flash('message', 'Product added to cart successfully!'); 
						Session::flash('alert-class', 'alert-success'); 
						return redirect('/cart');
					
				
			} else {
				Session::flash('flash_message', 'Sorry! You can not proceed with 0 quantity!'); 
				Session::flash('alert-class', 'alert-success');
				return back();	
				
			}
		
	}
	
	public function updateCart()
    {

			$cartExist = Session::get('cart');
			$result = array();
			$cart = array();
			$j = 0;
			foreach($_POST['product_id'] as $product_id) {					
		
				$productFirstrow = Product::where('id',$product_id)->first();

				$title = $productFirstrow->product_title;
				

				
				// $price = $productFirstrow->price;
				$price = $cartExist[$product_id]['baseprice'];
				
					   
				
				$cart[$product_id]['id'] = $product_id;
				$cart[$product_id]['name'] = $title;
				$cart[$product_id]['baseprice'] = $price;
				$cart[$product_id]['qty'] = $_POST['qty'][$j];
				$cart[$product_id]['type'] = $_POST['type'][$j];
						
				$j++;
				
			}

			
			
			Session::put('cart',$cart);
			
			Session::flash('message', 'Your cart updated successfully!'); 
			Session::flash('alert-class', 'alert-success'); 
			
			return back();
			
	}
	
	
	public function removeCart($id) {
		
		//$id = isset($_POST['ArrayofArrays'][0]) ? $_POST['ArrayofArrays'][0] : '';

		if($id!=""){

			if(Session::has('cart')){

				$cart = Session::get('cart');

			}

			if(array_key_exists($id,$cart)){

				unset($cart[$id]);

			}

			Session::put('cart',$cart);

		}

		// echo 'success';
		Session::flash('flash_message', 'Product item removed successfully!'); 
		Session::flash('alert-class', 'alert-success');
		return back();	

  }
	
    

    
	

	public function invoice($id)
    {
		
		$order_id = $id;
		$order = orders::where('id',$order_id)->first();
		$order_products = orders_products::where('orders_id',$order_id)->get();
		
		return view('account.invoice')->with('title','Invoice #'.$order_id)->with(compact('order','order_products'))->with('order_id',$order_id);; 
	}	

	public function checkout() {
		

		
		if(Session::get('cart') && count(Session::get('cart'))>0) {
			$countries = DB::table('countries')
									->get();
			return view('checkout',['cart'=>Session::get('cart'),'countries'=>$countries]);
						
		} else {
			Session::flash('flash_message', 'No Product found'); 
			Session::flash('alert-class', 'alert-success'); 
			return redirect('/');
		}
		
    }
	

    public function language()
    {
		$languages = $_POST['id'];
	
		Session::put('language',$languages);
		
		Session::put('is_select_dropdown',1);	
		// Session::put('language',$languages);
		// $test = Session::get('language');
		
		// Session::put('test',$test);
		
		//return redirect('shop-detail/1', ['test'=>$test]);
    }	
	
	public function shipping (Request $request) {
		
		$PostalCode = $request->country; // Zipcode you are shipping To
		
		define("ENV","demo"); // demo OR live

		if(ENV == 'demo') {
			$client = new SoapClient("https://staging.postaplus.net/APIService/PostaWebClient.svc?wsdl");    
			$Password =  '123456';
			$ShipperAccount =  'DXB51487';
			$UserName =  'DXB51487';
			$CodeStation =  'DXB';
		}
		else {
			$client = new SoapClient("https://etrack.postaplus.net/APIService/PostaWebClient.svc?singleWsdl");
			$Password =  '';
			$ShipperAccount =  '';
			$UserName =  '';
			$CodeStation =  '';
		}

		$params = array(
			'ShipmentCostCalculation' => array(
				'CI' => array(
					'Password' => $Password,
					'ShipperAccount' => $ShipperAccount,
					'UserName' => $UserName,
					'CodeStation' => $CodeStation,
					),
				"OriginCountryCode" => 'AE',
				"DestinationCountryCode" => $PostalCode,
				"RateSheetType" => 'DOC',
				"Width" => 1,
				"Height" => 1,
				"Length" => 1,
				"ScaleWeight" => 1,
			),
		);


		try{
			
			$d = $client->__SoapCall("ShipmentCostCalculation", $params);
			$d = json_decode(json_encode($d), true);
			
			if(isset($d['ShipmentCostCalculationResult']['Message']) AND ($d['ShipmentCostCalculationResult']['Message'] == 'SUCCESS')) {
				$status = true;
				$rate = $d['ShipmentCostCalculationResult']['Amount'];
			}
			else {
				$status = false;
				$messgae = $d['ShipmentCostCalculationResult']['Message'];
			}
		}
		catch (SoapFault $exception) {
			$status = false;
			$messgae = "Error Found Please try Again";
		}
	
		//if($status):
		//	echo $rate;
		//else:
		//	echo $messgae;
		//endif;
						
		//}
		//$cart = Session::get('cart');
		
		
		
		if($status) {
		    
		    $cart = Session::get('cart');	
			$cart['shipping'] = $rate;
			//$cart['shipping_address'] = $_POST['shipping_address'];
			Session::put('cart',$cart); 
			
			// return view('shop.cart', ['rate'=> $rate, 'cart'=> $cart]);
			return redirect('/cart');
						
		} else {
			Session::flash('flash_message', 'Error'); 
			Session::flash('alert-class', 'alert-success'); 
			return view('shop.cart', ['messgae'=> $messgae]);
		}
	return view('shop.cart', ['messgae'=> $messgae, 'cart'=> $cart]);
	
}	


// PRODUCT SORTING
public function productSort($sort)
    {

    	// categories
    // 	$categories = DB::table('categories')->where('deleted_at', null)->get();
    	$categories = DB::table('categories')->where('type', 'parts')->where('deleted_at', null)->where('is_active', '1')->get();
    	
    	$banner = DB::table('inner_banners')->where('id', '14')->first();
    	
		

		if(isset($_GET['q']) && $_GET['q'] != '') {

			$keyword = $_GET['q'];



			if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'DESC')->paginate(12);
				}
				

			}

		}

		// RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 	if($_GET['range'] == 'less_25'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('price', 'DESC')->paginate(12);
				}
		 	}

		 }

		else{
			if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'DESC')->paginate(12);
				}
				

			}
		}	 
	        

        
        
        return view('shop.product_listing',compact('shop', 'categories', 'banner'));
    }




    // productsCategorySort
	public function productsCategorySort($category, $sort){

		// category id
		$cat = DB::table('categories')->where('slug', $category)->first();

		// categories
        // $categories = DB::table('categories')->where('deleted_at', null)->get();
        $categories = DB::table('categories')->where('type', 'hoods')->where('deleted_at', null)->where('is_active', '1')->get();
        

        $banner = DB::table('inner_banners')->where('id', '5')->first();


        if(isset($_GET['q']) && $_GET['q'] != '') {
			
			$keyword = $_GET['q'];
		

			if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
			}

		 }

		 // RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 	if($_GET['range'] == 'less_25'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}

		 }


		 else{
		 	if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
			}
		}


		
        
        return view('shop.product_listing',compact('shop', 'categories', 'banner'));

	}


	// Parts SORTING
public function PartSort($sort)
    {	//dd($sort);

    	// categories
    // 	$categories = DB::table('categories')->where('deleted_at', null)->get();
    $categories = DB::table('categories')->where('type', 'parts')->where('deleted_at', null)->where('is_active', '1')->get();
    
    	$banner = DB::table('inner_banners')->where('id', '14')->first();
    		// /dd('test');
		

		if(isset($_GET['q']) && $_GET['q'] != '') {

			$keyword = $_GET['q'];
				dd($keyword);


			if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'DESC')->paginate(12);
				}
				

			}

		}

		// RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 	if($_GET['range'] == 'less_25'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->orderBy('price', 'DESC')->paginate(12);
				}
		 	}

		 }

		else{
			if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->orderBy('price', 'DESC')->paginate(12);
				}
				

			}
		}	 
	        

        
        
        return view('shop.product_listing',compact('shop', 'categories', 'banner'));
    }



    // partsCategorySort
	public function PartsCategorySort($category, $sort){

		// category id
		$cat = DB::table('categories')->where('slug', $category)->first();

		// categories
        // $categories = DB::table('categories')->where('deleted_at', null)->get();
        $categories = DB::table('categories')->where('type', 'parts')->where('deleted_at', null)->where('is_active', '1')->get();

        $banner = DB::table('inner_banners')->where('id', '14')->first();


        if(isset($_GET['q']) && $_GET['q'] != '') {
			
			$keyword = $_GET['q'];
		

			if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('product_title', 'like', '%'.$keyword.'%')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
			}

		 }

		 // RANGE
		 elseif(isset($_GET['range']) && $_GET['range'] != ''){

		 	if($_GET['range'] == 'less_25'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '<', '25')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_25_50'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['25', '50'])->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_50_75'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['50', '75'])->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'between_75_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->whereBetween('price', ['75', '100'])->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}
		 	elseif($_GET['range'] == 'greater_100'){
		 		if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('price', '>', '100')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
		 	}

		 }


		 else{
		 	if(isset($sort) && $sort != ''){

				if($sort == 'oldest'){
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'ASC')->paginate(12);
				}
				elseif ($sort == 'newest') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('id', 'DESC')->paginate(12);
				}
				elseif ($sort == 'low_to_high') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'ASC')->paginate(12);
				}
				elseif ($sort == 'high_to_low') {
					$shop = DB::table('products')->where('type','part')->where('is_deleted', '0')->where('is_active', '1')->where('category', $cat->slug)->orderBy('price', 'DESC')->paginate(12);
				}
			}
		}


		
        
        return view('shop.product_listing',compact('shop', 'categories', 'banner'));

	}
      // clear whole cart
	  public function clearCart() {

	  	$cart = Session::get('cart');
	  	Session::forget('cart');
			

			// echo 'success';
			Session::flash('message', 'Cart is now empty!'); 
			Session::flash('alert-class', 'alert-success');
			return redirect('/');	

	  }
		
}
	