<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use Str;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Brand::all();
        return view('admin.brand.index',compact('data'));
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
                'brand_name' => 'required|unique:brands|max:255',
                'brand_image' => 'required | mimes:jpeg,jpg,png, | max:1000',
            ]);

        $image = $request->file('brand_image');

        $data = new Brand();
        $data->brand_name = $request->brand_name;
        $data->brand_slug = Str::slug($request->brand_name);
        if($image){
            $imageName     = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(50,50)->save('public/backend/images/brand/'.$imageName);   
            $upload_image  = 'public/backend/images/brand/'.$imageName;
            $data->brand_image = $upload_image;
        }
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
        $data = Brand::find($id);
        return view('admin.brand.ajax.edit',compact('data'));
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
                'brand_name' => 'required|unique:brands,brand_name,'.$id,
                'brand_image' => 'mimes:jpeg,jpg,png, | max:1000',
            ]);
        $image = $request->file('brand_image');

        $data = Brand::find($id);
        $data->brand_name = $request->brand_name;
        $data->brand_slug = Str::slug($request->brand_name);

        if($image){
            $imageName     = uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(50,50)->save('public/backend/images/brand/'.$imageName);   
            $upload_image  = 'public/backend/images/brand/'.$imageName;
            
            if(file_exists($data->brand_image)){
                unlink($data->brand_image);
            }

            $data->brand_image = $upload_image;
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
        $data = Brand::find($id);
        if(file_exists($data->brand_image)){
            unlink($data->brand_image);
        }
        $data->delete();
        $notification = array(
            'messege' =>'Successfully Deleted !',
            'alert-type'=>'success'
         );
        return back()->with($notification);
    }


    public function active($id)
    {
       $data         = Brand::find($id);
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
       $data         = Brand::find($id);
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
        $data = Brand::whereIn('id',$request->ids)->get();

        foreach($data ?: [] as $row){

            if(file_exists($row->brand_image)){
                unlink($row->brand_image);
            }
            $row->delete();
        }

        $notification = array(
            'messege' =>'Successfully Selected Delete',
            'alert-type'=>'success'
         );

        return back()->with($notification);
    }
}
