<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\Admin\Product;
use App\Models\Admin\Sale;
use App\Models\Admin\SaleDetails;
use Illuminate\Http\Request;

class SaleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexIqm() {
        $data      = Sale::where( 'shop_name', 'iqm' )->latest()->get();
        $shop_name = 'iqm';
        return view( 'admin.sale.index', compact( 'data', 'shop_name' ) );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexKkm() {
        $data      = Sale::where( 'shop_name', 'kkm' )->latest()->get();
        $shop_name = 'kkm';
        return view( 'admin.sale.index', compact( 'data', 'shop_name' ) );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMn() {
        $data      = Sale::where( 'shop_name', 'mn' )->latest()->get();
        $shop_name = 'mn';
        return view( 'admin.sale.index', compact( 'data', 'shop_name' ) );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexInvoice() {
        $data      = Sale::where( 'shop_name', '!=', 'kkm' )->where( 'shop_name', '!=', 'iqm' )->latest()->get();
        $shop_name = 'invo';
        return view( 'admin.sale.index', compact( 'data', 'shop_name' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIqm() {
        $product  = Product::all();
        $shop     = "iqm";
        $customer = Customer::where( 'name', 'iqm' )->select( 'id', 'name', 'due' )->first();
        return view( 'admin.sale.create', compact( 'product', 'shop', 'customer' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createKkm() {
        $product  = Product::all();
        $shop     = "kkm";
        $customer = Customer::where( 'name', 'kkm' )->select( 'id', 'name', 'due' )->first();
        return view( 'admin.sale.create', compact( 'product', 'shop', 'customer' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMn() {
        $product  = Product::all();
        $shop     = "mn";
        $customer = Customer::where( 'name', 'mn' )->select( 'id', 'name', 'due' )->first();
        return view( 'admin.sale.create', compact( 'product', 'shop', 'customer' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createInvoice() {
        $product     = Product::all();
        $excludedIds = ['iqm', 'kkm', 'mn'];
        $customers   = Customer::whereNotIn( 'name', $excludedIds )->get();

        return view( 'admin.sale.invo_create', compact( 'product', 'customers' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $sale              = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->shop_name   = $request->shop_name;
        $sale->invoice_no  = $request->invoice_no;
        $sale->sale_date   = $request->sale_date;
        $sale->total       = $request->total_price;
        $sale->due         = $request->due;
        $sale->paid        = $request->paid;
        $sale->g_total     = $request->g_total;
        $sale->save();

        Customer::where( 'id', $request->customer_id )->update( [
            'due' => $request->g_total,
        ] );

        $sale_id = $sale->id;

        $items            = $request->product_id;
        $item_price       = $request->item_price;
        $item_qty         = $request->item_qty;
        $item_total_price = $request->item_total_price;

        foreach ( $items as $key => $item ) {
            $data_details                   = new SaleDetails();
            $data_details->sale_id          = $sale_id;
            $data_details->product_id       = $item;
            $data_details->item_price       = $item_price[$key];
            $data_details->item_qty         = $item_qty[$key];
            $data_details->item_total_price = $item_total_price[$key];
            $data_details->save();
        }

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
        $data = Sale::where( 'id', $id )->with( 'sale_details' )->first();
        return view( 'admin.sale.view', compact( 'data' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $data    = Sale::find( $id )->with( 'sale_details' )->first();
        $product = Product::all();
        return view( 'admin.sale.edit', compact( 'data', 'product' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $data         = Sale::find( $id )->delete();
        $notification = [
            'messege'    => 'Successfully deleted !',
            'alert-type' => 'success',
        ];
        return back()->with( $notification );

    }

    public function getPrice( $product_id ) {
        $data = Product::where( 'id', $product_id )->select( 'buying_price', 'whole_sale' )->first();
        return response()->json( $data );
    }
}