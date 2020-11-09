<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\Http\Requests;
use App\Room;
use App\TokenSeries;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::get();
        $currentTime = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $nextDate = \Carbon\Carbon::now()->addDays(1)->format('Y-m-d');
        $todayDate = \Carbon\Carbon::now()->format('Y-m-d');

        $pending_room = 0;
        $complete_room = 0;
        $general_room = 0;
        $vip_room = 0;
        $vvip_room = 0;
        $p_room = [];
        $f_room = [];
        $normal_room = [];
        $vip_room = [];
        $vvip_room = [];
        foreach ($room as $row) {
            $get_booking = Booking::where('room_id', $row->id)->where('time_to', '>', $currentTime)->count();
            if ($get_booking < $row->size) {
                $p_room[] = $row;
                if($row->category_id == 1){
                    $normal_room[] = $row;
                }
                if($row->category_id == 2){
                    $vip_room[] = $row;
                }
                if($row->category_id == 3){
                    $vvip_room[] = $row;
                }
            }
            if ($get_booking >= $row->size) {
                $f_room[] = $row;
            }

        }

        $pending_room = count($p_room);
        $complete_room = count($f_room);
        $general_room = count($normal_room);
        $vip_room = count($vip_room);
        $vvip_room = count($vvip_room);

        $todayLeave = Booking::leftjoin('customers', 'customers.id', '=', 'bookings.customer_id')
            ->leftjoin('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->leftjoin('categories', 'categories.id', '=', 'rooms.category_id')
            ->leftjoin('wings', 'wings.id', '=', 'buildings.wing_id')
            ->select('bookings.*','customers.first_name','customers.last_name','customers.phone','rooms.room_number as room_name', 'buildings.name as buildings_name', 'wings.name as wings_name')
            ->whereDate('bookings.time_to','=', $todayDate)
            ->where('bookings.is_check_out','!=','1')
            ->get();

        $tomorrowLeave = Booking::leftjoin('customers', 'customers.id', '=', 'bookings.customer_id')
            ->leftjoin('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->leftjoin('categories', 'categories.id', '=', 'rooms.category_id')
            ->leftjoin('wings', 'wings.id', '=', 'buildings.wing_id')
            ->select('bookings.*','customers.first_name','customers.last_name','customers.phone', 'rooms.room_number as room_name', 'buildings.name as buildings_name', 'wings.name as wings_name')
            ->where('bookings.is_check_out','!=','1')
            ->where('bookings.time_to','like', $nextDate.'%')
            ->get();

        $nonLeavedUser = Booking::leftjoin('customers', 'customers.id', '=', 'bookings.customer_id')
            ->leftjoin('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->leftjoin('categories', 'categories.id', '=', 'rooms.category_id')
            ->leftjoin('wings', 'wings.id', '=', 'buildings.wing_id')
            ->select('bookings.*','customers.first_name','customers.last_name','customers.phone', 'rooms.room_number as room_name', 'buildings.name as buildings_name', 'wings.name as wings_name')
            ->whereDate('bookings.time_to','<', $todayDate)
            ->where('bookings.is_check_out','!=',1)
            ->get();

        return view('home', compact('pending_room', 'complete_room', 'todayLeave','tomorrowLeave','general_room','vip_room','vvip_room','nonLeavedUser'));
    }

    public function setToken(){
      $tokenSeries = TokenSeries::where('id',1)->first();
        $alphatoken = range('A', 'Z');
        rand(0,$tokenSeries->name);
        $customer = Customer::get();
        foreach ($customer as $row){
            $newToken = $alphatoken[rand(0,$tokenSeries->name)].'-'.$row->id;
            $updateToken = Customer::where('id',$row->id)->update(['token'=>$newToken]);
        }
    }
}
