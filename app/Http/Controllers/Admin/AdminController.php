<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Image;
class AdminController extends Controller
{   

    /**
     * Display a profile of the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {   
        $data = User::first();
        return view('admin.admin.profile',compact('data'));
    }

    /**
     * Display a password change page of the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {   
        $data = User::first();
        return view('admin.admin.password',compact('data'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request, $id)
    {   
        $data  = $request->except('_token');
        $image = $request->file('image');
        if($image){
            $imageName     = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(550,550)->save('public/backend/images/user/'.$imageName);   
            $upload_image  = 'public/backend/images/user/'.$imageName;
            $data['image'] = $upload_image;
        }
        User::where('id',$request->id)->update($data);
        return response()->json('successfully Update!');
    }

    public function passwordUpdate(Request $request)
    {
        $password    = Auth::user()->password;
        $oldpass     = $request->old_password;
        $newpass     = $request->new_password;
        $confirmpass = $request->confirm_password;
        if (Hash::check($oldpass,$password)) {
             if ($newpass === $confirmpass) {
                $user           = User::find(Auth::id());
                $user->password = Hash::make($newpass);
                        $user->save();
                        Auth::logout();  
                return response()->json(['success' =>'Successfully Password Update!']);
             }else{
                return response()->json(['error'   =>'Newpassword & Confirm Password Does Not Matched!']);
             }    
        }else{
            return response()->json(['error'=>'Old Password Not Matched!']); 
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
