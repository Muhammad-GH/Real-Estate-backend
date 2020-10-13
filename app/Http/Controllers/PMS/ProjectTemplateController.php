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
use DB;
/**
 * Class ProjectTemplateController.
 */
class ProjectTemplateController extends Controller
{
    
    /**
     * Get Task Project Function
     */
    public function save_template(Request $request){
        $dataAll = $request->all();
        $dataContent = $dataAll['data'];

        $project = new ProjectTaskTemplateName();
        $project->template_name = utf8_encode($dataAll['template_name']);
        if(auth()->guard('pro')->check()){
            $project->pro_user_id = auth()->guard('pro')->user()->id;
        }elseif(auth()->guard('proresource')->check()){
            $project->pro_resource_id = auth()->guard('proresource')->user()->id;
            $project->pro_user_id = auth()->guard('proresource')->user()->user_id;
        }
        $project->save();

        $templateId = $project->id;
        $paarentIds = [];
        $data = array();
        parse_str($dataContent, $data);
        
        foreach($data['data'] as $key => $daata){
            if($daata['parent_id'] == 0){
                $projectTemplate = new ProjectTaskTemplate();
                $projectTemplate->template_id = $templateId;
                $projectTemplate->parent_id = 0;
                $projectTemplate->area_id = ($daata['area_id'] && $daata['area_id'] != '')?$daata['area_id']:null;
                $projectTemplate->area_work_id = ($daata['area_work_id']  && $daata['area_work_id'] != '')?$daata['area_work_id']:null;
                $projectTemplate->task_name = $daata['task_name'];
                $projectTemplate->save();
                $paarentIds[$daata['id']] = $projectTemplate->id;
                unset($data['data'][$key]);
            }
        }

        while(count($data['data'])){
            foreach($data['data'] as $key => $daata){
                if(isset($paarentIds[$daata['parent_id']])){
                    $projectTemplate = new ProjectTaskTemplate();
                    $projectTemplate->template_id = $templateId;
                    $projectTemplate->parent_id = $paarentIds[$daata['parent_id']];
                    $projectTemplate->area_id = ($daata['area_id'] && $daata['area_id'] != '')?$daata['area_id']:null;
                    $projectTemplate->area_work_id = ($daata['area_work_id']  && $daata['area_work_id'] != '')?$daata['area_work_id']:null;
                    $projectTemplate->task_name = $daata['task_name'];
                    $projectTemplate->save();
                    $paarentIds[$daata['id']] = $projectTemplate->id;
                    unset($data['data'][$key]);
                }
            }
        }

        return response()->json([
            'status'=>'Success',
            'message'=>__('pms.messages.project_task_template_success'),
        ]);
    }


    /**
     * List Template Project Function
     */
    public function template_list(Request $request){
        
        
        if(auth()->guard('pro')->check()){
            $data = ProjectTaskTemplateName::where('pro_user_id' , auth()->guard('pro')->user()->id)->get();
        }elseif(auth()->guard('proresource')->check()){
            $data = ProjectTaskTemplateName::where('pro_user_id' , auth()->guard('proresource')->user()->user_id)->where('pro_resource_id' , auth()->guard('proresource')->user()->id)->get();
        }
        
        return view('pms.project.templates.template_list')->withTemplates($data);
    }

    /**
     * Load Template Project Function
     */
    public function template_load(Request $request){
        $template_id = $request->query('template_id');
        $projectTemplate = ProjectTaskTemplate::with('allchildtask')->where('template_id',$template_id)->where('parent_id',0)->orWhere('parent_id',null)->get();
        if(auth()->guard('pro')->check()){
            $resources = Resources::where('user_id', auth()->guard('pro')->user()->id )->get();
        }
        elseif(auth()->guard('proresource')->check()){
            $resources = Resources::where('user_id', auth()->guard('proresource')->user()->user_id )->get();
        }

        return view('pms.project.templates.template_load')->withResources($resources)->withTemplateTask($projectTemplate)->withTemplateId($template_id);
    }

    /**
     * Delete Template Project Function
     */
    public function template_delete(Request $request){
        $dataAll = $request->all();
        $template_id = $dataAll['template_id'];
        ProjectTaskTemplateName::where('id', $template_id)->delete();
        return response()->json([
            'status'=>'Success',
            'message'=>__('pms.messages.project_task_template_success'),
        ]);

    }

    /**
     * Delete Template Task Project Function
     */
    public function template_delete_task(Request $request){
        $task_id = $request->input('task_id');
        $post = ProjectTaskTemplate::where('id',$task_id)->first();
        if ($post != null) {
            ProjectTaskTemplate::where( 'parent_id' , $post->id )->update(['parent_id'=>$post->parent_id]);
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
    
    
}
