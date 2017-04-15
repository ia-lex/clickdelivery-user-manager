<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /**
     * Returns a view
    **/
    public function show()
    {
        return view('auth.login');
    }

    
    public function authenticate(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        if (!Auth::attempt($credentials)) {
            return back()->with('noAuth', 'Bad credentials');
        } elseif (!Auth::user()->activate) {
            $this->closeSession();
            return back()->with('noAuth', 'Your account is not activated');
        } else {
            return redirect()->route('manager');
        }
        
    }

    public function logout()
    {       
        $this->closeSession();
        return redirect()->route('login');
    }    

    private function closeSession()
    {
        Session::flush();
        Auth::logout();
    }
}
