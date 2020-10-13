<?php

namespace App\Http\Controllers\Backend\Pro\Category;

use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BackendPro\WorkCategory;
use App\Repositories\Backend\WorkCategoryRepository; 
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class WorkCategoryController.
 */
class WorkCategoryController extends Controller
{
    /**
     * @var WorkCategoryRepository
     */
    protected $WorkCategoryRepository;

    /**
     * WorkCategoryController constructor.
     *
     * @param WorkCategoryRepository $WorkCategoryRepository
     */
    public function __construct(WorkCategoryRepository $WorkCategoryRepository)
    {
        $this->WorkCategoryRepository = $WorkCategoryRepository;
    }


 

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
 
       
        $categories = WorkCategory::where('wc_parent_id', 0)->get();
 
 
        return view('backend.pro.workcategory.index',compact('categories'))
            ->withCategory($this->WorkCategoryRepository->getActivePaginated(25, 'wc_id', 'asc','wc_parent_id','=','0'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $categories = WorkCategory::all()->pluck('name', 'wc_id')->toArray(); 
        return view('backend.pro.workcategory.create',
            [
                'categories' => $categories,
            ]);
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, workcategory $Category)
    { 
        $data = $request->all();
        $Category = new WorkCategory();
    
        $Category->name = utf8_encode($data['name']);
        $Category->sort_name = str_replace(' ','-',strtolower(utf8_encode($data['name'])));
        $Category->wc_parent_id = utf8_encode($data['wc_parent_id']);
        $Category->save();
   
        return redirect()->route('admin.workcategory.index')->withFlashSuccess(__('alerts.backend.workcategory.created'));
    }


    public function getCategory($wc_id)
    {
        return WorkCategory::where('wc_id',$wc_id)->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$category_id)
    {   
    
        $parent_category = $this->nestedCategory();
     
        $categories = WorkCategory::all()->pluck('name', 'wc_id')->toArray();
        
 
        $categoryData = $this->getCategory($category_id);
       
        return view('backend.pro.workcategory.edit',
            [
                'wc_id' => $category_id,
                'categories' => $categories,
                'parent_category' => $parent_category,
                'category' => $categoryData,
            ]);
    }
    public function update(Request $request, $category_id)
    {
        $data = $request->all();
        $Category =  WorkCategory::where('wc_id',$category_id)->first();
       
        $Category->name = utf8_encode($data['name']);
        $Category->sort_name = str_replace(' ','-',strtolower(utf8_encode($data['name'])));
        $Category->wc_parent_id = utf8_encode($data['wc_parent_id']);
        $Category->save();
 

        return redirect()->route('admin.workcategory.index')->withFlashSuccess(__('alerts.backend.workcategory.updated'));
    }
    /**
     * @param Request $request
     * @param Delete Categroy              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($category_id)
    {
        $Category_child =  WorkCategory::where('wc_parent_id', '=', $category_id)->first();
         
        if ($Category_child == null) {
            $Category =  WorkCategory::where('wc_id',$category_id)->first();
            $Category->delete();
             
             
            return redirect()->route('admin.workcategory.index')->withFlashSuccess(__('alerts.backend.workcategory.deleted'));
        }
        return redirect()->route('admin.workcategory.index')->withFlashDanger(__('alerts.backend.workcategory.child_exist'));;
    }

    public function nestedCategory(){
        $parents = WorkCategory::where('wc_parent_id', 0)->get();
        
        foreach ($parents as $parent) {
            $childs = WorkCategory::where('wc_parent_id', $parent->wc_id)->get();
            if (count($childs) > 0) {
                $subCat = array();
                $categories = array();
                $category[$parent->wc_id] = $categories;
                        foreach ($childs as $i => $child) {
                            $subchilds = WorkCategory::where('wc_parent_id', $child->wc_id)->get();
                            
                            if (count($subchilds) > 0) {

                                $category[$parent->wc_id][$child->wc_id] = $subCat;
                                foreach ($subchilds as $subchild) {

                                    $category[$parent->wc_id][$child->wc_id][$subchild->wc_id] = $subchild->name;
                                }

                            }else{
                                $category[$parent->wc_id][$child->wc_id] = $categories;
                            }
                        }

            }else{
                $category[$parent->wc_id] = $parent->name;
            }
        }
        return $category;
    }
}
