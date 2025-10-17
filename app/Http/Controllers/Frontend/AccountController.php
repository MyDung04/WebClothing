<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetAccount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            $data = Auth::user();

            return view("frontend.account.account", compact('data'));
        }
    }
    public function Xuly(Request $request)
    {
        $user = Auth::user();
        $product = Product::where('id_user', $user->id)->get();
        $data = $request->all();
        $data['id_user'] = Auth::id();
        $img = [];
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $item) {
                $image = Image::make($item);
                $time = strtotime(date('Y-m-d H:i:s'));
                $name =  $time . $item->getClientOriginalName();
                $name_2 = "hinh50_" . $time . $item->getClientOriginalName();
                $name_3 = "hinh200_" . $time . $item->getClientOriginalName();
                // $check = 0;

                // foreach ($product as $it) {
                //     $images = json_decode($it->image, true);
                //     foreach ($images as $i) {
                //         if ($i == $name) {
                //             $check = 1;
                //             break;
                //         }
                //     }
                // }
                // if ($check == 1) {
                //     return $img = [];
                // }
                // if ($check == 0) {
                $dir = public_path('frontend/images/products/' . $data['id_user']);

                if (!is_dir($dir)) {
                    mkdir($dir); // Tạo thư mục 
                }
                $path = $dir . '/' . $name;
                $path_2 = $dir . '/' . $name_2;
                $path_3 = $dir . '/' . $name_3;
                $image->save($path);
                $image->resize(85, 84)->save($path_2);

                $image->resize(329, 380)->save($path_3);
                $img[] = $name;
                // }
            }
            return $img;
        }

        // xxx.png  ao nam 

        // xxx.png ao nu 


        // frontend/images/products/1/ 

        // frontend/images/products/2/
    }

    //update account
    public function PostAccount(ProfileRequest $request)
    {


        $id = Auth::id();
        $user = User::findorFail($id);
        $data = $request->all();

        $file = $request->file('avatar');
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
            $file->move('assets/images/blogs', $file->getClientOriginalName());
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            return redirect()->route('account.update')->with('success', 'Update thanh cong');
        } else {
            return redirect()->route('account.update')->withErrors('Fail', 'Loi');
        }
    }
    //myproduct
    public function myproduct()
    {
        $user = Auth::user();
        $data = Product::where('id_user', $user->id)->get();
        // if ($data)
        //     foreach ($data as $product) {
        //         $image = json_decode($product->image, true);
        //         $product->first = !empty($image) ? $image[0] : '';
        //     }
        return view('frontend.account.myproduct', compact('data'));
    }
    //addproduct
    public function GetProduct()
    {
        $id_category = Category::all();
        $id_brand = Brand::all();

        return view('frontend.account.addproduct', compact('id_category', 'id_brand'));
    }
    public function PostProduct(Request $request)
    {

        $data = $request->all();
        $img = $this->Xuly($request);
        //dd($img);
        if (empty($img)) {
            return redirect()->route('account.addproduct')->withErrors('Anh trung ten.');
        } else {

            $data['id_user'] = Auth::id();

            // json_encode:chuyen mảng sang chuỗi
            $data['image'] = json_encode($img);
            if (Product::create($data)) {
                return redirect()->route('account.myproduct')->with('success', 'Update thanh cong');
            } else {
                return redirect()->route('acc ount.addproduct')->withErrors('Fail', 'Loi');
            }
        }
        // $product = new Product();

    }
    //editproduct
    public function GetEdit($id)
    {
        $product = Product::find($id);
        $id_category = Category::all();
        $id_brand = Brand::all();
        $image = json_decode($product->image, true);

        return view('frontend.account.editproduct', compact('product', 'id_category', 'id_brand', 'image'));
    }
    public function PostEdit(Request $request, $id)
    {



        // $this->GetEdit()
        $product = Product::FindOrFail($id);
        $data = $request->all();
        //lay hinh anhcan xoa
        $image_del = $request->input('hinhxoa', []);
        //lay hinh anh trong db
        $image_db = json_decode($product->image, true);
        if (!empty($image_del)) {
            foreach ($image_db as $key => $img) {
                if (in_array($img, $image_del)) {
                    unset($image_db[$key]);
                }
            }
        }
        // dd($request->img());
        // $img = [];
        // if ($request->hasFile('img')) {
        //     foreach ($request->file('img') as $item) {
        //         $image = Image::make($item);

        //         $name = $item->getClientOriginalName();
        //         $name_2 = "hinh50_" . $item->getClientOriginalName();
        //         $name_3 = "hinh200_" . $item->getClientOriginalName();

        //         $path = public_path('frontend/images/products/' . $name);
        //         $path_2 = public_path('frontend/images/products/' . $name_2);
        //         $path_3 = public_path('frontend/images/products/' . $name_3);

        //         $image->save($path);
        //         $image->resize(85, 84)->save($path_2);

        //         $image->resize(329, 380)->save($path_3);
        //         $img[] = $name;
        //     }
        // }
        $this->Xuly($request);
        $arr_merge = array_merge($image_db, $img);
        reset($arr_merge);
        if (count($arr_merge) > 3) {
            return redirect()->route('editproduct', ['id' => $id])->withErrors('Chi tai toi da 3 anh');
        } else {
            $data['id_user'] = Auth::id();
            $data['image'] = json_encode($arr_merge);
            if ($product->update($data)) {
                return redirect()->route('myproduct')->with('success', 'Update thanh cong');
            } else {
                return redirect()->route('editproduct', ['id' => $id])->withErrors('Loi');
            }
        }
    }
    //delproduct
    public function GetDelete($id)
    {
        Product::where('id', $id)->delete();
        //Product::destroy($id);
        return redirect()->route('account.myproduct')->with('success', 'Xoa thanh cong');
    }
    public function index()
    {
        //
        return view("frontend.account.account");
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
