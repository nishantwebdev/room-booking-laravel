<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Customer;
use App\Countries;
use App\Room;
use App\States;
use App\Cities;
use App\UserLog;
use App\TokenSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCustomersRequest;
use App\Http\Requests\Admin\UpdateCustomersRequest;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use Excel;

use Intervention\Image\ImageManagerStatic as Image;

class CustomersController extends Controller
{
    /**
     * Display a listing of Customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (! Gate::allows('customer_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('customer_delete')) {
                return abort(401);
            }
            $customers = Customer::onlyTrashed()->orderBy('id', 'DESC')->paginate(100);
        } else {


          if(isset($request->q )){
            $q = $request->q;

            $customers = Customer::where('first_name','LIKE','%'.$q.'%')
            ->orWhere('last_name','LIKE','%'.$q.'%')
            ->orWhere('phone','LIKE','%'.$q.'%')
            ->orWhere('token','LIKE','%'.$q.'%')
            ->orderBy('id', 'DESC')->paginate(100);

          }else {
            $customers = Customer::select(['id','first_name','last_name','phone','token'])->orderBy('id', 'DESC')->paginate(100);
          }




        }

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating new Customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('customer_create')) {
            return abort(401);
        }
        $countries = \App\Countries::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $states = \App\States::where('country_id', '101')->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $cities = \App\Cities::where('state_id', '12')->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $categories = \App\Category::get()->pluck('name', 'id');

        return view('admin.customers.create', compact('countries','states','cities','categories'));
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param  \App\Http\Requests\StoreCustomersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomersRequest $request)
    {
      $tokenSeries = TokenSeries::where('id',1)->first();
        if (! Gate::allows('customer_create')) {
            return abort(401);
        }
        $request['address'] = $request['block'] .', '.$request['street'].', '.$request['landmark'];
        $customer = Customer::create($request->except(['namafoto','image','block','street','landmark']));

        $save_log = UserLog::create([
                    'created_by' => \Auth::user()->id,
                    'customer_id' => $customer->id,
                    'log_type' => "create_account",
                    'description' => 'Account Created Successfully.',
                ]);


        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $imagedetails = getimagesize($image);
          $filename = uniqid()."_".$customer->id . '.' . $image->getClientOriginalExtension();

          if($imagedetails[0] > 600){

            $img = Image::make($image->getRealPath())->resize(600, null, function ($constraint) {
          $constraint->aspectRatio();
          });

          }else{

            $img = Image::make($image->getRealPath())->resize($imagedetails[0], null, function ($constraint) {
          $constraint->aspectRatio();
          });

          }
          $img->save(base_path('public/images/user/' .$filename));

            $customer->image =  $filename;
            $customer->save();
        }

        if(!empty($_POST['namafoto'])){
                 $encoded_data = $_POST['namafoto'];
                   $binary_data = base64_decode( $encoded_data );

                   // save to server (beware of permissions // set ke 775 atau 777)
                   $namafoto = uniqid()."_".$customer->id.".jpeg";
                   $result = file_put_contents( base_path('public/images/user/').$namafoto, $binary_data );

                   if (!$result) die("Could not save image!  Check file permissions.");

                   $customer->image = $namafoto;
                   $customer->save();
        }





        $file_name = "qr_code_".$customer->id.".png";


        $pngImage = \QrCode::margin(5)->format('png')
                            ->size(750)->errorCorrection('H')
                            ->generate($customer->id, base_path('public/images/qr/').$file_name);
        $newToken = '';
        if($pngImage){
          $customer->qr_code = $file_name;
          $customer->save();


            $alphatoken = range('A', 'Z');

            rand(0,$tokenSeries->name);
            $newToken = $alphatoken[rand(0,$tokenSeries->name)].'-'.$customer->id;

            $updateToken = Customer::where('id',$customer->id)->update(['token'=>$newToken]);

        }
        return [
            'response'=>1,
            'token'=>$newToken
        ];
    }


    /**
     * Show the form for editing Customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('customer_edit')) {
            return abort(401);
        }

        $countries = \App\Countries::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $states = \App\States::where('country_id', '101')->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $cities = \App\Cities::where('state_id', '12')->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $categories = \App\Category::get()->pluck('name', 'id');
        $customer = Customer::findOrFail($id);

        return view('admin.customers.edit', compact('customer', 'countries','states','cities','categories'));
    }

    /**
     * Update Customer in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomersRequest $request, $id)
    {
        if (! Gate::allows('customer_edit')) {
            return abort(401);
        }
        $customer = Customer::findOrFail($id);
        $customer->update($request->except(['namafoto','image']));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid()."_".$customer->id . '.' . $image->getClientOriginalExtension();
            $location = base_path('public/images/user');

            $status = $image->move($location, $filename);

            $customer->image =  $filename;
            $customer->save();
        }

        if(!empty($_POST['namafoto'])){
                 $encoded_data = $_POST['namafoto'];
                   $binary_data = base64_decode( $encoded_data );

                   // save to server (beware of permissions // set ke 775 atau 777)
                   $namafoto = uniqid()."_".$customer->id.".jpeg";
                   $result = file_put_contents( base_path('public/images/user/').$namafoto, $binary_data );

                   if (!$result) die("Could not save image!  Check file permissions.");

                   $customer->image = $namafoto;
                   $customer->save();
        }



        return redirect()->route('admin.customers.index');
    }


    /**
     * Display Customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('customer_view')) {
            return abort(401);
        }

        $countries = \App\Countries::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $bookings = \App\Booking::where('customer_id', $id)->get();

        $customer = Customer::findOrFail($id);

        return view('admin.customers.show', compact('customer', 'bookings'));
    }


    /**
     * Remove Customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('customer_delete')) {
            return abort(401);
        }
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index');
    }

    /**
     * Delete all selected Customer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('customer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Customer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('customer_delete')) {
            return abort(401);
        }
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();

        return redirect()->route('admin.customers.index');
    }

    /**
     * Permanently delete Customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('customer_delete')) {
            return abort(401);
        }
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->forceDelete();

        return redirect()->route('admin.customers.index');
    }

    public static function getCountries()
    {

        $countries = Countries::get()->all();

        $html = '<option value="" >Select Country</option>';

        foreach ($countries as $country) {
            $html .= '<option value="' . $country->id . '" >' . $country->name . '</option>';
        }
        return $html;
    }

    public function getStates(Request $request)
    {

        $states = States::where('country_id', $request->get('country_id'))->get()->all();

        $html = '<option value="" >Select State</option>';

        foreach ($states as $state) {
            $html .= '<option value="' . $state->id . '" >' . $state->name . '</option>';
        }
        return $html;
    }

    public function getCities(Request $request)
    {

        $cities = Cities::where('state_id', $request->get('state_id'))->get()->all();

        $html = '<option value="" >Select City</option>';

        foreach ($cities as $city) {
            $html .= '<option value="' . $city->id . '" >' . $city->name . '</option>';
        }
        return $html;
    }

    public function printIcard($id){
        $data = Customer::findorFail($id);

        $bookings = Booking::where('customer_id', $id)->orderBy('id','DESC')->first();
        if(empty($bookings)){
            return Redirect::back()->withErrors(['Error', 'રૂમ આપવામાં આવેલ નથી તો આઈકાર્ડ પ્રિન્ટ થશે નહિ ']);
        }
        $bookings['roomDetails'] = $this->getRoomDetails($bookings['room_id']);
        $data['room_number'] = @$bookings['roomDetails']['room_number'];
        $data['wing_no'] = @$bookings['roomDetails']['wing_name'];
        $data['building_name'] = @$bookings['roomDetails']['building_name'];
        $data['category_name'] = @$bookings['roomDetails']['label'];
        $data['c_image'] = @$bookings['roomDetails']['image'];
        $data['id'] = $id;
        return view('admin.customers.card',compact('data'));

    }

    public function getRoomDetails($id){
        $room = Room::leftjoin('buildings','buildings.id','=','rooms.building_id')
            ->leftjoin('wings','wings.id','=','buildings.wing_id')
            ->leftjoin('categories','categories.id','=','rooms.category_id')
            ->select('rooms.*','wings.name as wing_name','buildings.name as building_name','buildings.*','categories.name as category_name','categories.*')
            ->where('rooms.id',$id)
            ->first();

        return $room;
    }

    public function confirmCard($id){
        $data['is_confirmed'] = 1;

        $update = Customer::where('id',$id)->update($data);
        /**
         * Log Data
         */

        $logU['created_by'] = Auth::user()->id;
        $logU['customer_id'] = $id;
        $logU['log_type'] = 'Confirm the Entry Card';
        $logU['description'] = 'Entry Card Confirm and allocate rooms';

        $addLog = new UserLog();
        $addLog->fill($logU);
        $addLog->save();
        Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Card Confirm Successfully.!! </div>');

        return redirect('admin/check-qr-scan');
    }

    public function import(Request $request)
    {
      $request->validate([
            'file' => 'required|file'
        ]);

        $tokenSeries = TokenSeries::where('id',1)->first();

        $path = $request->file('file')->getRealPath();
        $data = \Excel::load($path)->get();
 		$arr=array();
        if($data->count()){
          $i = 1;
          $row_msg = "";
            foreach ($data as $key => $value)
            {
            		$check=Customer::where('first_name',$value->first_name)
                ->where('last_name',$value->last_name)
                ->where('phone',$value->phone)
                ->where('deleted_at',NULL)
                ->count();

            		if($check==0)
                    {
                        $Customer= new Customer();
                        $Customer->first_name = $value->first_name;
                        $Customer->last_name = $value->last_name;
                        $Customer->address = $value->address;
                        $Customer->phone = $value->phone;
                        $Customer->email = $value->email;
                        $Customer->country_id = $value->country_id;
                        $Customer->state_id = $value->state_id;
                        $Customer->city_id = $value->city_id;
                        $Customer->village = $value->village;
                        $Customer->phone2 = $value->phone2;
                        $Customer->from_date = $value->from_date;
                        $Customer->to_date = $value->to_date;
                        $Customer->gender = $value->gender;
                        $Customer->age = $value->age;
                        $Customer->blood_group = $value->blood_group;
                        $Customer->education = $value->education;
                        $Customer->occupation = $value->occupation;
                        if($Customer->save())
                        {
                            $file_name = "qr_code_".$Customer->id.".png";
                            $pngImage = \QrCode::margin(5)->format('png')
                                            ->size(750)->errorCorrection('H')
                                            ->generate($Customer->id, base_path('public/images/qr/').$file_name);

                            $alphatoken = range('A', 'Z');
                            rand(0,$tokenSeries->name);
                            $newToken = $alphatoken[rand(0,$tokenSeries->name)].'-'.$Customer->id;

                            $updateToken = Customer::where('id',$Customer->id)->update(['token'=>$newToken,'qr_code'=>$file_name,'created_by'=>\Auth::user()->id]);
                            $row_msg .= "Row:".$i ." - #Success "."User Saved.<br>";
                        }else {
                          $row_msg .= "Row:".$i ." - #Error "."User Not Saved.<br>";
                        }
            		}else {
                  $row_msg .= "Row:".$i ." - #Error "."User Already Exist.<br>";
                }


              $i++;
            }
        }
        else
        {
            return back()->with('error', 'File is empty');
        }

        return back()->with('message', 'Insert Record successfully.')->with('import_data', $row_msg);
    }
}
