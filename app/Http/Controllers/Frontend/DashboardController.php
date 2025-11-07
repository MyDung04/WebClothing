<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;
use Symfony\Component\Console\Input\Input;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $category = Category::all();
        $brand = Brand::all();
        $product = Product::orderBy('created_at', 'desc')->take(6)->get();
        return view('frontend.dashboard.dashboard', compact('category', 'brand', 'product'));
    }

    public function cartajax(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $cart = session()->get('cart', []);
        $err = 1;
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += 1;
                $err = 0;
            }
        }
        unset($item);  //lay dung vi tri
        if ($err == 1) {
            $image = json_decode($data->image, true);
            $cart[] = [
                'id' => $data->id,
                'title' => $data->title,
                'price' => $data->price,
                'image' => $image[0],
                'quantity' => 1,
            ];
        }
        session()->put('cart', $cart);
        foreach ($cart as $item) {
            if ($item['id'] == $id) {
                $quantity = $item['quantity'];
                $total_price = (int) $item['quantity'] * (int)($item['price']);
                break;
            }
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'];
        }
        $total_big = 0;
        $total1 = 0;
        foreach ($cart as $item) {

            $total1 = (int) $item['quantity'] * (int)($item['price']);
            $total_big += $total1;
        }
        return response()->json(
            [
                'status' => 'success',
                'total' => $total,
                'quantity' => $quantity,
                'total_price' =>  $total_price,
                'total_big' => $total_big,
            ]
        );
    }
    public function cartajaxdown(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $cart = session()->get('cart', []);
        $err = 1;
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] -= 1;
                $err = 0;
            }
        }
        unset($item); // Quan trọng: tránh lỗi tham chiếu khi thêm mới

        session()->put('cart', $cart);
        foreach ($cart as $item) {
            if ($item['id'] == $id) {
                $quantity = $item['quantity'];
                $total_price = (int) $item['quantity'] * (int)($item['price']);

                break;
            }
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'];
        }
        $total_big = 0;
        $total = 0;
        foreach ($cart as $item) {
            $total = (int) $item['quantity'] * (int)($item['price']);
            $total_big += $total;
        }
        //session()->forget('cart');
        return response()->json(
            [
                'status' => 'success',
                'total' => $total,
                'quantity' => $quantity,
                'total_price' =>  $total_price,
                'total_big' => $total_big,
            ]
        );
    }

    public function cartajaxdel(Request $request)
    {
        $id = $request->id;
        // return response()->json(['status' => 'success', 'id' => $id]);
        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }
        session()->put('cart', $cart);
        $total_big = 0;
        $total = 0;
        foreach ($cart as $item) {
            $total = (int) $item['quantity'] * (int)($item['price']);
            $total_big += $total;
        }

        //session()->forget('cart');
        return response()->json(
            [
                'status' => 'success',
                'total_big' => $total_big,

            ]
        );
    }


    public function Search(Request $request)
    {
        // return view('frontend.dashboard.search');
        $text = $request->search;
        $product = Product::where("title", 'LIKE',  "%{$text}%")->get();
        return view('frontend.dashboard.search', compact('product'));
    }

    public function GetSearch()
    {
        return view('frontend.dashboard.search');
    }
    public function SearchAdvance(Request $request)
    {
        // dd($request->all());
        $product = Product::query();
        $check = 0;
        if (!empty($request->search)) {
            $text = $request->search;
            $product = $product->where("title", 'LIKE', "%{$text}%");
        }
        if (!empty($request->price)) {
            [$min, $max] = explode('-', $request->price);
            $product->whereBetween('price', [(int)$min, (int)$max]);
        }
        if (!empty($request->category)) {
            $product->where('id_category', $request->category);
        }
        if (!empty($request->brand)) {
            $product->where('id_brand', $request->brand);
        }
        if (!empty($request->status)) {
            $product->where('status', $request->status);
        }

        $product = $product->get();
        return view('frontend.dashboard.search', compact('product'));
    }

    public function slidesearchajax(Request $request)
    {
        $min = $request->min;
        $max = $request->max;
        $product = Product::whereBetween('price', [$min, $max])->get();

        //render=>biến view thành chuỗi HTML
        $html = view('frontend.dashboard.ajax', compact('product'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }



    public function searchajax(Request $request)
    {
        $data = $request->search;

        $product = Product::where('title', 'LIKE', "%{$data}%")->get();
        foreach ($product as $item) {
            $img = json_decode($item->image, true);
            $item->first = $img[0];
        }
        return response()->json(
            [
                'status' => 'success',
                'product' => $product,
            ]
        );
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
