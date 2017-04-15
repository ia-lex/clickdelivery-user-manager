<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     *This constants Must match those
     *in Role table alises
     *
    **/
    const admin_role_alias = 'ADM';
    const agent_role_alias = 'AGT';
    const user_role_alias = 'USR';

    protected $guarded = ['id'];
}
