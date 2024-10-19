<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Size::all();
        return view('admin.size.index',compact('data'));
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
        'size'     => 'required|unique:sizes|max:255',
            ]);

        $data         = new Size();
        $data->size   = $request->size;
        $data->save();
        $notification = array(
        'messege'     =>'Successfully Created !',
        'alert-type'  =>'success'
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
        $data = Size::find($id);
        return view('admin.size.ajax.edit',compact('data'));
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
        'size' => 'required|unique:sizes,size,'.$id,
            ]);

        $data                = Size::find($id);
        $data->size          = $request->size;
        $data->save();
        
        $notification        = array(
        'messege'            =>'Successfully Updated !',
        'alert-type'         =>'success'
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
        $data         = Size::find($id)->delete();
        $notification = array(
        'messege'     =>'Successfully Deleted !',
        'alert-type'  =>'success'
         );
        return back()->with($notification);
    }



    public function active($id)
    {
       $data         = Size::find($id);
       $data->status = 0;
       $data->save();
       $notification = array(
       'messege'     =>'Successfully Deactive',
       'alert-type'  =>'success'
        );

       return back()->with($notification); 
    }


    public function deactive($id)
    {
       $data         = Size::find($id);
       $data->status = 1;
       $data->save();
       $notification = array(
       'messege'     =>'Successfully Active',
       'alert-type'  =>'success'
        );

       return back()->with($notification); 
    }

    public function multiDelete(Request $request)
    {
        $data = $request->ids;

        foreach($data ?: [] as $row){
            Size::where('id',$row)->delete();
        }

        $notification = array(
        'messege'     =>'Successfully Selected Delete',
        'alert-type'  =>'success'
         );

        return back()->with($notification);
    }
}
