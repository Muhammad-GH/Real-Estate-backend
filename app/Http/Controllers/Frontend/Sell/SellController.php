<?php

namespace App\Http\Controllers\Frontend\Sell;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;

use Mail;
use Alert;
use Session;
use App\Models\ContactForm;

/**
 * Class SellController.
 */
class SellController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'type'      => 'required',
                'name'      => 'required',
                'email'   => 'required|email',
                'phone'      => 'required|numeric',
            ])->validate();

            
            $contactForm = new ContactForm;
            
            $contactForm->type = $data['type'];
            $contactForm->name = $data['name'];
            $contactForm->email = $data['email'];
            $contactForm->phone = $data['phone'];
            if(isset($data['additional_selection']) && $data['additional_selection'] !=''){
                $contactForm->additional_selection = implode(',',$data['additional_selection']);
            }else{
                $contactForm->additional_selection = '';
            }
            if($data['type'] == 'contact'){
                $contactForm->subject = $data['subject'];
                $contactForm->message = $data['message'];
            }

            if($contactForm->save()){
                if($data['type'] == 'contact'){
                    Alert::success('Success', 'Contact Details posted successfully!');
                }else{
                    Alert::success('Success', 'Contact Details posted successfully!');
                }
            }
        }
        return view('frontend.sell.index');
    }

    public function sellYourProperty(){
        return view('frontend.sell.sellYourProperty');
    }

    public function sell_ad(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'type'      => 'required',
                'name'      => 'required',
                'email'   => 'required|email',
                'phone'      => 'required|numeric',
            ])->validate();

            $contactForm = new ContactForm;

            $contactForm->type = $data['type'];
            $contactForm->name = $data['name'];
            $contactForm->email = $data['email'];
            $contactForm->phone = $data['phone'];
            if($data['type'] == 'myymassa'){
                $ar_content['file_path'] = '';
                // $contactForm->city = $data['city'];
                $contactForm->postCode = $data['postalCode'];
                $contactForm->apartment_size = $data['apartment_size'];
                // $contactForm->appartment_min_price = $data['appartment_min_price'];
                $contactForm->appartment_max_price = $data['appartment_max_price'];
                $contactForm->address = $data['address'];
                $contactForm->built_year = $data['built_year'];
                $contactForm->property_type = $data['property_type'];
                $contactForm->no_rooms = $data['no_rooms'];
                $contactForm->condition = implode(',',$data['condition']);
                $contactForm->additional_requests = $data['additional_requests'];
                $contactForm->additional_selection = isset($data['additional_selection']) ? $data['additional_selection'] : '';
                if($request->hasfile('appartment_photo'))
                {
                    $document = $request->file('appartment_photo');
                    $size = $document->getSize();;
                    $imageName  = time()."_".$document->getClientOriginalName();
                    $document->move(public_path().'/images/contactform/', $imageName);  
                    $ar_content['file_path'] = public_path().'/images/contactform/'. $imageName;
                    $contactForm->appartment_photo = $imageName;
                }
            }
            if($data['type'] == 'myymeille'){
                $ar_content['file_path'] = '';
                // $contactForm->city = $data['city'];
                $contactForm->apartment_size = $data['apartment_size'];
                $contactForm->appartment_max_price = $data['appartment_max_price'];
                $contactForm->address = $data['address'];
                $contactForm->built_year = $data['built_year'];
                $contactForm->property_type = $data['property_type'];
                $contactForm->no_rooms = $data['no_rooms'];
                $contactForm->condition = implode(',',$data['condition']);
                $contactForm->additional_requests = $data['additional_requests'];
                $contactForm->additional_selection = $data['additional_selection'];
                if($request->hasfile('appartment_photo'))
                {
                    $document = $request->file('appartment_photo');
                    $size = $document->getSize();;
                    $imageName  = time()."_".$document->getClientOriginalName();
                    $document->move(public_path().'/images/contactform/', $imageName);  
                    $ar_content['file_path'] = public_path().'/images/contactform/'. $imageName;
                    $contactForm->appartment_photo = $imageName;
                }
            }
            
            if($contactForm->save()){
                // print_r($data);
                // die;

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
                $condition = implode(',',$data['condition']);
                $additional_requests = $data['additional_requests'];
                $additional_selection = isset($data['additional_selection']) ? $data['additional_selection'] : '';
                 


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
                $body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
                    </div>';
                    
        
                /* API MAiler Lite */
                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $type = $data['type'];
                $group = '103746631'; //Myymässä                
                mailerLiteApi($group,$name,$email,$phone);
                
                /* API Mainler Lite */
                /* Email*/
                if($data['type'] == 'apartment'){
                    Alert::success('Success', 'Apartment Details posted successfully!');
                }elseif($data['type'] == 'myymassa'){
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
                     return redirect()->route('frontend.sell_thankyou')->with(['type' => $data['type']]);
                }elseif($data['type'] == 'myymeille'){
                    // print_r($data); die;
                    if( isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'PikaFlip'){
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

                        return redirect()->route('frontend.pikaflip-kiitos');
                    }elseif( isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'LKVFlip'){
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
                        return redirect()->route('frontend.lkvflip-kiitos');
                    }else{
                        if(isset($data['thankyou'])){
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
                            return redirect()->route('frontend.sellusService_thankyou');
                        }else{
                            return redirect()->route('frontend.sellus-service-form',[$contactForm->id,$contactForm->apartment_size]);
                        }
                    }   
                }
                else{
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
                    return redirect()->route('frontend.sell_thankyou')->with(['type' => $data['type']]);
                    // Alert::success('Success', 'Contact Details posted successfully!');
                }
            }
        }else {
            return view('frontend.sell.sell_ad');
        }
    }
    public function sell_us(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
             
            $validator = Validator::make($data, [
                'type'      => 'required',
                'name'      => 'required',
                'email'   => 'required|email',
                'phone'      => 'required|numeric',
            ])->validate();

            $contactForm = new ContactForm;

            $contactForm->type = $data['type'];
            $contactForm->name = $data['name'];
            $contactForm->email = $data['email'];
            $contactForm->phone = $data['phone'];
            if($data['type'] == 'myymassa'){

                $contactForm->city = $data['city'];
                $contactForm->apartment_size = $data['apartment_size'];
                $contactForm->appartment_max_price = $data['appartment_max_price'];
                $contactForm->address = $data['address'];
                $contactForm->built_year = $data['built_year'];
                $contactForm->property_type = $data['property_type'];
                $contactForm->no_rooms = $data['no_rooms'];
                $contactForm->condition = implode(',',$data['condition']);
                $contactForm->additional_requests = $data['additional_requests'];
                $contactForm->additional_selection = $data['additional_selection'];
                if($request->hasfile('appartment_photo'))
                {
                    $document = $request->file('appartment_photo');
                    $size = $document->getSize();;
                    $imageName  = time()."_".$document->getClientOriginalName();
                    $document->move(public_path().'/images/contactform/', $imageName);  
                    $contactForm->appartment_photo = $imageName;
                }
            }

            if($contactForm->save()){
                if($data['type'] == 'apartment'){
                    Alert::success('Success', 'Apartment Details posted successfully!');
                }else{
                    return redirect()->route('frontend.sell_thankyou')->withFlashSuccess('The Apartment Details posted successfully.');
                    // Alert::success('Success', 'Contact Details posted successfully!');
                }
            }
        }
        return view('frontend.sell.sell_thankyou');
    }
    public function sell_thankyou(Request $request)
    {
        $details = [
            'title'=> 'Kiitos tarjouspyynnöstäsi!',
            'description'=> 'Perehdymme tarjouspyyntöösi ja olemme pian yhteydessä.'
        ];

        return view('frontend.sell.sellusService_thankyou')->with($details);
        // return view('frontend.sell.sell_thankyou')->with(['type' => 'myymassa']);
    }

    public function sellusService_thankyou(){
        $details = [
            'title'=> 'Kiitos tarjouspyynnöstäsi!',
            'description'=> 'Perehdymme tarjouspyyntöösi ja olemme pian yhteydessä.'
        ];

        if(isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'PikaFlip'){
            $details = [
                'title'=> 'Kiitos kiinnostuksestasi myydä asunto Flipkodille!',
                'description'=> 'Perehdymme asuntoosi ja olemme pian yhteydessä.'
            ];
            setcookie("asuntosi-type", "", time()-3600);
        }elseif(isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'LKVFlip'){
            $details = [
                'title'=> 'Kiitos kiinnostuksestasi kilpailuttaa kiinteistönvälittäjä kauttamme!',
                'description'=> 'Perehdymme asuntoosi ja esittelemme kohteeseesi sopivimman välittäjän'
            ];
            setcookie("asuntosi-type", "", time()-3600);
        }elseif(isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'OmaFlip'){
            $details = [
                'title'=> 'Kiitos kiinnostuksestasi räätälöidä Flippaus kauttamme!',
                'description'=> 'Perehdymme asuntoosi ja tarjouspyyntöösi sekä toimitamme pian valitsemasi palvelut.'
            ];
            setcookie("asuntosi-type", "", time()-3600);
        }elseif(isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'MaxiFlip'){
            $details = [
                'title'=> 'Kiitos kiinnostuksestasi Flipata asuntosi kanssamme!',
                'description'=> 'Perehdymme asuntoosi ja olemme pian yhteydessä.'
            ];
            setcookie("asuntosi-type", "", time()-3600);
        }

        return view('frontend.sell.sellusService_thankyou')->with($details);
    }
    
    public function sell_property(Request $request)
    {
        
        $query = ContactForm::where('type','ostamassa')->where('approved',1);
        
        $searchData = [];
        if($request->isMethod("POST") ){
            $searchData = $request->all();
            unset($searchData['_token']);
            // Session::put('searchData', $searchData);
        }
        // if($request->get('page') && Session::has('searchData')){
        //     $searchData = Session::get('searchData');
        // }
        if(!empty($searchData)){  
            
            // if(isset($searchData['keyword']) && !empty($searchData['keyword']) ){
            //     $term  = $searchData['keyword'];
            //     $query->where(function ($q) use($term) {
            //         $q->where('title', 'LIKE', '%'.$term.'%');
            //         $q->orWhere('name', 'LIKE', '%'.$term.'%');
            //         $q->orWhere('details', 'LIKE', '%'.$term.'%');
            //         $q->orWhere('area', 'LIKE', '%'.$term.'%');
            //         $q->orWhere('address', 'LIKE', '%'.$term.'%');
            //         // $q->orWhere('details', 'LIKE', '%'.$term.'%');
            //     });
            // }
            // if($searchData['filter'] == 1){
                if(isset($searchData['city']) && !empty($searchData['city']) ){
                    $city = $searchData['city'];
                    $query->where(function ($q) use($city) {
                        $q->where('city', 'LIKE', '%'.$city.'%');
                        // $q->where('address', 'LIKE', '%'.$city.'%');
                        // $q->orWhere('area', 'LIKE', '%'.$city.'%');
                    });
                }
                if(isset($searchData['appartment_type']) && !empty($searchData['appartment_type']) ){
                    $query->where('property_type', 'LIKE', '%'.$searchData['appartment_type'].'%');
                }
                if(isset($searchData['min']) && !empty($searchData['min']) ){
                    $query->where('appartment_min_price', '>=', (int)$searchData['min']);
                    $query->where('appartment_max_price', '<=',  (int)$searchData['max']);
                }
            // }
            // Session::put('searchData', $searchData);
        }
        // print_r($searchData);
        // dd($query->toSql());
        //     die;
        $propertyContact = $query->orderBy('id', 'asc')->paginate(6);
        // dd($propertyContact->toSql());

        

        return view('frontend.sell.sell_property')
            ->withPropertyContacts($propertyContact)
            ->withSearchData($searchData);
    }

    public function sell_property_details(Request $request,$id){
        $property = ContactForm::where('type','ostamassa')->where('id',$id)->orderBy('id', 'asc')->first();
        return view('frontend.sell.sell_property_details')->withProperty($property);
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store_contact(Request $request)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'type'      => 'required',
            'name'      => 'required',
            'phone'   => 'required|numeric',
            'email'      => 'required|email',
            'subject'   => 'required',
            'message'      => 'required',
            'property_id'     => 'required',
        ])->validate();

        $contactForm = new ContactForm;
        
        $contactForm->type     =  $data['type'];
        $contactForm->name     =  $data['name'];
        $contactForm->phone      =  $data['phone'];
        $contactForm->email   =  $data['email'];
        $contactForm->subject   =  $data['subject'];
        $contactForm->message   =  $data['message'];
        $contactForm->property_type   =  $data['property_id'];
        
        $proj = $contactForm->save();

        Alert::success('menestys', 'Kiitos yhteystietojen jakamisesta');
        return redirect()->back()->withFlashSuccess(__('Kiitos yhteystietojen jakamisesta.'));

    }
     

}
