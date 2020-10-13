<?php

namespace App\Events\Frontend\Auth;

use App\Models\Auth\ProUser;
use Illuminate\Queue\SerializesModels;

/**
 * Class ProUserLoggedIn.
 */
class ProUserLoggedIn
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct(ProUser $user)
    {
        $this->user = $user;
    }
}
