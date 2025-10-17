<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list()
    {
        //
        $data  = Brand::all();
        return view("admin.brand.brand", compact('data'));
    }
    public function GetAdd()
    {
        //

        return view("admin.brand.add");
    }
    public function PostAdd(Request $request)
    {
        //
        $data = $request->all();
        if (Brand::create($data)) {
            $data  = Brand::all();
            return view("admin.brand.brand", compact('data'));
        }


        return view("admin.brand.add");
    }

    public function GetEdit($id)
    {
        //
        $brand = Brand::find($id);

        return view("admin.brand.edit", compact('brand'));
    }

    public function PostEdit(Request $request, $id)
    {
        //
        $brand = Brand::findOrFail($id);
        $infor = $request->all();
        if ($brand->update($infor)) {
            $data = Brand::all();
            return view("admin.brand.brand", compact('data'));
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }

    public function Delete($id)
    {
        Brand::where('id', $id)->delete();
        $data = Brand::all();
        return view("admin.brand.brand", compact('data'));
    }
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
