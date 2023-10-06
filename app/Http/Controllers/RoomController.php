<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomType;
use App\Models\MultiImage;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    //Room Edit Page
    public function edit($id){
        $type = RoomType::where('id',$id)->get();
        $room = Room::where('room_type_id',$id)->get();
        $roomId = $room[0]['id'];
        $multiImg = MultiImage::where('rooms_id',$roomId)->get();
        $basic_facility = Facility::where('rooms_id',$roomId)->get();
        $roomNo = RoomNumber::where('rooms_id',$roomId)->get();
        return view('admin.room_section.room.room_edit',compact('room','type','basic_facility','multiImg','roomNo'));
    }

    //Room Update Page
    public function update(Request $request , $id){

        $data = [
            'total_adult'=>$request->total_adult ,
            'total_child'=>$request->total_child ,
            'price'=>$request->price ,
            'discount'=>$request->discount ,
            'size'=>$request->size ,
            'room_capacity'=>$request->room_capacity ,
            'bed_style'=>$request->bed_style ,
            'view'=>$request->view ,
            'short_desc'=>$request->short_desc ,
            'description'=>$request->description ,
            'status'=>1

        ];
        if($request->hasFile('image')){
            $oldImage = Room::where('id',$id)->first();
            $oldImage = $oldImage->image;
            if($oldImage != null){
                $path = 'upload/room/' . $oldImage;
                unlink($path);
            }
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $path = 'upload/room/'.$name_gen;
            Image::make($image)->resize(550,850)->save($path);
            $data['image'] = $name_gen;
        }
        Room::where('id',$id)->update($data);
        if($request->facility_name == null){
            $noti = array(
                'message'=>'No Basic Facilities Selected',
                'alert-type'=>'error'
            );
            return back()->with($noti);
        } else{
            Facility::where('rooms_id',$id)->delete();
            $facilities = Count($request->facility_name);
            for($i=0; $i < $facilities ; $i++){
                $fcount = new Facility();
                $fcount->rooms_id = $id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            }
        }
        if($request->hasfile('multi_image'))
         {

            foreach($request->file('multi_image') as $file)
            {
                $name = time().rand(1,500).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/room/multiImg'), $name);
                $file= new MultiImage();
                $file->rooms_id = $id;
                $file->multi_image = $name;
                $file->save();
            }
         }
        $noti = array(
            'message'=>'Room Update Success',
            'alert-type'=>'success'
        );
        return back()->with($noti);
    }

    public function deleteMulti($id){
        $oldImg = MultiImage::where('id',$id)->get()->toArray();
        foreach($oldImg as $old){
            $deleteImg = $old['multi_image'];
            $path = 'upload/room/multiImg/'.$deleteImg;
            unlink($path);
        }
        MultiImage::where('id',$id)->delete();
        $noti = array(
            'message'=>'Image Delete Success',
            'alert-type'=>'success'
        );
        return back()->with($noti);

    }

    //Room Number Create
    public function create(Request $request){
        $data = [
            'rooms_id'=>$request->rooms_id,
            'room_type_id'=>$request->room_type_id,
            'room_no'=>$request->room_no,
            'status'=>$request->status
        ];
        RoomNumber::create($data);
        $noti = array(
            'message'=>'Room Number Create Success',
            'alert-type'=>'success'
        );
        return back()->with($noti);
    }

    //Room Number Edit
    public function numberEdit($id){
        $roomNumber = RoomNumber::find($id);
        return view('admin.room_section.room.room_no_edit',compact('roomNumber'));
    }

    //Update Room Number
    public function numberUpdate(Request $request,$id){
        $data = [
            'room_no'=>$request->room_no,
            'status'=>$request->status
        ];
        RoomNumber::where('id',$id)->update($data);
        $noti = array(
            'message'=>'Room Number Update Success',
            'alert-type'=>'success'
        );
        return redirect()->route('room.type.list')->with($noti);
    }

    //Delete Room Number
    public function numberDelete($id){
        RoomNumber::where('id',$id)->delete();
        return back();
    }

    // =========== Delete All Room Data ============ //
    public function deleteAll($id){

        //Get Room Id
        $room = Room::where('room_type_id',$id)->get();
        $roomId = $room[0]['id'];

        //Room Delete
        $img = Room::where('id',$roomId)->get();
        $img = $img[0]['image'];
        if($img != null){
            $path = 'upload/room/'.$img;
            unlink($path);
        }
        Room::where('id',$roomId)->delete();

        //Facility Delete
        Facility::where('rooms_id',$roomId)->delete();

        //MultiImage delete
        $oldImg = MultiImage::where('rooms_id',$roomId)->get()->toArray();
        if($oldImg != null){
            foreach($oldImg as $old){
                $deleteImg = $old['multi_image'];
                $path = 'upload/room/multiImg/'.$deleteImg;
                unlink($path);
            }
        }
        MultiImage::where('rooms_id',$roomId)->delete();

        //Room Number Delete
        RoomNumber::where('rooms_id',$roomId)->delete();

        //Room Type Delete
        RoomType::where('id',$id)->delete();

        $noti = array(
            'message'=>'Room Delete Success',
            'alert-type'=>'success'
        );
        return back()->with($noti);
    }
}
