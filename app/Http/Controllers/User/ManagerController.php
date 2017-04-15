<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\StoreUserFormRequest;
use App\User;
use App\Role;

class ManagerController extends Controller
{
    private $exclude = [
        '_token', 
        '_method', 
        'id', 
        'password', 
        'able_to_read', 
        'activate'
    ];

    public function show()
    {
    	if (!Auth::user()->activate) {
    		return redirect()->route('login');
    	}

    	$roleId = Auth::user()->role_id;
    	$roleAlias = Role::findOrFail($roleId)->alias;

    	$data = User::authorized($roleAlias)->paginate(10);

    	return view('home')->with('users', $data);
    }

    public function update(StoreUserFormRequest $request)
    {
        $userData = $request->except($this->exclude);
        $id = $request->get('id');
        $password = $request->get('password');
        $ableToRead = $request->has('able_to_read');
        $activate = $request->has('activate');
        if ($password) {
            $userData['password'] = bcrypt($password);
        }

        if (Auth::user()->role_id == 1) {
            $userData['able_to_read'] = $ableToRead;
            $userData['activate'] = $activate;
        }
        
        
        $user = User::findOrFail($id);        
        $user->update($userData);
        return back();
    }

    public function store(StoreUserFormRequest $request)
    {        
        $userData = $request->except('password');
        $userData['password'] = bcrypt($request->get('password'));
        $userData['able_to_read'] = $request->has('able_to_read');;
        $userData['activate'] = $request->has('activate');
        
        User::create($userData);

        return back()->with('status', 'User Succefully created');
    }

    public function delete(Request $request)
    {
        $userId = $request->get('id');
        $user = User::findOrFail($userId);
        $user->delete();
        
        return back();
    }
}
