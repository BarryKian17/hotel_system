<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    //Check out page
    public function checkOut(){
        if(Session::has('book_date')){
            $booking_data = Session::get('book_date');
            $room = Room::find($booking_data['room_id']);
            $room_name = RoomType::where('id',$room->room_type_id)->get();
            $toDate = Carbon::parse($booking_data['check_in']);
            $fromDate = Carbon::parse($booking_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);
            return view('user.room.checkout.checkout',compact('booking_data','room','toDate','fromDate','nights','room_name'));
        } else {
            if($request->available_room < $request->number_of_rooms){
                $noti = array(
                    'message'=>'SomeThing Went Wrong',
                    'alert-type'=>'error'
                );
                return redirect('/')->with($noti);
        }


    }
    }
    //User Booking Store
    public function bookingStore(Request $request){
        $validateData = $request->validate([
            'check_in'=>'required',
            'check_out'=>'required',
            'number_of_rooms'=>'required',
            'person'=>'required',

        ]);

        if($request->available_room < $request->number_of_rooms){
            $noti = array(
                'message'=>'SomeThing Went Wrong',
                'alert-type'=>'error'
            );
            return back()->with($noti);
        }

        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_room'] = $request->available_room;
        $data['person'] = $request->person;
        $data['check_in'] = date('Y-m-d',strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d',strtotime($request->check_out));
        $data['room_id'] = $request->room_id;

        Session::put('book_date',$data);

        return redirect()->route('user.check.out');


    }
}
