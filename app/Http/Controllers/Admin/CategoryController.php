<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $data  = Category::all();
        return view("admin.category.category", compact('data'));
    }
    public function GetAdd()
    {
        //

        return view("admin.category.add");
    }
    public function PostAdd(Request $request)
    {
        //
        $data = $request->all();
        if (Category::create($data)) {
            $data  = Category::all();
            return view("admin.category.category", compact('data'));
        }


        return view("admin.category.add");
    }

    public function GetEdit($id)
    {
        //
        $category = Category::find($id);

        return view("admin.category.edit", compact('category'));
    }

    public function PostEdit(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $infor = $request->all();
        if ($category->update($infor)) {
            $data = Category::all();
            return view("admin.category.category", compact('data'));
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }

    public function Delete($id)
    {
        Category::where('id', $id)->delete();
        $data = Category::all();
        return view("admin.category.category", compact('data'));
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
