<?php

namespace App\Http\Controllers\Auth;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
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

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    protected function showLinkRequestForm(){
        $search = null;
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('auth.passwords.email',compact('categories','search'));
    }
}
