@extends('frontend.layout.app')
@section('content')

<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">EDIT PRODUCT</h2>
        <div class="signup-form">
            <!--sign up form-->
            <h2>New Product Signup!</h2>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" value="{{$product->title}}" />
                <input type="number" name="price" value="{{$product->price}}" />
                <select name="id_category" class="form-control form-control-line">
                    @foreach($id_category as $item)
                    <option value="{{ $item->id }}" {{ $product->id_category == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
                <select name="id_brand" placeholder="select brand" class="form-control form-control-line">

                    @foreach($id_brand as $item)
                    <option value="{{ $item->id }}" {{$product->id_brand == $item->id ? 'selected': ''}}>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
                <select name="status" id="sale" class="form-control form-control-line">
                    <option value="0" {{$product->status == 0 ? 'selected': ''}}>New</option>
                    <option value="1" {{$product->status == 1 ? 'selected': ''}}>Sale</option>
                </select>
                <input type="number" name="sale" class="hide" id="nhapsale" value="{{$product->sale}}">
                <input type="text" name="company" value="{{$product->company}}" />

                <label for="files">Select files:</label>
                <input type="file" id="files" name="img[]" multiple><br><br>

                <div class="img" style="display: flex; gap: 200px; margin-left:10px">
                    @foreach($image as $img)
                    <img src="{{ asset('/frontend/images/products/'.$img)}}" style="width: 100px; height:100px;">
                    @endforeach
                </div>
                <div class="checkbox-row" style="display: flex;">
                    @foreach($image as $img)
                    <input type="checkbox" name="hinhxoa[]" value="{{ $img }}">
                    @endforeach
                </div>

        </div>
        <textarea name="detail" value="{{$product->detail}}" id="">{{$product->detail}}</textarea>

        <button type="submit" class="btn btn-default">Signup</button>
        @if($errors->any())
        <div class="alert">
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


@endsection

@section('zoom')
<script>
    $(document).ready(function() {
        var saleInput = $("#nhapsale");
        alert($("#sale").val());
        if ($("#sale").val() == "1") {
            saleInput.removeClass("hide").addClass("show");
        } else {
            saleInput.removeClass("show").addClass("hide");
        }

        $("#sale").click(function() {
            var status = $(this).val();
            if (status == "1") {
                saleInput.removeClass("hide").addClass("show");
            } else {
                saleInput.removeClass("show").addClass("hide");
            }
        });
    });
</script>
@endsection