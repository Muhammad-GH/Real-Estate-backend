<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\FrontendPages;
use App\Models\FrontendPagesContent;


/**
 * Class AjaxController.
 */
class AjaxController extends Controller
{
    
    /**
     * AjaxController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function savePageContent(Request $request)
    { 
        if ($request->isMethod('post')) {
            $post = $request->all();

            $pageRow = FrontendPages::where('url_slug',$post['pageRoute'])->first();
            $languageCode = $request->session()->get('locale');
            if(! ($pageRow && $languageCode) ){
                echo json_encode([
                    'status'=>'Failed',
                    'message'=>'Error: Page not found.'
                ]);
                die;
            }

            $page = FrontendPagesContent::where(['page_id'=>$pageRow->page_id, 'lang_code'=>$languageCode])->first();

            if($page){     
                //Update
                $page->html_content = $post['content'];
                $page->save();
            }else{
                // Add
                $page = new FrontendPagesContent();
                $page->page_id = $pageRow->page_id;
                $page->language_id = 1;
                $page->lang_code = $languageCode;
                $page->html_content = $post['content'];
                $page->save();

                //utf8_decode 
            }
        }
        
        echo json_encode([
                'status'=>'Success',
                'message'=>'Saved successfully.'
            ]);
        die;
    }
    
} /* END of class: AjaxController */
