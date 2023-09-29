<?php

namespace App\Http\Controllers;

use App\Models\book_area;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BookAreaController extends Controller
{
    //Book Area Page
    public function page(){
        $data = book_area::find(1);
        return view('admin.team.booking_area',compact('data'));
    }

    //update booking area
    public function update(Request $request){
        $id = $request->id;
        $this->bookingUpdate($request);
        $data = [
            'short_title'=>$request->short_title,
            'main_title'=>$request->main_title,
            'link_url'=>$request->link_url,
            'short_description'=>$request->description,
        ];
        if($request->hasFile('image')){
            $oldImage = book_area::where('id',$id)->first();
            $oldImage = $oldImage->image;
            unlink($oldImage);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $path = 'upload/team/' . $name_gen;
            Image::make($image)->resize(1000,1000)->save($path);
            $data['image'] = $path;
        }
        book_area::where('id',$id)->update($data);
        $noti = array(
            'message'=>'Edit Booking Area Successful.',
            'alert-type'=>'success'
        );
        return back()->with($noti);
    }

    //Booking area validation
    private function bookingUpdate($request){
        Validator::make($request->all(),[
            'image'=>'mimes:png,jpg,avif,jpeg'
        ])->validate();
    }
}
