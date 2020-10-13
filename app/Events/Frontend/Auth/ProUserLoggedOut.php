<?php

namespace App\Events\Frontend\Auth;

use App\Models\Auth\ProUser;
use Illuminate\Queue\SerializesModels;

/**
 * Class ProUserLoggedOut.
 */
class ProUserLoggedOut
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
