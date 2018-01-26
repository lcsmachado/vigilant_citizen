<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{

    public  function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.adminLogin');
    }

    public function login(Request $request)
    {
        //Validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attempt to log the user in
        $admin = Admin::where('email',$request->email)->first();
        if($admin != null)
        {
            if($admin->status == 1 && $admin->deleted == 0) {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) { //if successful, then redirect to their intended location

                    return redirect()->intended(route('painel'));
                }
            }
        }

        //if unsuccessful, then redirect back to the form login
        Session::flash('message','Falha ao logar!');
        return redirect()->back()->withInput($request->only('email','remember'));
    }

   /* public function Adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }*/

}
