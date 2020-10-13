<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Bussiness\Project;
use App\Models\Bussiness\ProjectTask;
use App\Models\Bussiness\ProjectTaskLink;
use App\Models\Bussiness\ProjectTaskTime;
use App\Models\Bussiness\Area;
use App\Models\Bussiness\Resources;
use DB;
use DateTime;
/**
 * Class GanttController.
 */
class GanttController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    { 
        $project_id = $request['project_id'];
        $query = Project::with('user')->with('resource');
        $query->where('pro_project.id','=',$request['project_id']);
        if(auth()->guard('pro')->check()){
            $query->where('pro_user_id','=',auth()->guard('pro')->user()->id);
            $query->with('tasks');
            $type = 'pro_user';
        } elseif(auth()->guard('proresource')->check()){
             
            //$query->join('pro_resources','pro_resources.user_id','pro_project.pro_user_id');
            //$query->where('pro_resources.id ','=',auth()->guard('proresource')->user()->id);
            //$query->with('tasks');
            $query->with('taskscreatedbyresource');
            $type = 'resource';
        }
        
        $data = $query->get();
       //print_r($data); die;
        $recent = Project::with('resource')->where('start_date','!=',null)->limit(3)->orderBy('updated_at', 'asc')->get();
        $resources = Resources::get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        }
  
       if($data){
           
           foreach($data as $key=>$project){
                $projects[$key]['id'] = $project->id;
                $projects[$key]['text'] = $project->name;
                $projects[$key]['start_date'] = $project->start_date;
                $projects[$key]['duration'] = 2;
                $projects[$key]['progress'] = 0;
                $projects[$key]['open'] = true;

                if(isset($project->tasks)){
                   
                    foreach($project->tasks as $k=>$task){
                        $projects[$key][$k]['id'] = $task->id;
                        $projects[$key][$k]['text'] = $task->task_name;
                        $projects[$key][$k]['start_date'] = $task->start_date;
                        $projects[$key][$k]['duration'] = 2;
                        $projects[$key][$k]['progress'] = 0;
                        if($task->parent_id>0){
                            $projects[$key][$k]['parent'] = $task->parent_id;
                        }else{
                            $projects[$key][$k]['parent'] = $project->id;
                        }
                        
                       
                    }
                }
           }
       }
       $linkquery = ProjectTaskLink::where('project_id','=',$request['project_id']);
       $linkdata = $linkquery->get();
       //echo '<pre>'; print_r($linkdata);die();
        return view('pms.gantt.index')->withType($type)->withProjectid($project_id)->withPage('project')->withProjects($data)->withRecentProject($recent)->withResources($resources)->withLinks($linkdata);
    }

    
    public function get_gantt(Request $request)
    {
        $project_id = $request['project_id'];
        $query = Project::with('user')->with('resource');
        $query->where('id','=',$request['project_id']);
        if(auth()->guard('pro')->check()){
            $query->where('pro_user_id','=',auth()->guard('pro')->user()->id);
            $query->with('tasks');
        } elseif(auth()->guard('proresource')->check()){
            
            $query->where('pro_resource_id','=',auth()->guard('proresource')->user()->id);
            $query->with('tasks');
        }
        $projects = $query->get();
        $recent = Project::with('resource')->where('start_date','!=',null)->limit(3)->orderBy('updated_at', 'asc')->get();
        $resources = Resources::get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        }
  
      
        if($projects){
            foreach($projects as $key=>$project){
                $project_start_date =  date('d-m-Y', strtotime($project->start_date));
                $project_end_date =  date('d-m-Y', strtotime($project->end_date));
                
                $datetime1 = new DateTime($project_start_date);
                $datetime2 = new DateTime($project_end_date);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');//now do whatever you like with $days
                 
                $gantt_parse =  "[{ id: $project->id, text: '$project->name', start_date: '$project_start_date', duration: $days, progress: 0, open: true, type: gantt.config.types.project },";
                   
                    if(isset($project->tasks)){
                    $count = 1;
                        foreach($project->tasks as $k=>$task){
                            $task_start_date =  date('d-m-Y', $task->start_date);
                            $task_end_date =  date('d-m-Y', $task->end_date);
                            
                            $assignee_to =   $task->assignee_to;
                            $priority =   $task->priority;
                            if($priority =='low'){
                                $priority = 3;
                            }
                            if($priority =='medium'){
                                $priority = 2;
                            }
                            if($priority =='high'){
                                $priority = 1;
                            }
                            $datetime1 = new DateTime($task_start_date);
                            $datetime2 = new DateTime($task_end_date);
                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->format('%a');//now do whatever you like with $days
                            if($days == 0 ) $days = 1;
                            if($task->parent_id > 0){
                                $parent_id = $task->parent_id;
                            }else{
                                $parent_id = $project->id;
                            }
                            if($count == count($project->tasks)){
                                $gantt_parse .= "{ id: $task->id, text: '$task->task_name', start_date: '$task_start_date', duration: $days, progress: 0, parent: $parent_id, owner_id: $assignee_to, priority:$priority, type: gantt.config.types.task }";
                            }else{
                                $gantt_parse .= "{ id: $task->id, text: '$task->task_name', start_date: '$task_start_date', duration: $days, progress: 0, parent: $parent_id, owner_id: $assignee_to, priority:$priority, type: gantt.config.types.task },";
                            }
                            
                            $count++;

                        
                        }
                    }
                    $gantt_parse .=  "]";
            }
        }

        
       return trim($gantt_parse);
    }

     /**
     * Edit Task Project Function
     */
    public function update_task(Request $request){
        $dataAll = $request->all();
        
      
        if(isset($dataAll['start_date']) && !empty($dataAll['start_date'])){
            $data_task['start_date'] = strtotime($dataAll['start_date']);
            $dataAll['start_date'] = strtotime($dataAll['start_date']);
        }else{
            unset($dataAll['start_date']);
        }
        if(isset($dataAll['end_date']) && !empty($dataAll['end_date'])){
            $data_task['end_date'] = strtotime($dataAll['end_date']);
            $dataAll['end_date'] = strtotime($dataAll['end_date']);
        }else{
            unset($dataAll['end_date']); 
        }
        if(isset($dataAll['deadline']) && !empty($dataAll['deadline'])){
            $data_task['deadline'] = strtotime($dataAll['deadline']);
            $dataAll['deadline'] = strtotime($dataAll['deadline']);
        }else{
            unset($dataAll['deadline']); 
        }
 
        
        if(isset($dataAll['project_start_date']) && !empty($dataAll['project_start_date'])){
            $data_project['start_date'] = date('Y-m-d',strtotime($dataAll['project_start_date']));
        } 
        if(isset($dataAll['project_end_date']) && !empty($dataAll['project_end_date'])){
            $data_project['end_date'] = date('Y-m-d',strtotime($dataAll['project_end_date']));
        } 

        if( isset($dataAll['project_id']) && $dataAll['project_id'] > 0 ){
            $data_project['id'] = $dataAll['project_id'];
            Project::where( 'id' , $dataAll['project_id'] )->update($data_project);

        }
        
        if( isset($dataAll['id']) && $dataAll['id'] ==0 ){
            $project = new ProjectTask();
            $project->project_id = utf8_encode($dataAll['project_id']);
            $project->task_name = utf8_encode($dataAll['task_name']);
            $project->assignee_to = $dataAll['assignee_to'];
            if($dataAll['parent_id'] == $dataAll['project_id']){
                //$project->parent_id = $dataAll['project_id'];
                $project->parent_id = 0;
            }else{
                $project->parent_id = $dataAll['parent_id'];
            }
            $project->task_order = $dataAll['task_order'];
            if(isset($dataAll['priority'])){
                if($dataAll['priority'] == 1){
                    $project->priority = 'high';
                }
                if($dataAll['priority'] == 2){
                    $project->priority = 'medium';
                }
                if($dataAll['priority'] == 3){
                    $project->priority = 'low';
                }
            }
            if(isset($dataAll['status'])){
                if($dataAll['status'] == 1){
                    $project->status = 'Todo';
                }
                if($dataAll['status'] == 2){
                    $project->status = 'Inprogress';
                }
                if($dataAll['status'] == 3){
                    $project->status = 'Done';
                }
            }
             
           // $project->status = utf8_encode($dataAll['status']);
            //$project->description = utf8_encode($dataAll['description']);
           // $project->report_to = $dataAll['report_to'];
           // $project->labels = utf8_encode($dataAll['labels']);
           
            $project->start_date = (isset($dataAll['start_date']) && !empty($dataAll['start_date']) )?$dataAll['start_date']:null;
            $project->end_date = (isset($dataAll['end_date']) && !empty($dataAll['start_date']) )?$dataAll['end_date']:null;
            if(auth()->guard('pro')->check()){
                $project->pro_user_id = auth()->guard('pro')->user()->id;
            }elseif(auth()->guard('proresource')->check()){
                $project->pro_resource_id = auth()->guard('proresource')->user()->id;
                $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
            }
            $project->save();
            $task_id = $project->id;
        }else{
            if(isset($dataAll['priority'])){
                if($dataAll['priority'] == 1){
                    $data_task['priority'] = 'high';
                }
                if($dataAll['priority'] == 2){
                    $data_task['priority'] = 'medium';
                }
                if($dataAll['priority'] == 3){
                    $data_task['priority'] = 'low';
                }
            }
            if(isset($dataAll['status'])){
                if($dataAll['status'] == 1){
                    $data_task['status'] = 'Todo';
                }
                if($dataAll['status'] == 2){
                    $data_task['status'] = 'Inprogress';
                }
                if($dataAll['status'] == 3){
                    $data_task['status'] = 'Done';
                }
            }
            if(isset($dataAll['type'])){
                if($dataAll['type'] == 'progress'){
                    $data_task['progress'] = $dataAll['progress'];
                }
            }
            if(isset($dataAll['parent_id'])){
                 
                if($dataAll['parent_id'] == $dataAll['project_id']){
                    $data_task['parent_id']  = 0;
                }else{
                    $data_task['parent_id'] = $dataAll['parent_id'];
                }
                     
            
            }

             
            if(isset($dataAll['task_order'])){
                $data_task['task_order'] = $dataAll['task_order'];
            }  
            if(isset($dataAll['assignee_to'])){
                $data_task['assignee_to'] = $dataAll['assignee_to'];
            }  

           
         
            ProjectTask::where( 'id' , $dataAll['id'] )->update($data_task);
            $task_id = $dataAll['id'];
        } 
        
        
        return response()->json([
            'status'=>'Success',
            'id'=>$task_id,
            'message'=>'Project Task Saved successfully.',
        ]);
        die;
    
    }


    public function delete_task(Request $request){
        $project_id = $request->input('task_id');
        $post = ProjectTask::where('id',$project_id)->first();
        if ($post != null) {
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
        die;
    }

    public function create_link(Request $request){
        $dataAll = $request->all();
        $project_id = $dataAll['project_id'];
        
        $task_source = $dataAll['task_source']; 
        $task_target = $dataAll['task_target']; 
        $type = $dataAll['type']; 
        $post = ProjectTaskLink::where('project_id',$project_id)->where('task_source',$task_source)->where('task_target',$task_target)->where('type',$type)->first();
        if ($post != null) {
             
             
        }else{
            $projecttasklink = new ProjectTaskLink();
            $projecttasklink->project_id = $dataAll['project_id'];
            $projecttasklink->task_source = $dataAll['task_source'];
            $projecttasklink->task_target = $dataAll['task_target'];
            $projecttasklink->type = $dataAll['type'];
            $projecttasklink->save();
            $link_id = $projecttasklink->id;
            return response()->json([
                'status'=>'Success',
                'id'=>$link_id,
                'message'=>'Project Task Link Saved successfully.',
            ]);
        }
        die;
    }

    

    public function delete_link(Request $request){
        $id = $request->input('id');
        $post = ProjectTaskLink::where('id',$id)->first();
        if ($post != null) {
            $post->delete();
            return response()->json([
                'status'=>'Success',
                'message'=>'Project Task Link deleted successfully.',
            ]);
        }else{
            return response()->json([
                'status'=>'Fail',
                'message'=>'Unable to deleted project task, Please refresh and try again!',
            ]);
        }
        die;
    }

     

}
