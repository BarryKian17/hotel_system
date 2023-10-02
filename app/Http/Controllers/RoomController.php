<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //Room Edit Page
    public function edit($id){
        $type = RoomType::where('id',$id)->get();
        $basic_facility = Facility::where('rooms_id',$id)->get();
        $room = Room::where('room_type_id',$id)->get();
        return view('admin.room_section.room.room_edit',compact('room','type','basic_facility'));
    }
}
