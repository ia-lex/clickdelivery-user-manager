<?php

namespace App\Http\Controllers\Ext;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Socialite;
use Exception;

class FacebookAuthController extends Controller
{
	/**
	 * Redirect the user to facebook authentication page
	**/
    public function redirectToProvider()
    {
    	return Socialite::driver('facebook')->redirect();
    }

    /**
     * Get the user information from facebook
    **/
    public function handleProviderCallback()
    {
    	try {
    		$user = Socialite::driver('facebook')->user();
    	} catch (Exception $e) {
    		return redirect('auth/facebook');
    	}

    	$authUser = $this->getOrCreateUser($user);

        if (!$authUser) {
            return back()->with('noAuth', 'Your email is already registered');
        }
        
    	Auth::login($authUser, false);

    	return redirect('home');
    }

    /**
     * Get or create a new user
    **/
    private function getOrCreateUser($facebookUser)
    {
    	$user = User::where('facebook_id', $facebookUser->id)->first();
    	if ($user) {
    		return $user;
    	}

    	$password = bcrypt($facebookUser->name);
    	$roleId = Role::where('alias', Role::user_role_alias)
            ->first()
            ->id;

        $duplicate = User::where('email', $facebookUser->email)->first();
        if ($duplicate) {            
            return ;
        }

    	return User::create([
    		'name' => $facebookUser->name, 
    		'email' => $facebookUser->email,
    		'password' => $password,
    		'role_id' => $roleId,
    		'activate' => true,
    		'facebook_id' => $facebookUser->id
    	]);
    }
}
