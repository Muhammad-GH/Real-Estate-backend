<?php

namespace App\Events\Backend\Auth\ProUser;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserConfirmed.
 */
class ProUserConfirmed
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
