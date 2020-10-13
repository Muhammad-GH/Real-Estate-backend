<?php

namespace App\Http\Controllers\Backend\Pro\Category;

use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BackendPro\Category;
use App\Repositories\Backend\CategoryRepository; 
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class CategoryController.
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $CategoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $CategoryRepository
     */
    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }


 

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /*$categories = Category::whereNull('category_parent_id')
        ->with('childrenCategories')
        ->get();*/

        $categories = Category::where('category_parent_id', 0)->get();

 
        return view('backend.pro.category.index',compact('categories'))
            ->withCategory($this->CategoryRepository->getActivePaginated(25, 'category_id', 'asc','category_parent_id','=','0'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $categories = Category::all()->pluck('category_name', 'category_id')->toArray(); 
        return view('backend.pro.category.create',
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
    public function store(Request $request, Category $Category)
    {
        $data = $request->all();
        $Category = new Category();
    
        $Category->category_name = utf8_encode($data['category_name']);
        
        $Category->category_parent_id = utf8_encode($data['category_parent_id']);
        $Category->save();
   
        return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.category.created'));
    }


    public function getCategory($category_id)
    {
        return Category::where('category_id',$category_id)->first();
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
     
        $categories = Category::all()->pluck('category_name', 'category_id')->toArray();
        
 
        $categoryData = $this->getCategory($category_id);
       
        return view('backend.pro.category.edit',
            [
                'category_id' => $category_id,
                'categories' => $categories,
                'parent_category' => $parent_category,
                'category' => $categoryData,
            ]);
    }
    public function update(Request $request, $category_id)
    {
        $data = $request->all();
        $Category =  Category::where('category_id',$category_id)->first();
       
        $Category->category_name = utf8_encode($data['category_name']);
        $Category->category_parent_id = utf8_encode($data['category_parent_id']);
        $Category->save();
 

        return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.category.updated'));
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
        $Category_child =  Category::where('category_parent_id', '=', $category_id)->first();
         
        if ($Category_child == null) {
            $Category =  Category::where('category_id',$category_id)->first();
            $Category->delete();
             
             
            return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.category.deleted'));
        }
        return redirect()->route('admin.category.index')->withFlashDanger(__('alerts.backend.category.child_exist'));;
    }

    public function nestedCategory(){
        $parents = Category::where('category_parent_id', 0)->get();
        
        foreach ($parents as $parent) {
            $childs = Category::where('category_parent_id', $parent->category_id)->get();
            if (count($childs) > 0) {
                $subCat = array();
                $categories = array();
                $category[$parent->category_id] = $categories;
                        foreach ($childs as $i => $child) {
                            $subchilds = Category::where('category_parent_id', $child->category_id)->get();
                            
                            if (count($subchilds) > 0) {

                                $category[$parent->category_id][$child->category_id] = $subCat;
                                foreach ($subchilds as $subchild) {

                                    $category[$parent->category_id][$child->category_id][$subchild->category_id] = $subchild->category_name;
                                }

                            }else{
                                $category[$parent->category_id][$child->category_id] = $categories;
                            }
                        }

            }else{
                $category[$parent->category_id] = $parent->category_name;
            }
        }
        return $category;
    }
}
