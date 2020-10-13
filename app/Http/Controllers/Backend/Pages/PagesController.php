<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Pages;
use App\Models\PagesLanguage;
// use App\Models\Auth\User;
use App\Repositories\Backend\PagesRepository;
use App\Repositories\Backend\PagesLanguageRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Session;
use Redirect;
/**
 * Class PagesController.
 */
class PagesController extends Controller
{
    /**
     * @var PagesRepository
     */
    protected $pagesRepository;
    protected $pagesLanguageRepository;

    /**
     * PagesController constructor.
     *
     * @param PagesRepository $PagesRepository
     */
    public function __construct(PagesRepository $pagesRepository, PagesLanguageRepository $pagesLanguageRepository)
    {
        $this->pagesRepository = $pagesRepository;
        $this->pagesLanguageRepository = $pagesLanguageRepository;
    }



    public function getPagesLanguage($categoryId)
    {
        return PagesLanguage::where('id',$categoryId)->first();
    }
    
    public function editPage(){
        Session::put('pages_editable', 'true');
        return Redirect::away('/');
    }
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.pages.index')
            ->withPages($this->pagesRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $languages = Languages::where('status', 1)->get();
        return view('backend.pages.create',
            [
                'languages' => $languages,
            ]);
    }

    public function uploadImage($image){
        //$size = $image->getSize();;
        $imageName  = time()."_".$image->getClientOriginalName();
        $image->move(public_path().'/images/pages/', $imageName);
        return $imageName;
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Pages $pages, PagesLanguage $pagesLanguage)
    {
        $data = $request->all();
        $page = new Pages();
        $page->name = utf8_encode($data['name'][1]);
        $page->banner_title = utf8_encode($data['banner_title'][1]);
        $page->content = utf8_encode($data['content'][1]);
        if($request->hasfile('banner'))
        {
            $file = $request->file('banner');
            if(isset($file[1])){
                $page->banner = $this->uploadImage($file[1]);
            }
        }
        $page->language_id = 1;
        $page->save();
        if(count($data['name']) > 1){
            foreach($data['name'] as $l_id => $name){
                if($l_id == 1){
                    continue;
                }
                $pageLanguage = new PagesLanguage();
                $pageLanguage->name = utf8_encode($data['name'][$l_id]);
                $pageLanguage->banner_title = utf8_encode($data['banner_title'][$l_id]);
                $pageLanguage->content = utf8_encode($data['content'][$l_id]);
                $pageLanguage->parent_id = $page->id;
                $pageLanguage->language_id = $l_id;
                if($request->hasfile('banner'))
                {
                    $file = $request->file('banner');
                    if(isset($file[$l_id])){
                        $pageLanguage->banner = $this->uploadImage($file[$l_id]);
                    }
                }
                $pageLanguage->save();
            }
        }
        return redirect()->route('admin.pages.index')->withFlashSuccess('The Pages was successfully created.');
    }

  
    public function getPages($pagesId)
    {
        return Pages::where('id',$pagesId)->with('pageLanguage')->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$pagesId)
    {
        $pagesData = $this->getPages($pagesId);
        $pagesLanguage = PagesLanguage::where('parent_id',$pagesId)->get();
        $languages = Languages::where('status', 1)->get();
        $data[1]['name'] = $pagesData->name;
        $data[1]['banner_title'] = $pagesData->banner_title;
        $data[1]['banner'] = $pagesData->banner;
        $data[1]['content'] = $pagesData->content;
        if($pagesLanguage){
            foreach($pagesLanguage as $pageLanguage){
                $data[$pageLanguage->language_id]['name'] = $pageLanguage->name;
                $data[$pageLanguage->language_id]['banner'] = $pageLanguage->banner;
                $data[$pageLanguage->language_id]['banner_title'] = $pageLanguage->banner_title;
                $data[$pageLanguage->language_id]['content'] = $pageLanguage->content;
            }
        }
        return view('backend.pages.edit',
            [
                'pagesId' => $pagesId,
                'languages' => $languages,
                'data' => $data,
            ]);
    }
    public function update(Request $request, $pagesId)
    {
        $data = $request->all();
        $page =  $this->getPages($pagesId);
        $page->name = utf8_encode($data['name'][1]);
        $page->banner_title =( $data['banner_title'][1]);
        $page->content = ($data['content'][1]);
        if($request->hasfile('banner'))
        {
            $file = $request->file('banner');
            if(isset($file[1])){
                $page->banner = $this->uploadImage($file[1]);
            }
        }
        $page->save();
        if(count($data['name']) > 1){
            foreach($data['name'] as $l_id => $name){
                if($l_id == 1){
                    continue;
                }
                $pageLanguage = PagesLanguage::where('parent_id',$pagesId)->where('language_id',$l_id)->first();
                if(!$pageLanguage){
                    $pageLanguage = new PagesLanguage();
                }
                $pageLanguage->name = utf8_encode($data['name'][$l_id]);
                $pageLanguage->banner_title = ($data['banner_title'][$l_id]);
                $pageLanguage->content = ($data['content'][$l_id]);
                $pageLanguage->parent_id = $page->id;
                $pageLanguage->language_id = $l_id;
                if($request->hasfile('banner'))
                {
                    $file = $request->file('banner');
                    if(isset($file[$l_id])){
                        $pageLanguage->banner = $this->uploadImage($file[$l_id]);
                    }
                }
                $pageLanguage->save();
            }
        }

        return redirect()->route('admin.pages.index')->withFlashSuccess('Page has been updated successfully.');
    }

}
