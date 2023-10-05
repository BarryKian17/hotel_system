<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use Illuminate\Http\Request;
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
}
