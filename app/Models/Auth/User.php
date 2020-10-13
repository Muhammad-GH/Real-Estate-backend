<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;

        protected $fillable = [
            'first_name', 'last_name','email', 'password','confirmed','phone',
            'active',
            'confirmed',
            'roles',
            'rights',
            ];/**
            * The attributes that should be hidden for arrays.
            *
            * @var array
            */protected $hidden = [
            'password', 'remember_token',
            ];


}
