<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Countries;
use App\States;
use App\Cities;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCustomersRequest;
use App\Http\Requests\Admin\UpdateCustomersRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerPage()
    {
      $countries = \App\Countries::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
      $states = \App\States::where('country_id', '101')->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
      $cities = \App\Cities::where('state_id', '12')->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

      return view('front.register', compact('countries','states','cities'));
    }

    public function store(StoreCustomersRequest $request)
    {

      $customer = Customer::where('first_name',$request->first_name)
      ->where('last_name',$request->last_name)
      ->where('phone',$request->phone)
      ->where('deleted_at',NULL)
      ->get();

      if(count($customer)){
        return redirect()->route('register.page')->withError('Data Already Registered.')->withInput();
      }

      $requestData = $request->except(['image','_token']);

      if($request->from_date && $request->from_date != ""){

        $date = date_create($request->from_date);
        $requestData['from_date'] =  date_format($date,"Y-m-d 00:00:00");
      }

      if($request->to_date && $request->to_date != ""){
      $date = date_create($request->to_date);
      $requestData['to_date'] =  date_format($date,"Y-m-d 00:00:00");
    }

    $requestData['created_by']=0;

        $customer = Customer::create($requestData);

        $save_log = UserLog::create([
                    'created_by' => 0,
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

        $file_name = "qr_code_".$customer->id.".png";


        $pngImage = \QrCode::margin(5)->format('png')->size(750)->errorCorrection('H')
                            ->generate($customer->id, base_path('public/images/qr/').$file_name);

        if($pngImage){
          $customer->qr_code = $file_name;
          $customer->save();
        }

        return redirect()->route('register.page')->withMessage('Data registered Successfully.');
    }


}
