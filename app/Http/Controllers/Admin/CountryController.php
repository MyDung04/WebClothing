<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        $data  = Country::all();
        return view("admin.country.country", compact('data'));
    }
    public function GetAdd()
    {
        //

        return view("admin.country.add");
    }
    public function PostAdd(Request $request)
    {
        //
        $data = $request->all();
        if (Country::create($data)) {
            $data  = Country::all();
            return view("admin.country.country", compact('data'));
        }


        return view("admin.country.add");
    }

    public function GetEdit($id)
    {
        //
        $country = Country::find($id);

        return view("admin.country.edit", compact('country'));
    }

    public function PostEdit(Request $request, $id)
    {
        //
        $country = Country::findOrFail($id);
        $infor = $request->all();
        if ($country->update($infor)) {
            $data = Country::all();
            return view("admin.country.country", compact('data'));
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }

    public function Delete($id)
    {
        Country::where('id', $id)->delete();
        $data = Country::all();
        return view("admin.country.country", compact('data'));
    }
    public function index()
    {
        //
        // return view("admin.country.country");
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
