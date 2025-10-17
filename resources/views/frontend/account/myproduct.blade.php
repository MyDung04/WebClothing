@extends('frontend.layout.app')
@section('content')

<div class="col-sm-9">
    <div class="table-responsive cart_info">
        @if($data->isEmpty())
        <h2>Khong co mat hang nao</h2>
        <button style="background-color: orange;"><a href="{{url('/member/addproduct')}}"> ADD
                PRODUCT</a></button>
        @else
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">image</td>
                    <td class="description">name</td>
                    <td class="price">price</td>

                    <td class="total">action</td>

                </tr>
            </thead>
            <tbody>

                @foreach($data as $product)
                <tr>
                    <td class="cart_product">
                        <a href=""><img
                                src="{{ asset('/frontend/images/products/'.$product->id_user.'/'.json_decode($product->image, true)[0])}}"
                                alt="" style="width: 100px; height:100px;"></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$product->title}}</a></h4>

                    </td>
                    <td class="cart_price">
                        <p>{{$product->price}}</p>
                    </td>

                    <td class="cart_total">
                        <a href="{{url('member/editproduct/'.$product->id)}}">Edit </a>
                        <a href="{{url('member/deleteproduct/'.$product->id)}}">Delete </a>
                    </td>

                </tr>

                @endforeach



            </tbody>
        </table>
        <button style="background-color: orange;"><a href="{{url('/member/addproduct')}}"> ADD
                PRODUCT</a></button>
        @endif

        @if(session('success'))
        <div class="alert">
            {{session('success')}}
        </div>
        @endif
    </div>
</div>

@endsection