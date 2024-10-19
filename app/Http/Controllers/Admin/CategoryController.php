<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Category::all();
        return view( 'admin.category.index', compact( 'data' ) );
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
            'category' => 'required|unique:categories|max:255',
        ] );

        $data                = new Category();
        $data->category      = $request->category;
        $data->category_slug = Str::slug( $request->category );
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
        $data = Category::find( $id );
        return view( 'admin.category.ajax.edit', compact( 'data' ) );
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
            'category' => 'required|unique:categories,category,' . $id,
        ] );

        $data                = Category::find( $id );
        $data->category      = $request->category;
        $data->category_slug = Str::slug( $request->category );
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
        $data         = Category::find( $id )->delete();
        $notification = [
            'messege'    => 'Successfully Deleted !',
            'alert-type' => 'success',
        ];
        return back()->with( $notification );
    }

    public function active( $id ) {
        $data         = Category::find( $id );
        $data->status = 0;
        $data->save();
        $notification = [
            'messege'    => 'Successfully Deactive',
            'alert-type' => 'success',
        ];

        return back()->with( $notification );
    }

    public function deactive( $id ) {
        $data         = Category::find( $id );
        $data->status = 1;
        $data->save();
        $notification = [
            'messege'    => 'Successfully Active',
            'alert-type' => 'success',
        ];

        return back()->with( $notification );
    }

    public function multiDelete( Request $request ) {
        $data = $request->ids;

        foreach ( $data ?: [] as $row ) {
            Category::where( 'id', $row )->delete();
        }

        $notification = [
            'messege'    => 'Successfully Selected Delete',
            'alert-type' => 'success',
        ];

        return back()->with( $notification );
    }
}