<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\DealerAccount;
use Illuminate\Http\Request;
use Image;
use File;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\imagetable;
use Illuminate\Validation\Rule;


class DealerAccountController extends Controller
{

    public function __construct()
    {
        
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
        
        
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 10000;

            if (!empty($keyword)) {
                $dealeraccount = DealerAccount::where('dealer_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $dealeraccount = DealerAccount::paginate($perPage);
            }

            return view('admin.dealer-account.index', compact('dealeraccount'));
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
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $dealer_id = \DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->pluck('name', 'id');
            
            return view('admin.dealer-account.create', compact('dealer_id'));
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
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'email' => 'required|string|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
		]);
		
	
		$dealer = DB::table('dealers')->where('id', $request->dealer_id)->first();
		$name = $dealer->name;
		$email = $request->email;
		
		
		// store in user table
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($_POST['password']),
                'user_type' => '2',
            ]);
            
       
            
            

            $dealeraccount = new dealeraccount($request->all());
            $dealeraccount->dealer_id = $request->dealer_id;
            $dealeraccount->user_id = $user->id;
            $dealeraccount->name = $name;
            $dealeraccount->email = $email;
            
            $dealeraccount->save();
            
            
            
            // REGISTRATION EMAIL
            $send_email = array();
            $send_email['email'] = $email;
            $send_email['password'] = $request->password;
            
             Mail::send('mailingtemplates.dealerRegistration', ['send_email' => $send_email], function ($m) use ($send_email) {
                  $m->from('john.david7595@gmail.com', 'Modernaire');
                  $m->to($send_email['email'],'Modernaire')->subject('Dealer Account');
              });
            // REGISTRATION EMAIL
            
            
            

            return redirect('admin/dealer-account')->with('message', 'Dealer account added!');
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
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $dealeraccount = DealerAccount::findOrFail($id);
            return view('admin.dealer-account.show', compact('dealeraccount'));
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
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $dealeraccount = DealerAccount::findOrFail($id);
            
            $dealer_id = \DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->pluck('name', 'id');
            
            return view('admin.dealer-account.edit', compact('dealeraccount', 'dealer_id'));
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
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $dealer_user = DB::table('dealer_accounts')->where('id', $id)->first()->user_id;
        
            
            
		
		
		    if($request->password != ''){
                $this->validate($request, [
			        'email' => ['required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', 'string', 'email', 'max:255', Rule::unique('users')->ignore($dealer_user)],
                    'password' => 'required|confirmed|min:8',
                    'password_confirmation' => 'required|same:password',
		        ]);
                
            }
            else{
                $this->validate($request, [
			        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($dealer_user)],
		        ]);
            }
            $requestData = $request->all();
            

        


            $dealeraccount = DealerAccount::findOrFail($id);
             $dealeraccount->update($requestData);
             
             
            // update user table
            $updateUser['email'] = $request->email;

            if($request->password != ''){
                $updateUser['password'] = Hash::make($_POST['password']);
            }

            DB::table('users')->where('id', $dealer_user)->update($updateUser);
            
            
            

             return redirect('admin/dealer-account')->with('message', 'Dealer account updated!');
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
        $model = str_slug('dealeraccount','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            // DealerAccount::destroy($id);
            
            
            
            // delete from user table
            $dealer = DB::table('dealer_accounts')->where('id', $id)->first();
            
            $updateUser['deleted_at'] = now();
            DB::table('dealer_accounts')->where('id', $id)->update($updateUser);
            DB::table('users')->where('id', $dealer->user_id)->update($updateUser);

            return redirect('admin/dealer-account')->with('message', 'Dealer account has been disabled!');
        }
        return response(view('403'), 403);

    }
    
    
    // enableDealer
    public function enableDealer($id){
        $dealer = DB::table('dealer_accounts')->where('id', $id)->first();
        
        $update['deleted_at'] = null;
        DB::table('dealer_accounts')->where('id', $id)->update($update);
        DB::table('users')->where('id', $dealer->user_id)->update($update);
        
        return redirect('admin/dealer-account')->with('message', 'Dealer account has been enabled!');
    }
}
