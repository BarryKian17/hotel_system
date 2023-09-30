<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    //Room Type list
    public function list(){
        $list = RoomType::get();
        return view('admin.room_section.room_type.list',compact('list'));
    }

    //Room Type add page
    public function addPage(){
        return view('admin.room_section.room_type.add_room_type');
    }

    //Room Type Create
    public function create(Request $request){
        $data = ['name'=>$request->name];
        $room_id = RoomType::insertGetId($data);
        Room::insert([
            'room_type_id'=>$room_id
        ]);
        $noti = array(
            'message'=>'Room Type Create Successful.',
            'alert-type'=>'success'
        );
        return redirect()->route('room.type.list')->with($noti);
    }
}
