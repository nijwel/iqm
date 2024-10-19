<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AmountPaid;
use App\Models\Admin\Customer;

class AmountPaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AmountPaid::latest()->get();
        $customers = Customer::latest()->get();
        return view('admin.amount_paid.index',compact('data','customers'));
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
        $customer = Customer::where('id',$request->customer_id)->first();

        $data = new AmountPaid();
        $data->customer_id = $request->customer_id;
        $data->amount = $request->amount;
        $data->due_left = $customer->due - $request->amount;
        $data->date = date('Y-m-d');
        $data->save();

        Customer::where('id',$request->customer_id)->decrement('due',$request->amount);
        $notification        = array(
            'messege'            =>'Successfully Created !',
            'alert-type'         =>'success'
         );
        return redirect()->back()->with($notification);
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
        $data = AmountPaid::find($id);
        $customers = Customer::latest()->get();
        return view('admin.amount_paid.ajax.edit',compact('data','customers'));
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
        $customer = Customer::where('id',$request->customer_id)->first();

        $data = AmountPaid::find($id);

        Customer::where('id',$data->customer_id)->increment('due',$data->amount);
        Customer::where('id',$data->customer_id)->decrement('due',$request->amount);
        AmountPaid::where('id',$id)->increment('due_left',$data->amount);
        AmountPaid::where('id',$id)->decrement('due_left',$request->amount);

        $data->amount = $request->amount;
        $data->save();
        $notification        = array(
            'messege'            =>'Successfully Updated !',
            'alert-type'         =>'success'
         );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AmountPaid::find($id);
        Customer::where('id',$data->customer_id)->increment('due',$data->amount);
        $data->delete();
        $notification        = array(
            'messege'            =>'Successfully Deleted !',
            'alert-type'         =>'success'
         );
        return redirect()->back()->with($notification);

    }
}
