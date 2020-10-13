<?php

namespace App\Http\Controllers\Backend\RoomsData;

use App\Models\Languages;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Rooms;
use App\Models\RoomsData;
use App\Models\RoomsDataLanguage;
// use App\Models\Auth\User;
use App\Repositories\Backend\RoomsDataRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Class RoomsDataController.
 */
class RoomsDataController extends Controller
{
    /**
     * @var RoomsDataRepository
     */
    protected $roomsDataRepository;

    /**
     * RoomsDataController constructor.
     *
     * @param RoomsDataRepository $RoomsDataRepository
     */
    public function __construct(RoomsDataRepository $roomsDataRepository)
    {
        $this->roomsDataRepository = $roomsDataRepository;
    }



    public function getRoomsDataLanguage($id)
    {
        return RoomsDataLanguage::where('parent_id',$id)->first();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.roomsdata.index')
            ->withRoomsData($this->roomsDataRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $languages = Languages::where('status', 1)->get();
        $rooms = Rooms::where('id','!=',6)->get();
        return view('backend.roomsdata.create',
            [
                'languages' => $languages,
                'rooms' => $rooms,
            ]);
    }
    public function uploadImage($image){
        //$size = $image->getSize();;
        $imageName  = time()."_".$image->getClientOriginalName();
        $image->move(public_path().'/images/rooms-data/', $imageName);
        return $imageName;
    }
    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, RoomsData $roomsData, RoomsDataLanguage $roomsDataLanguage)
    {
        $data = $request->all();
        $roomsData = new RoomsData();
        $roomsData->work_type = ($data['work_type']['fi']);
        $roomsData->type = ($data['type']['fi']);
        $roomsData->room_id = ($data['room_id']['fi']);
        $roomsData->msgtype = ($data['msgtype']['fi']);
        if($roomsData->type == 1){
            $roomsData->content = ($data['message']['fi']);
        }elseif($roomsData->type == 2){
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                if(isset($file['fi'])){
                    $roomsData->content = $this->uploadImage($file['fi']);
                }
            }
        }
        $roomsData->language_code ='fi';
        $roomsData->save();
        if(count($data['room_id']) > 1){
            foreach($data['room_id'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $roomsDataLanguage = new RoomsDataLanguage();
                $roomsData->work_type = ($data['work_type'][$l_id]);
                $roomsData->type = ($data['type'][$l_id]);
                $roomsData->room_id = ($data['room_id'][$l_id]);
                $roomsData->msgtype = ($data['msgtype'][$l_id]);
                if($roomsData->type == 1){
                    $roomsData->content = ($data['message'][$l_id]);
                }elseif($roomsData->type == 2){
                    if($request->hasfile('image'))
                    {
                        $file = $request->file('image');
                        if(isset($file[$l_id])){
                            $roomsData->content = $this->uploadImage($file[$l_id]);
                        }
                    }
                }
                $roomsDataLanguage->parent_id = $roomsData->id;
                $roomsDataLanguage->language_code = $l_id;
                $roomsDataLanguage->save();
            }
        }
        return redirect()->route('admin.roomsdata.index')->withFlashSuccess('The Department has been successfully created.');
    }


    public function getRoomsData($RoomsDataId)
    {
        return RoomsData::where('id',$RoomsDataId)->first();
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(Request $request,$id)
    {

        $rooms = Rooms::where('id','!=',6)->get();
        $roomsDataData = $this->getRoomsData($id);
        $roomsDataLanguages = RoomsDataLanguage::where('parent_id',$id)->get();
        $languages = Languages::where('status', 1)->get();
        $data['fi']['room_id'] = $roomsDataData->room_id;
        $data['fi']['work_type'] = $roomsDataData->work_type;
        $data['fi']['type'] = $roomsDataData->type;
        $data['fi']['content'] = $roomsDataData->content;
        $data['fi']['msgtype'] = $roomsDataData->msgtype;

        if($roomsDataLanguages){
            foreach($roomsDataLanguages as $roomsDataLanguage){
                $data[$roomsDataLanguage->language_code]['work_type'] = $roomsDataLanguage->work_type;
                $data[$roomsDataLanguage->language_code]['type'] = $roomsDataLanguage->type;
                $data[$roomsDataLanguage->language_code]['room_id'] = $roomsDataLanguage->room_id;
                $data[$roomsDataLanguage->language_code]['content'] = $roomsDataLanguage->content;
                $data[$roomsDataLanguage->language_code]['msgtype'] = $roomsDataLanguage->msgtype;
            }
        }
        return view('backend.roomsdata.edit',
            [
                'id' => $id,
                'languages' => $languages,
                'data' => $data,
                'rooms' => $rooms,
            ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $roomsData =  RoomsData::where('id',$id)->first();
        $roomsData->work_type = ($data['work_type']['fi']);
        $roomsData->type = ($data['type']['fi']);
        $roomsData->room_id = ($data['room_id']['fi']);
        $roomsData->msgtype = ($data['msgtype']['fi']);
        if($roomsData->type == 1){
            $roomsData->content = ($data['message']['fi']);
        }
        elseif($roomsData->type == 2){
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                if(isset($file['fi'])){
                    $roomsData->content = $this->uploadImage($file['fi']);
                }
            }
        }
        $roomsData->save();
        if(count($data['room_id']) > 1){
            foreach($data['room_id'] as $l_id => $title){
                if($l_id == 'fi'){
                    continue;
                }
                $roomsDataLanguage = RoomsDataLanguage::where('parent_id',$id)->where('language_code',$l_id)->first();
                if(!$roomsDataLanguage){
                    $roomsDataLanguage = new RoomsDataLanguage();
                }
                $roomsData->work_type = ($data['work_type'][$l_id]);
                $roomsData->type = ($data['type'][$l_id]);
                $roomsData->room_id = ($data['room_id'][$l_id]);
                $roomsData->msgtype = ($data['msgtype'][$l_id]);
                if($roomsData->type == 1){
                    $roomsData->content = ($data['message'][$l_id]);
                }elseif($roomsData->type == 2){
                    if($request->hasfile('image'))
                    {
                        $file = $request->file('image');
                        if(isset($file[$l_id])){
                            $roomsData->content = $this->uploadImage($file[$l_id]);
                        }
                    }
                }
                $roomsDataLanguage->parent_id = $roomsData->id;
                $roomsDataLanguage->language_code = $l_id;
                $roomsDataLanguage->save();
            }
        }

        return redirect()->route('admin.roomsdata.index')->withFlashSuccess('Department has been updated successfully.');
    }
    /**
     * @param Request $request
     * @param InvestProperty              $InvestProperty
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($id)
    {
        $roomsData =  RoomsData::where('id',$id)->first();
        if ($roomsData != null) {
            $roomsData->delete();
            $roomsDataLanguage = RoomsDataLanguage::where('parent_id',$id)->get();
            if ($roomsDataLanguage != null) {
                foreach($roomsDataLanguage as $pd){
                    $pd->delete();
                }
            }
            return redirect()->route('admin.roomsdata.index')->withFlashSuccess(__('Department has been deleted successfully.'));
        }
        return redirect()->back();
    }
}
