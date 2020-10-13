<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;
use App\Models\Auth\UserDetail;
use App\Models\UserInvest;
/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }
    
    /**
     * @return mixed
     */
    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }
   
    public function userInvest()
    {
        return $this->hasMany(UserInvest::class);
    }
}
