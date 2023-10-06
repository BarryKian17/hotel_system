<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Facility;
use Carbon\CarbonPeriod;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Http\Controllers\Controller;

class UserRoomController extends Controller
{
    //User Room List Page
    public function list(){
        $room = Room::select('rooms.*','room_types.name as room_name')
                ->leftJoin('room_types','rooms.room_type_id','room_types.id')
                ->get();
        return view('user.room.room_list',compact('room'));
    }

    //Room Detail Page
    public function detail($id){
        $room = Room::select('rooms.*','room_types.name as room_name')
        ->leftJoin('room_types','rooms.room_type_id','room_types.id')
        ->where('rooms.id',$id)
        ->get();
        $facility = Facility::where('rooms_id',$id)->get();
        $multiImage = MultiImage::where('rooms_id',$id)->get();
        $otherRoom = Room::select('rooms.*','room_types.name as room_name')
        ->leftJoin('room_types','rooms.room_type_id','room_types.id')
        ->where('rooms.id','!=' ,$id)
        ->limit(2)->get();
        return view('user.room.room_detail',compact('room','facility','multiImage','otherRoom'));
    }

    //Room Availability Search
    public function bookSearch(Request $request){
        $request->flash();
        if($request->check_in == $request->check_out){
            $noti = array(
                'message'=>'You need to choose different Date for check out date',
                'alert-type'=>'error'
            );
            return back()->with($noti);
        }

        $inDate = date('Y-m-d',strtotime($request->check_in));
        $outDate = date('Y-m-d',strtotime($request->check_out));
        $allDate = Carbon::create($outDate)->subDay();
        $d_period = CarbonPeriod::create($inDate,$allDate);
        $dt_array = [];
        foreach($d_period as $period){
            array_push($dt_array,date('Y-m-d',strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('room_numbers')->where('status',1)->get();

        return view('user.room.search_room',compact('room','check_date_booking_ids'));

    }
}
