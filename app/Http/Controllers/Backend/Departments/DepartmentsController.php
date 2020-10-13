<?php

namespace App\Http\Controllers\Backend\Departments;

use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\JobDepartment;
use App\Models\JobDepartmentLanguage;
// use App\Models\Auth\User;
use App\Repositories\Backend\DepartmentsRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class DepartmentsController.
 */
class DepartmentsController extends Controller
{
    /**
     * @var DepartmentsRepository
     */
    protected $departmentsRepository;

    /**
     * DepartmentsController constructor.
     *
     * @param departmentsRepository $departmentsRepository
     */
    public function __construct(DepartmentsRepository $departmentsRepository)
    {
        $this->departmentsRepository = $departmentsRepository;
    }



    public function getJobDepartmentLanguage($department_id)
    {
        return JobDepartmentLanguage::where('department_id',$department_id)->first();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.departments.index')
            ->withDepartments($this->departmentsRepository->getActivePaginated(25, 'department_id', 'asc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $languages = Languages::where('status', 1)->get();
        return view('backend.departments.create',
            [
                'languages' => $languages,
            ]);
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, JobDepartment $jobDepartment, JobDepartmentLanguage $departmentLanguage)
    {
        $data = $request->all();
        $jobDepartment = new JobDepartment();
        $jobDepartment->sort_name = utf8_encode($data['sort_name']['fi']);
        $jobDepartment->department_name = utf8_encode($data['department_name']['fi']);
        $jobDepartment->language_code ='fi';
        $jobDepartment->save();
        if(count($data['department_name']) > 1){
            foreach($data['department_name'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $departmentLanguage = new JobDepartmentLanguage();
                $departmentLanguage->department_name = utf8_encode($data['department_name'][$l_id]);
                $departmentLanguage->sort_name = utf8_encode($data['sort_name'][$l_id]);
                $departmentLanguage->parent_id = $jobDepartment->id;
                $departmentLanguage->language_code = $l_id;
                $departmentLanguage->save();
            }
        }
        return redirect()->route('admin.departments.index')->withFlashSuccess('The Department has been successfully created.');
    }


    public function getJobDepartment($jobDepartmentId)
    {
        return JobDepartment::where('department_id',$jobDepartmentId)->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$department_id)
    {
        $JobDepartmentData = $this->getJobDepartment($department_id);
        $departmentLanguages = JobDepartmentLanguage::where('parent_id',$department_id)->get();
        $languages = Languages::where('status', 1)->get();
        $data['fi']['department_name'] = $JobDepartmentData->department_name;
        $data['fi']['sort_name'] = $JobDepartmentData->sort_name;

        if($departmentLanguages){
            foreach($departmentLanguages as $departmentLanguage){
                $data[$departmentLanguage->language_code]['department_name'] = $departmentLanguage->department_name;
                $data[$departmentLanguage->language_code]['sort_name'] = $departmentLanguage->sort_name;
            }
        }
        return view('backend.departments.edit',
            [
                'department_id' => $department_id,
                'languages' => $languages,
                'data' => $data,
            ]);
    }
    public function update(Request $request, $department_id)
    {
        $data = $request->all();
        $jobDepartment =  JobDepartment::where('department_id',$department_id)->first();
        $jobDepartment->sort_name = utf8_encode($data['sort_name']['fi']);
        $jobDepartment->department_name = utf8_encode($data['department_name']['fi']);
        $jobDepartment->save();
        if(count($data['department_name']) > 1){
            foreach($data['department_name'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $departmentLanguage = JobDepartmentLanguage::where('parent_id',$department_id)->where('language_code',$l_id)->first();
                if(!$departmentLanguage){
                    $departmentLanguage = new JobDepartmentLanguage();
                }
                $departmentLanguage->sort_name = utf8_encode($data['sort_name'][$l_id]);
                $departmentLanguage->department_name = utf8_encode($data['department_name'][$l_id]);
                $departmentLanguage->parent_id = $jobDepartment->department_id;
                $departmentLanguage->language_code = $l_id;
                $departmentLanguage->save();
            }
        }

        return redirect()->route('admin.departments.index')->withFlashSuccess('Department has been updated successfully.');
    }
    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($department_id)
    {
        $jobDepartment =  JobDepartment::where('department_id',$department_id)->first();
        if ($jobDepartment != null) {
            $jobDepartment->delete();
            $departmentLanguage = JobDepartmentLanguage::where('parent_id',$department_id)->get();
            if ($departmentLanguage != null) {
                foreach($departmentLanguage as $pd){
                    $pd->delete();
                }
            }
            return redirect()->route('admin.departments.index')->withFlashSuccess(__('Department has been deleted successfully.'));
        }
        return redirect()->back();
    }
}
