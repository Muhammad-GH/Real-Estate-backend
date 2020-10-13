<?php

namespace App\Http\Controllers\Backend\Calculator;

use App\Models\City;
use App\Models\PropertyConditioning;
use App\Models\AppartmentConditioning;
use App\Models\AreaSellingPrice;
use App\Models\RenovationData;
use App\Models\WorkRates;
use App\Models\Rooms;
use App\Repositories\RenovationClass;
use App\Repositories\Backend\PDFRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\PDF;
use App\Models\ResultPercentage;
use Response;

class CalculatorController extends Controller
{
    /**
     * @var PropertyRepository
     */
    protected $propertyConditioning;
    protected $appartmentConditioning;
    protected $areaSellingPrice;
    protected $renovationData;
    protected $pdfRepository;

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
    public function __construct(PDFRepository $pdfRepository, RenovationClass $renovationData)
    {
        parent::__construct();
        $this->pdfRepository = $pdfRepository;
        $this->renovationData = $renovationData;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = City::get();
        $appartment = AppartmentConditioning::where(['status' => 1])->get();
        $property = PropertyConditioning::where(['status' => 1])->get();
        $areaSelling = AreaSellingPrice::where(['status' => 1])->get();
        return view('backend.calculator.index',
            [
                'appartment' => $appartment,
                'property' => $property,
                'areaSelling' => $areaSelling,
                'city' => $city,
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function renovationsubmissions(Request $request)
    {
        return view('backend.calculator.renovationsubmissions')
            ->withRenovationData($this->renovationData->getActivePaginated(25, 'id', 'desc', 1));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function flipsubmissions(Request $request)
    {
        return view('backend.calculator.flipsubmissions')
            ->withRenovationData($this->renovationData->getActivePaginated(25, 'id', 'desc', 2));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function renovationview(Request $request, $id)
    {
        $renovationData = RenovationData::where('id', $id)->first();
        return view('backend.calculator.renovationview', [
            'renovationData' => $renovationData
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function flipview(Request $request, $id)
    {
        $renovationData = RenovationData::where('id', $id)->first();
        return view('backend.calculator.renovationview', [
            'renovationData' => $renovationData
        ]);
    }

    /**
     * @param Request $request
     * @param InvestProperty $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroysubmission($id)
    {
        $jobs = RenovationData::where('id', $id)->first();
        if ($jobs != null) {
            $jobs->delete();
            return redirect()->back()->withFlashSuccess(__('Submission has been deleted successfully.'));
        }
        return redirect()->back();
    }

    public function flipcalc()
    {
        $city = City::get();
        $materials = Materials::where(['status' => 1])->orderBy('type', 'asc')->get();
        $rooms = Rooms::where('id', '!=', 6)->get();
        $materials_data = [];
        $work_data = [];
        $i = 0;
        foreach ($rooms as $room) {
            $material = Materials::where(['status' => 1, 'room_id' => $room->id])->orderBy('type', 'asc')->get();

            if ($material->count() > 0) {
                foreach ($material as $mat) {
                    $materials_data[$room->name][$i]['name'] = $mat->name;
                    $materials_data[$room->name][$i]['id'] = $mat->id;
                    $materials_data[$room->name][$i]['parent_id'] = $mat->parent_id;
                    $materials_data[$room->name][$i]['basic'] = $mat->basic;
                    $materials_data[$room->name][$i]['exclusive'] = $mat->exclusive;
                    $materials_data[$room->name][$i]['area_allocation'] = $mat->area_allocation;
                    $materials_data[$room->name][$i]['type'] = $mat->type;
                    $materials_data[$room->name][$i]['cost_type'] = $mat->cost_type;
                    $i++;
                }
            }

            $work = WorkRates::where(['room_id' => $room->id, 'parent_id' => NULL])->orderBy('type', 'asc')->get();
            if ($work->count() > 0) {
                foreach ($work as $wor) {
                    $child = WorkRates::where(['room_id' => $room->id, 'parent_id' => $wor->id])->get();
                    if ($child->count() <= 0) {
                        $work_data[$room->name][$i]['name'] = $wor->name;
                        $work_data[$room->name][$i]['id'] = $wor->id;
                        $work_data[$room->name][$i]['parent_id'] = $wor->parent_id;
                        $work_data[$room->name][$i]['one_time_cost'] = $wor->one_time_cost;
                        $work_data[$room->name][$i]['cost_per_hour'] = $wor->cost_per_hour;
                        $work_data[$room->name][$i]['time_per_m2'] = $wor->time_per_m2;
                        $work_data[$room->name][$i]['cost_per_m2'] = $wor->cost_per_m2;
                        $work_data[$room->name][$i]['type'] = $wor->type;
                        $work_data[$room->name][$i]['area_allocation'] = $wor->area_allocation;
                    }
                    $i++;
                }
            }
            if ($work) {
                foreach ($work as $wor) {
                    $child = WorkRates::where(['room_id' => $room->id, 'parent_id' => $wor->id])->orderBy('type', 'asc')->get();
                    if ($child->count() > 0) {
                        $p = 0;
                        $work_data[$room->name][$i]['name'] = $wor->name;
                        $work_data[$room->name][$i]['id'] = $wor->id;
                        $work_data[$room->name][$i]['parent_id'] = $wor->parent_id;
                        $work_data[$room->name][$i]['one_time_cost'] = $wor->one_time_cost;
                        $work_data[$room->name][$i]['cost_per_hour'] = $wor->cost_per_hour;
                        $work_data[$room->name][$i]['time_per_m2'] = $wor->time_per_m2;
                        $work_data[$room->name][$i]['cost_per_m2'] = $wor->cost_per_m2;
                        $work_data[$room->name][$i]['type'] = $wor->type;
                        $work_data[$room->name][$i]['area_allocation'] = $wor->area_allocation;
                        foreach ($child as $childwor) {
                            $work_data[$room->name][$i]['parent_id'][$p]['name'] = $childwor->name;
                            $work_data[$room->name][$i]['parent_id'][$p]['id'] = $childwor->id;
                            $work_data[$room->name][$i]['parent_id'][$p]['parent_id'] = $childwor->parent_id;
                            $work_data[$room->name][$i]['parent_id'][$p]['one_time_cost'] = $childwor->one_time_cost;
                            $work_data[$room->name][$i]['parent_id'][$p]['cost_per_hour'] = $childwor->cost_per_hour;
                            $work_data[$room->name][$i]['parent_id'][$p]['time_per_m2'] = $childwor->time_per_m2;
                            $work_data[$room->name][$i]['parent_id'][$p]['type'] = $childwor->type;
                            $work_data[$room->name][$i]['parent_id'][$p]['cost_per_m2'] = $childwor->cost_per_m2;
                            $work_data[$room->name][$i]['parent_id'][$p]['area_allocation'] = $childwor->area_allocation;
                            $p++;
                        }
                    }
                    $i++;
                }
            }
        }
        $other_materials = Materials::where(['type' => 1])->get();
        $areaSelling = AreaSellingPrice::where(['status' => 1])->get();
        $work = WorkRates::orderBy('type', 'asc')->get();
        return view('backend.calculator.flip-calc',
            [
                'materials' => $materials,
                'rooms' => $rooms,
                'other_material' => $other_materials,
                'areaSelling' => $areaSelling,
                'city' => $city,
                'workrates' => $work,
                'materials_data' => $materials_data,
                'work_data' => $work_data
            ]);
    }

    public function resultpercentage(Request $request)
    {

        if ($request->isMethod('post')) {
            ResultPercentage::where('room_id', $request->room)->update(['min' => $request->min, 'max' => $request->max]);
        }
        $result = ResultPercentage::all();
        $rooms = Rooms::all();
        return view('backend.calculator.resultpercentage')->with(['data' => $result])->with(['roomsdata' => $rooms]);
    }

    public function createResultPercentage(Request $request)
    {
        if ($request->isMethod('post')) {
            if (ResultPercentage::where('room_id', $request->room)->first()) {
                ResultPercentage::where('room_id', $request->room)->update(['min' => $request->min, 'max' => $request->max]);
            } else {
                $result = new ResultPercentage();
                $result->room_id = $request->room;
                $result->min = $request->min;
                $result->max = $request->max;
                $result->save();
            }
            return redirect('admin/calculator/result-percentage');
        }
        $rooms = Rooms::all();
        return view('backend.calculator.createResultPercentage')->with(['roomsdata' => $rooms]);
    }

    public function workRates()
    {
        $work = WorkRates::all();
        return view('backend.calculator.workrates', [
            'workrates' => $work
        ]);
    }

    public function importdata()
    {
        return view('backend.calculator.importdata');
    }

    public function importworkrates(Request $request)
    {

        $file = $request->file('upload-workrates');
        $filepath = $file->getRealPath();
        $extension = $file->getClientOriginalExtension();
        if ($extension != 'csv') {
            return redirect()->route('admin.calculator.import-data')->withFlashDanger('Please select valid file!');
        }
        $filde2 = fopen($filepath, "r");
        $errors = [];
        $i = 1;

        while (($row = fgetcsv($filde2)) !== FALSE) {
            if ($i <= 1) {
                $i++;
                continue;
            }
            $area_al = [];
            if ($row[7] == 1) {
                $wall = 'wall';
                if (preg_match("/{$wall}/i", $row[6])) {
                    $area_al[] = 'Wall';
                }
                $roof = 'roof';
                if (preg_match("/{$roof}/i", $row[6])) {
                    $area_al[] = 'Roof';
                }
                $floor = 'floor';
                if (preg_match("/{$floor}/i", $row[6])) {
                    $area_al[] = 'Floor';
                }
                $cabinet = 'cabinet';
                if (preg_match("/{$cabinet}/i", $row[6])) {
                    $area_al[] = 'Cabinet';
                }
            }
            if (count($area_al) < 1) {
                $area_al[] = 'No caculation on one time cost';
            }

            if (trim($row[0]) == '') {
                $work = WorkRates::where('name', utf8_encode(trim($row[1])))->where('parent_id', NULL)->where('room_id', $request->room)->first();
                if (!$work) {
                    $work = new WorkRates();
                    $work->name = utf8_encode(trim($row[1]));
                    $work->room_id = $request->room;
                }
                $work->one_time_cost = $row[2];
                $work->cost_per_hour = $row[3];
                $work->time_per_m2 = $row[4];
                if ($row[7] == 1) {
                    $work->cost_per_m2 = $row[4] * $row[3];
                } else {
                    $work->cost_per_m2 = $row[5];
                }
                $work->area_allocation = implode('+', $area_al);
                $work->type = $row[7];
                $work->save();
            } else {
                $parentexists = WorkRates::where('name', utf8_encode(trim($row[0])))->where('room_id', $request->room)->first();
                if ($parentexists) {
                    $work = WorkRates::where('name', utf8_encode(trim($row[1])))->where('parent_id', $parentexists->id)->first();
                    if (!$work) {
                        $work = new WorkRates();
                    }
                    $work->parent_id = $parentexists->id;
                    $work->room_id = $request->room;
                    $work->name = utf8_encode(trim($row[1]));
                    $work->one_time_cost = $row[2];
                    $work->cost_per_hour = $row[3];
                    $work->time_per_m2 = $row[4];
                    if ($row[7] == 1) {
                        $work->cost_per_m2 = $row[4] * $row[3];
                    } else {
                        $work->cost_per_m2 = $row[5];
                    }
                    //$work->cost_per_m2 = $row[5] == 0 || $row[5] =='' ? 0 : (60/floatval($row[4])) * floatval($row[3]);
                    $work->area_allocation = implode('+', $area_al);
                    $work->type = $row[7];
                    $work->save();
                } else {
                    $work = new WorkRates();
                    $work->parent_id = null;
                    $work->room_id = $request->room;
                    $work->name = utf8_encode(trim($row[0]));
                    $work->one_time_cost = 0;
                    $work->cost_per_hour = 0;
                    $work->time_per_m2 = 0;
                    $work->cost_per_m2 = 0;
                    $work->area_allocation = implode('+', $area_al);
                    $work->type = 0;
                    $work->save();
                    $subwork = new WorkRates();
                    $subwork->parent_id = $work->id;
                    $subwork->room_id = $request->room;
                    $subwork->name = utf8_encode(trim($row[1]));
                    $subwork->one_time_cost = $row[2];
                    $subwork->cost_per_hour = $row[3];
                    $subwork->time_per_m2 = $row[4];
                    if ($row[7] == 1) {
                        $subwork->cost_per_m2 = $row[4] * $row[3];
                    } else {
                        $subwork->cost_per_m2 = $row[5];
                    }
                    //$subwork->cost_per_m2 =  $row[5] == 0 || $row[5] =='' ? 0 :(60/floatval($row[4])) * floatval($row[3]);
                    $subwork->area_allocation = implode('+', $area_al);
                    $subwork->type = $row[7];
                    $subwork->save();
                }
            }

        }
        if (count($errors) > 0) {
            return redirect()->route('admin.calculator.index')->withFlashDanger(implode(",\n", $errors));
        }

        return redirect()->route('admin.calculator.flip-calc')->withFlashSuccess('Work rates has been imported successfully!');
        //
    }

    public function exportworksrates(Request $request)
    {
        $table = WorkRates::where('room_id', $request->room)->get();
        $filename = tempnam(sys_get_temp_dir(), '') . "Workrates.csv";
        $handle = fopen($filename, 'w+');
        $parent_name = '';
        fputcsv($handle, array('parent', 'name', 'one_time_cost', 'cost_per_hour', 'time_per_m2 (in hours)', 'cost_per_m2', 'area_allocation', 'work-cost-type (0 = one-time / 1=hourly)'));
        foreach ($table as $row) {
            if ($row->parent_id != '') {
                $parent = WorkRates::where('id', $row->parent_id)->first();
                if ($parent) {
                    $parent_name = $parent->name;
                }
            }
            fputcsv($handle, array($parent_name, utf8_decode($row->name), $row->one_time_cost, $row->cost_per_hour, $row->time_per_m2, $row->cost_per_m2, $row->area_allocation, $row->type));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'Workrates.csv', $headers);
    }

    public function exportmaterialsrates(Request $request)
    {
        $table = Materials::where('room_id', $request->room)->get();
        $filename = tempnam(sys_get_temp_dir(), '') . "materials.csv";

        $handle = fopen($filename, 'w+');
        $parent_name = '';
        fputcsv($handle, array('WorkName', 'Name', 'Basic', 'Exclusive', 'Area_allocation (if multiple use + to seprate)', 'material-type (0=normal/1=materials including assembly work)', 'cost-type (0=one-time /1=/m2)'));
        foreach ($table as $row) {
            if ($row->parent_id != '') {
                $parent = Materials::where('id', $row->parent_id)->first();
                if ($parent) {
                    $parent_name = $parent->name;
                }
            }
            fputcsv($handle, array($parent_name, $row->name, $row->basic, $row->exclusive, $row->area_allocation, $row->type, $row->cost_type));
            //fputcsv($filename, array($parent_name, $row->name, $row->basic, $row->exclusive,$row->area_allocation,$row->type,$row->cost_type));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'materials.csv', $headers);
        //print_r($export_data);
    }

    public function importmaterialsrates(Request $request)
    {
        $file = $request->file('upload-materials-rates');
        $filepath = $file->getRealPath();
        $extension = $file->getClientOriginalExtension();
        $errorlist = [];
        if ($extension != 'csv') {
            return redirect()->route('admin.calculator.import-data')->withFlashDanger('Please select valid file!');
        }
        $filde2 = fopen($filepath, "r");
        $errors = [];
        $i = 1;
        while (($row = fgetcsv($filde2)) !== FALSE) {
            if ($i <= 1) {
                $i++;
                continue;
            }
            $area_al = [];
            if ($row[6] == 1) {
                $wall = 'wall';
                if (preg_match("/{$wall}/i", $row[4])) {
                    $area_al[] = 'Wall';
                }
                $roof = 'roof';
                if (preg_match("/{$roof}/i", $row[4])) {
                    $area_al[] = 'Roof';
                }
                $floor = 'floor';
                if (preg_match("/{$floor}/i", $row[4])) {
                    $area_al[] = 'Floor';
                }
                $cabinet = 'cabinet';
                if (preg_match("/{$cabinet}/i", $row[4])) {
                    $area_al[] = 'Cabinet';
                }
            }
            if (count($area_al) < 1) {
                $area_al[] = 'No caculation on one time cost';
            }

            if (trim($row[0]) == '') {
                $alreadyexists = Materials::where('name', utf8_encode(trim($row[1])))->where('parent_id', NULL)->where('room_id', $request->room)->first();
                #$alreadyexists = \DB::selectOne('select COUNT(`name`) as materialCount from `materials` where `name` = :materialName AND `parent_id` IS NULL AND `room_id` = :roomID ', ['materialName' => utf8_encode(trim($row[1])), 'roomID' => $request->room ]);

                if (!$alreadyexists) {
                    $work = new Materials();
                    $work->name = utf8_encode(trim($row[1]));
                    $work->room_id = $request->room;
                    $work->basic = $row[2];
                    $work->exclusive = $row[3];
                    $work->area_allocation = implode('+', $area_al);
                    $work->type = $row[5];
                    if ($row[6] != '') {
                        $work->cost_type = $row[6];
                    }
                    $work->status = 1;
                    $work->save();
                } else {
                    //$existingwork = Materials::where('name',(trim($row[0])))->where('parent_id',NULL)->where('room_id',$request->room);
                    $alreadyexists->basic = $row[2];
                    $alreadyexists->exclusive = $row[3];
                    $alreadyexists->area_allocation = implode('+', $area_al);
                    $alreadyexists->type = $row[5];
                    if ($row[6] != '') {
                        $alreadyexists->cost_type = $row[6];
                    }
                    $alreadyexists->cost_type = $row[6];
                    $alreadyexists->save();
                    //$existingwork->update(['basic' => $row[2], 'exclusive' => $row[3], 'area_allocation'=>implode('+',$area_al), 'type'=>$row[5], 'cost_type'=>$row[6] ]);
                }
            } else {
                $parentexists = Materials::where('name', utf8_encode(trim($row[0])))->first();
                if ($parentexists) {
                    $work = Materials::where('name', utf8_encode(trim($row[1])))->where('parent_id', $parentexists->id)->first();
                    if (!$work) {
                        $work = new Materials();
                    }
                    $work->parent_id = $parentexists->id;
                    $work->room_id = $request->room;
                    $work->name = utf8_encode(trim($row[1]));
                    $work->basic = $row[2];
                    $work->exclusive = $row[3];
                    $work->area_allocation = implode('+', $area_al);;
                    $work->type = $row[5];
                    if ($row[6] != '') {
                        $work->cost_type = $row[6];
                    }
                    $work->status = 1;
                    $work->save();
                } else {
                    $work = new Materials();
                    $work->parent_id = null;
                    $work->room_id = $request->room;
                    $work->name = utf8_encode(trim($row[0]));
                    $work->basic = 0;
                    $work->exclusive = 0;
                    $work->area_allocation = implode('+', $area_al);
                    $work->type = 0;
                    $work->cost_type = 0;
                    $work->status = 1;
                    $work->save();
                    $subwork = new Materials();
                    $subwork->parent_id = $work->id;
                    $subwork->room_id = $request->room;
                    $subwork->name = utf8_encode(trim($row[1]));
                    $subwork->basic = $row[2];
                    $subwork->exclusive = $row[3];
                    $subwork->area_allocation = implode('+', $area_al);;
                    $subwork->type = $row[5];
                    if ($row[6] != '') {
                        $subwork->cost_type = $row[6];
                    }
                    $subwork->status = 1;
                    $subwork->save();
                }
            }
        }
        if (count($errorlist) > 0) {
            return redirect()->route('admin.calculator.flip-calc')->withFlashDanger(implode(",\n", $errorlist));
        }

        return redirect()->route('admin.calculator.flip-calc')->withFlashSuccess('Materials rates has been imported successfully!');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo '<pre>';
        print_r($request);
        die;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyConditioning $propertyConditioning
     * @param  \App\Models\AppartmentConditioning $appartmentConditioning
     * @param  \App\Models\AreaSellingPrice $areaSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyConditioning $propertyConditioning, AppartmentConditioning $appartmentConditioning, AreaSellingPrice $areaSellingPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyConditioning $propertyConditioning
     * @return \Illuminate\Http\Response
     */
    public function editproerty(PropertyConditioning $propertyConditioning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppartmentConditioning $appartmentConditioning
     * @return \Illuminate\Http\Response
     */
    public function editapprtment(AppartmentConditioning $appartmentConditioning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaSellingPrice $areaSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function createareaselling(Request $request, AreaSellingPrice $areaSellingPrice)
    {
        $data = $request->all();
        if (count($data)) {
            $model = AreaSellingPrice::Where(['postal_code' => trim($data['postal_code']), 'city' => $data['city']])->first();
            if ($model) {
                $areaSellingPrice = $model;
                //
            }
            $areaSellingPrice->city = $data['city'];
            $areaSellingPrice->postal_code = $data['postal_code'];
            $areaSellingPrice->price = $data['price'];
            $areaSellingPrice->save();
        }
        return redirect()->route('admin.calculator.index')->withFlashSuccess('A new area max selling price has been created successfully!');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaSellingPrice $areaSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function createappartment(Request $request, AppartmentConditioning $appartmentConditioning)
    {
        $data = $request->all();
        if (count($data) && trim($data['appartment']) != "") {
            $model = AppartmentConditioning::Where(['name' => trim($data['appartment'])])->first();
            if ($model) {
                return redirect()->route('admin.calculator.index')->withFlashDanger($data['appartment'] . ' already exist in apartment conditioning!');
            }
            $appartmentConditioning->name = $data['appartment'];
            $appartmentConditioning->poor_value = $data['poor_value'];
            $appartmentConditioning->avg_value = $data['avg_value'];
            $appartmentConditioning->excellent_value = $data['excellent_value'];
            $appartmentConditioning->save();
            return redirect()->route('admin.calculator.index')->withFlashSuccess('A new apartment conditioning item has been created successfully!');
        } else {
            return redirect()->route('admin.calculator.index')->withFlashDanger('Apartment conditioning name required!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaSellingPrice $areaSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function createproperty(Request $request, PropertyConditioning $propertyConditioning)
    {
        $data = $request->all();
        if (count($data) && trim($data['property']) != "") {
            $model = PropertyConditioning::Where(['name' => trim($data['property'])])->first();
            if ($model) {
                return redirect()->route('admin.calculator.index')->withFlashDanger($data['property'] . ' already exist in property conditioning!');
            }
            $propertyConditioning->name = $data['property'];
            $propertyConditioning->renovated_value = $data['renovated_value'];
            $propertyConditioning->norenovated_value = $data['norenovated_value'];
            $propertyConditioning->dontknow_value = $data['dontknow_value'];
            $propertyConditioning->save();
            return redirect()->route('admin.calculator.index')->withFlashSuccess('A new property conditioning item has been created successfully!');
        } else {
            return redirect()->route('admin.calculator.index')->withFlashDanger('Property conditioning name required!');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaSellingPrice $areaSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function importareaselling(Request $request, AreaSellingPrice $areaSellingPrice)
    {
        $file = $request->file('upload-price');
        if ($file) {
            $filepath = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'csv') {
                return redirect()->route('admin.calculator.index')->withFlashDanger('Please select valid file!');
            }
            $filde2 = fopen($filepath, "r");
            $errors = [];
            $i = 1;
            while (($row = fgetcsv($filde2)) !== FALSE) {
                if (strtolower($row[0]) == 'city' || trim($row[0]) == "" || trim($row[1]) == "") {
                    $i++;
                    continue;
                }
                $city = City::Where('name', (trim($row[0])))->orWhere('id', trim($row[0]))->first();
                if ($city) {
                    $model = AreaSellingPrice::Where(['postal_code' => trim($row[1]), 'city' => $city->id])->first();
                    if (!$model) {
                        $model = new AreaSellingPrice();
                        $model->city = $city->id;
                    }
                    if ($row[2] == '') {
                        $row[2] = 0;
                    }
                    $model->postal_code = trim($row[1]);
                    $model->price = trim($row[2]);
                    $model->save();
                    $i++;
                } else {
                    $errors[] = 'City <b>' . $row[0] . '</b> is not exist! in row number ' . $i . "<br>";
                    $i++;
                    continue;
                }
            }
            if (count($errors) > 0) {
                return redirect()->route('admin.calculator.index')->withFlashDanger(implode("\n", $errors));
            }
            return redirect()->route('admin.calculator.index')->withFlashSuccess('A new area max selling price has been created successfully!');
        }
        return redirect()->route('admin.calculator.index')->withFlashDanger("Please select valid file!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\PropertyConditioning $propertyConditioning
     * @return \Illuminate\Http\Response
     */
    public function updateproperty(Request $request, PropertyConditioning $propertyConditioning)
    {
        $data = $request->all();
        if (isset($data['property']) && count($data['property'])) {
            foreach ($data['property'] as $key => $property) {
                $model = PropertyConditioning::where('id', $key)->first();
                if ($model) {
                    $model->renovated_value = $property['renovated_value'];
                    $model->norenovated_value = $property['norenovated_value'];
                    $model->dontknow_value = $property['dontknow_value'];
                    $model->save();
                }
            }
        }
        return redirect()->route('admin.calculator.index')->withFlashSuccess('Property conditioning price has been updated successfully!');
    }

    public function updatworkrates(Request $request)
    {
        $data = $request->all();
        if (isset($data['workrates']) && count($data['workrates'])) {
            foreach ($data['workrates'] as $key => $workrates) {
                $model = WorkRates::where('id', $key)->first();
                if ($model->type == 0) {
                    $model->one_time_cost = $workrates['one_time_cost'];
                    $model->save();
                } else {
                    $model->cost_per_hour = $workrates['cost_per_hour'];
                    $model->time_per_m2 = $workrates['time_per_m2'];
                    $model->cost_per_m2 = $workrates['cost_per_m2'];
                    $model->area_allocation = $workrates['area_allocation'];
                    $model->save();
                }
            }
        }

        return redirect()->route('admin.calculator.flip-calc')->withFlashSuccess('Work rates has been updated successfully!');
    }

    public function updateothermaterials(Request $request, PropertyConditioning $propertyConditioning)
    {
        $data = $request->all();
        if (isset($data['other_materials']) && count($data['other_materials'])) {
            foreach ($data['other_materials'] as $key => $property) {
                $model = Materials::where('id', $key)->first();
                if ($model) {
                    $model->basic = $property['basic'];
                    $model->exclusive = $property['exclusive'];
                    $model->save();
                }
            }
        }
        return redirect()->route('admin.calculator.flip-calc')->withFlashSuccess('Other materials price has been updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\AppartmentConditioning $appartmentConditioning
     * @return \Illuminate\Http\Response
     */
    public function updateapprtment(Request $request, AppartmentConditioning $appartmentConditioning)
    {
        $data = $request->all();
        if (isset($data['appartment']) && count($data['appartment'])) {
            foreach ($data['appartment'] as $key => $appartment) {
                $model = AppartmentConditioning::where('id', $key)->first();
                if ($model) {
                    $model->poor_value = $appartment['poor_value'];
                    $model->avg_value = $appartment['avg_value'];
                    $model->excellent_value = $appartment['excellent_value'];
                    $model->save();
                }
            }
        }
        return redirect()->route('admin.calculator.index')->withFlashSuccess('Appartment conditioning price has been updated successfully!');
        //
    }

    public function updatematerials(Request $request)
    {
        $data = $request->all();

        if (isset($data['material']) && count($data['material'])) {
            foreach ($data['material'] as $key => $material) {
                $model = Materials::where('id', $key)->first();
                if ($model) {
                    $model->basic = $material['basic'] != null ? $material['basic'] : 0;
                    $model->exclusive = $material['exclusive'] != null ? $material['exclusive'] : 0;
                    $model->area_allocation = array_key_exists("area_allocation", $material) && $material['area_allocation'] != null ? $material['area_allocation'] : '';
                    $model->save();
                }
            }
        }
        return redirect()->route('admin.calculator.flip-calc')->withFlashSuccess('Materials price has been updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\AreaSellingPrice $areaSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function updateareaselling(Request $request, AreaSellingPrice $areaSellingPrice)
    {
        $data = $request->all();
        $errors = [];
        if (isset($data['area']) && count($data['area'])) {
            foreach ($data['area'] as $key => $area) {
                $model = AreaSellingPrice::where('id', $key)->first();
                if ($model) {
                    $model->price = $area['price'];
                    $ckmodel = AreaSellingPrice::where('postal_code', $area['postal_code'])->where('city', $area['city'])->first();
                    if ($ckmodel) {
                        if ($ckmodel->id != $model->id) {
                            $errors[] = 'Postal Code :-' . $area['postal_code'];
                            continue;
                        }
                    }
                    $model->city = $area['city'];
                    $model->postal_code = $area['postal_code'];
                    $model->save();
                }
            }
        }
        if (count($errors) > 0) {
            return redirect()->route('admin.calculator.index')->withFlashDanger("These postal codes are already exist!<br>" . implode(",\n", $errors));
        }
        return redirect()->route('admin.calculator.index')->withFlashSuccess('Area max selling price has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyConditioning $propertyConditioning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = array_filter(explode("-", $request->ids));
        $type = $request->type;
        if ($type == 'work') {
            WorkRates::destroy($ids);
            return 'true';
        } elseif ($type == 'met') {
            Materials::destroy($ids);
            return 'true';
        }
        return redirect()->route('admin.calculator.flip-calc');
    }

}
