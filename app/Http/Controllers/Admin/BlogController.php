<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ham khoi taoj cua huong doi tuong 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list()
    {
        //
        $data  = Blog::paginate(2);
        return view("admin.blog.blog", compact('data'));
    }
    public function GetAdd()
    {
        //

        return view("admin.blog.add");
    }
    public function PostAdd(BlogRequest $request)
    {
        $data = $request->all();
        $file = $request->image;
        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
            $file->move('assets/images/blogs', $file->getClientOriginalName());
        }
        Blog::create($data);
        // Quay về trang list
        return redirect()->route('blog')->with('success', 'Thêm blog thành công!');
    }

    public function GetEdit($id)
    {
        //
        $blog = Blog::find($id);

        return view("admin.blog.edit", compact('blog'));
    }

    public function PostEdit(BlogRequest $request, $id)
    {
        //
        $blog = Blog::findOrFail($id);
        $infor = $request->all();
        if ($blog->update($infor)) {
            // Quay về trang list
            return redirect()->route('blog')->with('success', 'Thêm blog thành công!');
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }

    public function Delete($id)
    {
        Blog::where('id', $id)->delete();
        $data = Blog::all();
        return view("admin.blog.blog", compact('data'));
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
