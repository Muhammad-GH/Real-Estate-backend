<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Bussiness\Project;
use App\Models\Bussiness\Agreement;
use App\Models\Bussiness\AgreementProposalRevision;
use App\Models\Bussiness\ProjectTask;
use App\Models\Bussiness\ProjectTaskLink;
use App\Models\Bussiness\ProjectTaskTime;
use App\Models\Bussiness\Area;
use App\Models\Bussiness\Resources;
use App\Models\Bussiness\ChatGroup; 
use App\Models\Bussiness\ChatUserGroup; 
use App\Models\Bussiness\ChatMessages; 
use DB;
use DateTime;
/**
 * Class ProjectSummaryController.
 */
class ProjectSummaryController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $project_id = $request['project_id'];
        $query = Project::with('user')->with('resource');
        $query->where('id','=',$request['project_id']);
         
        if(auth()->guard('pro')->check()){
            $query->where('pro_user_id','=',auth()->guard('pro')->user()->id);
            $query->with('summarytasks');
            $query->with('tasktime');
            $query->with('taskresource');
            // $query->with(['time' => function ($query) use ($project_id) {
            //     $query->where('project_task_id ', '=', $project_id);
            // }]);
        } elseif(auth()->guard('proresource')->check()){
            
            $query->where('pro_resource_id','=',auth()->guard('proresource')->user()->id);
            $query->with('summarytasks');
            $query->with('tasktime');
            $query->with('taskresource');
        }
        $query->with('agreement');
        //$query->join('pro_agreement', 'pro_agreement.agreement_id', '=', 'pro_project.aggrement_id');
        //$query->join('pro_proposal', 'pro_proposal.proposal_id', '=', 'pro_agreement.agreement_proposal_id');
        $query->with('proposal');
        $data = $query->get();
        $recent = Project::with('resource')->where('start_date','!=',null)->limit(3)->orderBy('updated_at', 'asc')->get();
        $resources = Resources::get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        } 
        
        //echo '<pre>'; print_r($data[0]['proposal_id']);die();
        $proposal_revision = array();
        if(isset($data[0]['proposal_id']) && $data[0]['proposal_id']>0){
            $proposal_revision = AgreementProposalRevision::where('table_name','pro_proposal')->where('propID',$data[0]['proposal_id'])->orderBy('created_at', 'asc')->with('user')->get();
        }
        $agreement_revision = array();
        if(isset($data[0]['aggrement_id']) && $data[0]['aggrement_id']>0){
            $agreement_revision = AgreementProposalRevision::where('table_name','pro_agreement')->where('propID',$data[0]['aggrement_id'])->orderBy('created_at', 'asc')->with('user')->get();
        }
        //echo '<pre>'; print_r($proposal_revision);die();
 
       //echo '<pre>'; print_r($linkdata);die();
       $proposal_attachment = array();
       $agreement_attachment = array();
       if($data){
            foreach($data as $key=>$project){
            
                $project_name = $project->name;
                $project_start_date =  date('d-m-Y', strtotime($project->start_date));
                $project_end_date =  date('d-m-Y', strtotime($project->end_date));
                
                $datetime1 = new DateTime($project_start_date);
                $datetime2 = new DateTime($project_end_date);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');//now do whatever you like with $days
                
                $proposal_attachment['pdf'] = $data[0]->proposal['proposal_pdf'];
                $proposal_attachment['attachment'] = $data[0]->proposal['proposal_attachment'];
                
                $agreement_attachment['pdf'] = $data[0]->agreement['agreement_pdf'];
                $agreement_attachment['attachment'] = $data[0]->agreement['agreement_attachment'];
                
                    
            }
        }
    $task_array = array();
    if(isset($data[0]->summarytasks)){
        foreach($data[0]->summarytasks as $key=>$task_val){
            $id = $task_val['id'];
            $assignee_to =  $task_val['assignee_to'];
            $assignee_to = preg_split ("/\,/", $assignee_to); 
            //$resource_array = DB::table('pro_resources')->select(DB::raw('CONCAT(first_name, \' \', last_name ) AS full_name'),'pro_resources.id as id')->
            $resource_array = Resources::select(DB::raw('CONCAT(first_name, \' \', last_name ) AS full_name'))->
            whereIn('pro_resources.id' ,$assignee_to)->get();
             
            
            if($resource_array){
                $total = count($resource_array);
                $count = 0;
                $assignee_name = '';
                foreach($resource_array as $val){
                    //$assignee_name[$id][] =  $val->full_name;
                    $count++;
                    if($count == $total){
                        $assignee_name .=  $val->full_name.'';
                    }else{
                        $assignee_name .=  $val->full_name.', ';
                    }
                    
                }
                
            }
             
            $task_array[$task_val['id']]['parent_id'] = $task_val['parent_id'];
            $task_array[$task_val['id']]['task_name'] = $task_val['task_name'];
            $task_array[$task_val['id']]['description'] = $task_val['description'];
            //$task_array[$task_val['id']]['assignee_to'] = $task_val['first_name'].' '.$task_val['last_name'];
            $task_array[$task_val['id']]['assignee_to'] = $assignee_name;
            $task_array[$task_val['id']]['start_date'] = $task_val['start_date'];
            $task_array[$task_val['id']]['end_date'] = $task_val['end_date'];
            $task_array[$task_val['id']]['deadline'] = $task_val['deadline'];
            $task_array[$task_val['id']]['checkpoint'] = $task_val['checkpoint'];
            
            $task_array[$task_val['id']]['duration'] = $task_val['duration'];
            $task_array[$task_val['id']]['status'] = $task_val['status'];
            $task_array[$task_val['id']]['progress'] = $task_val['progress'];
            $task_array[$task_val['id']]['created_at'] = $task_val['created_at'];
            
        }
 
        if(isset($data[0]->tasktime)){
            foreach($data[0]->tasktime as $key=>$tasktime_val){
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['description'] = $tasktime_val['description'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['hours'] = $tasktime_val['hours'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['file'] = $tasktime_val['file'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['date'] = $tasktime_val['date'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['audits'] = $tasktime_val['audits'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['report'] = $tasktime_val['report'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['image'] = $tasktime_val['image'];
                $task_array[$tasktime_val['project_task_id']]['time'][$tasktime_val['id']]['signature'] = $tasktime_val['signature'];
                
            }
        }
    }

 /* Get Project Chat */
    
    $chatquery = ChatGroup::with('user');
    if(isset($project_id) && $project_id > 0){
        // $query->where('project_id','=',$request['project_id']);
        $chatquery->where('pro_chat_group.project_id','=',$project_id);
        $chatquery->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
        $chatquery->leftJoin('pro_chat_messages','pro_chat_messages.message_group_id','=','pro_chat_user_group.cug_group_id');
        $chatquery->leftJoin('pro_users','pro_users.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Pro User');
        $chatquery->leftJoin('pro_user_detail','pro_user_detail.user_id','=','pro_users.id');//->where('message_user_type', '=','Pro User');
        $chatquery->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
        $chatquery->select('pro_chat_messages.*','pro_chat_messages.created_at as time','pro_chat_group.*','pro_users.id as pro_user_id','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_user_detail.company_logo as company_logo','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name','pro_resources.photo as photo','pro_resources.id as resource_id');
 
    }  
    
    if(auth()->guard('pro')->check()){
        $chatquery->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
        //$query->with('group');
        $user_id = auth()->guard('pro')->user()->id;
        $user_type = 'Pro User';
    } elseif(auth()->guard('proresource')->check()){
        $chatquery->where('cug_resource_id','=',auth()->guard('proresource')->user()->id);
        $user_id = auth()->guard('proresource')->user()->id;
        $user_type = 'Resource';
    }
    $chatquery->orderBy('time', 'asc');
    $chatdata = $chatquery->get();
    //echo '<pre>';print_r($chatdata);die;
 /* Get Project Chat */

        return view('pms.projectsummary.index')->withProjectid($project_id)->withPage('project')->withProjectsummary($data)->withRecentProject($recent)->withResources($resources)->withProposalrevision($proposal_revision)->withAgreementrevision($agreement_revision)->withTaskarray($task_array)->withMessages($chatdata)->withUserid($user_id)->withUsertype($user_type);
    }

     
}
