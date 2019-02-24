<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Admin;

class AdminsController extends Controller
{
    use AuthenticatesUsers;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }

    /**
     * Show the form for Admin login
     *
     * @return \Illuminate\Http\Response
     */
    public function adminLoginForm()
    {
      return view('admin.login');
    }


    /**
     * Authentication of administrator
     */
    public function adminLogin(Request $request)
    {
      $this->validate($request, Admin::$rules);

      $admin = Auth::guard('admin')->attempt([
        'email'     => $request->email,
        'password'  => $request->password,
      ]);

      if ($admin)
      {
        return redirect()->route('index');
      }
      else
      {
        return redirect()->route('admin.login.form')->withErrors([
          'error'     => 'Identifiants incorrects',
        ]);
      }
    }



    /**
     * Disconnection of administrator
     */
    public function adminLogout()
    {
      Auth::guard('admin')->logout();
      return redirect()->route('index');
    }
}
