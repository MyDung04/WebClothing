@extends("frontend.layout.app")
@section('content')

<div class="col-sm-9 padding-right">
    <div class="features_items">
        <h2 class="title text-center">Search Results</h2>

        @foreach($product as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ asset('/frontend/images/products/'.$item->id_user.'/'.json_decode($item->image, true)[0]) }}"
                            alt="{{ $item->title }}" />
                        <h2>{{ $item->price }}</h2>
                        <p>{{ $item->title }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection