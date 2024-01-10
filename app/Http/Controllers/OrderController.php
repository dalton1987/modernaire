<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inquiry;
use Illuminate\Support\Facades\Redirect;
use App\newsletter;
use App\Program;
use App\imagetable;
use App\Product;
use App\Banner;
use App\orders;
use App\orders_products;
use App\Http\Requests\OrderRequest;
use DB;
use View;
use Session;
use App\Http\Traits\HelperTrait;
use Auth;
use Hash;
use Mail;

class OrderController extends Controller
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
        // $this->middleware('guest');
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
	
		
	
	public function checkout() {
		
		$language = Session::get('language');
		$product_detail = DB::table('products')->first();
		
		if(Session::get('cart') && count(Session::get('cart'))>0) {
		
			$countries = DB::table('countries')->get();
			return view('shop.checkout',['cart'=>Session::get('cart'),'countries'=>$countries,'language'=>$language,'product_detail'=>$product_detail]);
						
		} else {
			Session::flash('flash_message', 'No product found!'); 
			Session::flash('alert-class', 'alert-success'); 
			return redirect('/');
		}
		
    }
	
	
	public function getStates(Request $request){
     
        $states = DB::table('states')->where('country_id', $request->country_id)->get();
        echo json_encode(array("states"=> $states));
		
    }

	public function getCities(Request $request){
		
        $cities = DB::table('cities')->where('state_id', $request->state_id)->get();
        echo json_encode(array("cities"=> $cities));
		
    }
    
	public function newOrder(Request $request) {
		//dd($_POST);
		
		define("ENV", "demo"); //demo OR pro

		if(ENV == 'demo') {
		  $endpoint = 'https://apidemo.myfatoorah.com';
		  $username= "apiaccount@myfatoorah.com";
		  $password="api12345*";
		}
		else{
		  $endpoint = 'https://apikw.myfatoorah.com/swagger/ui/index';
		  $username= "Ndeumens@ninolife.com";
		  $password="Noah&0306";
		}

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"{$endpoint}/Token");
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('grant_type' => 'password',
																		'username' => $username,
																		'password' =>$password
																  )));
		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		$json = json_decode($result, true);

		if(isset($json['access_token']) && !empty($json['access_token'])){
		  $access_token= $json['access_token'];
		}
		else{
		  $access_token='';
		}

            		$cart = Session::get('cart');
            		$product_detail = DB::table('products')->first();
                    
                 
		           
					if(Session::get('language') == 'ksa'){
						$price = $product_detail->sar_price;
					}
					elseif(Session::get('language') == 'uae'){
						$price = $product_detail->price;
					}
					elseif(Session::get('language') == 'qatar'){
						$price = $product_detail->qar_price;
					
					}
					elseif(Session::get('language') == 'bahrain'){
						$price = $product_detail->bhr_price;
					}
					elseif(Session::get('language') == 'oman'){
						$price = $product_detail->omr_price;
					}
					elseif(Session::get('language') == 'jordan'){
						$price = $product_detail->jod_price;
					}
					elseif(Session::get('language') == 'egypt'){
						$price = $product_detail->egp_price; 
					}
					elseif(Session::get('language') == 'kuwait'){
						$price = $product_detail->kwd_price;
					}
					else{
                      $price = $product_detail->price;
					}
		
	            	$t= time();
	
					if(Session::get('language') == 'ksa'){
						$currency = 'SAR';
					}
					elseif(Session::get('language') == 'uae'){
						$currency = 'AED';
					}
					elseif(Session::get('language') == 'qatar'){
						$currency = 'QAR';
					}
					elseif(Session::get('language') == 'bahrain'){
						$currency = 'BHD';
					}
					elseif(Session::get('language') == 'oman'){
						$currency = 'OMR';
					}
					elseif(Session::get('language') == 'jordan'){
						$currency = 'JOD';
					}
					elseif(Session::get('language') == 'egypt'){
						$currency = 'EGP'; 
					}
					elseif(Session::get('language') == 'kuwait'){
						$currency = 'KWD';
					}
					else{
                      $currency = 'AED';
					}
					
					
	      // dd($currency);
	    
	     //dd($price);
	     //return;
		$name = $_POST['first_name']." ".$_POST['last_name'];
		$post_string = array();
		$post_string['InvoiceValue'] = 10;
		$post_string['CustomerName'] = $name;
		$post_string['CustomerBlock'] = $_POST['area'];
		$post_string['CustomerStreet'] = "Street";
		$post_string['CustomerHouseBuildingNo'] = $_POST['building']; 
		$post_string['CustomerCivilId'] = "123456789124";
		$post_string['CustomerAddress'] = $_POST['address_line_1'];
		$post_string['CustomerReference'] = $t;
		$post_string['DisplayCurrencyIsoAlpha'] = $currency;
		$post_string['CountryCodeId'] = $_POST['country_code'];
		$post_string['CustomerMobile'] = $_POST['phone_no'];
		$post_string['CustomerEmail'] = $_POST['email'];
		$post_string['DisplayCurrencyId'] = 3;
		$post_string['SendInvoiceOption'] = 1;
		$post_string['payment_method'] = $_POST['payment_method'];
		$post_string['company_name'] = $_POST['company_name'];
		$post_string['city'] = $_POST['city'];
		$post_string['landmark'] = $_POST['landmark'];
		$post_string['floor_num'] = $_POST['floor_num'];
		$post_string['InvoiceItemsCreate'][] = array(
												"ProductId"=> null,
												"ProductName"=> $cart[1]['name'],
												"Quantity"=> $cart[1]['qty'],
												"UnitPrice"=> $price);
		$post_string['CallBackUrl'] =  "https://www.ninolife.com/payment";
		$post_string['Language'] = 2;
		$post_string['ExpireDate'] = "2022-12-31T13:30:17.812Z";
		$post_string['ApiCustomFileds'] = "weight=10,size=L,lenght=170";
		$post_string['ErrorUrl'] = "https://www.ninolife.com?error=payment";
		$post_string = json_encode($post_string);

		$soap_do     = curl_init();
		curl_setopt($soap_do, CURLOPT_URL, "{$endpoint}/ApiInvoices/CreateInvoiceIso");
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true);
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Content-Length: ' . strlen($post_string),  'Accept: application/json','Authorization: Bearer '.$access_token));
		$result1 = curl_exec($soap_do);
		 // echo "<pre>";print_r($result1);die;
		$err    = curl_error($soap_do);
		$json1= json_decode($result1,true);
		
		$RedirectUrl= $json1['RedirectUrl'];
		
		//echo $RedirectUrl;
		//return;
		
		//redirect::to($RedirectUrl);
		//dd($RedirectUrl);
		$ref_Ex=explode('/',$RedirectUrl);
		//echo "<pre>";
		//print_r($ref_Ex);
		//return;
		$referenceId =  $ref_Ex[4];
		//echo $referenceId;
		//return;
		 curl_close($soap_do);
		
		$orders = new orders();	
		$orders->payment_method=$_POST['payment_method'];
		$orders->delivery_country=$_POST['country'];
		$orders->country_code=$_POST['country_code'];
		$orders->delivery_first_name=$_POST['first_name'];
		$orders->delivery_last_name=$_POST['last_name'];
		$orders->order_company=$_POST['company_name'];
		$orders->delivery_address_1=$_POST['address_line_1'];
		$orders->delivery_city=$_POST['city'];
		$orders->area=$_POST['area'];
		$orders->landmark=$_POST['landmark'];
		$orders->floor_num=$_POST['floor_num'];
		$orders->building=$_POST['building'];
		$orders->order_email=$_POST['email'];
		$orders->delivery_phone_no=$_POST['phone_no'];
		$orders->payment_id='';
		$orders->order_id='';
		$orders->track_id='';
		$orders->ref_id=$referenceId;
		$orders->order_items=count(Session::get('cart'));
		$orders->order_item_total=$_POST['subtotal'];
		$orders->order_total=$_POST['subtotal'];
		//dd($orders,$cart);
		
		if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'paypal') {
			$orders->transaction_id = $_POST['payment_id'];	
			$orders->order_status = $_POST['payment_status'];	
			$orders->card_token=$_POST['payer_id'];
		}	
		
		$orders->save();
		
		$orders = orders::orderBy('id','desc')
							->first();
		
		foreach($cart as $key=>$value) {

    		if($value['name'] != '') {
    		    
    			$order_products = new orders_products;
    			$order_products->order_products_product_id=$value['id'];
    			$order_products->order_products_name=$value['name'];
    			$order_products->order_products_price=$value['baseprice'];
    			$order_products->orders_id=$orders->id;
    			$order_products->order_products_qty=$value['qty'];
    			$order_products->mat_language=$value['mat_language'];
    			$order_products->order_products_subtotal= $value['baseprice'] * $value['qty'];
    			$order_products->ref_id=$referenceId;
    			$order_products->save();
    			
    		}
		
		}
		//$orders->user_id= $id;
		
	
	
		
		//echo '<br><a href="'.$RedirectUrl.'" id="paymentRedirect"  class="btn btn-success">Click here to Payment Link</a>';
			Session::forget('cart');
		return view('shop.checkout2',['cart'=>Session::get('cart'),'RedirectUrl'=>$RedirectUrl]);
		
		
				
	}
	
	public function success() {
		return view('account.success');
	}
	
	public function placeOrder(Request $request) {

	  
			$validateArr = array();
			$messageArr = array();
		
		
			$id = 0;
			if(isset($_POST['create']) && $_POST['create'] == '1') {
				
					
						if($_POST['password'] == '') {
							
							$validateArr['password'] = 'min:6|required_with:confirm_password|same:confirm_password';
							$validateArr['confirm_password'] = 'min:6';
							
							
						} else {
							
							$validateArr['email'] = 'required|max:255|email|unique:users';
							$this->validate($request,$validateArr,$messageArr);
							
							$pw = Hash::make($_POST['password']);
							$fullName = $request->first_name." ".$request->last_name;
							
							DB::insert("INSERT INTO users(email,name,password) values('".$_POST['email']."','".$fullName."','".$pw."')");
						
							
							$user = DB::table('users')->orderBy('id', 'desc')->first();	
							$id = $user->id;
						
						}
			}
			
			$validateArr['email'] = 'required|max:255|email';
			$this->validate($request,$validateArr,$messageArr);
			
			if(Auth::check()) {
				$id = Auth::user()->id; 
			}
			
			$cart=Session::get('cart');
			
			$subtotal=0;
			foreach($cart as $key=>$value) {
				$subtotal+=	$value['baseprice'] * $value['qty'];
				
			}	
		
			$order = new orders();
			
			$order->billing_first_name=$request->first_name;
			$order->billing_last_name=$request->last_name;
			$order->billing_address_1=$request->address;
			$order->billing_country=$request->country;
			$order->billing_city=$request->city;
			$order->billing_state=$request->state;
			$order->billing_zip_code=$request->zip_code;
			$order->billing_email=$request->email;
			$order->billing_phone_no=$request->phone;
			$order->order_notes=$request->order_notes;
			$order->product_sizes = $request->sizes;


			if(isset($_POST['shippingAddress']) && $_POST['shippingAddress'] == '1'){
				$order->delivery_first_name=$request->first_name;
				$order->delivery_last_name=$request->last_name;
				$order->delivery_address_1=$request->address;
				$order->delivery_city=$request->city;
				$order->delivery_state=$request->state;
				$order->delivery_zip_code=$request->zip_code;
				$order->delivery_country=$request->country;
				$order->order_email=$request->email;
				$order->delivery_phone_no=$request->phone;
				$order->product_sizes = $request->sizes;
			}
			else{
				$order->delivery_first_name=$request->ship_first_name;
				$order->delivery_last_name=$request->ship_last_name;
				$order->delivery_address_1=$request->ship_address;
				$order->delivery_city=$request->ship_city;
				$order->delivery_state=$request->ship_state;
				$order->delivery_zip_code=$request->ship_zip_code;
				$order->delivery_country=$request->ship_country;
				$order->order_email=$request->ship_email;
				$order->delivery_phone_no=$request->ship_phone;
				$order->product_sizes = $request->sizes;
			}	
			
			
			$order->order_email=$request->email;


			// tax save in db	
			$order->tax=$request->tax;
			$order->total_with_tax=$request->total_with_tax;	
		
			
			$order->payment_status='0';
			$order->payment_method = $request->payment_type;

		
			$order->order_items=count(Session::get('cart'));
			
			$order->order_item_total=$subtotal;
			// $orders->id= $orders->order_id;	
			$total+=	$subtotal + $cart['shipping'];
			
			$order->order_total=$total;
			$order->user_id= $id;
			
			
			// if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'paypal') {
			// 	$order->transaction_id = $_POST['payment_id'];	
			// 	$order->order_status = $_POST['payment_status'];	
			// 	$order->card_token=$_POST['payer_id'];
			// }
			
			
			
            //PAYPAL PAYMENT
            if($request->payment_status == 'Completed'){
			    	$order->payment_status = '1';
			    }

			    // $order->paypal_orderID = $request->paypal_orderID;
			    // $order->paypal_payerID = $request->paypal_payerID;
			    // $order->paypal_paymentID = $request->paypal_paymentID;
			    // $order->paypal_paymentToken = $request->paypal_paymentToken;
			    // $order->payment_method = 'PayPal';
			
			
			
		
			if($order->save()) {
		       
				$orders = orders::orderBy('id','desc')
								->first();
				$subtotal=0;
				foreach($cart as $key=>$value) {
					if($value['name'] != '') {
    					$order_products = new orders_products;
    					$order_products->order_products_product_id=$value['id'];
    					$order_products->user_id=Auth::user()->id;
    					$order_products->order_products_name=$value['name'];
    					$order_products->order_products_price=$value['baseprice'];
    					$order_products->orders_id=$orders->id;
    					$order_products->order_products_qty=$value['qty'];
    					$order_products->product_weight=$value['selected_weight'];
						$order_products->shipping=$cart['shipping'];
    					$order_products->order_products_subtotal= $value['baseprice'] * $value['qty'];
    					$order_products->products_size = $orders->product_sizes;
    					$order_products->save();
					}
				}
				
				
				
				
				// INVOICE EMAIL
				$admin_id = DB::table('users')->where('id','1')->first();
				$order_data = DB::table('orders')->where('id',$order->orders_id)->first();
				$order_products = DB::table('orders_products')->where('orders_id',$order->orders_id)->get();

				$send_email = array();
					    
			    $send_email['id'] = $order_data->id;
			    $send_email['delivery_first_name'] = $order_data->billing_first_name;
			    $send_email['delivery_last_name'] = $order_data->billing_last_name;
			    $send_email['delivery_address_1'] = $order_data->billing_address_1;
			    $send_email['delivery_country'] = $order_data->billing_country;
			    $send_email['delivery_city'] = $order_data->delivery_city;
			    $send_email['delivery_phone_no'] = $order_data->delivery_phone_no;
			    $send_email['transaction_id'] = $order_data->paypal_paymentID;
                $send_email['payer_id'] = $order_data->paypal_payerID;
			    $send_email['order_email'] = $order_data->order_email;
			    $send_email['created_at'] = $order_data->created_at;
			    $send_email['order_total'] = $order_data->total_with_tax;
			    $send_email['order_notes'] = $order_data->order_notes;

			    // $send_email['admin_email'] = $admin_id->email;
			    $send_email['admin_email'] = DB::table('m_flag')->where('id', '900')->first()->flag_value;	
			    

			    //For buyer invoice Email Method 
			   	// Mail::send('mailingtemplates.OrderNotification', ['send_email' => $send_email,'order_products' => $order_products], function ($m) use ($send_email) {
			   	// 	$m->from('john.david7595@gmail.com', 'Modernaire');
			    //   	$m->to($send_email['order_email'],'Modernaire')->subject('Order Invoice');
			    // });

			    //For admin invoice Email Method 
			  	// Mail::send('mailingtemplates.OrderNotification', ['send_email' => $send_email,'order_products' => $order_products], function ($m) use ($send_email) {
			  	// 	$m->from('john.david7595@gmail.com', 'Modernaire');
			   //  	$m->to($send_email['admin_email'],'Modernaire')->subject('Order Invoice');
			   //  });
				// INVOICE EMAIL
				
				Session::forget('cart');
				
				
				
				
				
				if(isset($_POST['create']) && $_POST['create'] == '1'){
					Session::flash('message', 'Your account has been created and payment has been authorized!'); 
					Session::flash('alert-class', 'alert-success');
				}
				else{
					Session::flash('message', 'Please complete the payment step to proceed!'); 
					Session::flash('alert-class', 'alert-success');
				}
				

				$orderId = $orders->id;
				// return view('shop.orderComplete', compact('orderId'));

				// order complete page
				// return redirect('orderComplete?id='.$orderId);

				// orderPayment page
				// return redirect('/');
				return redirect('orderPayment?id='.$orderId);

				//echo "data saved";
				//return;
				if(Auth::check()) {
					return redirect('/');
				} else {
					return redirect('/');
				}
				
			}	
			
	}	


	public function orderComplete(){
		return view('shop.orderComplete');
	}


	// orderPayment
	public function orderPayment(){

		$order = DB::table('orders')->where('id', $_GET['id'])->first();
		$order_products = DB::table('orders_products')->where('orders_id', $_GET['id'])->get();

		return view('shop.orderPayment', compact('order', 'order_products'));
	}


	// paymentComplete
	public function paymentComplete(Request $request){
	

				$order_id = $_POST['order_id'];

			    // SAVE IN DB
			    if($request->payment_status == 'Completed'){
			    	$updatePayment['payment_status'] = '1';
			    }

			    $updatePayment['paypal_orderID'] = $request->paypal_orderID;
			    $updatePayment['paypal_payerID'] = $request->paypal_payerID;
			    $updatePayment['paypal_paymentID'] = $request->paypal_paymentID;
			    $updatePayment['paypal_paymentToken'] = $request->paypal_paymentToken;
			    $updatePayment['payment_method'] = 'PayPal';

			    DB::table('orders')->where('id', $order_id)->update($updatePayment);


			    // INVOICE EMAIL
				$admin_id = DB::table('users')->where('id','1')->first();
				$order_data = DB::table('orders')->where('id',$order_id)->first();
				$order_products = DB::table('orders_products')->where('orders_id',$order_id)->get();

				$send_email = array();
					    
			    $send_email['id'] = $order_data->id;
			    //billing
			    $send_email['billing_first_name'] = $order_data->billing_first_name;
			    $send_email['billing_last_name'] = $order_data->billing_last_name;
			    $send_email['billing_email'] = $order_data->billing_email;
			    $send_email['billing_phone_no'] = $order_data->billing_phone_no;
			    $send_email['billing_address_1'] = $order_data->billing_address_1;
			    $send_email['billing_city'] = $order_data->billing_city;
			    $send_email['billing_state'] = $order_data->billing_state;
			    $send_email['billing_country'] = $order_data->billing_country;
			    $send_email['billing_zip_code'] = $order_data->billing_zip_code;
			    //shipping
			    $send_email['delivery_first_name'] = $order_data->delivery_first_name;
			    $send_email['delivery_last_name'] = $order_data->delivery_last_name;
			    $send_email['delivery_state'] = $order_data->delivery_state;
			    $send_email['delivery_zip_code'] = $order_data->delivery_zip_code;
			    $send_email['delivery_address_1'] = $order_data->delivery_address_1;
			    $send_email['delivery_country'] = $order_data->delivery_country;
			    $send_email['delivery_city'] = $order_data->delivery_city;
			    $send_email['delivery_phone_no'] = $order_data->delivery_phone_no;
			    $send_email['transaction_id'] = $order_data->paypal_paymentID;
                $send_email['payer_id'] = $order_data->paypal_payerID;
			    $send_email['order_email'] = $order_data->order_email;
			    $send_email['created_at'] = $order_data->created_at;
			    $send_email['order_total'] = $order_data->total_with_tax;
			    $send_email['order_notes'] = $order_data->order_notes;
			    $send_email['logo'] = imagetable::select('img_path')->where('table_name','=','logo')->first();

			     $send_email['admin_email'] = $admin_id->email;
			    // $send_email['admin_email'] ='rosedev200@gmail.com';
			    //$send_email['admin_email'] = DB::table('m_flag')->where('id', '900')->first()->flag_value;	
			    
			   
			    

			    //For buyer invoice Email Method 
			   	Mail::send('mailingtemplates.OrderNotification', ['send_email' => $send_email,'order_products' => $order_products], function ($m) use ($send_email) {
			   		$m->from('john.david7595@gmail.com', 'Modernaire');
			      	$m->to($send_email['order_email'],'Modernaire')->subject('Order Invoice');
			    });

			    //For admin invoice Email Method 
			  	Mail::send('mailingtemplates.OrderNotification', ['send_email' => $send_email,'order_products' => $order_products], function ($m) use ($send_email) {
			  		$m->from('john.david7595@gmail.com', 'Modernaire');
			    	$m->to($send_email['admin_email'],'Modernaire')->subject('Order Invoice');
			    });
				// INVOICE EMAIL


				// order complete page
				
				Session::forget('cart');

		    
	        	Session::flash('message', 'Your order has been received successfully!'); 
				Session::flash('alert-class', 'alert-success');
			//	return view('mailingtemplates.OrderNotification');
				return redirect('orderComplete?id='.$order_id);
	    	
    	}

		
		

	


	
		public function payment () {

		if(isset($_GET['paymentId'])){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,'https://apidemo.myfatoorah.com/Token');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('grant_type' => 'password','username' => 'apiaccount@myfatoorah.com','password' => 'api12345*')));
        $result = curl_exec($curl);
        $error= curl_error($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $json = json_decode($result, true);
        $access_token= $json['access_token'];
        $token_type= $json['token_type'];
       if(isset($_GET['paymentId']))
        {
            $id=$_GET['paymentId'];
        }
        $password= 'api12345*';
        $url = 'https://apidemo.myfatoorah.com/ApiInvoices/Transaction/'.$id;
        $soap_do1 = curl_init();
        curl_setopt($soap_do1, CURLOPT_URL,$url );
        curl_setopt($soap_do1, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do1, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do1, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do1, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do1, CURLOPT_POST, false );
        curl_setopt($soap_do1, CURLOPT_POST, 0);
        curl_setopt($soap_do1, CURLOPT_HTTPGET, 1);
        curl_setopt($soap_do1, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Accept: application/json','Authorization: Bearer '.$access_token));
        $result_in = curl_exec($soap_do1);
        $err_in = curl_error($soap_do1);
        $file_contents = htmlspecialchars(curl_exec($soap_do1));
        curl_close($soap_do1);
        $getRecorById = json_decode($result_in, true);
        
		//dd($getRecorById,$getRecorById['InvoiceItems'][0]['ProductName']);
		
		
		  DB::table('orders')
            ->where('ref_id', $getRecorById['InvoiceId'])
            ->update(['transaction_id' => $getRecorById['TransactionId']
			, 'payment_id'=> $getRecorById['PaymentId']
			, 'payment_method' => $getRecorById['PaymentGateway']
			]);
		  DB::table('orders_products')
            ->where('ref_id', $getRecorById['InvoiceId'])
            ->update([ 
			'order_products_name' => $getRecorById['InvoiceItems'][0]['ProductName']
			, 'order_products_price' => $getRecorById['InvoiceItems'][0]['UnitPrice']
			, 'order_products_qty' => $getRecorById['InvoiceItems'][0]['Quantity']
			, 'order_products_subtotal' => $getRecorById['InvoiceItems'][0]['ExtendedAmount']
			]);
		
	
		
		
	}
	return view('account.success');
	
	}



	// checkEmail
	public function checkEmail($email)
	{
		$check = DB::table('users')->where('email', $email)->first();
		
		if($check == ''){
			$return = '0';
		}
		else{
			$return = '1';
		}

		return \Response::json($return);
	}
	
	
	
	//goToCheckout
	public function goToCheckout($id){
	    if(Session::has('cart')){
			$cart = Session::get('cart');
	    }	
			$cartId = $id;
			$product = DB::table('products')->where('id', $id)->first();
			
			$cart[$cartId]['id'] = $id;
			$cart[$cartId]['name'] = $product->product_title;
			$cart[$cartId]['baseprice'] = $product->price;
			$cart[$cartId]['qty'] = 1;
			Session::put('cart',$cart);
			
			
			return redirect('checkout');
		
	
	}
	
	
}	
