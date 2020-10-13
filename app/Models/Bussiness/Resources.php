<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Auth\BaseUser;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

class Resources extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;
    // use SoftDeletes;
    // protected $guard = 'proresource';
    protected $table = 'pro_resources';
    protected $fillable = ['first_name', 'last_name', 'email', 'company', 'type', 'status'];
    protected $hidden = ['password'];

    public function permission()
    {
        return $this->hasOne('App\Models\Bussiness\ProResourcePermission', 'id', 'permission_id');
    }
}
