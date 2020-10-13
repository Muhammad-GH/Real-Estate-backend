<?php

namespace App\Http\Controllers\Frontend\Sale;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Mail;
use Alert;

use App\Models\ContactForm;
use App\Models\FrontendPages;
use App\Models\FrontendPagesContent;

/**
 * Class SaleController.
 */
class SaleController extends Controller
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
            if($data['type'] == 'contact'){
                $contactForm->subject = $data['subject'];
                $contactForm->message = $data['message'];
            }elseif($data['type'] == 'potential'){
            
                $contactForm->link_sale = $data['link_sale'];
                if($request->hasfile('attach_sale'))
                {
                    $document = $request->file('attach_sale');
                    $size = $document->getSize();;
                    $imageName  = time()."_".$document->getClientOriginalName();
                    $document->move(public_path().'/images/contactform/', $imageName);  
                    $contactForm->attach_sale = $imageName;
                }

            }elseif($data['type'] == 'ostamassa'){
                $ar_content['file_path'] = '';
                $contactForm->city = $data['city'];
                // $contactForm->postcode = $data['postcode'];
                // $contactForm->address = $data['address'];
                $contactForm->analysis_apartment_link = $data['analysis_apartment_link'];
                $contactForm->appartment_min_size = $data['appartment_min_size'];
                $contactForm->appartment_max_size = $data['appartment_max_size'];
                // $contactForm->built_year = $data['built_year'];
                $contactForm->property_type = $data['property_type'];
        
                $contactForm->appartment_min_price = $data['appartment_min_price'];
                $contactForm->appartment_max_price = $data['appartment_max_price'];
                // $contactForm->no_rooms = $data['no_rooms'];
                $contactForm->condition = implode(",",$data['condition']);
                // $contactForm->apartment_size = $data['apartment_size'];
                $contactForm->additional_requests = $data['additional_requests'];
                // $contactForm->additional_selection = $data['additional_selection'];
                $contactForm->construction_year_max = $data['construction_year_max'];
                $contactForm->construction_year_min = $data['construction_year_min'];
                $contactForm->rooms_min = $data['rooms_min'];
                $contactForm->rooms_max = $data['rooms_max'];
                
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

                /* Email */
                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $type = $data['type'];
                 
                if($data['type'] == 'contact'){
                
                    $sub = $data['subject'];
                    $msg = $data['message'];
                }

                if($data['type'] == 'ostamassa'){                 
                    $city = $data['city'];
                    $analysis_apartment_link = $data['analysis_apartment_link'];
                    $appartment_min_size = $data['appartment_min_size'];
                    $appartment_max_size = $data['appartment_max_size'];
                    $property_type = $data['property_type'];
                    $appartment_min_price = $data['appartment_min_price'];
                    $appartment_max_price = $data['appartment_max_price'];
                    $condition = implode(",",$data['condition']);
                    $additional_requests = $data['additional_requests'];
                    $construction_year_max = $data['construction_year_max'];
                    $construction_year_min = $data['construction_year_min'];
                    $rooms_min = $data['rooms_min'];
                    $rooms_max = $data['rooms_max'];
                }


                $subject = 'Flipkoti - '.$type;
                $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Nimi:  - <b>' .  $name . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $email . '</b></p>';
                $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $phone . '</b></p>';
                if($data['type'] == 'contact'){
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Viesti - <b>' . $msg . '</b></p>';
                    
                }
                if($data['type'] == 'ostamassa'){
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Lisää sijainti tai postinumero - <b>' . $city . '</b></p>';
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asuntotyyppi - <b>' . $property_type . '</b></p>';
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Jätä analysointipyyntö löytämästäsi asunnosta - <b>' . $analysis_apartment_link . '</b></p>';
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asunnon koko, Min ja max - <b>' . $appartment_min_size .'-'. $appartment_max_size .'</b></p>';
                    
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asunnon hinta, min ja max - <b>' . $appartment_min_price .'-'.$appartment_max_price. '</b></p>';
                    
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Asunnon kunto - <b>' . $condition . '</b></p>';
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Lisätoiveet tai vaatimukset - <b>' . $additional_requests . '</b></p>';
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Rakennusvuosi, Min ja max - <b>' .$construction_year_min.'-'. $construction_year_max . '</b></p>';
                    
                    $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Huoneiden lukumäärä, min ja max - <b>' . $rooms_min .'-'. $rooms_max . '</b></p>';
                }
                $body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
                    </div>';
                    
        
                Mail::send('mails/mail', ['body' =>$body], function ($message) use ($email,$subject,$type,$ar_content) {
                    //$message->to($email, 'Flipkoti')->subject($subject);
                    $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject($subject);
                    $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
                    if($type == 'ostamassa'){   
                        if($ar_content['file_path'] != '' ){
                            $message->attach($ar_content['file_path']);
                        }
                    }
                });

                /* API MAiler Lite */
                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
            
                $group = '103724041'; //Ostamassa                            
                mailerLiteApi($group,$name,$email,$phone);
                
                /* API Mainler Lite */

                /* Email*/
                if($data['type'] == 'contact'){
                    Alert::success('Success', 'Contact Details posted successfully!');
                }elseif($data['type'] == 'potential'){
                    Alert::success('Success', 'Potential Details posted successfully!');
                }elseif($data['type'] == 'apartment'){
                    Alert::success('Success', 'Apartment Details posted successfully!');
                }elseif($data['type'] == 'ostamassa'){
                    return redirect()->route('frontend.ostamassa_thankyou')->withFlashSuccess('The Apartment Details posted successfully.');
                }else{
                    Alert::success('Success', 'Contact Details posted successfully!');
                }
            }
        }
        
        $uripath = $request->path();

        $pageRow = FrontendPages::where('url_slug', $uripath)->first();
        $languageCode = $request->session()->get('locale');
        $page = 0;
        if( $pageRow && $languageCode ){

             $page = FrontendPagesContent::where(['page_id'=>$pageRow->page_id, 'lang_code'=>$languageCode])->first();
             //print_r($page); die;
        }

        return view('frontend.sale.index')->withPageContent($page);
    }

    public function ostamassa_thankyou (Request $request){
        return view('frontend.sale.ostamassa_thankyou ');
    }
}
