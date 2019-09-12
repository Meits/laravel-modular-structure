<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pub\SiteController;
use App\Models\Script;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        //template
        $this->template = 'public::auth.passwords.email';

        //title
        $this->title = __("public.auth_forgot_password_page_title");

        //canonical url
        $this->canonical = trim(\Request::root(),'/').'/';

        //render output
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        Session::flash('message',\trans('public.reset_password_send_link'));
        Session::flash('status','success');
        return redirect()->back();
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        Session::flash('message',trans($response));
        Session::flash('status','error');
        return back();
    }

}
