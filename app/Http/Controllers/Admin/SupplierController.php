<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Supplier::all();
        return view('admin.supplier.index',compact('data'));
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
                's_name'          => 'required',
                's_email'         => 'email   |unique:suppliers|max:255',
                's_phone'         => 'required|unique:suppliers|max:255',
                's_code'         => 'required|unique:suppliers|max:255',
                's_company_name'  => 'required|unique:suppliers|max:255',
                's_company_phone' => 'required|unique:suppliers|max:255',
            ]);

        $data                  = new Supplier();
        $data->s_name          = $request->s_name;
        $data->s_phone         = $request->s_phone;
        $data->s_email         = $request->s_email;
        $data->s_address       = $request->s_address;
        $data->s_company_name  = $request->s_company_name;
        $data->s_company_phone = $request->s_company_phone;
        $data->s_code          = $request->s_code;
        $data->save();

        $notification     = array(
        'messege'         =>'Successfully Created !',
        'alert-type'      =>'success'
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
        $data = Supplier::find($id);
        return view('admin.supplier.ajax.edit',compact('data'));
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
        's_name'          => 'required',
        's_email'         => 'email   |unique:suppliers,s_email,'.$id,
        's_phone'         => 'required|unique:suppliers,s_phone,'.$id,
        's_company_name'  => 'required|unique:suppliers,s_company_name,'.$id,
        's_company_phone' => 'required|unique:suppliers,s_company_phone,'.$id,
        ]);

        $data                  = Supplier::find($id);
        $data->s_name          = $request->s_name;
        $data->s_phone         = $request->s_phone;
        $data->s_email         = $request->s_email;
        $data->s_address       = $request->s_address;
        $data->s_company_name  = $request->s_company_name;
        $data->s_company_phone = $request->s_company_phone;
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
        $data         = Supplier::find($id)->delete();
        $notification = array(
        'messege'     =>'Successfully Deleted !',
        'alert-type'  =>'success'
         );
        return back()->with($notification);
    }



    public function active($id)
    {
       $data         = Supplier::find($id);
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
       $data         = Supplier::find($id);
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
            Supplier::where('id',$row)->delete();
        }

        $notification = array(
        'messege'     =>'Successfully Selected Delete',
        'alert-type'  =>'success'
         );

        return back()->with($notification);
    }

    //____Supplier Code Generate_____//

    public function code()
    {
        $data = Supplier::latest()->first();

        if($data){
            $s_code = ++$data->s_code;
        }else{
          $s_code = 1001;  
        }

        return response()->json($s_code);

    }
}
