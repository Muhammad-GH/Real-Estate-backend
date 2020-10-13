<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\PropertyConditioning;
use App\Models\AppartmentConditioning;
use App\Models\AreaSellingPrice;
use App\Models\WorkRates;
use App\Repositories\Backend\PDFRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\PDF;

class RenovationCalculatorController extends Controller
{
    /**
     * @var PropertyRepository
     */
    protected $propertyConditioning;
    protected $appartmentConditioning;


    /**
     * SettingController constructor.
     *
     * @param PDFRepository $pdfRepository
     */
    /*public function __construct(PropertyConditioning $propertyConditioning,AppartmentConditioning $appartmentConditioning,AreaSellingPrice $areaSellingPrice)
    {
        parent::__construct();
        $this->propertyConditioning = $propertyConditioning;
        $this->appartmentConditioning = $appartmentConditioning;
        $this->areaSellingPrice = $areaSellingPrice;
    }*/
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::get();
        $appartment = AppartmentConditioning::where(['status'=>1])->get();
        $property = PropertyConditioning::where(['status'=>1])->get();
        $areaSelling = AreaSellingPrice::where(['status'=>1])->get();
        return view('backend.calculator.index',
            [
                'appartment' => $appartment,
                'property' => $property,
                'areaSelling' => $areaSelling,
                'city' => $city,
            ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyConditioning  $propertyConditioning
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyConditioning $propertyConditioning)
    {
        //
    }
}
