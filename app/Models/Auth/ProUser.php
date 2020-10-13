<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\ProUserScope;
use App\Models\Auth\Traits\Method\ProUserMethod;
use App\Models\Auth\Traits\Attribute\ProUserAttribute;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;
use App\Models\Auth\Traits\Relationship\ProUserRelationship;

/**
 * Class ProUser.
 */
class ProUser extends BaseUser
{
    use ProUserAttribute,
        ProUserMethod,
        ProUserRelationship,
        ProUserScope;
    protected $table = 'pro_users';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'confirmed', 'phone',
        'type',
        'subtype',
        'active',
        'confirmed',
        'roles',
        'rights',
        'token',
        'photo'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */ protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserNeedsPasswordReset($token));
    }
}
