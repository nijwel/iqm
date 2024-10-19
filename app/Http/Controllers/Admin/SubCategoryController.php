<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = SubCategory::all();
        $category = Category::all();
        return view('admin.sub_category.index',compact('data','category'));
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
                'category_id' => 'required',
                'subcategory' => 'required|unique:sub_categories|max:255',
            ]);

        $data = new SubCategory();
        $data->category_id = $request->category_id;
        $data->subcategory = $request->subcategory;
        $data->subcategory_slug = Str::slug($request->subcategory);
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
        $data = SubCategory::find($id);
        $category = Category::all();
        return view('admin.sub_category.ajax.edit',compact('data','category'));
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
                'category_id' => 'required',
                'subcategory' => 'required|unique:sub_categories,subcategory,'.$id,
            ]);

        $data = SubCategory::find($id);
        $data->category_id = $request->category_id;
        $data->subcategory = $request->subcategory;
        $data->subcategory_slug = Str::slug($request->subcategory);
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
        $data = SubCategory::find($id)->delete();
        $notification = array(
            'messege' =>'Successfully Deleted !',
            'alert-type'=>'success'
         );
        return back()->with($notification);
    }



    public function active($id)
    {
       $data         = SubCategory::find($id);
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
       $data         = SubCategory::find($id);
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
            SubCategory::where('id',$row)->delete();
        }

        $notification = array(
            'messege' =>'Successfully Selected Delete',
            'alert-type'=>'success'
         );

        return back()->with($notification);
    }

    public function getSubcategory($cat_id)
    {
        $data = SubCategory::where('category_id',$cat_id)->get();
        return response()->json($data);
    }
}
