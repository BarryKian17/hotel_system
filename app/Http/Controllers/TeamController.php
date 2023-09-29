<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;


use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    //Team list page
    public function teamList(){
        $team = Team::get();
        return view('admin.team.list',compact('team'));
    }

    //Team add page
    public function addPage(){
        return view('admin.team.addTeam');
    }

    //member add
    public function add(Request $request){
        $this->memberAdd($request);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $path = 'upload/team/' . $name_gen;
        Image::make($image)->resize(550,670)->save($path);

        $data = [
            'name'=>$request->name,
            'position'=>$request->position,
            'facebook'=>$request->facebook,
            'image'=>$path
        ];
        Team::create($data);
        $noti = array(
            'message'=>'Add member Successful.',
            'alert-type'=>'success'
        );
        return redirect()->route('team.list')->with($noti);

    }

    //Edit page
    public function editPage($id){
        $member = Team::where('id',$id)->first();
        return view('admin.team.editTeam',compact('member'));
    }

    //Update Member
    public function update(Request $request){
        $id = $request->id;
        $this->memberUpdate($request);
        $data = [
            'name'=>$request->name,
            'position'=>$request->position,
            'facebook'=>$request->facebook,
        ];
        if($request->hasFile('image')){
            $oldImage = Team::where('id',$id)->first();
            $oldImage = $oldImage->image;
            unlink($oldImage);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $path = 'upload/team/' . $name_gen;
            Image::make($image)->resize(550,670)->save($path);
            $data['image'] = $path;
        }
        Team::where('id',$id)->update($data);
        $noti = array(
            'message'=>'Edit member Successful.',
            'alert-type'=>'success'
        );
        return redirect()->route('team.list')->with($noti);
    }

    //Delete member
    public function delete($id){
        $image = Team::where('id',$id)->first();
        $image = $image->image;
        unlink($image);
        Team::where('id',$id)->delete();
        $noti = array(
            'message'=>'Delete member Successful.',
            'alert-type'=>'info'
        );
        return redirect()->route('team.list')->with($noti);
    }

    //member add validation
    private function memberAdd($request){
        Validator::make($request->all(),[
            'image'=>'mimes:png,jpg,avif,jpeg'
        ])->validate();
    }

    //member update validation
    private function memberUpdate($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'position'=>'required',
            'facebook'=>'required',
            'image'=>'mimes:png,jpg,avif,jpeg'
        ])->validate();
    }
}
