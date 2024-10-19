<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AmountPaid;
use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Customer::latest()->get();
        return view( 'admin.customer.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $validated = $request->validate( [
            'name'  => 'required',
            'phone' => 'required|unique:customers|max:255',
            'due'   => 'required',
        ] );

        $data        = new Customer();
        $data->name  = $request->name;
        $data->phone = $request->phone;
        $data->due   = $request->due;
        $data->save();

        $notification = [
            'messege'    => 'Successfully Created !',
            'alert-type' => 'success',
        ];
        return back()->with( $notification );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $data = Customer::find( $id );
        return view( 'admin.customer.ajax.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        $validated = $request->validate( [
            'name'  => 'required',
            'phone' => 'required|unique:suppliers,s_phone,' . $id,
        ] );

        $data        = Customer::find( $id );
        $data->name  = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->due   = $request->due;
        $data->save();
        $notification = [
            'messege'    => 'Successfully Updated !',
            'alert-type' => 'success',
        ];
        return back()->with( $notification );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        AmountPaid::where( 'customer_id', $id )->delete();
        // Sale::where('customer_id',$id)->delete();
        $data         = Customer::find( $id )->delete();
        $notification = [
            'messege'    => 'Successfully Deleted !',
            'alert-type' => 'success',
        ];
        return back()->with( $notification );
    }

    public function getDue( $cus_id ) {
        $customer = Customer::where( 'id', $cus_id )->select( 'name', 'due', 'paid', 'created_at' )->first();

        return response()->json( $customer );
    }
}