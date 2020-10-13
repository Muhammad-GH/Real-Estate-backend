<?php

namespace App\Http\Controllers\Frontend\Stationing;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Alert;

use App\Models\Auth\User;
use App\Models\ContactForm;
use App\Models\InvestProperty;
use App\Models\UserInvest;
use App\Models\PDF;
/**
 * Class StationingController.
 */
class StationingController extends Controller
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
            }

            if($contactForm->save()){
                if($data['type'] == 'contact'){
                    Alert::success('Success', 'Contact Details posted successfully!');
                }else{
                    Alert::success('Success', 'Contact Details posted successfully!');
                }
            }
        }
        $query = InvestProperty::with('investmentImage');
        $properties = $query->orderBy('id', 'asc')->limit(4)->get();
        return view('frontend.stationing.index')->withInvestProperty($properties);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function investment_case(Request $request)
    {
        $query = InvestProperty::with('investmentImage');
        $properties = $query->orderBy('id', 'asc')->paginate(6);
        return view('frontend.stationing.investment_case')
                ->withInvestProperties($properties);
    }
    /**
     * @return \Illuminate\View\View
     */
    public function investment_view($id,Request $request)
    {
        
         if ($request->isMethod('post')) {
            $data = $request->all();
            
            
            $validator = Validator::make($data, [
                'agree_terms'      => 'required',
                'investment_time'   => 'required',
                'price'      => 'required|numeric',
            ])->validate();

            
            $userInvest = new UserInvest;
            $userInvest->user_id = $data['user_id'];
            $userInvest->invest_property_id = $data['invest_property_id'];
            $userInvest->price = $data['price'];
            $userInvest->investment_time = $data['investment_time'];
            $userInvest->agree_terms = $data['agree_terms'];
            
            if($userInvest->save()){
                return redirect()->route('frontend.user.investment_thankyou')->withFlashSuccess('Investment Details posted successfully. Our Staff will contact you soon.');
                Alert::success('Success', 'Investment Details posted successfully. Our Staff will contact you soon');
            }
        }

        $property = InvestProperty::with('investmentImage')->where('id',$id)->first();
        
        $user = '';
        if(auth()->check()){
            $userId = auth()->user()->id;
            $user = User::where('id',$userId)->with('userDetail')->first();
        }
        
        $pdfData = PDF::where('page','Invest Page')->get();
        
        return view('frontend.stationing.investment_view')
                ->withInvestProperty($property)
                ->withUser($user)->withPdf($pdfData);
    }
    public function investment_thankyou(Request $request)
    {
        return view('frontend.stationing.investment_thankyou');
    }
}
