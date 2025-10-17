<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Cmt;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BlogListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bloglist()
    {
        //
        $data = Blog::paginate(3);

        return view("frontend.blog.bloglist", compact('data'));
    }
    public function blogdetail($id)
    {

        $prev = null;
        $next = null;
        $blog = Blog::find($id);
        $prev = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $next = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $avgRate = Rate::where('id_blog', $id)->avg('rate');
        $avgRate = round($avgRate,);
        $cmt = Cmt::where('id_blog', $id)->get();
        // if (!$blog) {
        //     return view("frontend.member.login");
        // } else {
        return view("frontend.blog.blogdetail", compact('blog', 'next', 'prev', 'avgRate', 'cmt'));
        // }
    }
    public function rate(Request $request)
    {
        $check = Rate::where('id_blog', $request->id_blog)
            ->where('id_user', $request->id_user)
            ->exists();
        if ($check) {
            return response()->json('Fail');
        } else {
            $data = [
                'rate' => $request->rate,
                'id_blog' =>  $request->id_blog,
                'id_user' => $request->id_user,
                'level' => 0,
                'created_at' => now(),
            ];
            Rate::create($data);
            return response()->json('success');
        }

        // 
    }
    public function cmt(Request $request)
    {
        // $infor_blog = Blog::Find($id);
        $user = Auth::user();
        $data = [


            //ajax
            'cmt' => $request->cmt,
            // 'id_blog' =>  $request->id_blog,
            'id_blog' => $request->id_blog,
            'id_user' => $request->id_user,
            'user_name' => $request->user_name,
            'avatar' =>  $request->avatar,

            'level' => $request->level ?  $request->level  : 0,
            'created_at' => now(),
            //js
            // 'cmt' => $request->cmt,
            // // 'id_blog' =>  $request->id_blog,
            // 'id_blog' => $id,
            // 'id_user' => $user->id,
            // 'user_name' => $user->name,
            // 'avatar' => asset('/assets/images/blogs/' . $user->avatar),

            // 'level' => 0,
            // 'created_at' => now(),
        ];
        // if (Cmt::create($data)) {
        //     $prev = null;
        //     $next = null;
        //     $blog = Blog::find($id);
        //     $prev = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        //     $next = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        //     $avgRate = Rate::where('id_blog', $id)->avg('rate');
        //     $avgRate = round($avgRate,);
        //     $cmt = Cmt::where('id_blog', $id)->get();

        //     return view("frontend.blog.blogdetail", compact('blog', 'next', 'prev', 'avgRate', 'cmt'));
        // }


        //ajax
        if (Cmt::create($data)) {

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Loi '
            ]);
        }
    }
    public function reply(Request $request)
    {
        $id = $_POST['id'];
        $data = Cmt::Find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    // public function reply(Request $request)
    // {
    //     // Log::info('Dữ liệu nhận được:', $request->all());
    //     $data = [
    //         'cmt' => $request->cmt,
    //         'id_blog' =>  $request->id_blog,
    //         'id_user' => $request->id_user,
    //         'user_name' => $request->user_name,
    //         'avatar' => $request->avatar,
    //         'level' => $request->id,
    //         'created_at' => now(),

    //     ];
    //     if (Cmt::create($data)) {
    //         return response()->json(['data' => $data]);
    //     } else {
    //         return response()->json(['success' => false], 500);
    //     }
    // }
    public function index()
    {
        //
        return view("frontend.blog.bloglist");
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
