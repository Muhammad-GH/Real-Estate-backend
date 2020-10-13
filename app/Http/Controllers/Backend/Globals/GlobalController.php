<?php 
namespace App\Http\Controllers\Backend\Globals;
// use App\Repositories\Backend\GlobalRepository;
use App\Http\Controllers\Controller;
use App\Models\Languages; 
use App\Models\FrontendTextLanguage; 
use App\Models\FrontendText; 
use Illuminate\Http\Request;
use App\Models\Globals;
use Illuminate\Support\Facades\Storage;
use Validator;

Class GlobalController extends Controller
{
     /**
     * @var GlobalRepository
     */
    protected $globalRepository;
    // protected $blogCategoryRepository;

    /**
     * GlobalController constructor.
     *
     * @param GlobalRepository $GlobalRepository
     */
    // public function __construct(GlobalController $GlobalController)
    // {
    //     $this->globalRepository = $GlobalController;
    // }

    public function translation_index(Request $request)
    {
        $locale = app()->getLocale();
        $text = (!app()->isLocale('en')) ? FrontendTextLanguage::first() : FrontendText::first() ;
        $content = json_decode(Storage::get('translation.json'));

        return view('backend.translations.translations')->with(['lang'=>$content, 'text'=>$text]);
    }

    public function general()
    {
        $content = json_decode(Storage::get('translation.json'));
        $global = $this->getSettings();
        return view('backend.general.general')->with(['lang'=>$content,'global'=>$global]);
    }

    public function store(Request $request, Globals $global)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'page'     => 'required',
            'lang'   => 'required',
            'title'   => 'required',
            'meta'   => 'required',
            'date_format'   => 'required',
        ])->validate();

        $global = $this->getSettings();  
        
        $global->pagination     =  $data['page'];
        $global->lang   =  $data['lang'];
        $global->flipkoti   =  $data['title'];
        $global->desciption   =  $data['meta'];
        $global->date_format   =  $data['date_format'];

        $global->save();

        $this->saveJson($global);

        return redirect()->back()->withFlashSuccess('The content was successfully created.');
    }

    public function getSettings()
    {
        return Globals::latest('created_at')->first();
    }

    protected function saveJson($data)
    {
        Storage::put('general_settings.json', json_encode($data));
    }

    public function switch(Request $request, $locale){
        $request->session()->put('locale', $locale);
        return redirect()->back();
	}
	
} 
?>