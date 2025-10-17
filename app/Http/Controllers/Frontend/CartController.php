<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Xuly()
    {
        $cart = session()->get('cart', []);
        $total_big = 0;
        $qty = 0;
        foreach ($cart as $item) {
            $total_big += $item['quantity'] * $item['price'];
        }
        return [
            'cart' => $cart,
            'total_big' => $total_big,
        ];
    }
    public function cart()
    {
        $data = $this->Xuly();
        $cart = $data['cart'];
        $total_big = $data['total_big'];
        return view("frontend.cart.cart", compact('cart', 'total_big'));
    }
    public function checkout()
    {
        $data = $this->Xuly();
        $cart = $data['cart'];
        $total_big = $data['total_big'];
        return view("frontend.cart.checkout", compact('cart', 'total_big'));
    }



    public function Postcheckout(Request $request)
    {
        if (!Auth::check()) {
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
            $user = User::create($data);
            // Auth::login($user);
        } else {
            $user = Auth::user();
        }
        $cart = session()->get('cart', []);
        $total_big = 0;
        foreach ($cart as $item) {
            $total_big += $item['quantity'] * $item['price'];
        }
        $data_order = [
            'id_user' => $user->id,
            'total' => $total_big,
        ];
        $order = Order::create($data_order);
        foreach ($cart as $item) {
            $orderdetail = [
                'id_order' => $order->id,
                'id_product' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],

            ];
            OrderDetail::create($orderdetail);
        }
        Mail::to("huynhmydung.17082004@gmail.com")->send(new ConfirmMail($user, $order, $cart));
        session()->forget('cart');

        return redirect()->route('member.dashboard')->with('success', 'Đặt hàng thành công!');
    }

    public function index()
    {
        //
        return view("frontend.cart.cart");
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