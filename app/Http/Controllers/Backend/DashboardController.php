<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Session;
use App\Repositories\Backend\Auth\ProUserRepository;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(ProUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $default_admin_language =  config('global_configurations.admin.language');
        if($default_admin_language == ''){
            $default_admin_language = 'fi';
        }
        Session::put('locale', $default_admin_language);
        return view('backend.dashboard');
    }
    public function users()
    {
        return view('backend.prousers')
            ->withUsers($this->userRepository->getActivePaginated(25, 'id', 'asc'));
    }
}