<?php

namespace App\Http\Controllers\Backend\Blog;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\BlogLanguage;
use App\Models\Languages;
use App\Models\BlogCategory;
// use App\Models\Auth\User;
use App\Repositories\Backend\BlogRepository;
use App\Repositories\Backend\BlogCategoryRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class BlogController.
 */
class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepository;
    protected $blogCategoryRepository;

    /**
     * BlogController constructor.
     *
     * @param BlogRepository $BlogRepository
     */
    public function __construct(BlogRepository $BlogRepository, BlogCategoryRepository $BlogCategoryRepository)
    {
        $this->blogRepository = $BlogRepository;
        $this->blogCategoryRepository = $BlogCategoryRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index_category(Request $request)
    {
        return view('backend.blog.index_category')
            ->withBlogCategory($this->blogCategoryRepository->getActivePaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeletedCategory(Request $request)
    {
        return view('backend.blog.deleted_category')
            ->withBlogCategory($this->blogCategoryRepository->getDeletedPaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create_category(Request $request)
    {
        return view('backend.blog.create_category');
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store_category(Request $request, BlogCategory $blogCategory)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'     => ['required','max:150', Rule::unique('blog_category')],
            'details'   => 'required',
        ])->validate();
        
        $blogCategory->name     =  $data['name'];
        $blogCategory->details   =  $data['details'];
        $blogCategory->slug      = str_replace(" ","_",strtolower(str_replace("?",'',$data['name'])));

        $proj = $blogCategory->save();
        $blogCategoryId = $blogCategory->id;
        

        return redirect()->route('admin.blog.category.index')->withFlashSuccess('The Blog Category was successfully created.');
    }

  
    public function getBlogCategory($categoryId)
    {
        return BlogCategory::where('id',$categoryId)->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit_category(Request $request,$categoryId)
    {
        $blogCategoryData = $this->getBlogCategory($categoryId);
        return view('backend.blog.edit_category')
            ->withBlogCategory($blogCategoryData);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update_category(Request $request, $cat_id)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'     => ['required','max:150'],
            'details'   => 'required',
        ])->validate();
        
        $blogCategory = $this->getBlogCategory($cat_id);
        $blogCategory->name      =  $data['name'];
        $blogCategory->details   =  $data['details'];
        $blogCategory->slug      = str_replace(" ","_",strtolower(str_replace("?",'',$data['name'])));
        
        $investProperty = $blogCategory->save();
        
        return redirect()->route('admin.blog.category.index')->withFlashSuccess('Blog Category has been updated successfully.');
    }


    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy_category($category_id)
    {
        $post = BlogCategory::where('id',$category_id)->first();
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin.blog.category.index')->withFlashSuccess(__('Blog Category has been deleted successfully.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete_category($categoryId)
    {
        $post = BlogCategory::where('id',$categoryId)->onlyTrashed()->first();
        if ($post != null) {
            $post->forceDelete();
            return redirect()->route('admin.blog.category.deleted')->withFlashSuccess(__('Blog Category has been permanently deleted successfully.'));
        }
        return redirect()->back();

    }

    /**
     * @param Request $request
    * @param Property              $property
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore_category($categoryId)
    {
        $post = BlogCategory::where('id',$categoryId)->onlyTrashed()->first();
        if ($post != null) {
            $post->restore();
            return redirect()->route('admin.blog.category.deleted')->withFlashSuccess(__('Blog Category has been restored successfully.'));
        }
        return redirect()->back();

    }
    
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.blog.index')
            ->withBlog($this->blogRepository->getActivePaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getDeletedBlog(Request $request)
    {
        return view('backend.blog.deleted')
            ->withBlog($this->blogRepository->getDeletedPaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $blogCategory = BlogCategory::pluck('name','id');
        $languages = Languages::where('status', 1)->get();
        return view('backend.blog.create')->withBlogCategory($blogCategory)->withLanguages($languages);
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Blog $blog)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name.*'              => ['required','max:150', Rule::unique('blog', 'name')],
            'short_description.*' => 'required',
            'description.*'       => 'required',
            'tags.*'              => 'required',
            'blog_category_id.*'  => 'required',
            'image.*'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status.*'  => 'required',
        ])->validate();

        $blog->name     =  $data['name']['fi'];
        $blog->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",str_replace("?",'',$data['name']['fi'])));
        $blog->short_description  =  $data['short_description']['fi'];
        $blog->description  =  $data['description']['fi'];
        $blog->tags  =  $data['tags']['fi'];
        $blog->language_code  =  'fi';
        $blog->blog_category_id  =  $data['blog_category_id']['fi'];
        $blog->read_time  = $data['read_time']['fi'];
        $blog->status  = $data['status']['fi'];
        
        $blog->save();
        $blogId = $blog->id;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            if(isset($file['fi'])){
                $document = $file['fi'];
                $imageName  = time()."_".$document->getClientOriginalName();
                $document->move(public_path().'/images/blog/'.$blogId.'/', $imageName);
                Blog::where('id',$blogId)->update(['image' => $imageName]);
            }

        }
        if(count($data['name']) > 1){
            foreach($data['name'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $blogLanguage = BlogLanguage::where('parent_id',$blogId)->where('language_code',$l_id)->first();
                if(!$blogLanguage){
                    $blogLanguage = new BlogLanguage();
                }
                $blogLanguage->name     =  $data['name'][$l_id];
                $blogLanguage->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",str_replace("?",'',$blog->name)));
                $blogLanguage->short_description  =  $data['short_description'][$l_id];
                $blogLanguage->description  =  $data['description'][$l_id];
                $blogLanguage->tags  =  $data['tags'][$l_id];
                $blogLanguage->language_code  =  $l_id;
                $blogLanguage->parent_id = $blogId;
                $blogLanguage->blog_category_id  =  $data['blog_category_id'][$l_id];
                $blogLanguage->read_time  = $data['read_time'][$l_id];
                $blogLanguage->save();
                if($request->hasfile('image'))
                {
                    $file = $request->file('image');
                    if(isset($file[$l_id])) {
                        $document = $file[$l_id];
                        $imageName  = time()."_".$document->getClientOriginalName();
                        $document->move(public_path().'/images/blog/'.$blogId.'/', $imageName);
                        BlogLanguage::where('id',$blogLanguage->id)->update(['image' => $imageName]);
                    }
                }
            }
        }
        return redirect()->route('admin.blog.index')->withFlashSuccess('The Blog was successfully created.');
    }

  
    public function getBlog($blogId)
    {
        return Blog::where('id',$blogId)->with('category')->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$blogId)
    {
        $blogData = Blog::where('id',$blogId)->first();
        $blogLanguages = BlogLanguage::where('parent_id',$blogId)->get();
        $data['fi']['short_description'] = $blogData->short_description;
        $data['fi']['description'] = $blogData->description;
        $data['fi']['name'] = $blogData->name;
        $data['fi']['blog_category_id'] = $blogData->blog_category_id;
        $data['fi']['image'] = $blogData->image;
        $data['fi']['id'] = $blogData->id;
        $data['fi']['tags'] = $blogData->tags;
        $data['fi']['read_time'] = $blogData->read_time;
        $data['fi']['status'] = $blogData->status;
        if($blogLanguages){
            foreach($blogLanguages as $blogLanguage){
                $data[$blogLanguage->language_code]['short_description'] = $blogLanguage->short_description;
                $data[$blogLanguage->language_code]['description'] = $blogLanguage->description;
                $data[$blogLanguage->language_code]['name'] = $blogLanguage->name;
                $data[$blogLanguage->language_code]['blog_category_id'] = $blogLanguage->blog_category_id;
                $data[$blogLanguage->language_code]['image'] = $blogLanguage->image;
                $data[$blogLanguage->language_code]['id'] = $blogLanguage->parent_id;
                $data[$blogLanguage->language_code]['tags'] = $blogLanguage->tags;
                $data[$blogLanguage->language_code]['read_time'] = $blogLanguage->read_time;
                $data[$blogLanguage->language_code]['status'] = $blogLanguage->status;
            }
        }

        $languages = Languages::where('status', 1)->get();
        $blogCategory = BlogCategory::pluck('name','id');
        return view('backend.blog.edit')
            ->withBlog($blogData)
            ->withData($data)
            ->withLanguages($languages)
            ->withBlogCategory($blogCategory);
    }
    
    public function show(Request $request,$blogId)
    {
        $blogData = $this->getBlog($blogId);
        $blogCategory = BlogCategory::pluck('name','id');
        return view('backend.blog.show')
            ->withBlog($blogData)
            ->withBlogCategory($blogCategory);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, $blogId)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name.*'              => ['required','max:150', Rule::unique('blog','name')->ignore($blogId)],
            'short_description.*' => 'required',
            'description.*'       => 'required',
            'tags.*'              => 'required',
            'blog_category_id.*'  => 'required',
            'image.*'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status.*'              => 'required',
        ])->validate();

        $blog = $this->getBlog($blogId);
        $blog->name     =  $data['name']['fi'];
        $blog->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",str_replace("?",'',$data['name']['fi'])));
        $blog->short_description  =  $data['short_description']['fi'];
        $blog->description  =  $data['description']['fi'];
        $blog->tags  =  $data['tags']['fi'];
        $blog->blog_category_id  =  $data['blog_category_id']['fi'];
        $blog->read_time  = $data['read_time']['fi'];
        $blog->status  = $data['status']['fi'];
        $blog->save();
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            if(isset($file['fi'])){
                $document = $file['fi'];
                $imageName  = time()."_".$document->getClientOriginalName();
                
                try{
                    $document->move(public_path().'/images/blog/'.$blogId.'/', $imageName);
                    #move_uploaded_file(public_path().'/images/blog/'.$blogId.'/', $imageName);
                }catch(Exception $e){
                    echo '<pre>'; print_r($e); die;
                }
                
                Blog::where('id',$blogId)->update(['image' => $imageName]);
            }
        }
        if(count($data['name']) > 1){
            foreach($data['name'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $blogLanguage = BlogLanguage::where('parent_id',$blogId)->where('language_code',$l_id)->first();
                if(!$blogLanguage){
                    $blogLanguage = new BlogLanguage();
                }
                $blogLanguage->name     =  $data['name'][$l_id];
                $blogLanguage->slug      = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(" ","-",str_replace("?",'',$blog->name)));
                $blogLanguage->short_description  =  $data['short_description'][$l_id];
                $blogLanguage->description  =  $data['description'][$l_id];
                $blogLanguage->tags  =  $data['tags'][$l_id];
                $blogLanguage->language_code  =  $l_id;
                $blogLanguage->parent_id = $blogId;
                $blogLanguage->blog_category_id  =  $data['blog_category_id'][$l_id];
                $blogLanguage->read_time  = $data['read_time'][$l_id];
                $blogLanguage->status  = $data['status'][$l_id];
                $blogLanguage->save();
                if($request->hasfile('image'))
                {
                    $file = $request->file('image');
                    if(isset($file[$l_id])) {
                        $document = $file[$l_id];
                        $imageName  = time()."_".$document->getClientOriginalName();
                        $document->move(public_path().'/images/blog/'.$blogId.'/', $imageName);
                        BlogLanguage::where('id',$blogLanguage->id)->update(['image' => $imageName]);
                    }
                }
            }
        }

        // if($request->hasfile('image'))
        // {
        //     $document = $request->file('image');
        //     $size = $document->getSize();
        //     $imageName  = time()."_".$document->getClientOriginalName();
        //     $document->move(public_path().'/images/blog/'.$blogId.'/', $imageName);  
        //     Blog::where('id',$blogId)->update(['image' => $imageName]);
        // }

        return redirect()->route('admin.blog.index')->withFlashSuccess('Blog has been updated successfully.');
    }


    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($blog_id)
    {
        $post = Blog::where('id',$blog_id)->first();
        if ($post != null) {
            $post->forceDelete();
            $postLanguage = BlogLanguage::where('parent_id',$blog_id)->get();
            if ($postLanguage != null) {
                foreach($postLanguage as $pd){
                    $pd->forceDelete();
                }
            }
            return redirect()->route('admin.blog.index')->withFlashSuccess(__('Blog has been deleted successfully.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function changestatus($blog_id, $status)
    {
        Blog::where('id',$blog_id)->update(['status' => $status]);
        return redirect()->back()->withFlashSuccess(__('Blog has been successfully '.$status));

    }
    
    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete($blog_id)
    {
        $post = Blog::where('id',$blog_id)->onlyTrashed()->first();
        if ($post != null) {
            $post->forceDelete();
            $postLanguages = BlogLanguage::where('parent_id',$blog_id)->get();
            if ($postLanguages != null) {
                foreach($postLanguages as $pd){
                    $pd->forceDelete();
                }
            }
            return redirect()->route('admin.blog.deleted')->withFlashSuccess(__('Blog has been permanently deleted successfully.'));
        }
        return redirect()->back();

    }

    /**
     * @param Request $request
    * @param Property              $property
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore($blog_id)
    {
        $post = Blog::where('id',$blog_id)->onlyTrashed()->first();
        if ($post != null) {
            $post->restore();
            return redirect()->route('admin.blog.deleted')->withFlashSuccess(__('Blog has been restored successfully.'));
        }
        return redirect()->back();

    }

}
