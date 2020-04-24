<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;
use Intervention\Image\Facades\Image;
use File;


class SlotController extends Controller
{
    public function imageInsert(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');
        $image_name = null;
        if($request->hasfile('image')){
            $destination = public_path('images/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".$request->input('name')."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/thumb/').$image_name;
            Image::make($image)
            ->resize(300, 400)
            ->save($thumb_path);
        }

        $image_insert = DB::table('image_data')->insert([
            'name' => $request->input('name'),
            'image' => $image_name,            
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);
        if ($image_insert) {
            return redirect()->back()->with('message','Image Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function userEdit($user_id)
    {
        $slot_data = DB::table('user')->where('id',$user_id)->first();
        return view('admin.slot_edit',compact('slot_data'));
    }

    public function userUpdate(Request $request)
    {
        $this->validate($request, [
            'id'   => 'required|numeric',
            'mobile'   => 'required'
        ]);
        $id = $request->input('id');
        $mobile = $request->input('mobile');
        DB::table('user')
            ->where('id',$id)
            ->update([
                'mobile' => $mobile,                      
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
       
  
        return redirect()->back()->with('message',"Mobile Number Changed Successfully");
    }

    public function slotDelete($slot_id)
    {
        DB::table('image_data')->where('id',$slot_id)->delete();
        return redirect()->back();
    }
}
