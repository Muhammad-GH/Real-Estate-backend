<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Bussiness\Project; 
use App\Models\Bussiness\ChatGroup; 
use App\Models\Bussiness\ChatUserGroup; 
use App\Models\Bussiness\ChatMessages; 
 
use DB;
use DateTime;
/**
 * Class ChatController.
 */
class ChatController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    { //echo auth()->guard('proresource')->user()->id;
        $project_id = $request['project_id'];
        //$query = ChatUserGroup::with('user');
        //$query = ChatGroup::join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
       // $query = ChatUserGroup::join('pro_chat_group','pro_chat_group.group_id','=','pro_chat_user_group.cug_group_id');
        $query = ChatGroup::with('user');
        if(isset($request['project_id']) && $request['project_id'] > 0){
           // $query->where('project_id','=',$request['project_id']);
           $query->where('pro_chat_group.project_id','=',$request['project_id']);
           $query->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
           $query->leftJoin('pro_chat_messages','pro_chat_messages.message_group_id','=','pro_chat_user_group.cug_group_id');
           $query->leftJoin('pro_users','pro_users.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_user_detail','pro_user_detail.user_id','=','pro_users.id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
           $query->select('pro_chat_messages.*','pro_chat_messages.created_at as time','pro_chat_group.*','pro_users.id as pro_user_id','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_user_detail.company_logo as company_logo','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name','pro_resources.photo as photo','pro_resources.id as resource_id');
           //$query->with('messages');

           

        } else{
            $query->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
            //$query->join('pro_chat_group','pro_chat_group.group_id','=','pro_chat_group.cug_group_id');
            $query->leftJoin('pro_chat_messages','pro_chat_messages.message_group_id','=','pro_chat_user_group.cug_group_id');
            $query->leftJoin('pro_users','pro_users.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Pro User');
           //$query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
           //$query->select('pro_chat_messages.*','pro_chat_group.*','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name');
           $query->leftJoin('pro_user_detail','pro_user_detail.user_id','=','pro_users.id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
           $query->select('pro_chat_messages.*','pro_chat_messages.created_at as time','pro_chat_group.*','pro_users.id as pro_user_id','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_user_detail.company_logo as company_logo','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name','pro_resources.photo as photo','pro_resources.id as resource_id');
           
        }
        
        if(auth()->guard('pro')->check()){
            $query->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
            //$query->with('group');
            $user_id = auth()->guard('pro')->user()->id;
            $user_type = 'Pro User';
        } elseif(auth()->guard('proresource')->check()){
            $query->where('cug_resource_id','=',auth()->guard('proresource')->user()->id);
            $user_id = auth()->guard('proresource')->user()->id;
            $user_type = 'Resource';
        }
        $query->orderBy('time', 'asc');
        $data = $query->get();
        $total = $data->count();


        $groupquery = ChatGroup::with('user');
        $groupquery->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
       //$groupquery->select(  'pro_chat_group.group_id', 'pro_chat_group.group_name','pro_chat_group.project_id');
       if(auth()->guard('pro')->check()){
        $groupquery->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
        //$query->with('group');
        $user_id = auth()->guard('pro')->user()->id;
        $user_type = 'Pro User';
    } elseif(auth()->guard('proresource')->check()){
        $groupquery->where('cug_resource_id','=',auth()->guard('proresource')->user()->id);
        $user_id = auth()->guard('proresource')->user()->id;
        $user_type = 'Resource';
    }
    
    $groups = $groupquery->get();
    // if(isset($groupArr) && $groupArr->count() > 0 ){
    //     foreach($groupArr as $group){
    //         $groups[$group['group_id']][]['project_id'][] = $group['project_id'];
    //         $groups[$group['group_id']]['group_name'][] = $group['group_name'];  
    //     }
       
     //  echo '<pre>';print_r($groups);die;
    // } 
        if($total > 0){
            if(isset($request['project_id']) && $request['project_id'] > 0){
                return view('pms.chat.index')->withChat($data)->withProject($project_id)->withUserid($user_id)->withUsertype($user_type)->withAllgroups($groups);
            }else{
                return view('pms.chat.mainindex')->withChat($data)->withProject($project_id)->withUserid($user_id)->withUsertype($user_type)->withAllgroups($groups);
            }
        }else{
            return redirect()->route('frontend.pms.project')->withErrors(__('pms.messages.unauthorized_access'));
            //return redirect()->back()->withFlashSuccess(__('pms.messages.project_plan_success'));
        }
        
    }

     
    /**
     * Add Edit Save Messages Function
     */
    public function save_message(Request $request){ 
        $dataAll = $request->all();
       
        
        $dataContent = $dataAll['data'];
        $data = array();
        parse_str($dataContent, $data);
        $validator = Validator::make($data, [
            'group_id'     => 'required',
            'user_id' => 'required',
         
            'message_text'   => 'required',
            'attachment'    => 'mimes:doc,docx,pdf,zip|max:2048'
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 406);
        }
        unset($data['_token']);
        if($request->hasfile('attachment')){
            $file = $request->file('attachment');
            $attName  = time()."_".str_replace(' ','',$file->getClientOriginalName());
            $file->move(public_path().'/images/chat/', $attName);
            $data['attachment'] = $attName;
        }
        $todayDate = date('Y-m-d H:i:s');// "2010-09-17";
        $todayStartTime = strtotime($todayDate);

        $chat_messages = new ChatMessages();
        $chat_messages->message_group_id = utf8_encode($data['group_id']);
        $chat_messages->message_user_id = utf8_encode($data['user_id']);
        $chat_messages->message_user_type = utf8_encode($data['user_type']);
        $chat_messages->message_image = (isset($data['attachment']) && !empty($data['attachment']) )?$data['attachment']:'';
        $chat_messages->created_at = $todayStartTime;
    
        $chat_messages->message_text = utf8_encode($data['message_text']);
        $chat_messages->message_type = 'text';
    
        $chat_messages->save();
         


        if($request->ajax()){

            return response()->json([
                'status'=>'Success',
                'message'=>'Saved successfully.',
                'data' => ''
            ]);
        }else{
            return redirect()->back()->withFlashSuccess(__('pms.messages.project_plan_success'));
        }
    }

    public function get_message(Request $request)
    {  
        $project_id = $request['project_id'];
        $group_id = $request['group_id'];
        //$query = ChatUserGroup::with('user');
        //$query = ChatGroup::join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
       // $query = ChatUserGroup::join('pro_chat_group','pro_chat_group.group_id','=','pro_chat_user_group.cug_group_id');
        $query = ChatGroup::with('user');
        if(isset($request['project_id']) && $request['project_id'] > 0){
           // $query->where('project_id','=',$request['project_id']);
           $query->where('pro_chat_group.project_id','=',$request['project_id']);
           $query->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
           $query->leftJoin('pro_chat_messages','pro_chat_messages.message_group_id','=','pro_chat_user_group.cug_group_id');
           $query->leftJoin('pro_users','pro_users.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_user_detail','pro_user_detail.user_id','=','pro_users.id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
           $query->select('pro_chat_messages.*','pro_chat_messages.created_at as time','pro_chat_group.*','pro_users.id as pro_user_id','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_user_detail.company_logo as company_logo','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name','pro_resources.photo as photo','pro_resources.id as resource_id');
           
           //$query->with('messages');
 
        } 
        
        if(auth()->guard('pro')->check()){
            $query->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
            //$query->with('group');
            $user_id = auth()->guard('pro')->user()->id;
            $user_type = 'Pro User';
        } elseif(auth()->guard('proresource')->check()){
            $query->where('cug_resource_id','=',auth()->guard('proresource')->user()->id);
            $user_id = auth()->guard('proresource')->user()->id;
            $user_type = 'Resource';
        }
        $query->orderBy('time', 'asc');
        $data = $query->get();
    
        return view('pms.chat.partials.messages')->withChat($data)->withProject($project_id)->withUserid($user_id)->withUsertype($user_type);
        die;
        
    }

    
    public function get_active_group_message(Request $request)
    {  
        $project_id = $request['project_id'];
        $group_id = $request['group_id'];
        //$query = ChatUserGroup::with('user');
        //$query = ChatGroup::join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
       // $query = ChatUserGroup::join('pro_chat_group','pro_chat_group.group_id','=','pro_chat_user_group.cug_group_id');
        $query = ChatGroup::with('user');
        if(isset($request['project_id']) && $request['project_id'] > 0){
           // $query->where('project_id','=',$request['project_id']);
           $query->where('pro_chat_group.project_id','=',$request['project_id']);
           $query->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
           $query->leftJoin('pro_chat_messages','pro_chat_messages.message_group_id','=','pro_chat_user_group.cug_group_id');
           $query->leftJoin('pro_users','pro_users.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_user_detail','pro_user_detail.user_id','=','pro_users.id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
           $query->select('pro_chat_messages.*','pro_chat_messages.created_at as time','pro_chat_group.*','pro_users.id as pro_user_id','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_user_detail.company_logo as company_logo','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name','pro_resources.photo as photo','pro_resources.id as resource_id');
           
           //$query->with('messages');
 
        } 
        
        if(auth()->guard('pro')->check()){
            $query->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
            //$query->with('group');
            $user_id = auth()->guard('pro')->user()->id;
            $user_type = 'Pro User';
        } elseif(auth()->guard('proresource')->check()){
            $query->where('cug_resource_id','=',auth()->guard('proresource')->user()->id);
            $user_id = auth()->guard('proresource')->user()->id;
            $user_type = 'Resource';
        }
        $query->orderBy('time', 'asc');
        $data = $query->get();
    
        return view('pms.chat.partials.messages')->withChat($data)->withProject($project_id)->withUserid($user_id)->withUsertype($user_type);
        die;
        
    }

    
    public function get_search_message(Request $request)
    {  
        $project_id = $request['project_id'];
        $group_id = $request['group_id'];
        $message = $request['term'];
        //$query = ChatUserGroup::with('user');
        //$query = ChatGroup::join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
       // $query = ChatUserGroup::join('pro_chat_group','pro_chat_group.group_id','=','pro_chat_user_group.cug_group_id');
        $query = ChatGroup::select('pro_chat_messages.message_text','pro_chat_messages.message_id');
       
        if(isset($request['project_id']) && $request['project_id'] > 0){
           // $query->where('project_id','=',$request['project_id']);
           $query->where('pro_chat_group.project_id','=',$request['project_id']);
           $query->join('pro_chat_user_group','pro_chat_user_group.cug_group_id','=','pro_chat_group.group_id');
           $query->leftJoin('pro_chat_messages','pro_chat_messages.message_group_id','=','pro_chat_user_group.cug_group_id');
           $query->leftJoin('pro_users','pro_users.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Pro User');
           //$query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
           //$query->select('pro_chat_messages.*','pro_chat_group.*','pro_users.first_name as pro_user_firstname','pro_users.last_name as pro_user_lastname','pro_resources.first_name as resource_first_name','pro_resources.last_name as resource_last_name');
           $query->leftJoin('pro_user_detail','pro_user_detail.user_id','=','pro_users.id');//->where('message_user_type', '=','Pro User');
           $query->leftJoin('pro_resources','pro_resources.id','=','pro_chat_messages.message_user_id');//->where('message_user_type', '=','Resource');
            
           $query->where('pro_chat_messages.message_text','LIKE',"%$message%");
           //$query->with('messages');
 
        } 
        
        if(auth()->guard('pro')->check()){
            $query->where('cug_pro_user_id','=',auth()->guard('pro')->user()->id);
            //$query->with('group');
            $user_id = auth()->guard('pro')->user()->id;
            $user_type = 'Pro User';
        } elseif(auth()->guard('proresource')->check()){
            $query->where('cug_resource_id','=',auth()->guard('proresource')->user()->id);
            $user_id = auth()->guard('proresource')->user()->id;
            $user_type = ' 	Resource';
        }
        $query->pluck('pro_chat_messages.message_text','pro_chat_messages.message_id')->toArray();;
        $data = $query->get();
        $response = array();
        foreach($data as $jsondata){
            $response[] = array("value"=>$jsondata->message_id,"label"=>$jsondata->message_text);
         }
         

        return response()->json($response);
        die();
        
         
        
    }
     

}
