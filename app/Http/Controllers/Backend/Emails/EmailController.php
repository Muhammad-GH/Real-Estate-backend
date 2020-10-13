<?php 
namespace App\Http\Controllers\Backend\Emails;
use App\Repositories\Backend\EmailRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Models\EmailCase;
use Validator;
use DB;
use Mail;
use App\Models\Languages; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

Class EmailController extends Controller
{
     /**
     * @var BlogRepository
     */
    protected $emailRepository;
    // protected $blogCategoryRepository;

    /**
     * BlogController constructor.
     *
     * @param BlogRepository $BlogRepository
     */
    public function __construct(EmailRepository $EmailRepository)
    {
        $this->emailRepository = $EmailRepository;
        // $this->blogCategoryRepository = $BlogCategoryRepository;
    }

	public function index(Request $request)
    {
        return view('backend.email.index_mail')
            ->withContents($this->emailRepository->getActivePaginated(25, 'id', 'desc'));
    }

    /**
     * @param Request    $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $case = EmailCase::get();
        $languages = Languages::all();
        $html = json_decode(Storage::get('email_for. json'));
        // dd($html->intro);
        return view('backend.email.create')->with(['case'=>$case,'html'=>$html,'lang'=>$languages]);
    }

     /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(Request $request, Email $email)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'editor1'     => 'required',
            //'email_for'   => "required|unique:email_content,email_for",
            'email_for'   => "required",
            'subject'   => 'required',
            'language'   => 'required',
        ])->validate();
        
        $email->intro     =  $data['editor1'];
        $email->email_for   =  $data['email_for'];
        $email->subject   =  $data['subject'];
        $email->language   =  $data['language'];

        // $this->getForEmail($email->email_for);

        $email->save();

        $this->saveJson($email);

        return redirect()->route('admin.emails.index')->withFlashSuccess('The content was successfully created.');
    }

    public function getForEmail($data)
    {
        $for = Email::get();
        foreach ($for as $key => $value) {
            if ($value->email_for == $data) {
                $this->destroy($value->id);
            }
        }
    }
    
    public function store_case(Request $request, EmailCase $email)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'case'     => 'required',
        ])->validate();
        
        $email->email_case     =  $data['case'];
        $email->save();

        return redirect()->route('admin.emails.index')->withFlashSuccess('The content was successfully created.');
    }

    protected function saveJson($data)
    {
            $retVal = ($data->language == 'en') ? 'en/' : 'fi/' ;
            $files = File::files(storage_path().'/app/'.$retVal);
            $fileName = preg_replace('/\s+/', '_', $data->email_for.'.json');
            if (empty($files)) {
                Storage::put($retVal.$fileName, json_encode($data));
            }

            foreach ($files as $key => $value) {
                if (basename($value) == $fileName) {
                    // Need to comment this for update purpose
                    //return false;
                }
                Storage::put($retVal.$fileName, json_encode($data));
            }
    }

    public function edit(Request $request,$id)
    {
        $emailData = $this->getEmails($id);
        return view('backend.email.edit')->with(['emailData'=>$emailData]);
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'editor1'     => 'required',
            //'email_for'   => "required|unique:email_content,email_for,{$id}",
            'email_for'   => "required",
            'subject'   => 'required',
        ])->validate();

        $email = $this->getEmails($id);        
        $email->intro     =  $data['editor1'];
        $email->email_for   =  $data['email_for'];
        $email->subject   =  $data['subject'];
        $this->saveJson($email);
        $email->save();

        return redirect()->route('admin.emails.index')->withFlashSuccess('The content was successfully updated.');

    }

    public function getEmails($emailId)
    {
        return Email::where('id',$emailId)->first();
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy($id)
    {
        $email =  Email::where('id',$id)->first();
        if ($email != null) {
            $email->delete();
            return redirect()->route('admin.emails.index')->withFlashSuccess(__('Job has been deleted successfully.'));
        }
        return redirect()->back();
    }

    public function case()
    {
        $for = EmailCase::get();
        return view('backend.email.case')->with(['for'=>$for]);
    }

    public function destroy_case($id)
    {
        $email =  EmailCase::where('id',$id)->first();
        if ($email != null) {
            $email->delete();
            return redirect()->route('admin.emails.index')->withFlashSuccess(__('Job has been deleted successfully.'));
        }
        return redirect()->back();
    }
    
    public function send_mail(){

        $retVal = (app()->getLocale() == 'en') ? 'en/' : 'fi/' ;
        $content = json_decode(Storage::get($retVal.'template_test_en.json'));
        // dd($content);
    	$to_name = 'sherwin';
        $to_email = 'sherwinlukes@gmail.com';
        $data = array('name'=>$to_name, 'intro'=>$content->intro);
            
        Mail::send('mails.register', $data, function($message) use ($to_name, $to_email, $content) {

        $message->to($to_email, $to_name)
                ->subject('Artisans Web Testing Mail');
        $message->from('sherwinlukes@gmail.com','sherwin');
            });
        echo "sent";
    }
} 
?>