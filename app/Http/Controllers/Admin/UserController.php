<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class UserController extends Controller
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

    public function GetProfile()
    {
        $user = Auth::user();
        $country = Country::all();
        // $data = Country::find(Auth::id_country());
        return view("admin.user.profile", compact('user', 'country'));
    }
    public function PostProfile(ProfileRequest $request)
    {
        $id = Auth::id();
        $user = User::findorFail($id);

        $data = $request->all();
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        // if ($data['country']) {
        //     //lay ra id_country
        //     $c = Country::find($data['country']);
        // } else {
        // }
        // if (!empty($data['password']) && $data['password'] == $data['password-c']) {
        //     $data['password'] = bcrypt($data['password']);
        // } else {
        //     $data['password'] = $user->password;
        // }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('assets/images/users', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __("Update profile success"));
        } else {

            return redirect()->back()->withErrors(['error' => 'Update profile error']);
        }

        // $user = User::find(1);
        // return view("admin.user.profile", compact('user'));
    }

    public function GetUser()
    {
        $data = User::all();
        $country = Country::all();
        return view('admin.user.user', compact('data', 'country'));
    }

    public function GetEdit($id)
    {
        $user = User::FindOrFail($id);
        $country = Country::all();
        return view('admin.user.edit', compact('user', 'country'));
    }
    public function PostEdit(Request $request)
    {
        $data = $request->all();
        $user = User::where('id', $data['id'])->first();
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('assets/images/users', $file->getClientOriginalName());
            }
            return redirect()->route('user')->with('success', __("Update profile success"));
        } else {

            return redirect()->back()->withErrors(['error' => 'Update profile error']);
        }
    }

    public function Delete($id)
    {

        User::where('id', $id)->delete();
        $data = User::all();
        $country = Country::all();
        return view("admin.user.user", compact('data', 'country'));
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
