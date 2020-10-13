<?php 
namespace App\Http\Controllers\Backend\frontendManagement;
use App\Http\Controllers\Controller;
use App\Models\Languages;
use App\Models\FrontendText;
use App\Models\FrontendTextLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Class FrontendManagementController extends Controller{
	public function index(){
		$languages = Languages::all();
		return view('backend.frontendmanagement.languages')->with(['lang'=>$languages]);
	}
	public function addlanguage(Request $request){
		if($request->isMethod('post')){

			/* 	 $request->validate([
					'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);
			if ($logo = $request->file('logo')) {
			   $destinationPath = 'public/images/logos/'; // upload path
			   $profileImage = date('YmdHis') . "." . $logo->getClientOriginalExtension();
			   move_uploaded_file($_FILES["logo"]["tmp_name"], $destinationPath.$profileImage);
			} */
			/* if ($logo2 = $request->file('logo2')) {
			   $destinationPath = 'public/images/logos'; // upload path
			   $profileImage2 = date('YmdHis') . "." . $logo2->getClientOriginalExtension();
			   $logo2->move($destinationPath, $profileImage2);
			} */
			
			if(Languages::where('name',$request->name)->first()){
			    return redirect()->back()->with('msg', 'Already added!');
			}
			
			$lang = new Languages();
			$lang->name = $request->name;
			$lang->lang_code = strtolower(substr($request->name, 0, 2));
			//$lang->logo = $destinationPath.$profileImage;
			//$lang->logo2 = $destinationPath.$profileImage2;
			$lang->status = 1;

			$lang->save();
			$languages = Languages::all();
			$this->saveJson($languages);
			return redirect('admin/frontendmanagement');
			
		} 
		return view('backend.frontendmanagement.addlanguage');
	}

	protected function saveJson($data)
    {
        Storage::put('translation.json', json_encode($data));
	}
	
	public function alltext(){
		$frontendlangText = FrontendTextLanguage::with('langname','parentname')->distinct()->get(); 
		return view('backend.frontendmanagement.alltext')->with(['text'=>$frontendlangText]);
	}
	public function edittext(Request $request){
	    if($request->isMethod('post')){
	        foreach($request->lang_text as $key => $value){
	            if($key == 3){
	                FrontendText::where('id',$request->id)->update(['message'=>$value[0] ]);
	            }
	            FrontendTextLanguage::where('language_id',$key)->where('parent_id',$request->id)->update(['message'=>$value[0] ]);
	        }
	        return redirect('admin/frontendmanagement/alltext')->with('msg', 'Text updated successfully');
	    }
	    $fronttext = FrontendTextLanguage::with('parentname')->where('id',$request->id);
	    $languages = Languages::all();
	    return view('backend.frontendmanagement.editText')->with(['text'=>$fronttext->get(),'languages'=>$languages]);
	    
	}
	public function addtext(Request $request){
		$languages = Languages::all();

		if($request->isMethod('post')){
			$alreadytext = FrontendText::where('message',$request->name)->first();
			if(!$alreadytext){
				$frontendText = new FrontendText();
				$frontendText->message = $request->name;
				$frontendText->save();
				foreach($request->lang_text as $langId => $langtext){
					$FrontendTextLanguage = new FrontendTextLanguage();
					$FrontendTextLanguage->message = $langtext[0];
					$FrontendTextLanguage->parent_id = $frontendText->id;
					$FrontendTextLanguage->language_id = $langId;
					//return $FrontendTextLanguage->getAttributes();

					$FrontendTextLanguage->save();
				}
				return redirect('admin/frontendmanagement/alltext')->withSuccess('msg','success');
			}
			else{
				return redirect()->back()->with('msg', 'Text already exists');
			}
			
		}
		return view('backend.frontendmanagement.addText')->with(['languages'=>$languages]);
	}
} 
?>