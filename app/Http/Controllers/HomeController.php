<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inquiry;
use App\schedule;
use App\newsletter;
use App\post;
use App\banner;
use App\imagetable;
use DB;
use Mail;use View;
use Session;
use App\Http\Helpers\UserSystemInfoHelper;
use App\Http\Traits\HelperTrait;
use Auth;
use App\Profile;
use Illuminate\Support\Facades\Validator;
use App\Review;
use App\States;

class HomeController extends Controller
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
             
        $favicon = imagetable::
                     select('img_path')
                     ->where('table_name','=','favicon')
                     ->first(); 
        
        View()->share('logo',$logo);
        View()->share('favicon',$favicon);

    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        // META TAGS
        $pageTitle = 'Home';
        $pagedescription = '';
        $pagetags = '';
        
        $banners = DB::table('banners')->where('is_active', '1')->where('is_deleted', '0')->get();   
        $cms1 = DB::table('pages')->where('id', '1')->first();
        $cms2 = DB::table('pages')->where('id', '2')->first();
        $cms3 = DB::table('pages')->where('id', '3')->first();
        $cms4 = DB::table('pages')->where('id', '4')->first();
        $cms5 = DB::table('pages')->where('id', '5')->first();
        $cms6 = DB::table('pages')->where('id', '6')->first();
        $cms7 = DB::table('pages')->where('id', '7')->first();


        $testimonials = DB::table('testimonials')->where('is_active', '1')->where('deleted_at', null)->get(); 
        $showReview = DB::table('m_flag')->where('id', '1400')->first()->flag_value;
    


        $galleries = DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->orderBy('id', 'DESC')->take(6)->get()->toArray();
        $galleries = array_chunk($galleries, 6);

       

        $videos = DB::table('videos')->where('id', '1')->first();

        $products = DB::table('products')->where('is_deleted', '0')->where('type', 'product')->where('is_active', '1')->where('is_featured', '1')->orderBy('id', 'DESC')->get()->take(3);
        
        $hoods_catgeories = DB::table('categories')->where('deleted_at', NULL)->where('type' , 'hoods')->where('is_active', 1)->get();
        
        $featured_hoods = DB::table('products')->where('is_deleted', '0')->where('type', 'product')->where('is_active', '1')->where('is_featured', '1')
        // ->orderBy('id', 'DESC')
        ->orderBy('product_title', 'ASC')
        ->get();
        
        
        return view('welcome', compact('pageTitle', 'pagedescription', 'pagetags', 'banners', 'cms1', 'cms2', 'cms3', 'cms4', 'cms4', 'cms5', 'cms6', 'cms7', 'testimonials', 
        'galleries', 'videos', 'products', 'featured_hoods', 'showReview', 'hoods_catgeories'));
    }

    public function about()
    { 

        // META TAGS
        $pageTitle = 'About';
        $pagedescription = '';
        $pagetags = '';


        $banner = DB::table('inner_banners')->where('id', '1')->first();   

        $cms9 = DB::table('pages')->where('id', '9')->first();


        return view('about', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms9'));
    }
    public function warrantyinformation()
    { 

        // META TAGS
        $pageTitle = 'Warranty Information';
        $pagedescription = '';
        $pagetags = '';


        $banner = DB::table('inner_banners')->where('id', '16')->first();   

        $cms16 = DB::table('pages')->where('id', '16')->first();


        return view('warrantyinformation', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms16'));
    }
     public function useandcare()
    { 

        // META TAGS
        $pageTitle = 'Use And Care';
        $pagedescription = '';
        $pagetags = '';


        $banner = DB::table('inner_banners')->where('id', '17')->first();   

        $cms17 = DB::table('pages')->where('id', '17')->first();
        $use_care = DB::table('file_managements')->where('id', '4')->first();

        return view('useAndCare', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms17', 'use_care'));
    }
    
    public function motoroption()
    { 

        // META TAGS
        $pageTitle = 'Motor Option';
        $pagedescription = '';
        $pagetags = '';


        $banner = DB::table('inner_banners')->where('id', '15')->first();   

        $internal = DB::table('motoroptions')->where('category' , 10)->where('deleted_at' , NULL)->where('is_active' , '1')->get();
        $inline = DB::table('motoroptions')->where('category' , 11)->where('deleted_at' , NULL)->where('is_active' , '1')->get();
        $external = DB::table('motoroptions')->where('category' , 12)->where('deleted_at' , NULL)->where('is_active' , '1')->get();
        
        return view('motoroption', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'internal', 'inline', 'external'));
    }

    public function contact()
    { 

        // META TAGS
        $pageTitle = 'Contact';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '2')->first();   

        $cms10 = DB::table('pages')->where('id', '10')->first();
        $cms14 = DB::table('pages')->where('id', '14')->first();
        
        $states = DB::table('states')->where('country_id', '231')->get();
        
        $representatives = DB::table('services')->where('is_active', '1')->where('deleted_at', null)->get();
        
        // country states
        $country = DB::table('countries')->get();
        

        return view('contact', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms10', 'states', 'representatives', 'cms14', 'country'));
    }

    public function customProducts()
    { 

        // META TAGS
        $pageTitle = 'Product';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '6')->first();  


        $products = DB::table('products')->where('is_deleted', '0')->where('is_active', '1')->where('is_custom', '1')
        // ->orderBy('id', 'DESC')
        ->orderBy('product_title', 'ASC')
        ->paginate(12);


        return view('customProducts', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'products'));
    }


    public function gallery()
    { 

        // META TAGS
        $pageTitle = 'Gallery';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '3')->first();   

        $cms11 = DB::table('pages')->where('id', '11')->first();

        $galleries_material = DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->paginate(12);
        // $galleries_material = DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->where('type','material')->get()->toArray();
    
        // $galleries_material = array_chunk($galleries_material, 6);

        $galleries_model= DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->where('type','Model')->get()->toArray();
  
        $galleries_model = array_chunk($galleries_model, 6);

         $galleries_Island= DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->where('type','Island')->get()->toArray();
  
        $galleries_Island = array_chunk($galleries_Island, 6);

        $type = DB::table('options')->where('deleted_at', null)->get();
        
        
        //  $product_images = DB::table('product_imagess')->where('is_deleted', '0')->get();
      

        return view('gallery', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms11', 'galleries_material','type','galleries_model','galleries_Island', 'product_images'));
    }
    
    public function galleryCategory($slug){
        // META TAGS
        $pageTitle = 'Gallery';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '3')->first();   

        $cms11 = DB::table('pages')->where('id', '11')->first();
        
        $galleries_material = DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->where('type', $slug)->paginate(12);
        
        return view('gallery', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms11', 'galleries_material'));
    }




    // galleryModelCategory
    public function galleryModelCategory($slug){
        // META TAGS
        $pageTitle = 'Gallery';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '3')->first();   

        $cms11 = DB::table('pages')->where('id', '11')->first();

        $product = DB::table('products')->where('slug', $slug)->first();
        
        $galleries_material = DB::table('product_imagess')->where('is_deleted', '0')->where('product_id', $product->id)->paginate(12);
        
        return view('gallery', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms11', 'galleries_material'));
    }






    public function productDetail()
    { 

        // // META TAGS
        // $pageTitle = 'Product Details';
        // $pagedescription = '';
        // $pagetags = '';

        // $banner = DB::table('inner_banners')->where('id', '7')->first();   

        $banner = DB::table('inner_banners')->where('id', '7')->first();
        
        return view('productDetail', compact('pageTitle', 'pagedescription', 'pagetags', 'banner'));
    }

    public function productDetail2($slug)
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



        

        return view('productDetail2', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'product', 'averageRatings', 'reviews'));
    }

    public function productLogin()
    { 

        // META TAGS
        $pageTitle = 'Login';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '4')->first();   


        return view('productLogin', compact('pageTitle', 'pagedescription', 'pagetags', 'banner'));
    }

    public function product()
    { 

        // // META TAGS
        // $pageTitle = 'Product';
        // $pagedescription = '';
        // $pagetags = '';

        // $banner = DB::table('inner_banners')->where('id', '5')->first();   


        // $categories = DB::table('categories')->where('deleted_at', null)->where('is_active', '1')->get();


        // return view('product', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'categories'));
    }

    public function productCategory($category){

        // META TAGS
        $pageTitle = 'Product';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '5')->first();   


        $categories = DB::table('categories')->where('deleted_at', null)->where('is_active', '1')->get();

        return view('product', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'categories'));
    }


    public function cartPage()
    { 

        // META TAGS
        $pageTitle = 'CART';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '8')->first();   


        return view('cart', compact('pageTitle', 'pagedescription', 'pagetags', 'banner'));
    }

    public function checkoutPage()
    { 

        // META TAGS
        $pageTitle = 'CHECK OUT';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '9')->first();   


        return view('checkout', compact('pageTitle', 'pagedescription', 'pagetags', 'banner'));
    }


    // termsAndConditions
    public function termsAndConditions()
    { 

        // META TAGS
        $pageTitle = 'Terms and Conditions';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '10')->first();   


        $cms13 = DB::table('pages')->where('id', '13')->first();



        return view('termsAndConditions', compact('pageTitle', 'pagedescription', 'pagetags', 'banner', 'cms13'));
    }

    

    public function contactUsSubmit(Request $request)
    {

    //     if($_POST['page'] == 'home'){
    //         $validator = Validator::make($request->all(),[
    //             'first_name' => ['required', 'alpha_spaces'],
    //             'email' => ['required', 'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
    //             'subject' => ['required'],
    //             'message' => ['required'],
    //         ],
    //      ['first_name.alpha_spaces' => 'The name field may only contain letters and spaces.']
    //  );
    //     }
        // elseif ($_POST['page'] == 'contact') {
            $validator = Validator::make($request->all(),[
                'name' => ['required', 'alpha_spaces'],
                'email' => ['required', 'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'country' => ['required'],
                'state' => ['required'],
                'city' => ['required'],
                'services' => ['required'],
            ]);
        // }
               
        

        $response='';
        if ($validator->fails()){
            $response = array('message' => $validator->errors()->all(),'status' => false);
        }else {
            
            $country = DB::table('countries')->where('id', $request->country)->first()->name;
            
            $inquiry = new inquiry($request->all());
            $inquiry->country = $country;
            
            $check=$inquiry->save();
            $response = array('message' => 'Something went wrong. Try Again!', 'status' => false);
            if($check){
                
                
                
                    //EMAIL CODE
                    if($_POST['services'] == 'Customer Service'){
                        $array['admin_email'] = \DB::table('m_flag')->where('id', '1100')->first()->flag_value;
                    }
                    elseif($_POST['services'] == 'Technical Information'){
                        $array['admin_email'] = \DB::table('m_flag')->where('id', '1200')->first()->flag_value;
                    }
                    elseif($_POST['services'] == 'Installation'){
                        $array['admin_email'] = \DB::table('m_flag')->where('id', '1300')->first()->flag_value;
                    }
                    
                    
                    $array['name'] = $request->name;
                    $array['email'] = $request->email;
                    $array['state'] = $request->state;
                    $array['city'] = $request->city;
                    $array['services'] = $request->services;
                    $array['message'] = $request->message;
                    $array['id'] = $inquiry->id;
                    
                    
                    $admin_email = str_replace(" ","",$array['admin_email']);
                    $admin_email = explode(',' , $admin_email);
                    
                    
                    
                    foreach($admin_email as $mail){
                        $array['admin_email'] = $mail;
                        
                        // admin inquiry email
                        Mail::send('mailingtemplates.contactInquiry', ['array' => $array], function ($m) use ($array) {
                            $m->from('john.david7595@gmail.com', 'Modernaire');
                            $m->to($array['admin_email'],'Modernaire')->subject($array['services']);
                        });
                        
                    }
                    
                    
                    //EMAIL CODE
                    
                    
                $response = array('message' => 'Thankyou for contacting us, we will get back to you asap!', 'status' => true);
            }
        }

        return Response()->json($response);
    }

    public function newsletterSubmit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'newsletter_email' => ['required','email','unique:newsletter', 'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix']
        ]);

        $response='';
        if ($validator->fails()){
            $response = array('message' => $validator->errors()->all(),'status' => false);
        }else {
            $newsletter = new newsletter;
            $newsletter->newsletter_email=$request->newsletter_email;
            $check=$newsletter->save();
            $response = array('message' => 'Something went wrong. Try Again!', 'status' => false);
            if($check){
                
                
                    //EMAIL CODE
                    // $array['admin_email'] = \DB::table('m_flag')->where('id', '600')->first()->flag_value;
                    // $array['admin_email'] = \DB::table('users')->where('id', '1')->first()->email;
                    $array['admin_email'] = $request->newsletter_email;
                    $array['email'] = $request->newsletter_email;
                    $array['id'] = $inquiry->id;
                    
                    // admin inquiry email
                    Mail::send('mailingtemplates.newsletterInquiry', ['array' => $array], function ($m) use ($array) {
                            $m->from('john.david7595@gmail.com', 'Modernaire');
                            $m->to($array['admin_email'],'Modernaire')->subject('Newsletter Inquiry');
                    });
                    
                    //EMAIL CODE
                    
                    
                    
                $response = array('message' => 'Thank you for subscribing!', 'status' => true);
            }
        }

        return Response()->json($response);
        
    }



    // product review submit
    public function reviewSubmit(Request $request){

    $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'email' => ['required'],
            'star' => ['required'],
        ]);

        $response='';
        if ($validator->fails()){
            $response = array('message' => $validator->errors()->all(),'status' => false);
        }else {
            $review = new Review($request->all());

            $check=$review->save();
            $response = array('message' => 'Something went wrong. Try Again!', 'status' => false);
            if($check){
                $response = array('message' => 'Thankyou for the review!', 'status' => true);
            }
        }

        return Response()->json($response);
}   





    public function faq(){
        
        // META TAGS
        $pageTitle = 'FAQs';
        $pagedescription = '';
        $pagetags = '';
        
        $banner = DB::table('inner_banners')->where('id', '11')->first();   
        
        $faq = DB::table('faqs')->where('deleted_at', null)->where('is_active', '1')->get();
        
        $use_care = DB::table('file_managements')->where('id', '1')->first();
        $general_installation = DB::table('file_managements')->where('id', '2')->first();
      

        return view('faq',compact('faq', 'pageTitle', 'pagedescription', 'pagetags', 'banner', 'use_care', 'general_installation'));
    }
    
    public function locateDealer_old(){
        if((($_GET['address']) != '')){
        $address = trim($_GET['address']);
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where('address', 'LIKE', '%'.$address.'%')->get();
     }

     if(($_GET['zip']) != ''){
        $zip = trim($_GET['zip']);
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where('zip_code', 'LIKE', '%'.$zip.'%')->get();
     }

     if((($_GET['address']) != '') and (($_GET['zip']) != '')){
        $address = trim($_GET['address']);
        $zip = trim($_GET['zip']);
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where('address', 'LIKE', '%'.$address.'%')->where('zip_code', 'LIKE', '%'.$zip.'%')->get();
     }
        // META TAGS
        $pageTitle = 'Dealer';
        $pagedescription = '';
        $pagetags = '';
        
        
        $banner = DB::table('inner_banners')->where('id', '13')->first(); 
        
        if(($_GET['slug'] == '') and ($_GET['address'] == '') and ($_GET['zip'] == '')){
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->groupBy('service')->get();
        }if(($_GET['slug'] != '')){
            $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where('service', $_GET['slug'])->get();
         }
        
        $cms14 = DB::table('pages')->where('id', '14')->first();
        $representatives = DB::table('services')->where('is_active', '1')->where('deleted_at', null)->get();
          

        return view('locateDealer',compact('dealer','company', 'pageTitle', 'pagedescription', 'pagetags', 'banner', 'representatives', 'cms14'));
    }
    public function locateDealer(){
        if((($_GET['address']) != '')){
        $address = htmlentities($_GET['address']);
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where(DB::raw("CONCAT(address,' ',state, '', city)"), 'LIKE', '%'.$address.'%')->get();
        
     }

     if(($_GET['zip']) != ''){
        $zip = trim($_GET['zip']);
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where('zip_code', 'LIKE', '%'.$zip.'%')->get();
     }

     if((($_GET['address']) != '') and (($_GET['zip']) != '')){
        $address = trim($_GET['address']);
        $zip = trim($_GET['zip']);
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where(DB::raw("CONCAT(address,' ',state, '', city)"), 'LIKE', '%'.$address.'%')->where('zip_code', 'LIKE', '%'.$zip.'%')->get();
     }
        // META TAGS
        $pageTitle = 'Dealer';
        $pagedescription = '';
        $pagetags = '';
        
        
        $banner = DB::table('inner_banners')->where('id', '13')->first(); 
        
        if(($_GET['slug'] == '') and ($_GET['address'] == '') and ($_GET['zip'] == '')){
        $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->groupBy('service')->get();
        }if(($_GET['slug'] != '')){
            $dealer = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->where('service', $_GET['slug'])->get();
         }
        
        $cms14 = DB::table('pages')->where('id', '14')->first();
        $representatives = DB::table('services')->where('is_active', '1')->where('deleted_at', null)->get();
          

        return view('locateDealer',compact('dealer','company', 'pageTitle', 'pagedescription', 'pagetags', 'banner', 'representatives', 'cms14'));
    }
    
    public function materials(){
        
        
        // META TAGS
        $pageTitle = 'Materials';
        $pagedescription = '';
        $pagetags = '';
        
        
        $banner = DB::table('inner_banners')->where('id', '12')->first();   

        $cms11 = DB::table('pages')->where('id', '11')->first();


        $galleries = DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->get()->toArray();
        $galleries = array_chunk($galleries, 6);
        
        return view('materials', compact('banner', 'cms11', 'galleries', 'pageTitle', 'pagedescription', 'pagetags'));
    }
    
    public function parts(){
        
        $banner = DB::table('inner_banners')->where('id', '5')->first();   


        $categories = DB::table('categories')->where('deleted_at', null)->where('is_active', '1')->get();
        
        return view('parts', compact('banner', 'categories'));
    }
    
    
    
    // country state
    public function getStates($cid){
        $states = new States();
        $gstates = $states->getAllStatesByCountryID($cid);
        $selectStates = array();
        foreach($gstates as $category) {
            $selectStates[$category['id']] = $category['name'];
        }
        
        
        return $selectStates;
    }
    
    
    // instructional_information
    public function instructional_information(){
        
        $banner = DB::table('inner_banners')->where('id', '18')->first();
        
        $general_wallhood_installation = DB::table('file_managements')->where('id', '6')->first();
        $fan_switch_installation = DB::table('file_managements')->where('id', '7')->first();
        $light_switch_installation = DB::table('file_managements')->where('id', '8')->first();
        $knob_installation = DB::table('file_managements')->where('id', '9')->first();
        $baffle_filter_installation = DB::table('file_managements')->where('id', '10')->first();
        $mesh_filter_installation = DB::table('file_managements')->where('id', '11')->first();
        $wiring_harness_installation = DB::table('file_managements')->where('id', '12')->first();
        $charcoal_filter_installation = DB::table('file_managements')->where('id', '13')->first();
        $motor_replacement_installation = DB::table('file_managements')->where('id', '14')->first();
        
        return view('instructional_information', compact('banner', 'general_wallhood_installation', 'fan_switch_installation', 'light_switch_installation', 'knob_installation', 'baffle_filter_installation', 'mesh_filter_installation', 'wiring_harness_installation', 'charcoal_filter_installation', 'motor_replacement_installation'));
    }
    
    
    
    
    
    // latitude/longitude 
    public function submitLatLong(Request $request){

        $location['latitude'] = $request->latitude;
        $location['longitude'] = $request->longitude;

        Session::put('location', $location);

        $response = array('location' => $location, 'status' => true);

        return Response()->json($response);

    }
    
    
    
    // customBuild
    public function customBuild(){
        
        // META TAGS
        $pageTitle = 'Custom Build';
        $pagedescription = '';
        $pagetags = '';

        $banner = DB::table('inner_banners')->where('id', '2')->first(); 
        
        return view('customBuild', compact('pageTitle', 'pagedescription', 'pagetags', 'banner'));
    }
   
}
