<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Bussiness\Resources;
use App\Models\Bussiness\ProResourcePermission;


/**
 * Class PermissionController.
 */
class PermissionController extends Controller
{
    
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        $breadcrumb = [
            ['name'=> __('pms.dashboard.title') , 'route'=>'frontend.pms.dashboard'],
            ['name'=> __('pms.permission.title') , 'route'=>'frontend.pms.permission']
        ];
        
        // $resources = Resources::with('permission')->where('user_id','=',auth()->guard('pro')->user()->id)->get();
        $permissions = ProResourcePermission::get();
        $resources = [];

        return view('pms.permission.index')->withBreadcrumb($breadcrumb)->withResources($resources)->withPermissions($permissions);
    }
    

    /**
     * @return \Illuminate\Permission\Submit
     */
    public function permission_name(Request $request)
    {
        $data = $request->all();

        $permissionObject = new ProResourcePermission();
        $permissionObject->role_name = $data['role_name'];
        $permissionObject->view_project = (isset($data['view_project']))?1:0;
        $permissionObject->edit_project = (isset($data['edit_project']))?1:0;
        $permissionObject->edit_subtask = (isset($data['edit_subtask']))?1:0;
        $permissionObject->add_time = (isset($data['add_time']))?1:0;
        $permissionObject->planning_project = (isset($data['planning_project']))?1:0;
        $permissionObject->save();

        return redirect()->route('frontend.pms.permission')->withFlashSuccess(__('pms.messages.permission_updated_success'));
     
    }
    
    /**
     * @return \Illuminate\Permission\Submit
     */
    public function permission_submit(Request $request)
    {
        $data = $request->all();
        // print_r($data);
        // die;
        
        foreach($data['permission'] as $key => $permission){
            $perms = ProResourcePermission::where('id', '=', $key)->first();
            $permissionData = [
                'role_name' => $permission['role_name'],
                'view_project' => (isset($permission['view_project']))?1:0,
                'edit_project' => (isset($permission['edit_project']))?1:0,
                'planning_project' => (isset($permission['planning_project']))?1:0,
                'edit_subtask' => (isset($permission['edit_subtask']))?1:0,
                'add_time' => (isset($permission['add_time']))?1:0
            ];
            if (!$perms) {
                // $permissionData['pro_resource_id'] = $key;
                
                $permissionObject = new ProResourcePermission();
                $permissionObject->role_name = $permission['role_name'];
                $permissionObject->view_project = (isset($permission['view_project']))?1:0;
                $permissionObject->edit_project = (isset($permission['edit_project']))?1:0;
                $permissionObject->edit_subtask = (isset($permission['edit_subtask']))?1:0;
                $permissionObject->add_time = (isset($permission['add_time']))?1:0;
                $permissionObject->planning_project = (isset($permission['planning_project']))?1:0;
                $permissionObject->save();
                
            } else {
                ProResourcePermission::where( 'id' ,'=', $key )->update($permissionData);
            }            
        }


        return redirect()->route('frontend.pms.permission')->withFlashSuccess(__('pms.messages.permission_updated_success'));
    }


}
