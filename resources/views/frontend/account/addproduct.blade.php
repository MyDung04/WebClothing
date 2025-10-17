@extends('frontend.layout.app')
@section('content')

<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">ADD PRODUCT</h2>
        <div class="signup-form">
            <!--sign up form-->
            <h2>New Product Signup!</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Name" />
                <input type="number" name="price" placeholder="Price" />
                <!-- <label class="col-sm-12">Select Category</label> -->
                <select name="id_category" class="form-control form-control-line">
                    <option value="" disabled selected>Select category</option>
                    <!-- <option>London</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Canada</option>
                                                <option>Thailand</option>  -->
                    @foreach($id_category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <select name="id_brand" placeholder="select brand" class="form-control form-control-line">
                    <option value="" disabled selected>Select Brand</option>
                    @foreach($id_brand as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                    <!-- <option>London</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Canada</option>
                                                <option>Thailand</option>  -->
                </select>
                <select name="status" id="sale" class="form-control form-control-line">
                    <option disabled selected>Chọn trạng thái</option>
                    <option value="0">New</option>
                    <option value="1">Sale</option>
                </select>
                <input type="number" name="sale" class="hide" id="nhapsale" placeholder="Sale Price">
                <input type="text" name="company" placeholder="Company Profile" />

                <label for="files">Select files:</label>
                <input type="file" id="files" name="img[]" multiple><br><br>

                <textarea name="detail" placeholder="Detail" id=""></textarea>

                <button type="submit" class="btn btn-default">Signup</button>
                @if($errors->any())
                <div class="alert" style="color:red">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>



@endsection
@section('zoom')
<script>
    $(document).ready(function() {
        $('#sale').click(function() {
            var status = $(this).val();
            var saleInput = $(this).closest(".signup-form").find("#nhapsale");
            // alert("Status: " + status + "\nInput ID: " + $saleInput.attr('id'));
            if (status === "1") {
                saleInput.removeClass("hide").addClass("show");
            } else {
                saleInput.removeClass("show").addClass("hide");
            }
        });
    });
</script>
@endsection