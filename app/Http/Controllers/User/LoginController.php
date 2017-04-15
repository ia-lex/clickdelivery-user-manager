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

    /**
     * Get credentials an attemps a login, if there is no credentials
     * then an error is returned, if there is credentials but the account
     * is not activated yet, then a message is showed, if everything is ok
     * then redirect to manager
     * @param Request
    **/
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

    /**
     * Close the session and redirect to login
     *
    **/
    public function logout()
    {       
        $this->closeSession();
        return redirect()->route('login');
    }    

    /**
     * Flush and logout the actual user
    **/
    private function closeSession()
    {
        Session::flush();
        Auth::logout();
    }
}
