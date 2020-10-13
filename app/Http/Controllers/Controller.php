<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\FrontendTextLanguage;
use App\Models\Languages; 
use App\Models\Auth\User;
use Session;
/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public $langtext;
    public $langtextarr = array();
    public function __construct()
    {
        $languages = Languages::all();
        Session::put('languages',$languages);
        if(!Session::get('locale')){
            Session::put('locale','fi');
        }
        $this->langtext = FrontendTextLanguage::with('langname')->with('parentname')->get();
        foreach($this->langtext as $langdata) {
            array_push($this->langtextarr, array($langdata->message,$langdata->parentname->message));
        }
        Session::put('langtext',$this->langtextarr);
    }


    public function checkLogin() {
         
            return auth()->id();
         
    }
}
