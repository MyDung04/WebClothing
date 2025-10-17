@extends("frontend.layout.app")
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($cart))
                    <h2>Khong co san pham nao trong gio hang</h2>
                    @else
                    @foreach($cart as $item)
                    <tr>
                        <?php
                        $total = $item['quantity'] * $item['price'];
                        ?>
                        <input type="hidden" class="product_id" value="{{ $item['id'] }}">
                        <td class="cart_product">

                            <a href=""><img style="width: 100px; height: 100px;"
                                    src="{{ url('frontend/images/products/' . $item['image']) }}" alt=""></a>
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $item['title'] }}</a></h4>
                            <p>Web ID:<?php echo $item['id'] ?></p>
                        </td>
                        <td class="cart_price">
                            <p>{{$item['price']}}$</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{$item['quantity']}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$total}}$</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>

                    </tr>

                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>

                        <li>Total <span class="total_big">{{$total_big}}$</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{url('/member/checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->

@endsection
@section('zoom')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".cart_quantity_up").click(function(e) {
            e.preventDefault();
            var $qtyInput = $(this).closest('.cart_quantity_button').find(".cart_quantity_input");
            var $total = $(this).closest('.row').find(".total_big");
            var total_price = $(this).closest('tr').find(".cart_total_price");
            var id = $(this).closest('tr').find(".product_id").val();
            // var up = $qtyInput.val();
            // up++;

            // $(this).closest('.cart_quantity_button').find(".cart_quantity_input").val(up);
            // alert(id);
            $.ajax({
                type: 'POST',
                url: '{{ url("/member/dashboard/ajax") }}',

                data: {
                    id: id,
                    // quantity: up,
                },
                success: function(response) {
                    // alert(response.id);
                    if (response.status == 'success') {
                        $qtyInput.val(response.quantity);
                        total_price.text(response.total_price + '$');
                        $total.text(response.total_big + "$");

                    }

                },


            });
        })
        $(".cart_quantity_down").click(function(e) {
            e.preventDefault();
            var qtyInput = $(this).closest('.cart_quantity_button').find(".cart_quantity_input");
            var $total = $(this).closest('.row').find(".total_big");

            var total_price = $(this).closest('tr').find(".cart_total_price");
            var id = $(this).closest('tr').find(".product_id").val();
            var down = qtyInput.val();
            if (down >= 1) {
                $.ajax({
                    type: 'POST',
                    url: '{{ url("/member/dashboard/ajaxdown") }}',

                    data: {
                        id: id,
                        // quantity: down,
                    },
                    success: function(response) {
                        // alert(response.id);
                        if (response.status == 'success') {
                            qtyInput.val(response.quantity);
                            total_price.text(response.total_price + "$");
                            $total.text(response.total_big + "$");
                        }

                    },


                });
            } else {
                alert("Khong the giam duoc nua")
            }
            // down++;

            // $(this).closest('.cart_quantity_button').find(".cart_quantity_input").val(down);
            // alert(id);

        })
        $(".cart_quantity_delete").click(function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var id = $(this).closest('tr').find(".product_id").val();
            var total = $(this).closest('.row').find(".total_big");

            $.ajax({
                type: 'POST',
                url: '{{ url("/member/dashboard/ajaxdel") }}',

                data: {
                    id: id,
                    // quantity: down,
                },
                success: function(response) {
                    // alert(response.id);
                    if (response.status == 'success') {
                        row.remove();
                        total.text(response.total_big + "$");
                    }

                },


            });
        })
    })
</script>
@endsection