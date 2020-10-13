<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProfessionalsPropertyInfo;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Mail;

class ProfessionalsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function serviceFormSave(Request $request){
        $professional = new ProfessionalsPropertyInfo();
		$professional->service_type = $request->service_type;
		$professional->property_address = $request->property_address;
		$professional->year_of_built = $request->year_of_built;
		
		if( isset( $request->area_of_block ) ){
			$professional->area_of_block = $request->area_of_block;
		}
		
		$professional->no_of_apartments = $request->no_of_apartments;
		$professional->property_area = $request->property_area;
		$professional->common_area = $request->common_area;
		$professional->no_of_floors = $request->no_of_floors;
		
		if( isset( $request->renovation_done ) ){
			$professional->renovation_done = serialize($request->renovation_done);
		}
		
		if( isset( $request->renovation_year ) ){
			$professional->renovation_year = $request->renovation_year;
		}
		
		$professional->renovation_year = $request->renovation_year;
		$professional->contact_person_name = $request->contact_person_name;
		$professional->contact_email = $request->contact_email;
		$professional->phone_number = $request->phone_number;
		
		if( isset( $request->desired_start_date ) ){
			$professional->desired_start_date = $request->desired_start_date;
		}

		$subject = 'Flipkoti - '.$request->service_type;
        $body = '<div style="background: #fff; display: inline-block; width: 100%; padding: 50px 50px; box-sizing: border-box;">';
        $body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kiinteistön osoite:  - <b>' . $request->property_address . '</b></p>';
		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kiinteistön valmistumisvuosi:  - <b>' . $request->year_of_built . '</b></p>';
		if( isset( $request->area_of_block ) ){
			 
			$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Tontin pinta-ala:  - <b>' . $request->area_of_block . '</b></p>';
		}

		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Huoneistoneliöt:  - <b>' . $request->property_area . '</b></p>';
		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Huoneistomäärä:  - <b>' . $request->no_of_apartments . '</b></p>';
		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Yhteisten tilojen neliöt:  - <b>' . $request->common_area . '</b></p>';
		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Kerrosten lukumäärä:  - <b>' . $request->no_of_floors . '</b></p>';
		if( isset( $request->renovation_done ) ){
			$professional->renovation_done = serialize($request->renovation_done);
			$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Tehdyt Remontit:  - <b>' . $professional->renovation_done . '</b></p>';
		}
		if( isset( $request->renovation_year ) ){
			$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Remontin ajankohta:  - <b>' . $request->renovation_year . '</b></p>';
		}
		if( isset( $request->desired_start_date ) ){
			 
			$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">desired_start_date:  - <b>' . $professional->desired_start_date . '</b></p>';
		}

		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Sähköpostiosoite - <b>' . $request->contact_email . '</b></p>';
		
		$body .= '<p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Puhelinnumero - <b>' . $request->phone_number . '</b></p>'; 
		
		$body .= '  <p style="margin: 0 0 30px; line-height: 1.6;">Flipkodin tiimi <br> '.env('FK_INFO_EMAIL').' </p>
		</div>';
            

        Mail::send('mails/mail', ['body' =>$body], function ($message) use ($subject) {
            //$message->to($email, 'Flipkoti')->subject($subject);
            $message->to(env('FK_INFO_EMAIL'), 'Flipkoti')->subject($subject);
            $message->from(env('FK_INFO_EMAIL'), 'Flipkoti');
        });
        
		$professional->save();
		/* API MAiler Lite */
        $name = $request->contact_person_name;
        $email = $request->contact_email;
        $phone = $request->phone_number;
        $group = '103746709'; //Kiinteistöille & Taloyhtiöille  
        mailerLiteApi($group,$name,$email,$phone);
        
        /* API Mainler Lite */
        return response()->json([ 'type' => 'success', 'message' => __("Your tendering request has been received. We'll come back to you soon with saving potentials.") ]);
		
        #return redirect()->back()->with(['msg'=>'Successfully posted details']);
        
    }

    
}
