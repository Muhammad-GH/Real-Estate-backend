<?php

namespace App\Http\Controllers\Backend\Pro\Category;

use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BackendPro\MaterialCategory;
use App\Repositories\Backend\MaterialCategoryRepository; 
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class CategoryController.
 */
class MaterialCategoryController extends Controller
{
    /**
     * @var MaterialCategoryRepository
     */
    protected $MaterialCategoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param MaterialCategoryRepository $MaterialCategoryRepository
     */
    public function __construct(MaterialCategoryRepository $MaterialCategoryRepository)
    {
        $this->MaterialCategoryRepository = $MaterialCategoryRepository;
    }


 

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
 
        $categories = MaterialCategory::where('mc_parent_id', 0)->get();
 
 
        return view('backend.pro.materialcategory.index',compact('categories'))
            ->withCategory($this->MaterialCategoryRepository->getActivePaginated(25, 'mc_id', 'asc','mc_parent_id','=','0'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $categories = MaterialCategory::all()->pluck('name', 'mc_id')->toArray(); 
        return view('backend.pro.materialcategory.create',
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
    public function store(Request $request, materialcategory $Category)
    { 
        $data = $request->all();
        $Category = new MaterialCategory();
    
        $Category->name = utf8_encode($data['name']);
        $Category->sort_name = str_replace(' ','-',strtolower(utf8_encode($data['name'])));
        $Category->mc_parent_id = utf8_encode($data['mc_parent_id']);
        $Category->save();
   
        return redirect()->route('admin.materialcategory.index')->withFlashSuccess(__('alerts.backend.materialcategory.created'));
    }


    public function getCategory($mc_id)
    {
        return MaterialCategory::where('mc_id',$mc_id)->first();
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
     
        $categories = MaterialCategory::all()->pluck('name', 'mc_id')->toArray();
        
 
        $categoryData = $this->getCategory($category_id);
       
        return view('backend.pro.materialcategory.edit',
            [
                'mc_id' => $category_id,
                'categories' => $categories,
                'parent_category' => $parent_category,
                'category' => $categoryData,
            ]);
    }
    public function update(Request $request, $category_id)
    {
        $data = $request->all();
        $Category =  MaterialCategory::where('mc_id',$category_id)->first();
       
        $Category->name = utf8_encode($data['name']);
        $Category->sort_name = str_replace(' ','-',strtolower(utf8_encode($data['name'])));
        $Category->mc_parent_id = utf8_encode($data['mc_parent_id']);
        $Category->save();
 

        return redirect()->route('admin.materialcategory.index')->withFlashSuccess(__('alerts.backend.materialcategory.updated'));
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
        $Category_child =  MaterialCategory::where('mc_parent_id', '=', $category_id)->first();
         
        if ($Category_child == null) {
            $Category =  MaterialCategory::where('mc_id',$category_id)->first();
            $Category->delete();
             
             
            return redirect()->route('admin.materialcategory.index')->withFlashSuccess(__('alerts.backend.materialcategory.deleted'));
        }
        return redirect()->route('admin.materialcategory.index')->withFlashDanger(__('alerts.backend.materialcategory.child_exist'));;
    }

    public function nestedCategory(){
        $parents = MaterialCategory::where('mc_parent_id', 0)->get();
        
        foreach ($parents as $parent) {
            $childs = MaterialCategory::where('mc_parent_id', $parent->mc_id)->get();
            if (count($childs) > 0) {
                $subCat = array();
                $categories = array();
                $category[$parent->mc_id] = $categories;
                        foreach ($childs as $i => $child) {
                            $subchilds = MaterialCategory::where('mc_parent_id', $child->mc_id)->get();
                            
                            if (count($subchilds) > 0) {

                                $category[$parent->mc_id][$child->mc_id] = $subCat;
                                foreach ($subchilds as $subchild) {

                                    $category[$parent->mc_id][$child->mc_id][$subchild->mc_id] = $subchild->name;
                                }

                            }else{
                                $category[$parent->mc_id][$child->mc_id] = $categories;
                            }
                        }

            }else{
                $category[$parent->mc_id] = $parent->name;
            }
        }
        return $category;
    }
}
