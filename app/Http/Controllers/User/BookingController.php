<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Booking;
use App\Models\RoomType;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
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

    //booking checkout
    public function bookCheckout(Request $request){
    $this->validate($request,[
        'name'=>'required' ,
        'email'=>'required' ,
        'phone'=>'required' ,
        'country'=>'required' ,
        'address'=>'required' ,
        'zip_code'=>'required' ,
        'state'=>'required' ,

    ]);
    $booking_data = Session::get('book_date');
    $room = Room::find($booking_data['room_id']);
    $toDate = Carbon::parse($booking_data['check_in']);
    $fromDate = Carbon::parse($booking_data['check_out']);
    $total_nights = $toDate->diffInDays($fromDate);
    $code = rand(0000000000,9999999999);
    $check_in = date('Y-m-d',strtotime($booking_data['check_in']));
    $check_out = date('Y-m-d',strtotime($booking_data['check_out']));

    $data = [
        'rooms_id'=> $room->id ,
        'user_id'=>$request->user_id ,
        'name'=>$request->name ,
        'email'=>$request->email ,
        'address'=>$request->address ,
        'phone'=>$request->phone ,
        'country'=>$request->country ,
        'zip_code'=>$request->zip_code ,
        'state'=>$request->state ,
        'actual_price'=>$room->price ,
        'payment_method'=>$request->payment_method,

        'payment_status'=>0,
        'status'=>0,

        'sub_total'=>$request->subTotal ,
        'discount'=>$request->discount ,
        'total_price'=>$request->total ,
        'person'=>$request->person ,
        'number_of_rooms'=>$request->number_of_rooms ,
        'check_in'=>$check_in ,
        'check_out'=>$check_out ,
        'total_night'=>$total_nights ,
        'code'=>$code

    ];
    $booking_id = Booking::insertGetId($data);
    $eldate = Carbon::create($check_out)->subDay();
    $d_period = CarbonPeriod::create($check_in,$eldate);
    foreach($d_period as $period){
        $booked_dates = new RoomBookedDate();
        $booked_dates->booking_id = $booking_id;
        $booked_dates->room_id =  $room->id ;
        $booked_dates->book_date = date('Y-m-d',strtotime($period));
        $booked_dates->save();

    }

    Session::forget('book_date');
    $noti = array(
        'message'=>'Booked Successfully',
        'alert-type'=>'success'
    );
    return redirect('/')->with($noti);
 }
}
