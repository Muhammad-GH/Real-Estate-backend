<?php

namespace App\Http\Controllers\Backend\Jobs;

use App\Models\JobDepartment;
use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Jobs;
use App\Models\JobsLanguage;
// use App\Models\Auth\User;
use App\Repositories\Backend\JobsRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class JobsController.
 */
class JobsController extends Controller
{
    /**
     * @var JobsRepository
     */
    protected $jobsRepository;

    /**
     * JobsController constructor.
     *
     * @param JobsRepository $jobsRepository
     */
    public function __construct(JobsRepository $jobsRepository)
    {
        $this->jobsRepository = $jobsRepository;
    }



    public function getJobsLanguage($Id)
    {
        return JobsLanguage::where('id',$Id)->first();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.jobs.index')
            ->withJobs($this->jobsRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $languages = Languages::where('status', 1)->get();
        $department_data = [];
        $departments = JobDepartment::get();
        if($departments){
            foreach($departments as $department){
                $department_data[$department->department_id] =  $department->department_name;
            }
        }
        return view('backend.jobs.create',
            [
                'languages' => $languages,
                'department_data' => $department_data,
            ]);
    }

    public function uploadImage($image){
        //$size = $image->getSize();;
        $imageName  = time()."_".$image->getClientOriginalName();
        $image->move(public_path().'/images/jobs/', $imageName);
        return $imageName;
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Jobs $jobs, JobsLanguage $jobsLanguage)
    {
        $data = $request->all();
        $job = new Jobs();
        $job->title = $data['title']['fi'];
        $job->short_description = $data['short_description']['fi'];
        $job->description = $data['description']['fi'];
        $job->designation = $data['designation']['fi'];
        $job->vacancy = $data['vacancy']['fi'];
        $job->start_date = strtotime($data['start_date']['fi']);
        $job->end_date = strtotime($data['end_date']['fi']);
        $job->departmentId = $data['departmentId']['fi'];
        $job->location = $data['location']['fi'];
        $job->status = ($data['status']['fi']);
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            if(isset($file['fi'])){
                $job->image = $this->uploadImage($file['fi']);
            }
        }
        $job->language_code = 'fi';
        $job->save();
        if(count($data['title']) > 1){
            foreach($data['title'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $jobLanguage = new JobsLanguage();
                $jobLanguage->title = $data['title'][$l_id];
                $jobLanguage->short_description = $data['short_description'][$l_id];
                $jobLanguage->description = $data['description'][$l_id];
                $jobLanguage->designation = $data['designation'][$l_id];
                $jobLanguage->departmentId = $data['departmentId'][$l_id];
                $jobLanguage->location = $data['location'][$l_id];
                $jobLanguage->vacancy = $data['vacancy'][$l_id];
                $jobLanguage->start_date = strtotime($data['start_date'][$l_id]);
                $jobLanguage->end_date = strtotime($data['end_date'][$l_id]);
                $jobLanguage->status = ($data['status'][$l_id]);
                $jobLanguage->parent_id = $job->id;
                $jobLanguage->language_code = $l_id;
                if($request->hasfile('image'))
                {
                    $file = $request->file('image');
                    if(isset($file[$l_id])){
                        $jobLanguage->image = $this->uploadImage($file[$l_id]);
                    }
                }
                $jobLanguage->save();
            }
        }
        return redirect()->route('admin.jobs.index')->withFlashSuccess('The Jobs has been successfully created.');
    }


    public function getJobs($JobsId)
    {
        return Jobs::where('id',$JobsId)->with('jobLanguage')->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$id)
    {
        $languages = Languages::where('status', 1)->get();
        $department_data = [];
        $departments = JobDepartment::get();
        if($departments){
            foreach($departments as $department){
                $department_data[$department->department_id] =  $department->department_name;
            }
        }
        $JobsData = $this->getJobs($id);
        $JobsLanguage = JobsLanguage::where('parent_id',$id)->get();
        $data['fi']['title'] = $JobsData->title;
        $data['fi']['short_description'] = $JobsData->short_description;
        $data['fi']['description'] = $JobsData->description;
        $data['fi']['designation'] = $JobsData->designation;
        $data['fi']['vacancy'] = $JobsData->vacancy;
        $data['fi']['image'] = $JobsData->image;
        $data['fi']['departmentId'] = $JobsData->departmentId;
        $data['fi']['location'] = $JobsData->location;
        $data['fi']['start_date'] = $JobsData->start_date;
        $data['fi']['end_date'] = $JobsData->end_date;
        $data['fi']['status'] = $JobsData->status;
        if($JobsLanguage){
            foreach($JobsLanguage as $jobLanguage){
                $data[$jobLanguage->language_code]['title'] = $jobLanguage->title;
                $data[$jobLanguage->language_code]['short_description'] = $jobLanguage->short_description;
                $data[$jobLanguage->language_code]['description'] = $jobLanguage->description;
                $data[$jobLanguage->language_code]['designation'] = $jobLanguage->designation;
                $data[$jobLanguage->language_code]['vacancy'] = $jobLanguage->vacancy;
                $data[$jobLanguage->language_code]['image'] = $jobLanguage->image;
                $data[$jobLanguage->language_code]['departmentId'] = $jobLanguage->departmentId;
                $data[$jobLanguage->language_code]['location'] = $jobLanguage->location;
                $data[$jobLanguage->language_code]['start_date'] = $jobLanguage->start_date;
                $data[$jobLanguage->language_code]['end_date'] = $jobLanguage->end_date;
                $data[$jobLanguage->language_code]['status'] = $jobLanguage->status;
            }
        }
        return view('backend.jobs.edit',
            [
                'id' => $id,
                'languages' => $languages,
                'data' => $data,
                'department_data' => $department_data,
            ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $job =  $this->getJobs($id);
        $job->title = $data['title']['fi'];
        $job->short_description = $data['short_description']['fi'];
        $job->description = $data['description']['fi'];
        $job->designation = $data['designation']['fi'];
        $job->departmentId = $data['departmentId']['fi'];
        $job->location = $data['location']['fi'];
        $job->vacancy = $data['vacancy']['fi'];
        $job->start_date = strtotime($data['start_date']['fi']);
        $job->end_date = strtotime($data['end_date']['fi']);
        $job->status = ($data['status']['fi']);
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            if(isset($file['fi'])){
                $job->image = $this->uploadImage($file['fi']);
            }
        }
        $job->save();
        if(count($data['title']) > 1){
            foreach($data['title'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $jobLanguage = JobsLanguage::where('parent_id',$id)->where('language_code',$l_id)->first();
                if(!$jobLanguage){
                    $jobLanguage = new JobsLanguage();
                }
                $jobLanguage->title = $data['title'][$l_id];
                $jobLanguage->short_description = $data['short_description'][$l_id];
                $jobLanguage->description = $data['description'][$l_id];
                $jobLanguage->designation = $data['designation'][$l_id];
                $jobLanguage->departmentId = $data['departmentId'][$l_id];
                $jobLanguage->location = $data['location'][$l_id];
                $jobLanguage->vacancy = $data['vacancy'][$l_id];
                $jobLanguage->start_date = strtotime($data['start_date'][$l_id]);
                $jobLanguage->end_date = strtotime($data['end_date'][$l_id]);
                $jobLanguage->status = ($data['status'][$l_id]);
                $jobLanguage->parent_id = $job->id;
                $jobLanguage->language_code = $l_id;
                if($request->hasfile('image'))
                {
                    $file = $request->file('image');
                    if(isset($file[$l_id])){
                        $jobLanguage->image = $this->uploadImage($file[$l_id]);
                    }
                }
                $jobLanguage->save();
            }
        }

        return redirect()->route('admin.jobs.index')->withFlashSuccess('Job has been updated successfully.');
    }
    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($id)
    {
        $jobs =  Jobs::where('id',$id)->first();
        if ($jobs != null) {
            $jobs->delete();
            return redirect()->route('admin.jobs.index')->withFlashSuccess(__('Job has been deleted successfully.'));
        }
        return redirect()->back();
    }
}
