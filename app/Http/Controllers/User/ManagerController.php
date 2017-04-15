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

    private $tableRelationship = ['role'];

    /**
     * If the user is not activated then 
     * he will be redirected to login page,
     * if everything is ok then an scope is applied to return
     * all users in the DB or just the authenticated one.
     *
    **/
    public function show()
    {
    	if (!Auth::user()->activate) {
    		return redirect()->route('login');
    	}

    	$roleId = Auth::user()->role_id;
    	$roleAlias = Role::findOrFail($roleId)->alias;

    	$data = User::authorized($roleAlias)
            ->with($this->tableRelationship)
            ->paginate(10);

    	return view('home')->with('users', $data);
    }

    /**
     * Store a new user
     * @param StoreUserFormRequest A custom rules validation
    **/
    public function store(StoreUserFormRequest $request)
    {        
        $userData = $request->except('password');
        $userData['password'] = bcrypt($request->get('password'));
        $userData['able_to_read'] = $request->has('able_to_read');;
        $userData['activate'] = $request->has('activate');
        
        User::create($userData);

        return back()->with('status', 'User Succefully created');
    }

    /**
     * Updates an existing user, if the auth user has role 1 (Administrator)
     * then the permissions are applied
     * @param StoreUserFormRequest A custom rules validation
    **/
    public function update(Request $request)
    {
        $id = $request->get('id');
        $this->validate($request, [
            'email' => "filled|min:7|unique:users,email,{$id}",
        ]);
        $userData = $request->except($this->exclude);        
        $password = $request->get('password');
        if ($password) {
            $userData['password'] = bcrypt($password);
        }

        if (Auth::user()->role_id == 1) {
            $userData['able_to_read'] = $request->has('able_to_read');
            $userData['activate'] = $request->has('activate');
        }
        
        
        $user = User::findOrFail($id);        
        $user->update($userData);

        return back();
    }

    /**
     * Deletes a new user
     * @param Request
    **/
    public function delete(Request $request)
    {
        $userId = $request->get('id');
        $user = User::findOrFail($userId);
        $user->delete();
        
        return back();
    }
}
