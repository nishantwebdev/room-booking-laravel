<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Customer;
use App\Room;
use App\UserLog;
use App\Wings;
use App\Buildings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBookingsRequest;
use App\Http\Requests\Admin\UpdateBookingsRequest;

class BookingsController extends Controller
{
    /**
     * Display a listing of Booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('booking_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (!Gate::allows('booking_delete')) {
                return abort(401);
            }
            $bookings = Booking::onlyTrashed()->orderBy('id', 'DESC')->paginate(100);
        } else {

          if(isset($request->q )){
            $q = $request->q;


            $bookings = Booking::where('time_from','LIKE','%'.$q.'%')
            ->orWhere('time_to','LIKE','%'.$q.'%')
            ->orwhereHas('customer', function ($query) use ($q) {
                        $query->where('first_name','LIKE','%'.$q.'%')
                        ->orWhere('last_name','LIKE','%'.$q.'%')
                        ->orWhere('phone','LIKE','%'.$q.'%');
            })->orwhereHas('room', function ($query) use ($q) {
                        $query->where('room_number','LIKE','%'.$q.'%')
                              ->orwhereHas('building', function ($query) use ($q) {
                                        $query->where('name','LIKE','%'.$q.'%')
                                              ->orwhereHas('wing', function ($query) use ($q) {
                                                  $query->where('name','LIKE','%'.$q.'%');
                                              });
                                });
            })->orderBy('id', 'DESC')->paginate(100);


          }else {
            $bookings = Booking::orderBy('id', 'DESC')->paginate(100);
          }

        }

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating new Booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('booking_create')) {
            return abort(401);
        }
        $currentTime = \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $getAlreadyBooked = Booking::where('time_to','>=',$currentTime)->groupBy('customer_id')->select('customer_id')->get()->toArray();
        $customers = Customer::whereNotIn('id',$getAlreadyBooked)->get()->pluck('full_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $rooms = Room::get()->pluck('room_number', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $wing = Wings::pluck('name','id');
        $building = Buildings::pluck('name','id');
        return view('admin.bookings.create', compact('customers', 'rooms','wing','building'));
    }

    /**
     * Show the confirmation of Booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {


      $customers = Customer::find(explode(",",$request->ids));

      $room = Room::find($request->room_id);

      return view('admin.bookings.confirmed', compact('customers','room'))->withMessage("booking saved.");
    }

    /**
     * store new Booking Ajax.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAjax(Request $request)
    {
      $booking_ids = array();

      if(count($request->customer_id) > 0){

        foreach ($request->customer_id as $customer) {
          $booking = Booking::create([
            "room_id"=>$request->room_id,
            "time_from"=>$request->time_from,
            "time_to"=>$request->time_to,
            "customer_id"=>$customer,
            "additional_information"=>$request->additional_information,
            'created_by' => \Auth::user()->id,
          ]);

          $save_log = UserLog::create([
                      'created_by' => \Auth::user()->id,
                      'customer_id' => $customer,
                      'log_type' => "create_booking",
                      'description' => 'Booking Created Successfully. Room ID - '.$request->room_id,
                  ]);
                  $booking_ids[] = $customer;
        }

        if(count($booking_ids) == count($request->customer_id)){
          return array("status" =>"success","booking_ids"=>implode(",",$booking_ids),"room_id"=>$request->room_id);
        }else {
          return array("status" =>"error","booking_ids"=>implode(",",$booking_ids),"room_id"=>$request->room_id);
        }

      }else {
        return array("status" =>"error","room_id"=>$request->room_id);
      }

    }

    /**
     * Store a newly created Booking in storage.
     *
     * @param  \App\Http\Requests\StoreBookingsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingsRequest $request)
    {

        if (!Gate::allows('booking_create')) {
            return abort(401);
        }
        $booking = Booking::create($request->all());

        $save_log = UserLog::create([
                    'created_by' => \Auth::user()->id,
                    'customer_id' => $request->customer_id,
                    'log_type' => "create_booking",
                    'description' => 'Booking Created Successfully.',
                ]);

        return redirect()->route('admin.bookings.index');
    }


    /**
     * Show the form for editing Booking.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('booking_edit')) {
            return abort(401);
        }

        $customers = Customer::get()->pluck('first_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $rooms = Room::get()->pluck('room_number', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $booking = Booking::findOrFail($id);

        return view('admin.bookings.edit', compact('booking', 'customers', 'rooms'));
    }

    /**
     * Update Booking in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingsRequest $request, $id)
    {
        if (!Gate::allows('booking_edit')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());


        return redirect()->route('admin.bookings.index');
    }


    /**
     * Display Booking.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('booking_view')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }


    /**
     * Remove Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index');
    }

    /**
     * Delete all selected Booking at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Booking::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->restore();

        return redirect()->route('admin.bookings.index');
    }

    /**
     * Permanently delete Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->forceDelete();

        return redirect()->route('admin.bookings.index');
    }

}
