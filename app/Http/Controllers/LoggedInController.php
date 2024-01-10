<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use App\inquiry;
use App\newsletter;
use App\Program;
use App\imagetable;
use App\Banner;
use DB;
use View;
use File;
use App\orders_products;
use App\orders;
use Auth;
use Session;
use App\Http\Traits\HelperTrait;
use Illuminate\Validation\Rule;


class LoggedInController extends Controller
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
        $this->middleware('auth');
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

	
	public function orders()
    {
		
		$orders = orders::where('orders.user_id', Auth::user()->id)
				->orderBy('orders.id', 'desc')
				->paginate(10);
		return view('account.orders',['ORDERS'=>$orders]); 
		
	}
	

	public function account()
    {

		$orders = orders::where('orders.user_id', Auth::user()->id)
				->orderBy('orders.id', 'desc')
				->get();
		return view('account.index',['ORDERS'=>$orders]); 
		
	}


		public function update_profile(Request $request) {
		
		$user = DB::table('profiles')->where('id', Auth::user()->id)->first();
		
		$validateArr = array();
		$messageArr = array();
		$insertArr = array();
		$validateArr = [ 

			'uname' => 'required',
			'email' => array(),
			
		 ];
		 
		 if($user->email != $_POST['email']) {
			$validateArr['email'] = 'required|unique:users,email,NULL,id';
		 }

		if(trim($_POST['password']) != "") {
		
			$validateArr['password'] = 'required|min:6|confirmed'; 
            $validateArr['password_confirmation'] = 'required|min:6'; 
		}
		
		$this->validate($request,$validateArr,$messageArr);
		
		$insertArr['name'] = $_POST['uname'];	
		$insertArr['email'] = $_POST['email'];
	
		if(trim($_POST['password']) != "") {
				$insertArr['password'] = Hash::make($_POST['password']);
		}
			
		DB::table('users')
		->where('id', Auth::user()->id)
		->update(
					$insertArr
				);
					
					
		Session::flash('message', 'Your Profile Settings has been changed'); 
		Session::flash('alert-class', 'alert-success'); 
		return back();			
		
	}


	public function uploadPicture(Request $request) {	

		$user = DB::table('profiles')->where('id', Auth::user()->id)->first();
	
        if ($file = $request->file('pic')) {
            $extension = $file->extension()?: 'jpg|png';
            $destinationPath = public_path() . '/storage/uploads/users/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            //delete old pic if exists
            if (File::exists($destinationPath . $user->pic)) {
                File::delete($destinationPath . $user->pic);
            }
            //save new file path into db
            $profile->pic = $safeName;
        }

			$insertArr['pic'] = $safeName;

			DB::table('profiles')
			->where('id', Auth::user()->id)
			->update(
						$insertArr
					);

		Session::flash('message', 'Your Profile has been changed'); 
		Session::flash('alert-class', 'alert-success'); 
		return back();			

	}

    public function updateAccount(Request $request) {

		$user = DB::table('users')->where('id', Auth::user()->id)->first();
        
        
        if(Auth::user()->user_type != '2'){
            $this->validate($request, [
				'name' => 'required|alpha',
				'last_name' => 'required|alpha',
				'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
				
			]);
        }
		

		$insertArr['name'] = $_POST['name'];
		$insertArr['last_name'] = $_POST['last_name'];
		$insertArr['email'] = $_POST['email'];
	

			DB::table('users')
			->where('id', Auth::user()->id)
			->update(
				$insertArr
			);
			
			
// 			profile table
            $insertProfile['country'] = $_POST['country'];
            $insertProfile['address'] = $_POST['address'];
            $insertProfile['suite'] = $_POST['suite'];
            $insertProfile['city'] = $_POST['city'];
            $insertProfile['state'] = $_POST['state'];
            $insertProfile['postal'] = $_POST['postal'];
            $insertProfile['phone'] = $_POST['phone'];
            
            DB::table('profiles')
			->where('user_id', Auth::user()->id)
			->update(
				$insertProfile
			);
			
			
			if(Auth::user()->user_type == '2'){
			    $updateDealer['email'] = $_POST['email'];
			    DB::table('dealer_accounts')->where('user_id', Auth::user()->id)->update($updateDealer);
			}
			
			
			
			

			Session::flash('message', 'Your account settings has been updated!');
			Session::flash('alert-class', 'alert-success');

			return back();
		
	}


    // accountPasswordUpdate
	public function accountPasswordUpdate(Request $request){

	$user_password = Auth::user()->password;
	$current = $_POST['current_pass'];

	if(Hash::check($current, $user_password)){

		$this->validate($request, [
				'password' => 'required|string|min:6',
				'password_confirmation' => 'required',
			]);

		
		$user = DB::table('users')->where('id', Auth::user()->id)->first();

		$password = $_POST['password'];
		$confirmpass = $_POST['password_confirmation'];

		if($password == $confirmpass ){
			if(trim($_POST['password']) != "") {
				$insertArr['password'] = Hash::make($_POST['password']);
			}

			DB::table('users')
			->where('id', Auth::user()->id)
			->update(
				$insertArr
			);


			// logout after password reset
			Auth::logout();

			Session::flash('message', 'Your account password has been updated. Please login back with the new password.');
			Session::flash('alert-class', 'alert-success');

			return redirect('signin');
		}

		else{

			Session::flash('flash_message', 'Passwords do not match!');
			Session::flash('alert-class', 'alert-danger');
			return back();
		}

	}
	else{

		Session::flash('flash_message', 'Current password entered is incorrect!');
		Session::flash('alert-class', 'alert-danger');
		return back();

	}

		
	}


	public function accountDetail()
    {
		$orders = orders::where('orders.user_id', Auth::user()->id)
						->orderBy('orders.id', 'desc')
						->get();
		
		return view('account.account',['ORDERS'=>$orders]); 
		
	}
	
	public function invoice($id)
    {
		$order_id = $id;
		$order = orders::where('id',$order_id)->first();
		$order_products = orders_products::where('orders_id',$order_id)->get();
		
		return view('account.invoice')->with('title','Invoice #'.$order_id)->with(compact('order','order_products'))->with('order_id',$order_id);; 
	}


	public function friends()
    {
		return view('account.friends'); 
		
	}

	public function upload()
    {
		return view('account.upload'); 
		
	}

	public function password()
    {
		return view('account.password'); 
		
	}
	
}	
	
