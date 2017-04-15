<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that should be casted
    **/
    protected $casts = [
        'able_to_read' => 'boolean',
        'activate' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'facebook_id',
        'role_id', 
        'phone_number', 
        'able_to_read', 
        'activate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all users if the role is admin or agent
     * @param [$role] The role of the authenticated user
     *
    **/
    public function scopeAuthorized($query, $role)
    {
        $allowedAlias = [
            Role::admin_role_alias,
            Role::agent_role_alias,
        ];

        if (!in_array($role, $allowedAlias)) {
            $query->findOrFail(Auth::user()->id);
        }

        return $query;
    }

    /**
     *The user belongs to a role
     *
    **/
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
