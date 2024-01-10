<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Session;
use Mail;
use App\imagetable;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/'; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
            //'g-recaptcha-response' => 'required',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // storing in session
        $register['name'] = $request->name;
        $register['last_name'] = $request->last_name;
        $register['email'] = $request->email;
        $register['password'] = $request->password;
        Session::put('register',$register);

     
        $validator = $this->validator($request->all());
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator, 'registerForm');
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);


        // REGISTRATION EMAIL
        $send_email = array();
        $send_email['name'] = $request->name;
        $send_email['last_name'] = $request->last_name;
        $send_email['email'] = $request->email;
        
        Mail::send('mailingtemplates.userRegistration', ['send_email' => $send_email], function ($m) use ($send_email) {
            $m->from('john.david7595@gmail.com', 'Modernaire');
            $m->to($send_email['email'],'Modernaire')->subject('Registration');
        });
        // REGISTRATION EMAIL

        
        Session::flash('message', 'New account created successfully!'); 
        Session::flash('alert-class', 'alert-success'); 

        // session forget
        Session::forget('register');

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        if($user->profile == null){
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->localisation = $request->localisation;
            $profile->dob = $request->dob;
            $profile->save();
        }
        activity($user->name)
            ->performedOn($user)
            ->causedBy($user)
            ->log('Registered');
        $user->assignRole('user');
    }
}
