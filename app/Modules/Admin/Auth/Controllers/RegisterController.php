<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pub\SiteController;
use App\Mail\RegisterEmail;
use App\Models\Script;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends SiteController
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
        $this->middleware('guest')->except('logout');

        parent::__construct((new Script()));
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'is_register' => '0',
            'is_moderate' => '1',
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'entrance' => $data['entrance'],
            'floor' => $data['floor'],
            'flat' => $data['flat'],
            'aboutMy' => $data['aboutMy'],
            'status' => 1,
            'token' => str_random(30),
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);

        if($user) {
            $user->roles()->attach(2);
            return $user;
        }
        return null;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        //template
        $this->template = 'public::auth.register';

        //canonical url
        $this->canonical = trim(\Request::root(),'/').'/';

        //title
        $this->title = "Register page";

        //render output
        return $this->renderOutput();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        $this->registered($request, $user);

        return redirect($this->redirectPath());
    }

    /*private function sendConfirmationEmail($user)
    {
        $user->sendRegisterNotification();
    }*/

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectTo()
    {
        Session::flash('message',\trans('admin.register_succes_confirm_email'));
        Session::flash('status','success');
        return route('register');
    }

    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = User::whereToken($token)->first();

        if(empty($user)) {
            return redirect()->route('login')->with(['message' => 'Link is wrong.','status'=>'error']);
        }

        if($user->confirmEmail()) {
            return redirect()->route('login')->with(['message'=>'Your account has been activated.','status'=>'success']);
        }
    }


}
