<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Size;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {

        $id     = '';
        $search = $request->get( 'search' );
        $data   = Product::get();
        $brands = Category::all();
        return view( 'admin.product.index', compact( 'data', 'brands', 'id' ) );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexId( $category_slug ) {
        $id     = Category::where( 'category_slug', $category_slug )->first();
        $data   = Product::where( 'category_id', $id->id )->get();
        $brands = Category::all();
        return view( 'admin.product.index', compact( 'data', 'brands', 'id' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $category    = Category::where( 'status', 1 )->get();
        $subcategory = SubCategory::where( 'status', 1 )->get();
        $brand       = Brand::where( 'status', 1 )->get();
        $size        = Size::where( 'status', 1 )->get();
        $supplier    = Supplier::where( 'status', 1 )->get();
        return view( 'admin.product.create', compact( 'category', 'subcategory', 'brand', 'size', 'supplier' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $validated = $request->validate( [
            // 'product_name'   => 'required',
            'category_id'    => 'required',
            'subcategory_id' => 'required|unique:products|',
            'buying_price'   => 'required',
            'retail_price'   => 'required',
            'whole_sale'     => 'required',
            'net_price'      => 'required',

            // 'brand_id'       => 'required',
            // 'supplier_id'    => 'required',
            // 'product_code'   => 'required|unique:products|max:255',
        ] );

        $image = $request->file( 'product_image' );

        $data                      = new Product();
        $data->product_name        = $request->product_name;
        $data->product_slug        = Str::slug( $request->product_name );
        $data->product_code        = $request->product_code;
        $data->category_id         = $request->category_id;
        $data->subcategory_id      = $request->subcategory_id;
        $data->brand_id            = $request->brand_id;
        $data->size_id             = $request->size_id;
        $data->supplier_id         = $request->supplier_id;
        $data->admin_id            = Auth::id();
        $data->product_stock       = $request->product_stock;
        $data->net_price           = $request->net_price;
        $data->buying_price        = $request->buying_price;
        $data->retail_price        = $request->retail_price;
        $data->whole_sale          = $request->whole_sale;
        $data->hide_price          = $request->hide_price;
        $data->ex_rate             = $request->ex_rate;
        $data->trans_cost          = $request->trans_cost;
        $data->stock_value         = $request->buying_price * $request->product_stock;
        $data->product_description = $request->product_description;
        if ( $image ) {
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 480, 320 )->save( 'public/backend/images/product/' . $imageName );
            $upload_image        = 'public/backend/images/product/' . $imageName;
            $data->product_image = $upload_image;
        }
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
        $data = Product::where( 'id', $id )->first();
        return view( 'admin.product.view', compact( 'data' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $data        = Product::find( $id );
        $category    = Category::where( 'status', 1 )->get();
        $subcategory = SubCategory::where( 'status', 1 )->get();
        $brand       = Brand::where( 'status', 1 )->get();
        $size        = Size::where( 'status', 1 )->get();
        $supplier    = Supplier::where( 'status', 1 )->get();
        return view( 'admin.product.edit', compact( 'category', 'subcategory', 'brand', 'size', 'supplier', 'data' ) );

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
            // 'product_name'   => 'required',
            // 'category_id'    => 'required',
            // 'brand_id'       => 'required',
            // 'supplier_id'    => 'required',
            // 'product_code'   => 'required|unique:products,product_code,'.$id,

            'category_id'    => 'required',
            'subcategory_id' => 'required',
            'buying_price'   => 'required',
            'retail_price'   => 'required',
            'whole_sale'     => 'required',
        ] );

        $image = $request->file( 'product_image' );

        $data                      = Product::find( $id );
        $data->product_name        = $request->product_name;
        $data->product_slug        = Str::slug( $request->product_name );
        $data->product_code        = $request->product_code;
        $data->category_id         = $request->category_id;
        $data->subcategory_id      = $request->subcategory_id;
        $data->brand_id            = $request->brand_id;
        $data->size_id             = $request->size_id;
        $data->supplier_id         = $request->supplier_id;
        $data->admin_id            = Auth::id();
        $data->product_stock       = $request->product_stock;
        $data->buying_price        = $request->buying_price;
        $data->retail_price        = $request->retail_price;
        $data->whole_sale          = $request->whole_sale;
        $data->net_price           = $request->net_price;
        $data->hide_price          = $request->hide_price;
        $data->ex_rate             = $request->ex_rate;
        $data->trans_cost          = $request->trans_cost;
        $data->product_description = $request->product_description;
        $data->stock_value         = $request->buying_price * $request->product_stock;

        if ( $image ) {
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 480, 480 )->save( 'public/backend/images/product/' . $imageName );
            $upload_image = 'public/backend/images/product/' . $imageName;

            if ( file_exists( $data->product_image ) ) {
                unlink( $data->product_image );
            }

            $data->product_image = $upload_image;
        }
        $data->save();

        $notification = [
            'messege'    => 'Successfully Updated !',
            'alert-type' => 'success',
        ];
        return redirect()->route( 'index.product' )->with( $notification );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $data         = Product::find( $id )->delete();
        $notification = [
            'messege'    => 'Successfully Deleted !',
            'alert-type' => 'success',
        ];
        return back()->with( $notification );
    }

    public function active( $id ) {
        $data         = Product::find( $id );
        $data->status = 0;
        $data->save();
        $notification = [
            'messege'    => 'Successfully Deactive',
            'alert-type' => 'success',
        ];

        return back()->with( $notification );
    }

    public function deactive( $id ) {
        $data         = Product::find( $id );
        $data->status = 1;
        $data->save();
        $notification = [
            'messege'    => 'Successfully Active',
            'alert-type' => 'success',
        ];

        return back()->with( $notification );
    }

    public function productCode( $supplier_id ) {
        $supplier = Supplier::where( 'id', $supplier_id )->first();
        // $product = Product::where('supplier_id',$supplier_id)->first();

        $p = rand( '100000000', '999999999' );
        // if($supplier && $product){
        //      $product_code = ++$product->product_code;
        // }else{
        $product_code = $supplier->s_code . '-' . $p;
        // }

        return response()->json( $product_code );
    }
}