@extends("frontend.layout.app")
@section('content')



<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        <div class="search">
            <div class="find_box ">
                <input type="text" class="search" placeholder="Name" />
                <input type="text" class="price" placeholder="Choose Price" />
            </div>
        </div>
        @foreach($product as $product)

        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <!-- <div class="id_product " val="{{$product->id}}"></div> -->
                    <input type="hidden" class="id_product" value="{{$product->id}}">
                    <div class="productinfo text-center">
                        <img src="{{ asset('/frontend/images/products/'.$product->id_user.'/'.json_decode($product->image, true)[0])}}"
                            alt="" />
                        <h2>{{$product->price}}</h2>
                        <p>{{$product->title}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class=" overlay-content">
                            <h2>{{$product->price}}</h2>
                            <p>{{$product->name}}</p>
                            <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{url('member/product/detail/'.$product->id)}}"><i
                                    class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach


    </div>
    <!--features_items-->



</div>


@endsection
@section('zoom')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".add-to-cart").click(function(e) {
            e.preventDefault();
            var id = $(this).closest(".product-image-wrapper").find(".id_product").val();
            alert(id);

            $.ajax({
                type: 'post',
                url: '{{ url("/member/dashboard/ajax") }}',
                data: {
                    id: id,
                },
                success: function(response) {
                    console.log(response);
                    // alert(response.id);
                    if (response.status == 'success') {
                        $(".cart_quantity").text(response.total);
                    }
                },
            })
        });
    })
</script>
@endsection