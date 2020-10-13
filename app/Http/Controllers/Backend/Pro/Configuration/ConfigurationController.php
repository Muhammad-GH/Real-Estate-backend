<?php

namespace App\Http\Controllers\Backend\Pro\Configuration;
use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackendPro\Configuration;
use App\Models\BackendPro\Country;
use App\Models\BackendPro\CountryLanguage;
use App\Models\Language;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Session;

class ConfigurationController extends Controller
{
    public function index()
    {
        $default_admin_language =  config('global_configurations.admin.language');
        if($default_admin_language == ''){
            $default_admin_language = 'fi';
        }
        Session::put('locale', $default_admin_language);

        $configurations = Configuration::All()->pluck('configuration_val', 'configuration_name')->toArray();
        //$country = CountryLanguage::where(['countrylang_lang_id'=>2])->get();
        //$country = Country::countries();
        //$Languages = new Languages();
        $language_consumer = Languages::where(['status'=>1])->first();
        $default_consumer_language = $language_consumer['id'];
        $default_language =  config('global_configurations.admin.language');
        $language = Languages::where(['lang_code'=>$default_language])->first();
        $default_global_language = $language['id'];
       // $CountryLanguage = new CountryLanguage();

        //$country = CountryLanguage::with('country')->where(['countrylang_lang_id'=>2])->get()->toArray('country_id','country_name');
       // $country = CountryLanguage::select('countrylang_country_id','country_name')->where(['countrylang_lang_id'=>$default_global_language])->get();
       $country = CountryLanguage::select('country_name','countrylang_country_id')->where(['countrylang_lang_id'=>$default_global_language])->pluck('country_name','countrylang_country_id');
         
         
        return view('backend.pro.configuration.index',
        [
            'configuration' => $configurations,
            'country' => $country,
        ]);
    }

    public function store(Request $request)
    {
        $rules = Configuration::getValidationRules();
        $data = $this->validate($request, $rules);

        $validSettings = array_keys($rules);
        $data = $request->all();
        $ignore = array('_token','updated_at');
        foreach ($data as $key => $val) {
            if( !in_array($key, $ignore) ) {
                Configuration::add($key, $val, Configuration::getDataType($key));
                if($key == 'language'){
                    Session::put('locale', $val);
                }
            }
        }
        $config = "<?php \n 
        return [ 
            'admin' =>[  
                 \n";
        foreach ($data as $key => $val) {
            if( !in_array($key, $ignore) ) {
                $value = addslashes($val);
                $config .= "\n           '$key' => '$value', ";
            }
        }
        $config .= "\n  
        ]";
        $config .= "\n  
    ];?>";
         
        $file = '../config/global_configurations.php'; 
        file_put_contents($file, $config);
        
        
        return redirect()->back()->withFlashSuccess(__('alerts.backend.category.created'));
    }
}
