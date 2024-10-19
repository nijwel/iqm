<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('user_type',2)->get();
        return view('admin.user.index',compact('data'));
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
        $validated = $request->validate([
            'email'    => 'required|unique:users|',
            'password'    => 'required',
        ]);

        $data            = new User();
        $data->user_name = $request->user_name;
        $data->full_name = $request->user_name;
        $data->email     = $request->email;
        $data->password  = Hash::make($request->password);
        $data->user_type = 2;
        $data->save();

        $notification = array(
            'messege' =>'Successfully Created !',
            'alert-type'=>'success'
         );
        return back()->with($notification);
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
        $data = User::find($id);
        return view('admin.user.ajax.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email'   => 'required|unique:users,email,'.$id,
        ]);

        $data            = User::find($id);
        $data->user_name = $request->user_name;
        $data->full_name = $request->user_name;
        $data->email     = $request->email;
        if($request->password){
            $data->password  = Hash::make($request->password);
        }
        
        $data->save();
        $notification = array(
            'messege' =>'Successfully Updated !',
            'alert-type'=>'success'
         );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = User::find($id)->delete();
        $notification = array(
            'messege' =>'Successfully Deleted !',
            'alert-type'=>'success'
         );
        return back()->with($notification);
    }
}
