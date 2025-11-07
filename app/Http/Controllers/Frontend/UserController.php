<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Mail\ForgotMail;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetRegister()
    {
        return view('frontend.member.register');
    }
    public function PostRegister(ProfileRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
            $file->move('assets/images/blogs', $file->getClientOriginalName());
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }
        $data['level'] = 0;
        User::create($data);
        return redirect()->route('memberlogin')->with('success', 'Dang nhap thanh cong');
    }
    public function GetMemberLogin()
    {
        return view('frontend.member.login');
    }
    public function PostMemberLogin(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = $request->has('remember_me');

        if (Auth::attempt($login, $remember)) {
            if (Auth::user()->level == 0) {
                return redirect()->intended('/member/dashboard');
            } else {
                return redirect()->intended('/member/login');
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Email hoặc mật khẩu không đúng!']);
        }
    }

    public function logout()
    {

        Auth::logout();
        session()->flush();
        return redirect('/member/login');
    }

    public function GetForgot()
    {
        return view('frontend.member.forgot');
    }
    public function PostForgot(Request $request)
    {

        $email = $request->email;
        if (empty($email)) {
            return back()->withErrors(['error' => 'Bạn chưa nhập email!']);
        }
        Mail::to($email)->send(new ForgotMail($email));
        return back()->with('success', 'Đã gửi mail thành công!');
    }
    public function GetchangePassword()
    {
        return view('frontend.member.changePassword');
    }
    public function PostchangePassword(Request $request)
    {
        $pass = $request->passnew;
        $email = $request->email;
        $user = User::where('email', $email)->first();
        //  $user->update($data)  đúng khi $data là mảng
        if ($user) {
            $user->password = bcrypt($pass);
            $user->save();
            return redirect()->route('login')->with('success', 'Thay đổi mật khẩu thành công!');
        } else {
            return redirect()->route('changePassword')->withErrors(['fail' => 'Không tìm thấy user!']);
        }
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
