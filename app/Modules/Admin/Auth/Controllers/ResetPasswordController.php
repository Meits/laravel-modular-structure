<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pub\SiteController;
use App\Models\Script;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
        parent::__construct((new Script()));
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {

        //template
        $this->template = 'public::auth.passwords.reset';

        //title
        $this->title = "Password Reset page";

        //canonical url
        $this->canonical = trim(\Request::root(),'/').'/';

        $this->vars['token'] = $token;
        $this->vars['email'] = $request->email;

        //render output
        return $this->renderOutput();

    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {

        Session::flash('message',\trans('admin.reset_password_confirm'));
        Session::flash('status','success');
        return redirect($this->redirectPath());
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        Session::flash('message',trans($response));
        Session::flash('status','error');
        return redirect()->back();
    }
}
