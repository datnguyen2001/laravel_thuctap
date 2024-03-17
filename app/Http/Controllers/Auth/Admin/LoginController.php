<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Notifications\VerifyRegistration;
use App\Models\Admin;
use Illuminate\Http\Request;

use Auth;


class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
  *
  * @var string
  */
  protected $redirectTo = '/admin';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm()
  {
    return view('auth.admin.login');
  }


  public function login(Request $request)
  {

    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
     ]);
    
    
    $admin = Admin::Where('email',$request->email)->Where('password',$request->password)->first();
    
    if ($admin) { 
    
      return redirect()->route('admin.index');

    }
    
    else {
      session()->flash('error', 'Invalid Login');
      return back();
    
    }  

  

}


public function logout(Request $request)
  {

    $this->guard()->logout();
    $request->session()->invalidate();
    return redirect()->route('admin.login');

  }



}