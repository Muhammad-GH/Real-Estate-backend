<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\ProUser;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\ProUserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use Illuminate\Http\Request;
use DB;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

/**
 * Class UserConfirmationController.
 */
class ProUserConfirmationController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(ProUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function sendConfirmationEmail(ManageUserRequest $request, ProUser $user)
    {
        // Shouldn't allow users to confirm their own accounts when the application is set to manual confirmation
        if (config('access.users.requires_approval')) {
            return redirect()->back()->withFlashDanger(__('alerts.backend.users.cant_resend_confirmation'));
        }

        if ($user->isConfirmed()) {
            return redirect()->back()->withFlashSuccess(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.users.confirmation_email'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function confirm(ManageUserRequest $request, ProUser $user)
    {
        $this->userRepository->confirm($user);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.confirmed'));
    }

    public function IsConfirmed(Request $request)
    {
        $confirmed = DB::table('pro_users')
            ->where('id', $request->segment(4))
            ->update(['confirmed' => true]);
        return redirect()->back();
    }
    public function IsUnConfirmed(Request $request)
    {
        $confirmed = DB::table('pro_users')
            ->where('id', $request->segment(4))
            ->update(['confirmed' => false]);
        return redirect()->back();
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function unconfirm(ManageUserRequest $request, ProUser $user)
    {
        $this->userRepository->unconfirm($user);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.unconfirmed'));
    }
}
