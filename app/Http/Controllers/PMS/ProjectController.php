<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Bussiness\Project;
use App\Models\Bussiness\ProjectTask;
use App\Models\Bussiness\ProjectTaskTime;
use App\Models\Bussiness\Area;
use App\Models\Bussiness\Resources;
use App\Models\Bussiness\Agreement;
use App\Models\Bussiness\ProjectTaskTemplate;
use App\Models\Bussiness\ProjectTaskTemplateName;
use App\Models\Bussiness\ProjectClosure;
use App\Models\Bussiness\ChatGroup; 
use App\Models\Bussiness\ChatUserGroup; 
use App\Models\Bussiness\ChatMessages; 
use DB;
/**
 * Class ProjectController.
 */
class ProjectController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $searchValue = '';
        
        $query = Project::with('user')->with('resource');

        if(auth()->guard('pro')->check()){
            
            $query->where('pro_user_id','=',auth()->guard('pro')->user()->id);
            $proUserId = auth()->guard('pro')->user()->id;
            $query->orWhereHas('agreement', function($q) use ($proUserId)
                {
                    $q->whereHas('prouser', function($q) use ($proUserId)
                        {
                            $q->where('agreement_client_id','=', $proUserId);
                        }
                    );
                }
            );
            // $query->orWhere();
            // $query->orWhere();

        } elseif(auth()->guard('proresource')->check()){
            $query->with('tasks');
            $query->orWhere('pro_resource_id','=',auth()->guard('proresource')->user()->id);
            $resid = auth()->guard('proresource')->user()->id;
            $query->orWhereHas('tasks', function ($qry) use($resid) {
                $qry->where('assignee_to', 'like', '%'.$resid.'%');
                $qry->orWhere('report_to', '=', $resid );
            });
        }

        if($request->query('search') && $request->query('search') != ''){
            $searchValue = $request->query('search');
            $query->where(function ($q) use($searchValue) {
                $q->where('key_name', 'LIKE', '%'.$searchValue.'%');
                $q->orWhere('name', 'LIKE', '%'.$searchValue.'%');
            });
        }
        $data = $query->get();

        $breadcrumb = [
            ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
            ['name'=> __('pms.project.title') , 'route'=>'frontend.pms.project']
        ];

        $recent = Project::with('resource')->where('start_date','!=',null)->limit(3)->orderBy('updated_at', 'asc')->get();
        
        return view('pms.project.index')->withPage('project')->withBreadcrumb($breadcrumb)->withProjects($data)->withSearchValue($searchValue)->withRecentProject($recent);
    }

    /**
     * Create Function
     */
    public function create(){
        return redirect()->route('frontend.pms.project.create.aggrement');
    }

    /**
     * Create From Propoal Function
     */
    public function create_aggrement(){
        $userID = null;
        if(auth()->guard('pro')->check()){
            $userID = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $userID = auth()->guard('proresource')->user()->user_id;
        }
        $aggrements = Agreement::where('agreement_user_id',$userID)->get();
        // echo "<pre>";
        // print_r($aggrements);
        // die;

        return view('pms.project.create_aggrement')->withPage('project')->withType('aggrement')->withAggrements($aggrements);
    }

    /**
     * Create From aggrement Submit Function
     */
    public function create_aggrement_submit(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'     => 'required|min:5',
            'key_name'  => 'required|min:5',
            'aggrement_id'  => 'required'
        ],
        [
            'aggrement_id.required'  => __('pms.validaion.required.aggrement'),
            'name.required'  => __('pms.validaion.required.name'),
            'name.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
            'key_name.required'  => __('pms.validaion.required.name'),
            'key_name.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
        ])->validate();

        $project = new Project();
        $project->name = utf8_encode($data['name']);
        $project->key_name = utf8_encode($data['key_name']);
        $project->aggrement_id = $data['aggrement_id'];
        $project->start_date = (isset($data['start_date']) && !empty($data['start_date']) )?$data['start_date']:date('Y-m-d');
        $project->end_date = (isset($data['end_date']) && !empty($data['start_date']) )?$data['end_date']: date('Y-m-d',strtotime("+7 day", strtotime(date('Y-m-d'))));
        if(auth()->guard('pro')->check()){
            $project->pro_user_id = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
        }
        $project->save();
        /* Add Chat Group and one user */
        $project_id = $project->id;

        $chatGroup = new ChatGroup();
        $chatGroup->group_name = utf8_encode($data['name']);
        $chatGroup->project_id = $project_id;
        $chatGroup->save();
        $group_id = $chatGroup->id;
        if(auth()->guard('pro')->check()){
             
            $Chat_user_group = new ChatUserGroup();
            $Chat_user_group->cug_group_id = $group_id;
            $Chat_user_group->cug_pro_user_id = auth()->guard('pro')->user()->id;
            $Chat_user_group->cug_user_type = 'Pro User';
            $Chat_user_group->save();
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;

            $Chat_user_group = new ChatUserGroup();
            $Chat_user_group->cug_group_id = $group_id;
            $Chat_user_group->cug_resource_id = auth()->guard('proresource')->user()->id;
            $Chat_user_group->cug_user_type = 'Resource';
            $Chat_user_group->save();

        }
        /* Add Chat Group and one user */

        return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_created_success'));

    }

    /**
     * Create From scratch Function
     */
    public function create_scratch(){
        return view('pms.project.create_scratch')->withPage('project')->withType('scratch');
    }

    /**
     * Create From scratch Submit Function
     */
    public function create_scratch_submit(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'     => 'required|min:5',
            'key_name'  => 'required|min:5'
        ],
        [
            'name.required'  => __('pms.validaion.required.name'),
            'name.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
            'key_name.required'  => __('pms.validaion.required.name'),
            'key_name.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
        ])->validate();

        $project = new Project();
        $project->name = utf8_encode($data['name']);
        $project->key_name = utf8_encode($data['key_name']);
        $project->start_date = (isset($data['start_date']) && !empty($data['start_date']) )?$data['start_date']:date('Y-m-d');
        $project->end_date = (isset($data['end_date']) && !empty($data['start_date']) )?$data['end_date']: date('Y-m-d',strtotime("+7 day", strtotime(date('Y-m-d'))));
            
        if(auth()->guard('pro')->check()){
            $project->pro_user_id = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
        }
        $project->save();
        /* Add Chat Group and one user */
        $project_id = $project->id;

        $chatGroup = new ChatGroup();
        $chatGroup->group_name = utf8_encode($data['name']);
        $chatGroup->project_id = $project_id;
        $chatGroup->save();
        $group_id = $chatGroup->id;
        if(auth()->guard('pro')->check()){
             
            $Chat_user_group = new ChatUserGroup();
            $Chat_user_group->cug_group_id = $group_id;
            $Chat_user_group->cug_pro_user_id = auth()->guard('pro')->user()->id;
            $Chat_user_group->cug_user_type = 'Pro User';
            $Chat_user_group->save();
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;

            $Chat_user_group = new ChatUserGroup();
            $Chat_user_group->cug_group_id = $group_id;
            $Chat_user_group->cug_resource_id = auth()->guard('proresource')->user()->id;
            $Chat_user_group->cug_user_type = 'Resource';
            $Chat_user_group->save();

        }
        /* Add Chat Group and one user */

        return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_created_success'));

    }


    /**
     * Update Function
     */
    public function update(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'     => 'required|min:5',
            'key_name'  => 'required|min:5'
        ],
        [
            'name.required'  => __('pms.validaion.required.name'),
            'name.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
            'key_name.required'  => __('pms.validaion.required.name'),
            'key_name.min'     => __('pms.validaion.invalid.min_length',['min_len'=>5]),
        ])->validate();

        unset($data['_token']);
        Project::where( 'id' , $data['id'] )->update($data);

        return redirect()->back()->withFlashSuccess(__('pms.project.messages.project_updated_success'));

    }

    /**
     * View Project Function
     */
    public function view($project_id){
        $areaOfWork = Area::with('areawork')->get();
        $project = Project::where('id', $project_id)->first();
        
        if($project){
            $breadcrumb = [
                ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
                ['name'=> __('pms.project.title') , 'route'=>'frontend.pms.project'],
                ['name'=> ucfirst($project->name) , 'route'=>'']
            ];
            return view('pms.project.edit')->withPage('project')->withType('view')->withBreadcrumb($breadcrumb)->withArea($areaOfWork)->withProject($project);
        }else{
            return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_created_success'));
        }
        
    }

    /**
     * Edit Project Function
     */
    public function edit($project_id){
        $areaOfWork = Area::with('areawork')->get();
        $project = Project::where('id', $project_id)->first();
        if($project){
            $breadcrumb = [
                ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
                ['name'=> __('pms.project.title') , 'route'=>'frontend.pms.project'],
                ['name'=> ucfirst($project->name) , 'route'=>'']
            ];
            return view('pms.project.edit')->withPage('project')->withType('edit')->withBreadcrumb($breadcrumb)->withArea($areaOfWork)->withProject($project);
        }else{
            return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_created_success'));
        }
        
    }

    /**
     * planning Task Project Function
     */
    public function planning($project_id){
        $areaOfWork = Area::with('areawork')->get();
        $project = Project::where('id', $project_id)->first();
        if($project){
            
            $query = ProjectTask::where('id', '!=', null)->where('project_id','=',$project_id);
            
            $query->where(function ($q) {
                $q->where('parent_id', 0);
                $q->orWhere('parent_id',null );
            });
            $query->with('allchildtask');
            $data = $query->orderBy('id', 'asc')->get();
            
            
            
            $breadcrumb = [
                ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
                ['name'=> __('pms.project.title') , 'route'=>'frontend.pms.project'],
                ['name'=> ucfirst($project->name) , 'route'=>'']
            ];

            $resources = Resources::get();
            if(auth()->guard('pro')->check()){
                $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
            }
            elseif(auth()->guard('proresource')->check()){
                $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
            }
            // echo "<pre>";
            // print_r($data);
            // die;
            return view('pms.project.planning')->withPage('project')->withType('edit')->withBreadcrumb($breadcrumb)->withArea($areaOfWork)->withProject($project)->withResources($resources)->withProjectTask($data);

        }else{
            return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_created_success'));
        }
    }

    /**
     * Get Planning Task Project Function
     */
    public function get_planning($project_id){
        $areaOfWork = Area::with('areawork')->get();
        $project = Project::where('id', $project_id)->first();
        if($project){
            
            $query = ProjectTask::where('id', '!=', null)->where('project_id','=',$project_id);
            
            $query->where(function ($q) {
                $q->where('parent_id', 0);
                $q->orWhere('parent_id',null );
            });
            $query->with('allchildtask');
            $data = $query->orderBy('id', 'asc')->get();
            
            $resources = Resources::get();
            if(auth()->guard('pro')->check()){
                $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
            }
            elseif(auth()->guard('proresource')->check()){
                $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
            }
            
            return view('pms.project.partials.planning_task')->withPage('project')->withArea($areaOfWork)->withProject($project)->withResources($resources)->withProjectTask($data);

        }else{
            return response()->json([
                'status'=>false
            ]);
        }
    }

    /**
     * Delete Project Function
     */
    public function delete($project_id){
        $project = Project::where('id', $project_id)->first();
        if($project){
            $project->delete();
            return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_deleted_success'));
        }else{
            return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_deleted_unsuccess'));
        }
        
    }

    /**
     * Add Edit Task Project Function
     */
    public function add_edit_task(Request $request){
        $data = $request->all();
        
        $todayDate = date('Y-m-d');// "2010-09-17";
        $todayStartTime = strtotime($todayDate);
        $endStartTime = strtotime($todayDate. ' + 7 days');
        
        $projectTask = ProjectTask::where('project_id', $data['project_id'])->where('parent_id',0)->where('area_id',$data['area'])->first();
        if($projectTask){
            $project = new ProjectTask();
            $project->project_id = utf8_encode($data['project_id']);
            $project->parent_id = $projectTask->id;
            $project->area_id = utf8_encode($data['area']);
            $project->area_work_id = utf8_encode($data['area_work']);
            $project->start_date = $todayStartTime;
            $project->end_date = $endStartTime;
            $project->task_name = utf8_encode($data['area_work_name']);
            if(auth()->guard('pro')->check()){
                $project->pro_user_id = auth()->guard('pro')->user()->id;
            }elseif(auth()->guard('proresource')->check()){
                $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
            }
            $project->save();
        }else{
            $project = new ProjectTask();
            $project->project_id = utf8_encode($data['project_id']);
            $project->area_id = utf8_encode($data['area']);
            $project->task_name = utf8_encode($data['area_name']);
            $project->start_date = $todayStartTime;
            $project->end_date = $endStartTime;
            if(auth()->guard('pro')->check()){
                $project->pro_user_id = auth()->guard('pro')->user()->id;
            }elseif(auth()->guard('proresource')->check()){
                $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
            }
            $project->save();
            
            $projectSub = new ProjectTask();
            $projectSub->project_id = utf8_encode($data['project_id']);
            $projectSub->parent_id = $project->id;
            $projectSub->area_id = utf8_encode($data['area']);
            $projectSub->area_work_id = utf8_encode($data['area_work']);
            $projectSub->task_name = utf8_encode($data['area_work_name']);
            $projectSub->start_date = $todayStartTime;
            $projectSub->end_date = $endStartTime;
            if(auth()->guard('pro')->check()){
                $projectSub->pro_user_id = auth()->guard('pro')->user()->id;
            }elseif(auth()->guard('proresource')->check()){
                $projectSub->pro_resource_id = auth()->guard('proresource')->user()->id;
                $projectSub->pro_user_id = auth()->guard('proresource')->user()->user_id;
            }
            $projectSub->save();

        }


        if($request->ajax()){

            return response()->json([
                'status'=>'Success',
                'message'=>'Saved successfully.',
                'data' => $project
            ]);
        }else{
            return redirect()->back()->withFlashSuccess(__('pms.messages.project_plan_success'));
        }
    }

    /**
     * Get Task Project Function
     */
    public function get_task($project_id, $project_type, $type, Request $request){
        
        $time = time();
        $query = ProjectTask::where('id', '!=', null)->where('project_id','=',$project_id);
        if($project_type == 'backlog'){
            $query->where('end_date', '!=', null);
            $query->where('end_date', '<=', $time);
        }else{
            $query->where(function ($qry) use($time) {
                $qry->where('end_date', '>', $time)
                    ->orWhereNull('end_date');
            });
        }

        if(auth()->guard('proresource')->check()){
            $resid = auth()->guard('proresource')->user()->id;
            $query->where(function ($q) use($resid) {
                $q->where('assignee_to', 'like', '%'.$resid.'%');
                $q->orWhere('report_to', '=', $resid );
            });
        }
        $query->where('parent_id',0);
        $query->orWhere('parent_id',null);
        $query->with('allchildtask');
        $data = $query->orderBy('id', 'asc')->get();
        
        return view('pms.project.partials.task_list')->withProjectTask($data)->withProjectType($project_type)->withType($type);
        die;
    }

    /**
     * Create Task Project Function
     */
    public function delete_task(Request $request){
        $project_id = $request->input('task_id');
        $post = ProjectTask::where('id',$project_id)->first();
        if ($post != null) {
            ProjectTask::where( 'parent_id' , $post->id )->update(['parent_id'=>$post->parent_id]);
            $post->delete();
            
            return response()->json([
                'status'=>'Success',
                'message'=>'Project Task deleted successfully.',
            ]);
        }else{
            return response()->json([
                'status'=>'Fail',
                'message'=>'Unable to deleted project task, Please refresh and try again!',
            ]);
        }
    }

    /**
     * Create Task Project Function
     */
    public function create_task($project_id,Request $request){
        $resources = Resources::get();
        $projectList = ProjectTask::where('project_id',$project_id)->with('allchildtask')->where('parent_id',0)->orWhere('parent_id',null)->get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        }
        return view('pms.project.partials.task_create')->withResources($resources)->withProjectId($project_id)->withProjectList($projectList);
        die;
    }

    /**
     * Create Task Project Function
     */
    public function create_task_planning($project_id,Request $request){
        $resources = Resources::get();
        $projectList = ProjectTask::where('project_id',$project_id)->with('allchildtask')->where('parent_id',0)->orWhere('parent_id',null)->get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        }
        return view('pms.project.partials.task_create_planning')->withResources($resources)->withProjectId($project_id)->withProjectList($projectList);
        die;
    }

    /**
     * Edit Task Project Function
     */
    public function edit_task(Request $request){
        $project_id = $request->query('project_id');
        $task_id = $request->query('task_id');
        $data = ProjectTask::where('id',$task_id)->first();
        $projectList = ProjectTask::where('project_id',$project_id)->with('allchildtask')->where('parent_id',0)->orWhere('parent_id',null)->get();
        // echo "<pre>";print_r($projectList);
        // die;
        $data['assignee_to_selection'] = explode(',', $data['assignee_to']);
        $data['checkpoint_values'] = explode(',',$data['checkpoint']);

        $resources = Resources::get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        }

        if($data->start_date)
            $data->start_date = date('m/d/Y',$data->start_date);
        if($data->end_date)
            $data->end_date = date('m/d/Y',$data->end_date);
        if($data->deadline)
            $data->deadline = date('m/d/Y',$data->deadline);
        
        return view('pms.project.partials.task_edit')->withProjectTask($data)->withResources($resources)->withProjectList($projectList);
        die;
    }


    /**
     * View Task Project Function
     */
    public function view_task(Request $request){
        $project_id = $request->query('project_id');
        $task_id = $request->query('task_id');
        $data = ProjectTask::with('reporter')->with('time','time.resource_time','time.user_time')->where('id',$task_id)->first();
        $data['assignee_to_selection'] = explode(',', $data['assignee_to']);

        // ProjectTaskTime
        $data['assignee_to_data'] = Resources::whereIn('id', $data['assignee_to_selection'])->get();
        $data['checkpoint_values'] = explode(',',$data['checkpoint']);
        

        if($data->start_date)
            $data->start_date = date('m/d/Y',$data->start_date);
        if($data->end_date)
            $data->end_date = date('m/d/Y',$data->end_date);
        if($data->deadline)
            $data->deadline = date('m/d/Y',$data->deadline);
        
        return view('pms.project.partials.task_view')->withProjectTask($data);
        die;
    }

    /**
     * Edit Task Project Function
     */
    public function add_task_time_submit(Request $request){
        $data = $request->all();
        
        if($request->hasfile('signature')){
            $file = $request->file('signature');
            $sigName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            $file->move(public_path().'/project_task/signature/', $sigName);
            $data['signature'] = $sigName;
        }
        if($request->hasfile('image')){
            $file = $request->file('image');
            $imgName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            $file->move(public_path().'/project_task/image/', $imgName);
            $data['image'] = $imgName;

        }
        if($request->hasfile('report')){
            $file = $request->file('report');
            $rptName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            $file->move(public_path().'/project_task/report/', $rptName);
            $data['report'] = $rptName;
        }
        if($request->hasfile('audits')){
            $file = $request->file('audits');
            $auditName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            $file->move(public_path().'/project_task/audits/', $auditName);
            $data['audits'] = $auditName;
        }

        $project = new ProjectTaskTime();
        $project->project_id = utf8_encode($data['project_id']);
        $project->project_task_id = utf8_encode($data['project_task_id']);
        $project->description = utf8_encode($data['description']);
        $project->hours = utf8_encode($data['hours']);
        $project->date = strtotime($data['date']);
        $project->signature = (isset($data['signature']) && !empty($data['signature']) )?$data['signature']:'';
        $project->image = (isset($data['image']) && !empty($data['image']) )?$data['image']:'';
        $project->report = (isset($data['report']) && !empty($data['report']) )?$data['report']:'';
        $project->audits = (isset($data['audits']) && !empty($data['audits']) )?$data['audits']:'';

        if(auth()->guard('pro')->check()){
            $project->pro_user_id = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
        }
        $project->save();


        return response()->json([
            'status'=>'Success',
            'message'=>'Saved successfully.',
            'data' => $project
        ]);

        die;
    }

    /**
     * Edit Task Project Function
     */
    public function add_task_time(Request $request){
        $project_id = $request->query('project_id');
        $task_id = $request->query('task_id');
        $data = ProjectTask::where('id',$task_id)->first();
        $data['checkpoint_values'] = explode(',',$data['checkpoint']);

        return view('pms.project.partials.add_task_time')->withProjectTask($data);
        die;
    }

    /**
     * Edit Task Project Function
     */
    public function update_task(Request $request){
        $dataAll = $request->all();
        $dataContent = $dataAll['data'];
        $data = array();
        parse_str($dataContent, $data);
        
        unset($data['_token'], $data['assignee_to_selection']);
        if(isset($data['start_date']) && !empty($data['start_date'])){
            $data['start_date'] = strtotime($data['start_date']);
        }else{
            unset($data['start_date']);
        }
        if(isset($data['end_date']) && !empty($data['end_date'])){
            $data['end_date'] = strtotime($data['end_date']);
        }else{
            unset($data['end_date']); 
        }
        if(isset($data['deadline']) && !empty($data['deadline'])){
            $data['deadline'] = strtotime($data['deadline']);
        }else{
            unset($data['deadline']); 
        }

        if($request->hasfile('attachment')){
            $file = $request->file('attachment');
            $attName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            $file->move(public_path().'/project_task/attachment/', $attName);
            $data['attachment'] = $attName;
        }
        
        if( !isset($data['id']) ){
            $project = new ProjectTask();
            $project->project_id = utf8_encode($data['project_id']);
            $project->parent_id = utf8_encode($data['parent_id']);
            $project->task_name = utf8_encode($data['task_name']);
            $project->status = utf8_encode($data['status']);
            $project->description = utf8_encode($data['description']);
            $project->assignee_to = $data['assignee_to']?$data['assignee_to']:null;
            $project->report_to = $data['report_to']? $data['report_to']:null;
            $project->duration = $data['duration']?$data['duration']:null;
            $project->labels = $data['labels']?$data['labels']:null;
            //$project->priority = utf8_encode($data['priority']);
            $project->start_date = (isset($data['start_date']) && !empty($data['start_date']) )?$data['start_date']:null;
            $project->end_date = (isset($data['end_date']) && !empty($data['start_date']) )?$data['end_date']:null;
            $project->deadline = (isset($data['deadline']) && !empty($data['deadline']) )?$data['deadline']:null;
            $project->attachment = (isset($data['attachment']) && !empty($data['attachment']) )?$data['attachment']:'';
            if(auth()->guard('pro')->check()){
                $project->pro_user_id = auth()->guard('pro')->user()->id;
            }elseif(auth()->guard('proresource')->check()){
                $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
            }
            $project->save();

        }else{
            if(isset($data['duration']) && empty($data['duration'])){
                unset($data['duration']); 
            }
            ProjectTask::where( 'id' , $data['id'] )->update($data);
        }
        return response()->json([
            'status'=>'Success',
            'message'=>'Project Task Saved successfully.',
        ]);
        die;
    
    }


    /**
     * Add Planning Task Project Function
     */
    public function add_planning_task(Request $request){
        $data = $request->all();
        // echo "<pre>";
        // print_r(current($data['data']));
        // print_r($data);
        // die;
        $current = current($data['data']);
        $assigeList = ",";
        if(!isset($current['id'])){
            $projectId = $data['project_id'];
            ProjectTask::where( 'project_id' , $projectId )->delete();
            $paarentIds = [];
            foreach($data['data'] as $key => $projectTask){
                if($projectTask['parent_id'] == 0){

                    if(isset($projectTask['start_date']) && !empty($projectTask['start_date'])){
                        $projectTask['start_date'] = strtotime($projectTask['start_date']);
                    }else{
                        unset($projectTask['start_date']);
                    }
                    if(isset($projectTask['parent_id']) && !empty($projectTask['parent_id'])){
                        $projectTask['parent_id'] = $projectTask['parent_id'];
                    }else{
                        unset($projectTask['parent_id']);
                    }
                    if(isset($projectTask['end_date']) && !empty($projectTask['end_date'])){
                        $projectTask['end_date'] = strtotime($projectTask['end_date']);
                    }else{
                        unset($projectTask['end_date']); 
                    }
                    if(isset($projectTask['deadline']) && !empty($projectTask['deadline'])){
                        $projectTask['deadline'] = strtotime($projectTask['deadline']);
                    }else{
                        unset($projectTask['deadline']); 
                    }

                    $assigeList = $assigeList.$projectTask['assignee_to'].",";
                    $project = new ProjectTask();
                    $project->parent_id = 0;
                    $project->project_id = utf8_encode($projectId);
                    $project->area_id = (isset($projectTask['area_id']) && !empty($projectTask['area_id']) )?$projectTask['area_id']:null;;
                    $project->area_work_id = (isset($projectTask['area_work_id']) && !empty($projectTask['area_work_id']) )?$projectTask['area_work_id']:null;;
                    $project->task_name = utf8_encode($projectTask['task_name']);
                    $project->assignee_to = $projectTask['assignee_to'];
                    $project->checkpoint = $projectTask['checkpoint'];
                    $project->duration = $projectTask['duration'];
                    $project->deadline = (isset($projectTask['deadline']) && !empty($projectTask['deadline']) )?$projectTask['deadline']:null;
                    $project->start_date = (isset($projectTask['start_date']) && !empty($projectTask['start_date']) )?$projectTask['start_date']:null;
                    $project->end_date = (isset($projectTask['end_date']) && !empty($projectTask['end_date']) )?$projectTask['end_date']:null;
                    if(auth()->guard('pro')->check()){
                        $project->pro_user_id = auth()->guard('pro')->user()->id;
                    }elseif(auth()->guard('proresource')->check()){
                        $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                        $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
                    }

                    $project->save();
                    $paarentIds[$projectTask['template_id']] = $project->id;
                    unset($data['data'][$key]);

                }
            }
    
            while(count($data['data'])){
                foreach($data['data'] as $key => $projectTask){
                    if(isset($paarentIds[$projectTask['parent_id']])){
                        // $projectTemplate = new ProjectTaskTemplate();
                        // $projectTemplate->template_id = $templateId;
                        // $projectTemplate->parent_id = $paarentIds[$daata['parent_id']];
                        // $projectTemplate->area_id = ($daata['area_id'] && $daata['area_id'] != '')?$daata['area_id']:null;
                        // $projectTemplate->area_work_id = ($daata['area_work_id']  && $daata['area_work_id'] != '')?$daata['area_work_id']:null;
                        // $projectTemplate->task_name = $daata['task_name'];
                        // $projectTemplate->save();
                        // $paarentIds[$daata['id']] = $projectTemplate->id;
                        // unset($data['data'][$key]);

                        if(isset($projectTask['start_date']) && !empty($projectTask['start_date'])){
                            $projectTask['start_date'] = strtotime($projectTask['start_date']);
                        }else{
                            unset($projectTask['start_date']);
                        }
                        if(isset($projectTask['parent_id']) && !empty($projectTask['parent_id'])){
                            $projectTask['parent_id'] = $projectTask['parent_id'];
                        }else{
                            unset($projectTask['parent_id']);
                        }
                        if(isset($projectTask['end_date']) && !empty($projectTask['end_date'])){
                            $projectTask['end_date'] = strtotime($projectTask['end_date']);
                        }else{
                            unset($projectTask['end_date']); 
                        }
                        if(isset($projectTask['deadline']) && !empty($projectTask['deadline'])){
                            $projectTask['deadline'] = strtotime($projectTask['deadline']);
                        }else{
                            unset($projectTask['deadline']); 
                        }
    
                        $assigeList = $assigeList.$projectTask['assignee_to'].",";
                        $project = new ProjectTask();
                        $project->parent_id = $paarentIds[$projectTask['parent_id']];
                        $project->project_id = utf8_encode($projectId);
                        $project->area_id = (isset($projectTask['area_id']) && !empty($projectTask['area_id']) )?$projectTask['area_id']:null;;
                        $project->area_work_id = (isset($projectTask['area_work_id']) && !empty($projectTask['area_work_id']) )?$projectTask['area_work_id']:null;;
                        $project->task_name = utf8_encode($projectTask['task_name']);
                        $project->assignee_to = $projectTask['assignee_to'];
                        $project->checkpoint = $projectTask['checkpoint'];
                        $project->duration = $projectTask['duration'];
                        $project->deadline = (isset($projectTask['deadline']) && !empty($projectTask['deadline']) )?$projectTask['deadline']:null;
                        $project->start_date = (isset($projectTask['start_date']) && !empty($projectTask['start_date']) )?$projectTask['start_date']:null;
                        $project->end_date = (isset($projectTask['end_date']) && !empty($projectTask['end_date']) )?$projectTask['end_date']:null;
                        if(auth()->guard('pro')->check()){
                            $project->pro_user_id = auth()->guard('pro')->user()->id;
                        }elseif(auth()->guard('proresource')->check()){
                            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
                        }
    
                        $project->save();
                        $paarentIds[$projectTask['template_id']] = $project->id;
                        unset($data['data'][$key]);

                    }
                }
            }

        }else{
            $projectId = $data['project_id'];
            foreach($data['data'] as $projectTask){
                if(isset($projectTask['start_date']) && !empty($projectTask['start_date'])){
                    $projectTask['start_date'] = strtotime($projectTask['start_date']);
                }else{
                    unset($projectTask['start_date']);
                }
                if(isset($projectTask['parent_id']) && !empty($projectTask['parent_id'])){
                    $projectTask['parent_id'] = $projectTask['parent_id'];
                }else{
                    unset($projectTask['parent_id']);
                }
                if(isset($projectTask['end_date']) && !empty($projectTask['end_date'])){
                    $projectTask['end_date'] = strtotime($projectTask['end_date']);
                }else{
                    unset($projectTask['end_date']); 
                }
                if(isset($projectTask['deadline']) && !empty($projectTask['deadline'])){
                    $projectTask['deadline'] = strtotime($projectTask['deadline']);
                }else{
                    unset($projectTask['deadline']); 
                }

                $assigeList = $assigeList.$projectTask['assignee_to'].",";
                if(isset($projectTask['id'])){
                    ProjectTask::where( 'id' , $projectTask['id'] )->update($projectTask);
                }else{

                    $project = new ProjectTask();
                    $project->project_id = utf8_encode($projectId);
                    $project->area_id = (isset($projectTask['area_id']) && !empty($projectTask['area_id']) )?$projectTask['area_id']:null;;
                    $project->area_work_id = (isset($projectTask['area_work_id']) && !empty($projectTask['area_work_id']) )?$projectTask['area_work_id']:null;;
                    $project->task_name = utf8_encode($projectTask['task_name']);
                    $project->assignee_to = $projectTask['assignee_to'];
                    $project->checkpoint = $projectTask['checkpoint'];
                    $project->duration = $projectTask['duration'];
                    $project->deadline = (isset($projectTask['deadline']) && !empty($projectTask['deadline']) )?$projectTask['deadline']:null;
                    $project->start_date = (isset($projectTask['start_date']) && !empty($projectTask['start_date']) )?$projectTask['start_date']:null;
                    $project->end_date = (isset($projectTask['end_date']) && !empty($projectTask['end_date']) )?$projectTask['end_date']:null;
                    if(auth()->guard('pro')->check()){
                        $project->pro_user_id = auth()->guard('pro')->user()->id;
                    }elseif(auth()->guard('proresource')->check()){
                        $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                        $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
                    }
                    $project->save();
                }
            }
        }

        if($assigeList != ","){
            $assigeList =  array_filter( explode(",",$assigeList));
            $projectId = $data['project_id'];
            
            $chGroup = ChatGroup::where('project_id', '=', $projectId)->first();
            if($chGroup && count($assigeList) > 0 ){
                foreach($assigeList as $assigeid){
                    $chUsr = ChatUserGroup::where('cug_group_id', '=', $chGroup->group_id)->where('cug_resource_id', '=', $assigeid)->where('cug_user_type', '=', 'Resource')->first();
                    if (!$chUsr) {
                        $chUsrGp = new ChatUserGroup();
                        $chUsrGp->cug_group_id = $chGroup->group_id;
                        $chUsrGp->cug_resource_id = $assigeid;
                        $chUsrGp->cug_user_type = 'Resource';
                        $chUsrGp->save();
                    }
                }
            }
        }


        return response()->json([
            'status'=>'Success',
            'message'=> __('pms.messages.project_plan_success'),
        ]);
        die;


    }

    /**
     * New Planning Task Project Function
     */
    public function new_planning_task(Request $request){
        $dataAll = $request->all();
        $dataContent = $dataAll['data'];
        $data = array();
        parse_str($dataContent, $data);

        $project = new ProjectTask();
        $project->parent_id = $data['parent_id'];
        $project->project_id = $data['project_id'];
        $project->task_name = $data['task_name'];
        $project->status = $data['status'];
        $project->description = $data['description'];
        if(auth()->guard('pro')->check()){
            $project->pro_user_id = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
        }
        $project->save();


        return response()->json([
            'status'=>'Success',
            'message'=> __('pms.messages.project_plan_success'),
        ]);
        die;


    }

    /**
     * Update Project Release    Project Function
     */
    public function update_project_release($project_id, Request $request){
        $data = $request->all();
        
        Project::where( 'id' , $project_id )->update(['released_date'=>time(), 'released_to'=>implode(",",$data['permission'])]);
        
        return response()->json([
            'status'=>'Success',
            'message'=> __('pms.messages.project_plan_success'),
        ]);
        die;

    }

    /**
     * clouser Project Function
     */
    public function clouser(Request $request){
        
        $data = $request->all();
        // print_r($data);
        // die;
        
        $projectClouser = new ProjectClosure();
        $projectClouser->project_id = $data['project_id'];
        $projectClouser->closing_reason = (isset($data['reason']) && !empty($data['reason']) )?$data['reason']:null;
        $projectClouser->rating = (isset($data['rating']) && !empty($data['rating']) )?$data['rating']:null;
        $projectClouser->contractor_message  = (isset($data['message']) && !empty($data['message']) )?$data['message']:null;
        $projectClouser->feedback = (isset($data['feedback']) && !empty($data['feedback']) )?$data['feedback']:null;
        if(auth()->guard('pro')->check()){
            $projectClouser->pro_user_id = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $projectClouser->pro_resource_id = auth()->guard('proresource')->user()->id;
            $projectClouser->pro_user_id = auth()->guard('proresource')->user()->user_id;
        }
        $projectClouser->save();

        // Project::where( 'id' , $data->project_id )->update([ 'closure_by'=> $projectClouser->pro_user_id ]);
        return redirect()->route('frontend.pms.project')->withFlashSuccess(__('pms.messages.project_closure_success'));

        // return response()->json([
        //     'status'=>'Success',
        //     'message'=> __('pms.messages.project_closure_success'),
        // ]);
        // die;

    }
    
    

}
