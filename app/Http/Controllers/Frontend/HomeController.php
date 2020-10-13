<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PropertyController;
use App\Models\AppartmentConditioning;
use App\Models\AreaSellingPrice;
use App\Models\JobsLanguage;
use App\Models\Pages;
use App\Models\RoomsData;
use App\Models\PagesLanguage;
use App\Models\City;
use App\Models\Jobs;
use App\Models\JobDepartment;
use App\Models\Materials;
use App\Models\Property;
use App\Models\PropertyConditioning;
use App\Models\RenovationData;
use App\Models\Rooms;
use App\Models\WorkRates;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Mail;
use App\Models\ContactForm;
use App\Models\FrontendTextLanguage;
use App\Models\Blog;
use App\Models\ResultPercentage;
use App\Mail\Frontend\Contact\SendContact;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Models\SubscriptionList;
use App\Models\ProfessionalEnquiry;
use App\Models\SellUsService;
use App\Models\SellUsServiceSubmissions;
//use Illuminate\Support\Facades\Redirect;
/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->base_url = url('/');
        parent::__construct();
    }

    public function thankyou(Request $request)
    {
        $details = [
            'title'=> 'kiinnostuksestasi ostaa asunto Flipkodin kautta!',
            'description'=> 'Etsitään ja tehdään sinun asunto-unelmastasi totta. Olemme sinuun pian yhteydessä!'
        ];
        return view('frontend.thankyou')->with($details);
    }
    public function thankyou_subscribe(Request $request)
    {
        $details = [
            'title'=> 'Kiitos uutiskirjeen tilaamisesta!',
            'description'=> 'Kirjoitamme säännöllisesti uusista näkökulmista ja havainnoista asumisen alalta.'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function sijoittajalle_kiitos(Request $request)
    {
        $details = [
            'title'=> 'Kiitos liittymisestäsi Flipkodin sijoittajalistalle!',
            'description'=> 'Olemme teihin yhteydessä, kun löydämme potentiaalisia sijoituskohteita. Vaurastutaan yhdessä!'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function palveluntarjoajalle_kiitos(Request $request)
    {
        $details = [
            'title'=> 'Kiitos liittymisestäsi Flipkodin palveluntarjoajaksi!',
            'description'=> 'Olemme yhteydessä tulevista projekteista sekä muista yhteistyömahdollisuuksista.'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function kiinteistot_ja_taloyhtiot_kiitos(Request $request)
    {
        $details = [
            'title'=> 'Kiitos kiinnostuksestasi Flipkoti PRO:n!',
            'description'=> 'Olemme pian yhteydessä sopiaksemme sopivan ajan konseptin esittelylle'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function kiinteistot_ja_taloyhtiot_kiinteistokilpailuttaja_kiitos(Request $request)
    {
        $details = [
            'title'=> 'Kiitos kun haluat kilpailuttaa kiinteistösi kuluja ja säästää rahaa!',
            'description'=> 'Kilpailutamme valitsemasi palvelut ja palaamme kilpailutetun ehdotuksen kanssa.'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function remontoimassa_kiitos(Request $request)
    {
        $details = [
            'title'=> 'Kiitos kiinnostuksestasi Flipkodin remonttipalvelua kohtaan!',
            'description'=> 'Olemme pian yhteydessä ja katsotaan sinun remonttiisi paras ratkaisu!'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function ota_yhteytta_kiitos(Request $request)
    {
        $details = [
            'title'=> 'Kiitos yhteydenotostasi!',
            'description'=> 'Olemme teihin pian yhteydessä!'
        ];
        return view('frontend.thankyou')->with($details);
    }

    public function development(Request $request)
    {
        return view('frontend.maintenance');
    }

    public function index(Request $request)
    {
        $locale = Session::get('locale');
        $data_page = [];
        $page = Pages::where('id' , 1)->first();
        $data_page['banner'] = $page->banner;
        $data_page['content'] = $page->content;
        $data_page['banner_title'] = $page->banner_title;
        if($locale != 1 || $locale != ''){
            $pagedefault = Pages::where('id' , 1)->first();
            $page = PagesLanguage::where('parent_id' , 1)->where('language_id' , $locale)->first();
            if($page){
                $data_page['banner'] = $page->banner;
                $data_page['content'] = $page->content;
                $data_page['banner_title'] = $page->banner_title;
                if($page->banner == ''){
                    $data_page['banner'] = $pagedefault->banner;
                }if($page->banner == ''){
                    $data_page['banner_title'] = $pagedefault->banner_title;
                }if($page->banner == ''){
                    $data_page['content'] = $pagedefault->content;
                }
            }
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'type' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
            ])->validate();

            $contactForm = new ContactForm;

            $contactForm->type = $data['type'];
            $contactForm->name = $data['name'];
            $contactForm->email = $data['email'];
            $contactForm->phone = $data['phone'];
            if ($data['type'] == 'contact') {
                $contactForm->subject = $data['subject'];
                $contactForm->message = $data['message'];
            } elseif ($data['type'] == 'potential') {

                $contactForm->link_sale = $data['link_sale'];
                if ($request->hasfile('attach_sale')) {
                    $document = $request->file('attach_sale');
                    $size = $document->getSize();;
                    $imageName = time() . "_" . $document->getClientOriginalName();
                    $document->move(public_path() . '/images/contactform/', $imageName);
                    $contactForm->attach_sale = $imageName;
                }

            } elseif ($data['type'] == 'apartment') {

                $contactForm->city = $data['city'];
                $contactForm->postcode = $data['postcode'];
                $contactForm->address = $data['address'];
                $contactForm->appartment_min_size = $data['appartment_min_size'];
                $contactForm->appartment_max_size = $data['appartment_max_size'];
                $contactForm->built_year = $data['built_year'];
                $contactForm->property_type = implode(',', $data['property_type']);

                $contactForm->appartment_min_price = $data['appartment_min_price'];
                $contactForm->appartment_max_price = $data['appartment_max_price'];
                $contactForm->no_rooms = $data['no_rooms'];
                $contactForm->condition = $data['condition'];
                $contactForm->apartment_size = $data['apartment_size'];
                $contactForm->additional_requests = $data['additional_requests'];
                $contactForm->additional_selection = $data['additional_selection'];
                if ($request->hasfile('appartment_photo')) {
                    $document = $request->file('appartment_photo');
                    $size = $document->getSize();;
                    $imageName = time() . "_" . $document->getClientOriginalName();
                    $document->move(public_path() . '/images/contactform/', $imageName);
                    $contactForm->appartment_photo = $imageName;
                }
            }

            if ($contactForm->save()) {
                if ($data['type'] == 'contact') {
                    Alert::success('Success', 'Contact Details posted successfully!');
                } elseif ($data['type'] == 'potential') {
                    Alert::success('Success', 'Potential Details posted successfully!');
                } elseif ($data['type'] == 'apartment') {
                    Alert::success('Success', 'Apartment Details posted successfully!');
                } else {
                    Alert::success('Success', 'Contact Details posted successfully!');
                }
            }
        }
        //$query = Property::with('primaryImage','propertyImage');
        $properties =  []; //$query->orderBy('id', 'desc')->paginate(3);
        $query2 = ContactForm::where('type','ostamassa')->where('approved',1);
        $propertyContact = []; //$query2->orderBy('id', 'desc')->paginate(3);
        $blog = Blog::orderBy('id', 'desc')->where('status','Publish')->limit(3)->get();
        // echo '<pre>'; print_r($blog); die;
        $appartments = AppartmentConditioning::get();
        return view('frontend.index')->withBlog($blog)->withAppartments($appartments)->withLangtextarr($this->langtextarr)->withPage($data_page)->withProperties($properties)->withPropertyContact($propertyContact);
    }
    public function findapartment(Request $request){
        return view('frontend.appartmentInfoForm')->with(['PostalCode' =>$request->postal_code]);
    }

    public function tietosuojaseloste(){
        return view('frontend.tietosuojaseloste');
    }

    public function professionalEnquiry(Request $request){
        $professional = new ProfessionalEnquiry();
        $professional->first_name = $request->first_name;
        $professional->last_name = $request->last_name;
        $professional->type = $request->type;
        $professional->email = $request->email;
        $professional->phone = $request->phone;
        $professional->housing_association = $request->housing_association != '' ? $request->housing_association : '';
        $professional->contact_method = $request->contact_method;
        $professional->contact_time = $request->contact_time;
        $professional->message = $request->message !='' ? $request->message : '';
        $professional->save();
        $email = $request->email;
        $type = $request->type;
        $sbject_type = $type;
        if($type == 'renovation'){
            $sbject_type = 'Remontoimassa';
        }
        if($type == 'Investor'){
            $sbject_type = 'Sijoittajalle';
        }
        if($type == 'real estate and housing'){
            $sbject_type = 'Kiinteistot-ja-taloyhtiot';
        }
        if($type == 'Marketplace'){
            $sbject_type = 'Markkinapaikka';
        }
        if($type == 'service provider'){
            $sbject_type = 'Palveluntarjoajalle';
        }
        
        $cntMthd = 'sähköposti';
        if($request->contact_method == 'phone')
            $cntMthd = 'puhelin';
        if($request->contact_method == 'both')
            $cntMthd = 'molemmat';

        $subject = 'Flipkoti - '.$sbject_type;
        $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';
        $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' . $request->first_name . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sukunimi:  - <b>' . $request->last_name . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
           // $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Type - <b>' . $type . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $request->phone . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Yrityksen nimi - <b>' . $request->housing_association . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Haluttu yhteydenottotapa - <b>' .  $cntMthd . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Paras aika tavoitella - <b>' .  $request->contact_time . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Viesti - <b>' . $request->message . '</b></p>';
            
            $body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
            </div>';
            

        Mail::send('mails/mail', ['body' =>$body], function ($message) use ($email,$subject) {
            //$message->to($email, 'Flipkoti')->subject($subject);
            $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject($subject);
            $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
        });

        /* API MAiler Lite */
        $name = $request->first_name.' '.$request->last_name;
        $email = $request->email;
        $phone = $request->phone;
         
        
        if($type == 'renovation'){
            $group = '103746640'; //Remontoimassa
        }
        if($type == 'Investor'){
            $group = '103746706'; //Sijoittajalle 
        }
        if($type == 'real estate and housing'){
            $group = '103746709'; //Kiinteistöille & Taloyhtiöille 
        }
        if($type == 'Marketplace'){
            $group = '103746712'; //Markkinapaikka 
        }
        if($type == 'service provider'){
            $group = '103746694'; //Palveluntarjoajat  
        }

        mailerLiteApi($group,$name,$email,$phone);
        
        /* API Mainler Lite */
        if($request->type == 'service provider'){
            return response()->json(['success' => 'Kiitos liitymisestäsi palveluntarjoajaverkostoon!']);
        }
        if($request->type == 'Investor'){
            return response()->json(['success' => 'Kiitos liittymisestäsi sijoittajalistalle!']);
        }
        if($request->type == 'real estate and housing'){
            return response()->json(['success' => 'Kiitos esittelyn tilauksesta!']);
        }
        if($request->type == 'renovation'){
            return response()->json(['success' => 'Kiitos yhteydenotostasi, olemme teihin pian yhteydessä']);
        }
        if( 'Marketplace' == $request->type ){
            return response()->json(['success' => __('Thank you for joining our supplier/provider network!')]);
        }
        return redirect()->back()->with(['msg'=>'Successfully posted details']);

    }

    public function subscribe(Request $request){
        $subscriptionlist =  SubscriptionList::where('email',$request->email)->first();
        if(!$subscriptionlist){
            $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">
            <p style="margin: 0 0 15px; line-height: 1.6;">Kiitos liittymisestäsi uutiskirjeen tilaajaksi!</p>
            <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin uutiskirjeen tehtävä on tuoda sinulle hyötyä, uusia näkökulmia ja konkreettisia ratkaisuja pärjätä paremmin asumisen alalla. Kirjoitamme säännöllisesti asumisen alaan liittyvistä aiheista sekä uusista ja paremmista ratkaisuista.</p>
            <p style="margin: 0 0 30px; line-height: 1.6;">Emme myöskään kainostele nostaa alan epäkohtia esille, mutta pyrimme aina tuomaan rakentavasti Flipkodin ratkaisuehdotuksia keskusteluun. </p>
            <p style="margin: 0 0 30px; line-height: 1.6;">Antoisia lukuhetkiä ja kuullaan taas pian!</p>
            <p style="margin: 0 0 30px; line-height: 1.6;">Parhain terveisin,</p>
            <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
            </div>';
            $email = $request->email;
            Mail::send('mails/mail', ['body' =>$body], function ($message) use ($email) {
                $message->to($email, 'Flipkoti')->subject('Uutiskirje tilattu!');
                $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject('Uutiskirje tilattu!');
                $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
            });
            $subscriber = new SubscriptionList();
            $subscriber->email = $request->email;
            $subscriber->save();

            return response()->json([
                'success'=>'Kiitos viikkokirjeen tilauksesta!'
            ]);
            #return redirect()->back()->withErrors(['You have sucessfully subscribed to newsletter']);
        }
        else{
            return response()->json([
                'success'=>'Kiitos viikkokirjeen tilauksesta!'
            ]);
            #return redirect()->back()->withErrors(['Already subscribed']);
        }
    }

    public function FKProkiinteistoilleTaloyhtioille()
    {
        return view('frontend.FKProkiinteistoilleTaloyhtioille');
    }

    public function FKProPalveluntarjoajalle()
    {
        return view('frontend.FKProPalveluntarjoajalle');
    }

    public function FKProSijoittajalle()
    {
        return view('frontend.FKProSijoittajalle');
    }

    public function changelanguage(Request $request)
    {
        Session::put('locale', $request->lang);
        return redirect()->back();
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacyPolicy');
    }

    public function sellUs()
    {
        return view('frontend.sellUs');
    }

    public function sellusForm(Request $request){
        return view('frontend.sellusForm')->with(['postalCode' =>$request->postalCode]);
    }
    
    public function sellusServiceForm(Request $request){
        // $data = [
        //     [
        //         'rule' => 'lessthan',
        //         'value'=> '70',
        //         'price'=> 100

        //     ],
        //     [
        //         'rule' => 'between',
        //         'value'=> '70-140',
        //         'price'=> 200

        //     ],
        //     [
        //         'rule' => 'between',
        //         'value'=> '140-210',
        //         'price'=> 300

        //     ],
        //     [
        //         'rule' => 'greaterthan',
        //         'value'=> '210',
        //         'price'=> 300

        //     ]
        // ];
        // $dataval = serialize($data);
        // print_r($dataval);
        // die;
 
        $sell_services = SellUsService::where('parent_selltous_services', null)->get();
        foreach($sell_services as $key => $service){
            $child_services = SellUsService::where('parent_selltous_services', $service->service_id)->get();
            if($child_services->count() > 0){
                $sell_services[$key]['child_services'] = $child_services;
            }
        }

        return view('frontend.sellus-service-form')->with(['sell_services'=>$sell_services,'id' =>$request->id, 'appartment_size' => $request->size]);
    }

    public function sellusServiceSubmission(Request $request){
        $sell_services = SellUsService::select('name','price','price_type','pricing','price_range','special_offer')->whereIn('service_id', $request->services)->get();
        $data = $request->all();
        $submission = new SellUsServiceSubmissions();
        $submission->contactformid = $request->contactFormId;
        $submission->selected_services = json_encode($sell_services);
        $submission->issue_help = serialize($data['special_offer']);
        $special_offer = $data['special_offer'];
        
        $submission->save();

        $data = ContactForm::where('id',$request->contactFormId)->first();;
        if($data){
            $services_data ='';
            if($sell_services){
                
                foreach($sell_services as $val){

                    if($val->pricing == 'fixed'){
                        $price = $val->price;
                    }
                    if($val->pricing == 'variable'){
                        $price = budgetGetPriceVariable($data['size'], $val->price_range);
                    }
                    


                    $services_data .=  $val->name.' €'.$price.'<br> ';
                }
            }
            
            $services = $services_data;
            $issue_help = implode(',',array_filter($special_offer)); 
            /* Email */
            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $type = $data['type'];
            
            
            $postalCode = '';
            //if($data['type'] == 'myymassa'){                 
                $postalCode = $data['postalCode'];
                
            //}

            $apartment_size = $data['apartment_size'];
            $appartment_max_price = $data['appartment_max_price'];
            $address = $data['address'];
            $built_year = $data['built_year'];
            $property_type = $data['property_type'];
            $no_rooms = $data['no_rooms'];
            $condition =  $data['condition'];
            $additional_requests = $data['additional_requests'];
            $additional_selection = isset($data['additional_selection']) ? $data['additional_selection'] : '';
            $ar_content['file_path'] = '';
            if(isset($data['appartment_photo']))
            {
                $imageName  = $data['appartment_photo'];
                $ar_content['file_path'] = public_path().'/images/contactform/'. $imageName;
            }    

            $subject = 'Flipkoti - '.$type;
            $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' .  $name . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
            $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $phone . '</b></p>';
    
            if($data['type'] == 'myymassa' || $data['type'] == 'myymeille'){
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Lisää sijainti tai postinumero - <b>' . $postalCode . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kiinteistön koko - <b>' . $apartment_size  .'</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Hinta-arviosi kiinteistöstä - <b>' . $appartment_max_price. '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Rakennusvuosi - <b>' . $built_year. '</b></p>';
                
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asuntotyyppi - <b>' . $property_type . '</b></p>';
                
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asunnon kunto - <b>' . $condition . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Huoneistojen lukumäärä - <b>' . $no_rooms  . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Osoite tai Kiinteistön nimi - <b>' . $address . '</b></p>';

                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Lisätoiveet tai vaatimukset - <b>' . $additional_requests . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Huoneiston lisätiedot - <b>' . $additional_selection . '</b></p>';
                
            }
            if($services){
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">
                Valitse palvelut, jotka haluat lisätä tarjouspyyntöön - <b>' . $services . '</b></p>';
            }
            if($issue_help){
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">
                Kerro tarkemmin, mihin asioihin tarvitset konsultaatiota - <b>' . $issue_help . '</b></p>';
            }
            $body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
                </div>';
                

            Mail::send('mails/mail', ['body' =>$body], function ($message) use ($email,$subject,$type,$ar_content) {
                //$message->to($email, 'Flipkoti')->subject($subject);
                $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject($subject);
                $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
                if($type == 'myymassa' || $type == 'myymeille'){   
                    if($ar_content['file_path'] != '' ){
                        $message->attach($ar_content['file_path']);
                    }
                }
            });
            /* Email*/
        }



        if(isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'OmaFlip'){
            return redirect()->route('frontend.omaflip-kiitos');
        }else{
            return redirect()->route('frontend.sellusService_thankyou');
        }
    }


    public function sellAdForm(Request $request){
        return view('frontend.sellAdForm')->with(['postalCode' => $request->postalCode]);
    }
    public function ostamassa()
    {
        return view('frontend.ostamassa');
    }

    public function ura()
    {
        $locale = Session::get('locale');
        $jobs = [];
        $departments = JobDepartment::select('department_id','department_name','sort_name')->get();
        if($locale != 1 && $locale != '' && $locale != 'fi'){
            #$jobs = JobsLanguage::select('id','title','short_description','designation','location','vacancy','departmentId')->where('start_date','<=' , time())->where('language_code' , $locale)->where('end_date','>=', time())->where('status', 1)->get();

            $jobs = DB::table('jobs')
                ->leftJoin('jobs_language as jl', 'jobs.id', '=', 'jl.parent_id')
                ->leftJoin('department', 'jobs.departmentId', '=', 'department.department_id')
                //->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'jl.title', 'jl.short_description', 'jl.designation', 'jl.location')
                ->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'jobs.title', 'jobs.short_description', 'jobs.designation', 'jobs.location')
                ->where(function($query) use($locale) {
                    $query->where('jl.language_code', $locale)
                        ->orWhere('jl.language_code', null);
                })
                ->where('jobs.start_date','<=' , time())->where('jobs.end_date','>=', time())->where('jobs.status', 1)
                ->get();

            #echo '<pre>'; print_r($jobs); die;

        }else{
            $jobs = DB::table('jobs')
                ->leftJoin('department', 'jobs.departmentId', '=', 'department.department_id')
                ->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'title', 'short_description', 'designation', 'location')
                ->where('jobs.start_date','<=' , time())->where('jobs.end_date','>=', time())->where('jobs.status', 1)
                ->get();
        }
        return view('frontend.ura.index')->withJobs($jobs)->withDepartments($departments)->withActivedepartment('');
    }
    public function uraosasto(Request $request, $department)
    {
        $locale = Session::get('locale');

        if($locale != 1 && $locale != '' && $locale != 'fi'){
            $qry = DB::table('jobs')
                ->leftJoin('jobs_language as jl', 'jobs.id', '=', 'jl.parent_id')
                ->leftJoin('department', 'jobs.departmentId', '=', 'department.department_id')
                //->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'jl.title', 'jl.short_description', 'jl.designation', 'jl.location')
                ->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'jobs.title', 'jobs.short_description', 'jobs.designation', 'jobs.location')
                ->where(function($query) use($locale) {
                    $query->where('jl.language_code', $locale)
                        ->orWhere('jl.language_code', null);
                })
                ->where('jobs.start_date','<=' , time())->where('jobs.end_date','>=', time())->where('jobs.status', 1);

            if($department){
                $qry->where('jobs.departmentId', $department);
            }

            $jobs =  $qry->get();
        }else{
            $qry = DB::table('jobs')
                ->leftJoin('department', 'jobs.departmentId', '=', 'department.department_id')
                ->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'title', 'short_description', 'designation', 'location')
                ->where('jobs.start_date','<=' , time())->where('jobs.end_date','>=', time())->where('jobs.status', 1);
            if($department){
                $qry->where('jobs.departmentId', $department);
            }

            $jobs =  $qry->get();
        }

        return view('frontend.ura.joblist')->withJobs($jobs)->withActivedepartment($department);
    }
    public function uradetails(Request $request, $id)
    {
        $locale = Session::get('locale');
        if($locale != 1 && $locale != '' && $locale != 'fi'){
            $jobs = DB::table('jobs')
               // ->leftJoin('jobs_language as jl', 'jobs.id', '=', 'jl.parent_id')
                ->leftJoin('department', 'jobs.departmentId', '=', 'department.department_id')
                //->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'jl.title', 'jl.short_description','jl.description', 'jl.designation', 'jl.location')
                ->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'jobs.title', 'jobs.short_description','jobs.description', 'jobs.designation', 'jobs.location')
                ->where('jobs.id' , $id)
                //->where('jl.language_code' , $locale)
                #->where('jobs.start_date','<=' , time())->where('jobs.end_date','>=', time())->where('jobs.status', 1)
                ->first();

        }else{
            $jobs = DB::table('jobs')
                ->leftJoin('department', 'jobs.departmentId', '=', 'department.department_id')
                ->select('jobs.id','jobs.departmentId','jobs.vacancy','department.department_name', 'title', 'short_description', 'description', 'designation', 'location')
                ->where('jobs.id' , $id)->where('jobs.start_date','<=' , time())->where('jobs.end_date','>=', time())->where('jobs.status', 1)
                ->first();
        }
        if($jobs){
            return view('frontend.ura.uradetails')->withJob($jobs);
        }else{
            return redirect()->route('frontend.ura');
        }
    }

    public function renovation_calculator()
    {
        return view('frontend.renovation-calculator');
    }

    public function submitcareer(Request $request)
    {
        if ($request->isMethod('post')) {
            $ar_content['email'] = env('FK_INFO_EMAIL');
            $ar_content['file_path'] = '';
            if($request->hasfile('file'))
            {
                $file = $request->file('file');
                $imageName  = time()."_".$file->getClientOriginalName();
                $file->move(public_path().'/images/resumes/', $imageName);
                $ar_content['file_path'] = public_path().'/images/resumes/'. $imageName;
            }
            $data = '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Uusi ansioluettelo lähetetty!</p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Yksityiskohdat on annettu alla :- </p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' . $request->name . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero:  - <b>' . $request->phone . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköposti:  - <b>' . $request->email . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kerro meille itsestäsi ja saavutuksistasi:  - <b>' . $request->message . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Työnimike:  - <b>' . $request->title . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Työosasto:  - <b>' . $request->department . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Työn sijainti:  - <b>' . $request->location . '</b></p>';
            $body = array('name' => $request->name, 'body' => htmlspecialchars($data));
            Mail::send('mails/mail', $body, function ($message) use ($ar_content) {
                $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject('Uusi ehdokas haki!');
                $message->from(env('MAIL_USERNAME'), 'Flipkoti');
                if($ar_content['file_path'] != ''){
                    $message->attach($ar_content['file_path']);
                }
            });
            return redirect()->back()->withFlashSuccess('Tietosi on lähetetty onnistuneesti! Otamme sinuun yhteyttä pian!');
        }
    }

    public function renocalculator_final(Request $request)
    {
        if ($request->isMethod('post')) {
            $porstion_typ = $request->all()['portion_type'];
            $room = Rooms::where(['name' => $porstion_typ])->first();
            if (!$room) {
                return redirect('remontoimassa');
            }
            if ($room->id == 6) {
                $room_id = [1, 2, 3, 4, 5];
                $viewFile = 'frontend.multi-room';
            } else {
                $room_id = [$room->id];
                $viewFile = 'frontend.reno-calculator-final';
            }
            $both_array = [];
            $bt_array = [];
            $work_array = [];
            $wr_array = [];
            $metrial_array = [];
            $mt_array = [];
            $other_mt_array = [];
            $image_data = [];
            $roomsData = RoomsData::whereIn('room_id', $room_id)->orderBy('room_id', 'ASC')->get();
           
            $allroom = Rooms::whereIn('id', $room_id)->orderBy('id', 'ASC')->get();
            if($roomsData->count() > 0){
                foreach($allroom as $roo_id){
                    foreach($roomsData as $roomData){
                        if($roomData->work_type == 1 && $roomData->msgtype == 1 ){
                            $type = 'work_basic';
                        }elseif($roomData->work_type == 1 && $roomData->msgtype == 2 ){
                            $type = 'work_exclusive';
                        }elseif($roomData->work_type == 2 && $roomData->msgtype == 1 ){
                            $type = 'met_basic';
                        }elseif($roomData->work_type == 2 && $roomData->msgtype == 2 ){
                            $type = 'met_exclusive';
                        }
                      
                        if($roomData->type == 2){
                            $image_data[$roomData->room_id]['image'][$type] = "rooms-data/".$roomData->content;
                        }else{
                            $image_data[$roomData->room_id]['data'][$type] = $roomData->content;
                        }
                        $image_data[$roo_id->id]['room'] = $roo_id->name;
                        $image_data[$roo_id->id]['work_type'] = $roomData->work_type;
                        $image_data[$roo_id->id]['type'] = $roomData->type;
                    }
                }
            }else{
                foreach($allroom as $roo_id){
                    $image_data[$roo_id->id]['room'] = $roo_id->name;
                    $image_data[$roo_id->id]['work_basic'] = 'Urakoitsijan kilpailutus ja esisopimuksen valmistelu';
                    $image_data[$roo_id->id]['work_exclusive'] = 'Työnjohto, vastuu työstä, urakoitsijan kilpailutus ja valinta';
                    $image_data[$roo_id->id]['met_basic'] = 'sizechart-custom.jpg';
                    $image_data[$roo_id->id]['met_exclusive'] = 'sizechart-custom.jpg';
                    
                    $image_data[$roo_id->id]['work_type'] = $roomData->work_type;
                    $image_data[$roo_id->id]['type'] = $roomData->type;
                }
            }
            //echo'<pre>';print_r($image_data);die;
            foreach ($allroom as $single_room) {
                $worklist = WorkRates::whereIn('room_id', [$single_room->id])->where(['parent_id' => NULL])->orderBy('name', 'asc')->get();
                if ($worklist) {
                    $i = 0;
                    foreach ($worklist as $work) {
                        //both work and Material
                        $both_array[$single_room->name][$work->name]['name'] = $work->name;
                        $both_array[$single_room->name][$work->name]['id'] = $work->id . "_";
                        //$both_array[$single_room->name][$work->name]['parent_id'] = $work->parent_id;

                        $work_array[$single_room->name][$work->id]['name'] = $work->name;
                        $work_array[$single_room->name][$work->id]['id'] = $work->id;
                        $work_array[$single_room->name][$work->id]['parent_id'] = $work->parent_id;
                        $child_work = WorkRates::whereIn('room_id', [$single_room->id])->where(['parent_id' => $work->id])->get();
                        if ($child_work->count() > 0) {
                            foreach ($child_work as $child_wor) {
                                //both work and Material
                                $bt_array[$single_room->name][$work->name][$child_wor->name]['name'] = $work->name;
                                $bt_array[$single_room->name][$work->name][$child_wor->name]['id'] = $work->id . "_";
                                $bt_array[$single_room->name][$work->name][$child_wor->name]['parent_id'] = $work->parent_id;

                                $wr_array[$single_room->name][$work->name][$i]['name'] = $child_wor->name;
                                $wr_array[$single_room->name][$work->name][$i]['id'] = $child_wor->id;
                                $wr_array[$single_room->name][$work->name][$i]['parent_id'] = $work->id;
                                $i++;
                            }
                        }
                        $i++;
                    }
                }
                $material = Materials::whereIn('room_id', [$single_room->id])->where(['parent_id' => NULL])->where(['type' => 0])->orderBy('name', 'asc')->get();
                if ($material) {
                    $i = 0;
                    foreach ($material as $materi) {
                        //both work and Material
                        if (isset($both_array[$single_room->name][$materi->name]['id'])) {
                            $both_array[$single_room->name][$materi->name]['id'] = $both_array[$single_room->name][$materi->name]['id'] . $materi->id;
                        } else {
                            $both_array[$single_room->name][$materi->name]['name'] = $materi->name;
                            $both_array[$single_room->name][$materi->name]['id'] = '_' . $materi->id;
                        }

                        $metrial_array[$single_room->name][$materi->id]['name'] = $materi->name;
                        $metrial_array[$single_room->name][$materi->id]['id'] = $materi->id;
                        $metrial_array[$single_room->name][$materi->id]['parent_id'] = $materi->parent_id;
                        $child_met = Materials::whereIn('room_id', [$single_room->id])->where(['parent_id' => $materi->id])->get();
                        if ($child_met->count() > 0) {
                            foreach ($child_met as $child_mt) {
                                //both work and Material
                                if (isset($bt_array[$single_room->name][$materi->name][$child_mt->name]['id'])) {
                                    $bt_array[$single_room->name][$materi->name][$child_mt->name]['id'] = $bt_array[$single_room->name][$materi->name][$child_mt->name]['id'] .  $child_mt->id;
                                } else {
                                    $bt_array[$single_room->name][$materi->name][$child_mt->name]['id'] = "_" . $child_mt->id;
                                    $bt_array[$single_room->name][$materi->name][$child_mt->name]['name'] = $child_mt->name;
                                }

                                $mt_array[$single_room->name][$materi->name][$i]['name'] = $child_mt->name;
                                $mt_array[$single_room->name][$materi->name][$i]['id'] = $child_mt->id;
                                $mt_array[$single_room->name][$materi->name][$i]['parent_id'] = $materi->id;
                                $i++;
                            }
                        }
                        $i++;
                    }
                }
                $othermateriallist = Materials::whereIn('room_id', [$single_room->id])->where(['type' => 1,])->orderBy('name', 'asc')->get();
                if ($othermateriallist) {
                    $i = 0;
                    foreach ($othermateriallist as $othermat) {
                        $other_mt_array[$single_room->name][$othermat->id]['name'] = $othermat->name;
                        $other_mt_array[$single_room->name][$othermat->id]['id'] = $othermat->id;
                        $i++;
                    }
                }
            }
            $city = City::all();
            return view($viewFile)->withPost($request->all())->with([
                'worklist' => $worklist,
                'image_data' => $image_data,
                'materiallist' => $material,
                'cities' => $city,
                'work_array' => $work_array,
                'mt_array' => $mt_array,
                'both_array' => $both_array,
                'wr_array' => $wr_array,
                'bt_array' => $bt_array,
                'metrial_array' => $metrial_array,
                'rooms' => $room,
                'other_mt_array' => $other_mt_array,
                'porstion_typ' => $porstion_typ
            ]);
        } else {
            return redirect('remontoimassa');
        }
    }

    //calculating work amount
    public function getcalculating_work($wrk_itm1,$request,$room_id){
        if ($wrk_itm1->type == 0) {
            return $wrk_itm1->one_time_cost != '' ? $wrk_itm1->one_time_cost : 0;
        } else {
            $area_allocation = explode('+', $wrk_itm1->area_allocation);
            $total_area = 0;
            if (in_array("Wall", $area_allocation)) {
                $total_area += $request->wall_area[$room_id];
            }
            if (in_array("Floor", $area_allocation)) {
                $total_area += $request->floor_area[$room_id];
            }
            if (in_array("Roof", $area_allocation)) {
                $total_area += $request->roof_area[$room_id];
            }
            if (in_array("Cabinet", $area_allocation)) {
                $total_area += $request->cabinet_width / 1000;
            }
            if ($total_area == 0) {
                return $wrk_itm1->cost_per_m2 != '' ? $wrk_itm1->cost_per_m2 : 0;
            } else {
                return $total_area * $wrk_itm1->cost_per_m2;
            }
        }
    }
    //calculating metrial amount
    public function getcalculating_met($materials_data,$request,$room_id){
        if ($materials_data->cost_type == 0) {
            if ($request->budget == 'Premium') {
                $amount = $materials_data->exclusive;
            } else {
                $amount =  $materials_data->basic;
            }
        } else {
            $area_allocation = explode('+', $materials_data->area_allocation);
            $total_area = 0;
            if (in_array("Wall", $area_allocation)) {
                $total_area += $request->wall_area[$room_id];
            }
            if (in_array("Floor", $area_allocation)) {
                $total_area += $request->floor_area[$room_id];
            }
            if (in_array("Roof", $area_allocation)) {
                $total_area += $request->roof_area[$room_id];
            }
            if (in_array("Cabinet", $area_allocation)) {
                $total_area += $request->cabinet_width / 1000;
            }
            if ($request->budget == 'Premium') {
                $amount =  $materials_data->exclusive * $total_area;
            } else {
                $amount =  $materials_data->basic * $total_area;
            }
        }
        return $amount;
    }

    public function calculateRenovationCost(Request $request)
    {
        if ($request->isMethod('post')) {
            $sum_area = 0;
            $portion_type = $request->portion_type;
            $city = $request->city;
            $postal_code = $request->postal_code;
            $first_name = $request->name;
            $last_name = $request->last_name;
            $email = $request->email;
            $phone = $request->phone;
            $attachment = $request->attachment;
            $total_work_cost = 0;
            $tmin = $tmax = [];
            $mat_name = [];
            $work_name = [];
            $citymodel = City::where('id', $city)->first();
            $portion = Rooms::where('name', $portion_type)->first();
            // print_r($request->all());
            
            $portion_id = $portion->id;
            $room_id = $request->rooms;
            $other_materials = $work = $work_item = $materials = $materials_item = $both = $both_item = array();
            $allroom = Rooms::whereIn('id', $room_id)->get();
            // print_r($allroom);
            if ($allroom) {
                foreach ($allroom as $sinroom) {
                    $total_material_cost = 0;
                    $total_other_material_cost = 0;
                    $per_model = ResultPercentage::where('room_id', $sinroom->id)->first();
                    $work_name[$sinroom->name] = [];
                    $mat_name[$sinroom->name] = [];
                    if ($sinroom->id == 2) {
                        if ($request->kitchen_model == 'u') {
                            $total_work_cost = $total_work_cost + 500;
                            //$total_material_cost =+500;
                        } elseif ($request->kitchen_model == 'Saareke') {
                            $total_work_cost = $total_work_cost + 800;
                            //$total_material_cost =+800;
                        }
                    }
                    if (isset($request->work[$sinroom->name])) {
                        $work = $request->work[$sinroom->name];
                    }
                    if (isset($request->work_item[$sinroom->name])) {
                        $work_item = $request->work_item[$sinroom->name];
                    }
                    if (isset($request->metrial[$sinroom->name])) {
                        $materials = $request->metrial[$sinroom->name];
                    }
                    if (isset($request->metrial_item[$sinroom->name])) {
                        $materials_item = $request->metrial_item[$sinroom->name];
                    }
                    if (isset($request->both[$sinroom->name])) {
                        $both = $request->both[$sinroom->name];
                    }
                    if (isset($request->both_item[$sinroom->name])) {
                        $both_item = $request->both_item[$sinroom->name];
                    }
                    if (isset($request->other_materials[$sinroom->name])) {
                        $other_materials = $request->other_materials[$sinroom->name];
                    }
                    $total_area = $request->floor_area[$sinroom->id] + $request->wall_area[$sinroom->id] + $request->roof_area[$sinroom->id];
                    $total_selected_area[$sinroom->id] = array_sum([$request->floor_area[$sinroom->id] + $request->wall_area[$sinroom->id] + $request->roof_area[$sinroom->id]]);
                    if ($request->looking_for == 'Työ') {
                        if ($request->renovation_type == 'Täysremontti') {
                            $wrk = WorkRates::where('room_id', $sinroom->id)->get();
                        } else {
                            $wrk = WorkRates::whereIn('id', $work)->get();
                        }
                        foreach ($wrk as $work_data) {
                            array_push($work_name[$sinroom->name], $work_data->name);
                            if ($work_item != '') {
                                if (array_key_exists($work_data->id, $work_item) == true) {
                                    foreach ($work_item[$work_data->id] as $key => $value) {
                                        $wrk_itm1 = WorkRates::where('room_id', $sinroom->id)->where('id', $value)->first();
                                        array_push($work_name[$sinroom->name], $wrk_itm1->name);
                                        $total_work_cost = $total_work_cost + $this->getcalculating_work($wrk_itm1,$request,$sinroom->id);
                                    }
                                }
                            }
                            $total_work_cost = $total_work_cost +  $this->getcalculating_work($work_data,$request,$sinroom->id);
                        }
                        $total_estimation_cost[$sinroom->name] = $total_work_cost;
                        $percent_diff_min = ($per_model->min / 100) * $total_estimation_cost[$sinroom->name];
                        $percent_diff_max = ($per_model->max / 100) * $total_estimation_cost[$sinroom->name];
                        $tmin[$sinroom->name] = round($total_estimation_cost[$sinroom->name] - $percent_diff_min);
                        $tmax[$sinroom->name] = round($total_estimation_cost[$sinroom->name] + $percent_diff_max);
                    } else if ($request->looking_for == 'materiaali') {
                        if (isset($request->other_materials) && isset($request->other_materials)) {
                            if (count($materials) > 0 && count($request->other_materials) > 0) {
                                $matearr = array_merge($request->metrial_item, $request->other_materials);
                            } else {
                                $matearr = isset($materials) ? $materials : $request->other_materials;
                            }
                        } else {
                            $matearr = isset($materials) ? $materials : $request->other_materials;
                        }
                        if ($request->renovation_type == 'Täysremontti') {
                            $mat = Materials::where('room_id', $sinroom->id)->get();
                        } else {
                            if (is_array($matearr)) {
                                $mat = Materials::whereIn('id', $matearr)->get();
                            } else {
                                $mat = Materials::where('id', $matearr)->get();
                            }
                        }
                        foreach ($mat as $materials_data) {
                            if ($request->renovation_type == 'Täysremontti') {
                                array_push($mat_name[$sinroom->name], $materials_data->name);
                                $total_material_cost = $total_material_cost + $this->getcalculating_met($materials_data,$request,$sinroom->id);
                            } else {
                                if (array_key_exists($materials_data->id, $materials_item) == true) {
                                    foreach ($materials_item[$materials_data->id] as $key => $value) {
                                        $mat_data = Materials::where('id', $value)->first();
                                        array_push($mat_name[$sinroom->name], $mat_data->name);
                                        $total_material_cost = $total_material_cost + $this->getcalculating_met($mat_data,$request,$sinroom->id);

                                    }
                                } else {
                                    array_push($mat_name[$sinroom->name], $materials_data->name);
                                    $total_material_cost = $total_material_cost + $this->getcalculating_met($materials_data,$request,$sinroom->id);
                                }
                            }
                        }
                        $total_estimation_cost[$sinroom->name] = $total_material_cost;
                        $percent_diffmin = $per_model->min / 100 * $total_estimation_cost[$sinroom->name];
                        $percent_diffmax = $per_model->max / 100 * $total_estimation_cost[$sinroom->name];
                        $tmin[$sinroom->name] = $total_estimation_cost[$sinroom->name] - $percent_diffmin;
                        $tmax[$sinroom->name] = $total_estimation_cost[$sinroom->name] + $percent_diffmax;
                    } else {
                        if ($request->renovation_type == 'Täysremontti') {
                            $wrk = WorkRates::where('room_id', $sinroom->id)->get();
                            $mat = Materials::where('room_id', $sinroom->id)->get();
                        } else {
                            if (is_array($both) == 1) {
                                $new_wrk_arr = [];
                                $new_mat_arr = [];
                                foreach ($both as $key => $value) {
                                    $arr = explode('_', $both[$key]);
                                    array_push($new_wrk_arr, $arr[0]);
                                    if (count($arr) > 1) {
                                        array_push($new_mat_arr, $arr[1]);
                                    }
                                }
                                $new_mat_arr = array_filter($new_mat_arr);
                                $new_wrk_arr = array_filter($new_wrk_arr);
                                $wrk = WorkRates::whereIn('id', $new_wrk_arr)->get();
                                $mat = Materials::whereIn('id', $new_mat_arr)->get();
                            } else {
                                $wrk = WorkRates::where('id', str_replace("_", "", $both))->get();
                                $mat = Materials::where('id', str_replace("_", "", $both))->get();
                            }
                        }
                        foreach ($wrk as $work_data) {
                            array_push($work_name[$sinroom->name], $work_data->name);
                            $total_work_cost = $total_work_cost + $this->getcalculating_work($work_data, $request, $sinroom->id);
                        }
                        //Material
                        foreach ($mat as $mat_data) {
                            if (!in_array($mat_data->name, $mat_name[$sinroom->name])) {
                                array_push($mat_name[$sinroom->name], $mat_data->name);
                            }
                            if ($mat_data->cost_type == 0) {
                                if ($request->budget == 'Premium') {
                                    if ($mat_data->type == 0) {
                                        $total_material_cost += $mat_data->exclusive;
                                    } else {
                                        $total_other_material_cost += $mat_data->exclusive;
                                    }
                                } else {
                                    if ($mat_data->type == 0) {
                                        $total_material_cost += $mat_data->basic;
                                    } else {
                                        $total_other_material_cost += $mat_data->basic;
                                    }
                                }
                            } else {
                                $total_area = 0;
                                $area_allocation = explode('+', $mat_data->area_allocation);
                                if (in_array("Wall", $area_allocation)) {
                                    $total_area += $request->wall_area[$sinroom->id];
                                }
                                if (in_array("Floor", $area_allocation)) {
                                    $total_area += $request->floor_area[$sinroom->id];
                                }
                                if (in_array("Roof", $area_allocation)) {
                                    $total_area += $request->roof_area[$sinroom->id];
                                }
                                if (in_array("Cabinet", $area_allocation)) {
                                    $total_area += $request->cabinet_width / 1000;
                                }
                                if ($request->budget == 'Premium') {
                                    if ($mat_data->type == 0) {
                                        $total_material_cost += $total_area * $mat_data->exclusive;
                                    } else {
                                        $total_other_material_cost += $total_area * $mat_data->exclusive;
                                    }
                                } else {
                                    if ($mat_data->type == 0) {
                                        $total_material_cost += $total_area * $mat_data->basic;
                                    } else {
                                        $total_other_material_cost += $total_area * $mat_data->basic;
                                    }
                                }
                            }
                        }
                        $total_estimation_cost[$sinroom->name] = $total_work_cost;
                        $percent_diffmin = $per_model->min / 100 * $total_estimation_cost[$sinroom->name];
                        $percent_diffmax = $per_model->max / 100 * $total_estimation_cost[$sinroom->name];
                        $workmin = ($total_estimation_cost[$sinroom->name] - $percent_diffmin) + $total_material_cost;
                        $workmax = ($total_estimation_cost[$sinroom->name] + $percent_diffmax) + $total_material_cost + $total_other_material_cost;
                        $total_material_cost = 0;
                        $total_other_material_cost = 0;
                        if ($request->renovation_type != 'Täysremontti') {
                            // material calculations
                            if ($both_item != null || $both_item != '') {
                                foreach ($both_item as $bth_item) {
                                    foreach ($bth_item as $key => $value) {
                                        $bth_item[$key] = str_replace("_", "", $bth_item[$key]);
                                    }
                                    $mat_data = Materials::whereIn('id', $bth_item)->get();
                                    foreach ($mat_data as $child_mat_data) {
                                        if (!in_array($child_mat_data->name, $mat_name[$sinroom->name])) {
                                            array_push($mat_name[$sinroom->name], $child_mat_data->name);
                                        }
                                        $total_material_cost = $total_material_cost + $this->getcalculating_met($child_mat_data, $request, $sinroom->id);
                                    }
                                }
                            }
                            if (isset($other_materials)) {
                                if (is_array($other_materials)) {
                                    $other_mat = Materials::whereIn('id', $other_materials)->get();
                                } else {
                                    $other_mat = Materials::where('id', $other_materials)->get();
                                }
                                foreach ($other_mat as $other_mat_data) {
                                    $total_other_material_cost = $total_other_material_cost + $this->getcalculating_met($other_mat_data, $request, $sinroom->id);
                                }
                            }
                        }
                        $tmin[$sinroom->name] = ($workmin + $total_material_cost);
                        $tmax[$sinroom->name] = ($workmax + $total_material_cost + $total_other_material_cost);
                    }
                }
            }
            $min = round(array_sum($tmin));
            $max = round(array_sum($tmax));
            $arrtotal = $total_estimation_cost;
            $total_estimation_cost = round(array_sum($total_estimation_cost));
            
            $renoData = '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">emonttisi arvioitu hintahaitari Flipkodin kautta on <b> ' . $min . '€ </b>-<b> ' . $max . '€ </p>';

            $emailBody = '<div style="background: #111111 url(images/email-header-bg.jpg); text-align: center; padding: 80px 0; color: #fff;"> <p style="margin: 0; font-size: 16px;">Remonttisi arvioitu hintahaitari Flipkodin kautta on</p>
            <h3 style=" font-weight: 400; font-size: 20px; margin: 0 0 12px;"><b> ' . $min . '€ </b>-<b> ' . $max . '€</h3> </div> 
            <div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';

            $data = '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Yhteenveto remontoinnista :- </p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Remontoitava alue:  - <b>' . $request->portion_type . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asunnon tyyppi:  - <b>' . $request->appartment_type . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Etsit remonttiisi:  - <b>' . ucfirst($request->looking_for) . '</b></p>';
            $allroom = Rooms::whereIn('id', $room_id)->get();
            if ($allroom) {
                foreach ($allroom as $sinroom) {
                    $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Mittatiedot <b>' . $sinroom->name . '<b>:  - <b>' . number_format($total_selected_area[$sinroom->id], 2) . 'm<sup>2</sup> (Pituus = ' . $request->portion_length[$sinroom->id] . ' Cm, Leveys = ' . $request->portion_width[$sinroom->id] . ' Cm, Korkeus = ' . $request->portion_height[$sinroom->id] . ' Cm)</b></p>';
                }
            }

            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Budjettitaso:  - <b>' . ucfirst($request->budget) . '</b></p>';
            // $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Remonttityyppi:  - <b>' . ucfirst($request->renovation_type) . '</b></p>';
            if ($portion_id == 6) {
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Hinta-arvio huonetilakohtaisesti:  - </p>';
                foreach ($arrtotal as $rname => $tcost) {
                    $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">'.$rname.' - (Min) ' . round($tmin[$rname]) . '€, (Max) ' . round($tmax[$rname]) . '€</b></p>';
                }
            }
            if (in_array(2, $request->rooms)) {
                if (isset($request->kitchen_model)) {
                    $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Keittiömalli :<b>' . ucfirst($request->kitchen_model) . '</b>  - </p>';
                }
                if (isset($request->cabinet_width)) {
                    $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kaapin leveys :<b>' . ($request->cabinet_width / 1000) . ' MM</b>  - </p>';
                }
            }


            if ($request->looking_for == 'materiaali') {
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> Valitsemasi materiaalit :<b> ';
                foreach ($mat_name as $keynm => $vmat_name) {
                    $data .= '<br><b style="font-size: 18px;color: #000;">' . $keynm . ' : <br></b>';
                    if (count($vmat_name) > 0) {
                        for ($i = 0; $i < count($vmat_name); $i++) {
                            if ($i == 0) {
                                $data .= '<br><b>' . $vmat_name[$i] . '</b><br>';
                            } else {
                                $data .= '<b>' . $vmat_name[$i] . '</b><br>';
                            }
                        }
                    }
                }
                $data .= ' </b><br></p>';
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> Arvioitu hinta :<b> :<b> (Min) ' . $min . '€, (Max) ' . $max . ' €</b><br></p>';
            } elseif ($request->looking_for == 'Työ') {
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> Valittu työ :<b> ';
                foreach ($work_name as $keynw => $nwork_name) {
                    $data .= '<br><b style="font-size: 18px;color: #000;">' . $keynw . '</b><br>';
                    if (count($nwork_name) > 0) {
                        for ($i = 0; $i < count($nwork_name); $i++) {
                            $data .= '<b>' . $nwork_name[$i] . '</b><br>';
                        }
                    }
                }
                $data .= ' </b><br></p>';
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> Arvioitu hinta :<b> (Min) ' . $min . '€, (Max) ' . $max . ' €</b><br></p>';
            } else {
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> Valitsemasi materiaalit :<b> ';
                foreach ($mat_name as $keynm => $vmat_name) {
                    $data .= '<br><b style="font-size: 18px;color: #000;">' . $keynm . '</b><br>';
                    if (count($vmat_name) > 0) {
                        for ($i = 0; $i < count($vmat_name); $i++) {
                            $data .= '<b>' . $vmat_name[$i] . '</b><br>';
                        }
                    }
                }
                $data .= ' </b><br></p>';
                $data .= '<p style="padding-left: 20px; color: #5f5f5f; line-height: 1.6;">Valittu työ :<b> ';
                foreach ($work_name as $keynw => $nwork_name) {
                    $data .= '<br><b style="font-size: 18px;color: #000;">' . $keynw . '</b><br>';
                    if (count($nwork_name) > 0) {
                        for ($i = 0; $i < count($nwork_name); $i++) {
                            $data .= '<b>' . $nwork_name[$i] . '</b><br>';
                        }
                    }
                }
                $data .= ' </b><br></p>';
                $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> Arvioitu vähimmäishinta:<b> ' . $min . '€ </b><br>Suurin arvioitu hinta on: <b> ' . $max . '€</b></p>';
            }
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' . $request->name . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sukunimi:  - <b>' . $request->last_name . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $phone . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kaupunki - <b>' . $citymodel->name . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kerros - <b>' . $request->floor . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Postinumero - <b>' . $postal_code . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Viesti - <b>' . $request->message . '</b></p>';
            $renoData .= $data . '</div>';
            $data .= '<h2 style=" margin: 0 0 20px; font-size: 20px;">Tutustu myös muihin palveluihimme</h2>
                    <div style=" display: inline-block; width: 100%;">
                        <div style=" float: left; width: 46%; border: 1px solid #e8e9e9; padding: 22px 37px; box-sizing: border-box;">
                            <img style=" float: left; margin-right: 17px;" src="'.$this->base_url.'/images/icon-sale.png">
                            <p style="float: left; width: 107px; font-size: 17px; margin: 4px 0; font-weight: 600;""><a style="color:#2a5adc;" href="'.route('frontend.sale').'">Löydä unelmiesi asunto</a></p>
                        </div>
                        <div style=" float: right; width: 46%; border: 1px solid #e8e9e9; padding: 22px 37px; box-sizing: border-box;">
                            <img style=" float: left; margin: -4px 17px -4px 0;" src="'.$this->base_url.'/images/icon-home.png">
                            <p style="float: left; width: 107px;  font-size: 17px; margin: 4px 0; font-weight: 600;" href="'.route('frontend.sell').'">Myy asuntosi</a></p>
                        </div>
                    </div>
                </div>
            </div>';
           
            $emailBody .= $data;
            $body = array('name' => $email, 'body' => htmlspecialchars($emailBody));
            $model = new RenovationData();
            $model->name = $request->name;
            $model->email = $email;
            $model->phone = $phone;
            $model->type = 1;
            $model->content = $renoData;
            $model->save();
           
            $ar_content['email'] = $email;
            $ar_content['file_path'] = '';
            if($request->hasfile('appartment_photo'))
            {
                $file = $request->file('appartment_photo');
                $imageName  = time()."_".$file->getClientOriginalName();
                $file->move(public_path().'/images/renovation/', $imageName);
                $ar_content['file_path'] = public_path().'/images/renovation/'. $imageName;
            }
              
            Mail::send(['html' => 'mails/renovation-calculator'], $body, function ($message) use ($ar_content,$email) {
                
                $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject('Remonttilaskuri');
                $message->to($email, 'Flipkoti')->subject('Remonttilaskuri');
                $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
                if($ar_content['file_path'] != ''){
                    $message->attach($ar_content['file_path']);
                }
            });

            /* API MAiler Lite */
            $name = $request->name.' '.$request->last_name;
            $email = $request->email;
            $phone = $request->phone;
        
            $group = '103746640'; //Remontoimassa                                        
            mailerLiteApi($group,$name,$email,$phone);
            
            /* API Mainler Lite */
            
            $final_text = '<p>Remonttisi arvioitu hintahaitari</p>';
            return view('frontend.calculator')->with(['final_text' => $final_text, 'final_total' => $request->looking_for == 'materiaali' ? '<p class="eurobx"><span>' . $min . ' € </span><span class="spacer">-</span><span>' . $max . ' € </span></p>' : '<p class="eurobx"><span>' . $min . ' € </span><span class="spacer">-</span><span>' . $max . ' €</span></p>', 'type' => 'renovation-calculator', 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'phone' => $phone, 'portion_type' => $portion_type]);
        } else {
            return redirect('remontoimassa');
        }

    }

    public function contact_us(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'type' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
            ])->validate();

            $contactForm = new ContactForm;

            $contactForm->type = $data['type'];
            $contactForm->name = $data['name'];
            $contactForm->email = $data['email'];
            $contactForm->phone = $data['phone'];
            if ($data['type'] == 'contact') {
                $contactForm->subject = $data['subject'];
                $contactForm->message = $data['message'];
            }

            if ($contactForm->save()) {
                $sbject_type = $data['type'];
                $email = $data['email'];
                $phone = $data['phone'];
                $name = $data['name'];
                if($data['type']  == 'contact'){
                    $sbject_type = 'Ota-yhteytta';
                }

                
                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $type = $data['type'];
                $sub  = $data['subject'];
                $msg = $data['message'];
                $subject = 'Flipkoti - '.$sbject_type;
                $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' .  $name . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $phone . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Viesti - <b>' . $msg . '</b></p>';
                $body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
                    </div>';
                    
        
                Mail::send('mails/mail', ['body' =>$body], function ($message) use ($email,$subject) {
                    //$message->to($email, 'Flipkoti')->subject($subject);
                    $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject($subject);
                    $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
                });
                /* API MAiler Lite */
                $group = '103723387';
                mailerLiteApi($group,$name,$email,$phone);
                 
                /* API Mainler Lite */
                 
                if ($data['type'] == 'contact') {
                    Alert::success('Success', 'Kiitos yhteydenotostasi!');
                } else {
                    Alert::success('Success', 'Kiitos yhteydenotostasi!');
                }
            }


        }
        return view('frontend.cms.contact_us');
    }

    public function calculator_final(Request $request)
    {
         
        if ($request->isMethod('post')) {
            $post = $request->all();
            $appartments = AppartmentConditioning::get();
            $property = PropertyConditioning::get();
            $city = City::get();
            $blog = Blog::orderBy('id', 'asc')->limit(3)->get();

            return view('frontend.calculator-final', ['post' => $post, 'appartments' => $appartments, 'property' => $property, 'city' => $city])->withBlog($blog);
        } else {
            return redirect()->route('frontend.index');
        }
    }

    public function calculator(Request $request)
    {
        if ($request->isMethod('post')) {
            $post = $request->all();
            $est_price = $post['est_apartmentprice'];
            $avg_discount = $est_price * ($post['avg_discount'] / 100);
            $brokerage = $est_price * ($post['brokerage'] / 100);
            $sales_duration = $post['sales_duration'];
            $monthly_cost = $post['monthly_cost'];
            $t_monthly_cost = $monthly_cost * $sales_duration;
            $est_total = round($est_price - ($avg_discount + $brokerage + $t_monthly_cost));
            $built_on = $post['built_on'];
            $p_offer = "No";
            if (isset($post['p_offer'])) {
                $p_offer = $post['p_offer'];
            }
            $phone = $post['phone'];
            $city = $post['city'];
            $postal_code = $post['postal_code'];
            $apt_total = 0;
            $apart_names = [
                'poor_value' => 'Poor',
                'avg_value' => 'Average',
                'excellent_value' => 'Excellent',
            ];
            $apart = '';
            if (isset($post['appartment']) && count($post['appartment'])) {
                foreach ($post['appartment'] as $key_id => $appartment) {
                    $model = AppartmentConditioning::where('id', $key_id)->first();
                    if ($model) {
                        $apt_total = $apt_total + $model->$appartment;
                        $apart .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;"> ' . __($model->name) . '  -  <b>' . __($apart_names[$appartment]) . '</b></p>';
                    }
                }
            }
            $prop_names = [
                'renovated_value' => 'Already Renovated',
                'norenovated_value' => 'Renovation Needed',
                'dontknow_value' => "Don't Know",
            ];
            $pt_total = 0;
            $prop = '';
            if (isset($post['property']) && count($post['property'])) {
                foreach ($post['property'] as $key_id => $property) {
                    $model = PropertyConditioning::where('id', $key_id)->first();
                    if ($model) {
                        $pt_total = $pt_total + $model->$property;
                        $prop .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">' . __($model->name) . '  -  <b>' .  __($prop_names[$property]) . '</b></p>';
                    }
                }
            }
            $area = $post['area'];
            $apt_current_sales = $est_total / $area;
            $rooms = $post['rooms'];
            $email = $post['email'];
            $area_price = 0;
            $point_one = round($est_price * 0.01);
            $point_two = round($est_price * 0.04);
            $areaSelling = AreaSellingPrice::where(['city' => $city, 'postal_code' => $postal_code])->first();
            if ($areaSelling) {
                $area_price = $areaSelling->price;
                $deduction = $area_price - $apt_current_sales;
                $deduction_total = $area * $deduction;


                $avg_total = $area * $area_price * 0.02;

                $avg_total = $avg_total + $apt_total + $pt_total + 500;
                $final_total = round(($deduction_total - $avg_total) * 0.5);
                $final_text = 'Laskurimme näkemys potentiaalista!';
                if ($final_total < 1000) {
                    $final_total_text = '<p>Arvioitu säästöpotentiaalisi</p><p class="eurobx"><span>' . $point_one . ' € </span><span class="spacer">-</span><span>' . $point_two . ' €</span></p>';
                    $final_total_text_email = 'Arvioitu säästöpotentiaalisi <p class="eurobx"  style="margin:0;"><span>' . $point_one . ' € </span><span class="spacer">- </span><span>' . $point_two . ' €</span>';
                    $final_text = '';
                } else {
                    $final_total_text = "<p>Arvioitu säästöpotentiaalisi</p><p class='eurobx'>€ " . $final_total . "</p>";
                    $final_total_text_email = "Arvioitu säästöpotentiaalisi <p class='eurobx' style='margin:0;'>€ " . $final_total . "";
                }
            } else {
                $final_total_text = '<p>Arvioitu säästöpotentiaalisi</p><p class="eurobx"><span>' . $point_one . ' € </span><span class="spacer">- </span><span>' . $point_two . ' €</span></p>';
                $final_total_text_email = 'Arvioitu säästöpotentiaalisi <p class="eurobx" style="margin:0;"><span>' . $point_one . ' € </span><span class="spacer">- </span><span>' . $point_two . ' €</span>';
                $final_text = '';
            }
            $citymodel = City::where('id', $city)->first();

            //$data = '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Your submission details has given below :- </p>';
            $data = '';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">' . $final_text . '<br>' . $final_total_text . '</p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $phone . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kaupunki - <b>' . $citymodel->name . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Postinumero - <b>' . $postal_code . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Recieved Promotional offer - <b>' . ucfirst($p_offer) . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Arvioitu asunnon myyntihinta - € <b>' . $est_price . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Keskimääräinen alennus  - <b>' . $post['avg_discount'] . ' %</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Keskimääräinen alennus  - € <b>' . $avg_discount . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Välityspalkkio - <b>' . $post['brokerage'] . ' %</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Välittäjän palkkio - € <b>' . $brokerage . ' </b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Myyntiaika - <b>' . $sales_duration . ' Kuukausi</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kuukausikulu - € <b>' . $monthly_cost . ' </b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kuukausikulu yhteensä - € <b>' . $t_monthly_cost . ' </b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asunnon koko - <b>' . $area . ' /m2 </b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Huoneiden lukumäärä - <b>' . $rooms . ' </b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Syötä asunnon perustiedot selvittääksesi potentiaalin  :- </p>';
            $data .= "<pre style='padding-left: 20px;font-size: 14px;font-family: sans-serif;'>" . $apart . "</pre>";
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Syötä perustiedot taloyhtiöstä :- </p>';
            $data .= "<pre style='padding-left: 20px;font-size: 14px;font-family: sans-serif;'>" . $prop . "</pre>";
            $dataNew = '';
            $dataNew .= '<div style="background: #111111 url(images/email-header-bg.jpg); text-align: center; padding: 80px 0; color: #fff;">
            <p style="margin: 0; font-size: 16px;">Asuntosi flippauspontentiaali Flipkodin kanssa on</p>
            <h3 style=" font-weight: 400; font-size: 20px; margin: 0 0 12px;">'.$final_total_text.'</h3>
        </div>
        <div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">
            <h1 style=" margin: 0 0 10px; font-size: 24px;">Hyvä asunnon omistaja,</h1>
            <p style="margin: 0 0 15px; line-height: 1.6;">Kiitos flippauslaskurin käytöstä.</p>
            <p style="margin: 0 0 30px; line-height: 1.6;">Asuntoflippaus on perinteisesti ollut asuntosijoittajien tapa saada sijoitusasunnosta paras mahdollinen tuotto myyntihetkellä. Flipkodin avulla myös Sinulla on mahdollisuus päästä tienaamaan asunnollasi sen sijaan että myisit sen polkuhintaan ja maksaisit sen päälle valtavat välityspalkkiot.</p>
            <h2 style=" margin: 0 0 20px; font-size: 20px;">Asuntosi laskelmat perinteisellä tavalla myytynä</h2>
            <table style="width: 100%;">
                <tr>
                    <td style="padding-bottom: 12px;">Arvioitu asunnon myyntihinta: ' . $est_price. '€</td>
                    <td style="padding-bottom: 12px;">Keskimääräinen alennus: '  .$avg_discount.'€</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 12px;">Välittäjän palkkio: ' . $brokerage. '€</td>
                    <td style="padding-bottom: 12px;">Myyntiaika: ' .  $sales_duration . ' Kuukausi.</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 12px;">Kuukausikulu: ' . $t_monthly_cost . ' €</td>
                    <td></td>
                </tr>
            </table>
            <div style=" padding: 40px 0; border-top: 1px dashed #b3b6ba; margin: 6px 0 40px; border-bottom: 1px dashed #b3b6ba; display: inline-block; width: 100%;">
                <div style=" float: left; width: 49%; border-right: 1px dashed #b3b6ba; padding-right: 30px; box-sizing: border-box;">
                    <p style=" font-weight: 400; color: #909090; margin: 0;">Todennäköinen kauppahinta</p>
                    <h4 style="margin: 11px 0 20px; font-size: 20px; color: #383838;"> '.number_format(($est_price-$avg_discount),2,".","").'€</h4>
                    <p style=" font-weight: 400; color: #909090; margin: 0;">Välittäjän palkkio</p>
                    <h4 style="margin: 11px 0 20px; font-size: 20px; color: #383838;"> '.$brokerage.'€</h4>
                    <p style=" font-weight: 400; color: #909090; margin: 0;">Kuukausikulu</p>
                    <h4 style="margin: 11px 0 0; font-size: 20px; color: #383838;"> '.$t_monthly_cost.'€</h4>
                </div>
                <div style="float: left; width: 50%; padding-left: 50px; box-sizing: border-box; padding-top: 60px;">
                    <p style=" font-size: 22px; color: #999; margin: 0 0 12px;">Asunnon arvo sinulle</p>
                    <h3 style=" font-size: 38px; line-height: 1; margin: 0; color: #b1b1b1;"> '.number_format(($est_price-$avg_discount-$brokerage-$t_monthly_cost),2,".","").'€</h3>
                </div>
            </div>
            <h2 style="margin: 0 0 20px; font-size: 20px;">Näin paljon enemmän voisit tienata flippaamalla</h2>
            <p style=" font-weight: 800; font-size: 31px; margin: 0 0 70px; line-height: 1;">'.$point_one.'€ - '.$point_two.'€</p>
            <h2 style=" margin: 0 0 20px; font-size: 20px;">Tutustu myös muihin palveluihimme</h2>
            <div style=" display: inline-block; width: 100%;">
                <div style=" float: left; width: 46%; border: 1px solid #e8e9e9; padding: 22px 37px; box-sizing: border-box;">
                    <img src="'.$this->base_url.'/images/icon-sale.png" style="float:left; margin-right:17px;" >
                    <p style=" font-size: 17px; margin: 4px 0; font-weight: 600;"><a style="color:#2a5adc;" href="'.route('frontend.buying').'">Löydä unelmiesi asunto</a> </p>
                </div>
                <div style=" float: right; width: 46%; border: 1px solid #e8e9e9; padding: 22px 37px; box-sizing: border-box;">
                    <img style=" float: left; margin: -4px 17px -4px 0;" src="'.$this->base_url.'/images/icon-home.png">
                    <p style=" font-size: 17px; margin: 4px 0; font-weight: 600;"><a style="color:#2a5adc;" href="'.route('frontend.sell').'">Myy asuntosi</a></p>
                </div>
            </div>
        </div>
        ';
        $dataNewDesign = '';
        $dataNewDesign .= '<div style="background: #111111 url(images/email-header-bg.jpg); text-align: center; padding: 74px 0; color: #fff; background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <p style="margin: 0; font-size: 20px; font-weight: 400;">Asuntosi flippauspontentiaali Flipkodin kanssa on</p>
                            <h3 style="font-weight: 600;font-size: 22px;margin: 18px 0 0;">'.$final_total_text_email.'</h3>
                    </div> 
        <div style="background: #fff; display: inline-block; width: 100%; padding: 4%; box-sizing: border-box;">
            <h1 style="margin: 0 0 10px;font-size: 24px;font-weight: 600;">Hyvä asunnon omistaja,</h1>
            <p style="margin: 0 0 15px;line-height: 1.6;font-size: 15px;">Kiitos flippauslaskurin käytöstä.</p>
            <p style="margin: 0 0 50px;line-height: 1.6;font-size: 15px;">Asuntoflippaus on perinteisesti ollut asuntosijoittajien tapa saada sijoitusasunnosta paras mahdollinen tuotto myyntihetkellä. Flipkodin avulla myös Sinulla on mahdollisuus päästä tienaamaan asunnollasi sen sijaan että myisit sen polkuhintaan ja maksaisit sen päälle valtavat välityspalkkiot.</p>
            <h2 style="margin: 0 0 20px;font-size: 18px;font-weight: 600;margin:0px;">Asuntosi laskelmat perinteisellä tavalla myytynä</h2>
            <ul style=" padding: 0; list-style: none;">
                <li style="padding-bottom: 10px;font-size: 14px;max-width: 300px;width: 100%;display: inline-block; margin:0;">
                Arvioitu asunnon myyntihinta: <b style="font-weight: 600;">' . $est_price. '€</b>
                </li>
                <li style="padding-bottom: 10px;font-size: 14px;max-width: 280px;width: 100%;display: inline-block; margin:0;">
                Keskimääräinen alennus: <b style="font-weight: 600;">'  .$avg_discount.'€</b>
                </li>
                <li style="padding-bottom: 10px;font-size: 14px;max-width: 300px;width: 100%;display: inline-block; margin:0;">
                Välittäjän palkkio: <b style="font-weight: 600;">' . $brokerage. '€</b>
                </li>
                <li style="padding-bottom: 10px;font-size: 14px;max-width: 280px;width: 100%;display: inline-block; margin:0;">
                Myyntiaika: <b style="font-weight: 600;">' .  $sales_duration . ' Kuukausi.</b>
                </li>
                <li style="padding-bottom: 10px;font-size: 14px;max-width: 280px;width: 100%;display: inline-block; margin:0;">
                Kuukausikulu: <b style="font-weight: 600;">' . $t_monthly_cost . ' €</b>
                </li>
            </ul>
 
            <div style="padding: 40px 0;border-top: 1px dashed #b3b6ba;margin: 10px 0 40px;border-bottom: 1px dashed #b3b6ba;display: inline-block;width: 100%;">
                <div style="display: inline-block;box-sizing: border-box;min-width: 290px;vertical-align: middle;">
                    <p style="font-weight: 400;color: #909090;margin: 0;font-weight: 500;font-size: 14px;">Todennäköinen kauppahinta</p>
                    <h4 style="margin: 11px 0 20px;font-size: 20px;color: #383838;font-weight: 600;"> '.number_format(($est_price-$avg_discount),2,".","").'€</h4>
                    <p style="font-weight: 400;color: #909090;margin: 0;font-weight: 500;font-size: 14px;">Välittäjän palkkio</p>
                    <h4 style="margin: 11px 0 20px;font-size: 20px;color: #383838;font-weight: 600;"> '.$brokerage.'€</h4>
                    <p style="font-weight: 400;color: #909090;margin: 0;font-weight: 500;font-size: 14px;">Kuukausikulu</p>
                    <h4 style="margin: 11px 0 20px;font-size: 20px;color: #383838;font-weight: 600;"> '.$t_monthly_cost.'€</h4>
                </div>
                <div style="display: inline-block;">
                    <div style="text-align: left;display: inline-block;">
                        <p style="font-size: 20px;color: #828282;margin: 0 0 12px;font-weight: 600;">Asunnon arvo sinulle</p>
                        <h3 style=" font-size: 38px; line-height: 1; margin: 0; color: #b1b1b1;">'.number_format(($est_price-$avg_discount-$brokerage-$t_monthly_cost),2,".","").'€</h3>
                    </div>
                </div>

                
            </div>
            <h2 style="margin: 0 0 25px;font-size: 18px;font-weight: 600;">Näin paljon enemmän voisit tienata flippaamalla</h2>
            <p style="font-weight: 700;font-size: 27px;margin: 0 0 70px;line-height: 1;">'.$point_one.'€ - '.$point_two.'€</p>
            <h2 style="margin: 0 0 36px;font-size: 19px;font-weight: 600;">Tutustu myös muihin palveluihimme</h2>
        </div>

        <div style="background: #fff; display: inline-block; width: 100%; box-sizing: border-box; padding:0 2% 2%;">
            <div style="padding: 0 2%;float: left;box-sizing: border-box;width: 50%;min-width: 306px; margin-bottom: 20px">
                <div style="border: 1px solid #e8e9e9;padding: 22px 24px;box-sizing: border-box;text-align: center;">
                    <img style="margin-bottom: 10px;height: 56px;width: 50px;object-fit: contain;" src="'.$this->base_url.'/images/icon-sale.png">
                    <p style="font-size: 17px;margin: 4px 0;font-weight: 600;"><a style="color:#2a5adc; text-decoration: none;" href="'.route('frontend.buying').'">Löydä unelmiesi asunto</p>
                </div>
            </div>
            <div style="padding: 0 2%;float: left;box-sizing: border-box;width: 50%;min-width: 306px;  margin-bottom: 20px">
                <div style="border: 1px solid #e8e9e9;padding: 22px 24px;box-sizing: border-box;text-align: center;">
                    <img style="margin-bottom: 10px;height: 56px;width: 50px;object-fit: contain;" src="'.$this->base_url.'/images/icon-home.png">
                    <p style="font-size: 17px;margin: 4px 0;font-weight: 600;"><a style="color:#2a5adc; text-decoration: none;" href="'.route('frontend.sell').'">Myy asuntosi</p>
                </div>
            </div>
        </div>


         
    ';

            $model = new RenovationData();
            $model->name = $email;
            $model->email = $email;
            $model->phone = $phone;
            $model->type = 2;
            $model->content = substr($data, 111);
            $model->save();
            $body = array('name' => $email, 'body' => htmlspecialchars($dataNewDesign));
            /* API MAiler Lite */
            $name = $post['email'];
            $email = $post['email'];
            $phone = $post['phone'];
           
            $group = '103746631'; //Myymässä            
            mailerLiteApi($group,$name,$email,$phone);
            
            /* API Mainler Lite */

            Mail::send('mails/flip-calculator', $body, function ($message) use ($email) {
                 
                //$message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject('Flipkodin Flippauslaskuri');
                $message->to($email, 'Flipkoti')->subject('Flipkodin Flippauslaskuri');

                $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
            });

            /* Email to info */
            $body = array('name' => $email, 'body' => htmlspecialchars($data));
            Mail::send('mails/flip-calculator', $body, function ($message) use ($email) {
                $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject('Flipkodin Flippauslaskuri');
                $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
            });
            /* Email to info */  
            return view('frontend.calculator', ['type' => 'flip', 'final_total' => $final_total_text, 'final_text' => $final_text, 'email' => $post['email'], 'phone' => $post['phone'], 'portion_type' => $post['portion_type'] ]);

        } else {
            return redirect()->route('frontend.index');
        }
    }

    public function about_us(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'type' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
            ])->validate();

            $contactForm = new ContactForm;

            $contactForm->type = $data['type'];
            $contactForm->name = $data['name'];
            $contactForm->email = $data['email'];
            $contactForm->phone = $data['phone'];
            if ($data['type'] == 'contact') {
                $contactForm->subject = $data['subject'];
                $contactForm->message = $data['message'];
            }

            if ($contactForm->save()) {
                $sbject_type = $data['type'];
                if($data['type']  == 'contact'){
                    $sbject_type = 'Meista';
                }

                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $type = $data['type'];
                $sub  = $data['subject'];
                $msg = $data['message'];
                $subject = 'Flipkoti - '.$sbject_type;
                $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' .  $name . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $phone . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Viesti - <b>' . $msg . '</b></p>';
                $body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
                    </div>';
                    
        
                Mail::send('mails/mail', ['body' =>$body], function ($message) use ($email,$subject) {
                   // $message->to($email, 'Flipkoti')->subject($subject);
                    $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject($subject);
                    $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
                });

                if ($data['type'] == 'contact') {
                    return response()->json(['success' => 'Kiitos yhteydenotostasi!']);
                } else {
                    return response()->json(['success' => 'Kiitos yhteydenotostasi!']);
                }
            }
        }
        return view('frontend.cms.about_us');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(Request $request)
    {
        if ($request->isMethod('post')) {
            $post = $request->all();
            if($post['type'] == 'renovation-calculator'){
               $time =  'Remonttilaskuri Ajanvaraus  ' . $post['portion_type'] ;
            }
            else{
                $time =  'Flippauslaskuri Ajanvaraus ';
            }
            $data = '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi <b>' . $post['fname'] . ' ' . $post['lname'] . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $post['email'] . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $post['code'] . $post['phone'] . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Päivämäärä - <b>' . $post['datepicker'] . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">  ' . $time . '- <b>' . $post['time'] . '</b></p>';
            $data .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Viesti - <b>' . $post['message'] . '</b></p>';

            $body = array('name' => 'Admin', 'body' => htmlspecialchars($data));
            $mail_subject = 'Flipkoti Yhteydenottolomake '. $post['portion_type'];
            Mail::send('mails/mail', $body, function ($message) use ($mail_subject) {
                $message->to(config('mail.from.address'), config('mail.from.name'))->subject($mail_subject);
                $message->from(env('FK_INFO_EMAIL'), 'Flipkoti | Yhteydenottolomake');
            });
            /* API MAiler Lite */
            $name = $post['fname'].' '.$post['lname']; 
            $email = $post['email'];
            $phone = $post['phone'];
            if($post['type'] == 'renovation-calculator'){
                $group = '103746640'; //Remontoimassa   
             }
             else{
                $group = '103746631'; //Myymässä 
             }
                       
            mailerLiteApi($group,$name,$email,$phone);
            
            /* API Mainler Lite */

            if($post['type'] == 'renovation-calculator'){
                return redirect()->route('frontend.remonttilaskuri-kiitos');
            }
            else{
                return redirect()->route('frontend.Flip-thankyou');
            }
        }
        return redirect()->route('frontend.index');
    }
    public function renovationThankyou(){
        return view('frontend.renovation-calculator-thankyou');
    }
    public function FlipThankyou(){
        return view('frontend.thankyou-page.flip-calculator');
    }
    function flipCalculator(){
        return view('frontend.flipcalculator');
    }
}
