<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomType;
use App\Models\MultiImage;
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

        return view('admin.room_section.room.room_edit',compact('room','type','basic_facility','multiImg'));
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
                $name = time().rand(1,50).'.'.$file->getClientOriginalExtension();
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
}
