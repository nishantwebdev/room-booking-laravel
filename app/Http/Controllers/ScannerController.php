<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\QrScanLog;
use App\Room;
use App\UserLog;
use Illuminate\Http\Request;
use URL;
use Auth;

class ScannerController extends Controller
{
    public function index(){
        return view('scanData.index');
    }

    public function getData(Request $request){
        $id = $request['id'];

        $user = Customer::where('id',$id)->first();
        if(empty($user)){
            return [
                'data'=>'',
                'status'=>0
            ];
        }

        $currentTime = \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $bookings = Booking::where('customer_id', $id)->orderBy('id','DESC')->first();
        $bookingsTime = Booking::where('customer_id', $id)->orderBy('id','DESC')->where('time_to','>=',$currentTime)->first();
        if(empty($bookings)){
            return [
                'data'=>'રૂમ બુકિંગ મળ્યું નથી',
                'status'=> 2
            ];
        }

        $bookings['roomDetails'] = $this->getRoomDetails($bookings['room_id']);
//        $bookings['roomDetails']['category_name'] = @$bookings['roomDetails']['category_name'] == 'normal' ? 'સ્વામિનારાયણ' :(@$bookings['roomDetails']['category_name'] == 'vip' ? 'નીલકંઠ':(@$bookings['roomDetails']['category_name'] == 'vvip' ? 'સહજાનંદ':''));



        if(empty($bookingsTime)){
            return [
                'data'=>'તમારો બુકિંગનો સમય પૂરો થઈ ગયો છે',
                'status'=> 2
            ];
        }

        $user['image'] = URL::to('public/images/user/'.$user['image']);
        $user['qr_code'] = URL::to('public/images/qr/'.$user['qr_code']);
        $user['country'] = @$user->country->name;
        $user['state'] = @$user->state->name ;
        $user['city'] = @$user->city->name;

        $data = array('user'=>$user,'booking'=>$bookings);

        $checkEntry = QrScanLog::where('customer_id',$id)->where('created_at', '>',\Carbon\Carbon::now()->subHours(1)->toDateTimeString())->count();

        if($checkEntry >= 100){
            return [
                    'data'=>'એક કલાક માં બોવ બધી ઈન/આઉટ એન્ટ્રી : '.$checkEntry,
                    'status'=> 2
            ];
        }


        $checkUserLog = QrScanLog::where('customer_id',$id)->get();
        if(count($checkUserLog) == 0){
            $logU['type'] = 'Entry Card';
            $logU['message'] = 'Entry Card Confirm';
            $usLog['log_type'] = 'Entry Card';
            $usLog['description'] = 'Entry Card Confirm';
        } elseif ((count($checkUserLog)%2) == 0){
            $logU['type'] = 'Exit Card';
            $logU['message'] = 'Exit Card Confirm';
            $usLog['log_type'] = 'Exit Card';
            $usLog['description'] = 'Exit Card Confirm';
        }else{
            $logU['type'] = 'Entry Card';
            $logU['message'] = 'Entry Card Confirm';
            $usLog['log_type'] = 'Entry Card';
            $usLog['description'] = 'Entry Card Confirm';
        }

        $logU['scaner_id'] = Auth::user()->id;
        $logU['customer_id'] = $id;
        $addLog = new QrScanLog();
        $addLog->fill($logU);
        $addLog->save();

        $usLog['created_by'] = Auth::user()->id;
        $usLog['customer_id'] = $id;
        $uaddLog = new UserLog();
        $uaddLog->fill($usLog);
        $uaddLog->save();

        $updateBooking = Booking::where('id',$bookings['id'])->update(['is_check_in'=>'1', "additional_information" => "Room Check in at ".\Carbon\Carbon::now()->format('Y-m-d H:i:s') ]);
        return [
            'data'=>$data,
            'status'=>1
        ];

    }

    public function getRoomDetails($id){
        $room = Room::leftjoin('buildings','buildings.id','=','rooms.building_id')
            ->leftjoin('categories','categories.id','=','rooms.category_id')
            ->leftjoin('wings','wings.id','=','buildings.wing_id')
            ->select('rooms.*','buildings.name as building_name','categories.name as category_name','wings.name as wing_name')
            ->where('rooms.id',$id)
            ->first();

        return $room;
    }

    public function exit(){
        return view('scanData.exit');
    }

    public function exitScan(Request $request){
        $id = $request['id'];

        $user = Customer::where('id',$id)->first();
        if(empty($user)){
            return [
                'data'=>'ઉપયોગકર્તા ના મળ્યો',
                'status'=>2
            ];
        }

        $bookings = Booking::where('customer_id', $id)->where('is_check_out','!=','1')->orderBy('id','DESC')->first();

        if(empty($bookings)){
            return [
                'data'=>'અમાન્ય યુઝર.',
                'status'=>2
            ];
        }

        $updateBooking = Booking::where('id',$bookings['id'])->update(['is_check_out'=>'1', "time_to" => \Carbon\Carbon::now()->format('Y-m-d H:i:s'), "additional_information" => "Room leave at ".\Carbon\Carbon::now()->format('Y-m-d H:i:s') ]);

        return [
            'data'=>'ચેકઆઉટ સફળ',
            'status'=>1
        ];
    }
}
