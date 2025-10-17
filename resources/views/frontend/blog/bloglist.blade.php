@extends("frontend.layout.app")

@section('content')


<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        @foreach($data as $bloglist)
        <div class="single-blog-post">
            <h3>{{ $bloglist->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
                <img src="{{ asset('images/blog/' . $bloglist->image) }}" alt="" width="300" height="200">
            </a>
            <p>{{$bloglist->description}}</p>
            <a class="btn btn-primary" href="{{ url('/member/blogdetail/'.$bloglist->id)}}">Read More</a>
        </div>

        @endforeach
        <p></p>
        {{$data->links('pagination::bootstrap-4')}}
    </div>
</div>
@endsection