<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserFormRequest;
use App\Role;
use App\User;

class RegisterController extends Controller
{
    
    public function show()
    {
        return view('auth.register');
    }

    public function store (StoreUserFormRequest $request)
    {
        $roleId = Role::where('alias', Role::user_role_alias)
            ->first()
            ->id;

        $userData = $request->except('password');
        $userData['password'] = bcrypt($request->get('password'));
        $userData['role_id'] = $roleId;
        
        User::create($userData);

        return redirect('login')->with('status', 'User Succefully created');

    }
}
