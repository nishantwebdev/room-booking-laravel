<?php
namespace App\Http\Controllers\Admin;

use App\Room;
use App\Booking;
use App\Customer;
use App\Wings;
use App\Buildings;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class FindRoomsController extends Controller
{
    public function findUsersAjax(Request $request)
    {
      $q = $request->searchTerm;
	    $data = array();

      $currentTime = \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');

      $getAlreadyBooked = Booking::where('time_to','>=',$currentTime)->groupBy('customer_id')->select('customer_id')->get()->toArray();

      $customers = Customer::whereNotIn('id',$getAlreadyBooked)
      ->where('first_name','LIKE','%'.$q.'%')
      ->orWhere('last_name','LIKE','%'.$q.'%')
      ->orWhere('phone','LIKE','%'.$q.'%')
      ->orWhere('token','LIKE','%'.$q.'%')
      ->orderBy('id', 'DESC')->get()->pluck('full_name_with_mobile_and_id', 'id');

      foreach ($customers as $key => $value) {
        $data[] = array("id"=>$key, "text"=>$value);
      }
      return $data;
    }


    public function index(Request $request)
    {
        if (!Gate::allows('find_room_access')) {
            return abort(401);
        }

        $categories = Category::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $time_from = $last_from = $request->input('time_from');
        $time_to = $request->input('time_to');
        $currentTime = \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');

        //$getAlreadyBooked = Booking::where('time_to','>=',$currentTime)->groupBy('customer_id')->select('customer_id')->get()->toArray();

        //$customers = Customer::whereNotIn('id',$getAlreadyBooked)->get()->pluck('full_name_with_mobile_and_id', 'id');
        $customers = array();
        $customer_id = array();

        if ($request->isMethod('POST')) {



			if($request->input('customer_id')){
				$customer_id = $request->input('customer_id');

          $customers = Customer::whereIn('id',$customer_id)->get()->pluck('full_name_with_mobile_and_id', 'id');
			}




          if(!(strtotime($time_to) > strtotime($time_from))){
            return redirect()->back()->withError('To date should greater than From Date.');
          }
            $time_from_d =  date_create($time_from);
            $time_to_d = date_create($time_to);
            $diff = date_diff($time_from_d,$time_to_d);
            $days = $diff->format("%a");
            $booking_data_array = array();
            $date_array = array();

            if($days > 0){

              //dd($days);
              for($i = 0;$i<$days;$i++){

                $time = strtotime($last_from);

                $newTime = $time + 86400;
                $last_to = date('Y-m-d 10:00:00', $newTime);
                if($i == ($days-1) && ( strtotime($time_to)) - $time < 86400 ){
                  break;
                }



                $bookings = Booking::selectRaw('room_id, count(*)')
                // ->where('time_to','>=',$last_to)
                // ->where('time_from','<=',$last_from)
                ->where('is_check_out','=',0)
                ->groupBy('room_id')
                ->get();
                //SELECT room_id , COUNT(*) FROM `bookings` WHERE DATE(`time_to`) >= '2019-09-23 00:00:00' AND DATE(`time_from`) <= '2019-09-22 00:00:00' GROUP BY `room_id`

                $booking_array = array();
                if(count($bookings) > 0){
                  foreach ($bookings as $booking) {
                    $booking_array[$booking->room_id]['total_booking'] =  $booking['count(*)'];
                  }
                }
                $booking_data_array[$last_from] = $booking_array;
                $date_array[]=$last_from;
                $last_from = $last_to;

              }

              $bookings = Booking::selectRaw('room_id, count(*)')
              ->where('time_to','>=',$time_to)
              ->where('time_from','<=',$last_from)
              ->groupBy('room_id')
              ->get();

              if(count($bookings) > 0){
                $booking_array = array();
                if(count($bookings) > 0){


                  foreach ($bookings as $booking) {

                    $booking_array[$booking->room_id]['total_booking'] =  $booking['count(*)'];
                  }
                }
            }

            $booking_data_array[$last_from] = $booking_array;
            $date_array[]=$last_from;

            }


            $rooms = Room::where('deleted_at', NULL)->where('category_id',$request->category_id)->get();

            foreach ($rooms as $room) {

                foreach ($booking_data_array as $key => $value) {

                  if (array_key_exists($room->id,$value))
                  {

                      $temp = array("total_booking" => $value[$room->id]['total_booking']);

                    $room[$key] = $temp;


                  }
                else
                  {
                    $temp = array("total_booking"=>0);
                    $room[$key] = $temp;
                  }

                }

            }
            //dd($date_array);
            $category_id = $request->category_id;
            $wing = ["sssss", "aaaaaa", "ffff"];
//            $wing = Wings::pluck('name','id');
//            $wing_id = $request->wing;
//            $building = Buildings::pluck('name','id');
//            $building_id = $request->building;
        } else {
            $rooms = null;
            $wing = Wings::pluck('name','id');
            $building = Buildings::pluck('name','id');
        }
        return view('admin.find_rooms.index', compact('rooms','categories', 'time_from', 'time_to','date_array','category_id','customers','customer_id'));
    }

    public function getBuilding(Request $request){
      $building = Buildings::where('wing_id',$request->wing)->pluck('name','id');

      return response()->json($building);
    }

    public function getRoom(Request $request){
      $room = Room::where('building_id',$request->building)->pluck('room_number','id');
      return response()->json($room);
    }
}
